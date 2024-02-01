<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Command;

use Nextstore\SyliusDropshippingCorePlugin\Factory\Currency\ExchangeRateFactory;
use Nextstore\SyliusDropshippingCorePlugin\Factory\Currency\ExchangeRateLogFactory;
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Model\ExchangeRate;
use Nextstore\SyliusDropshippingCorePlugin\Entity\Config\Config;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateExchangeRateCommand extends Command
{
    protected static $defaultName = 'app:update-rate';

    protected static $serviceUrl = 'http://monxansh.appspot.com/xansh.json?currency=';

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ExchangeRateLogFactory */
    private $exchangeRateLogFactory;

    /** @var ExchangeRateFactory */
    private $exchangeRateFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        ExchangeRateLogFactory $exchangeRateLogFactory,
        ExchangeRateFactory $exchangeRateFactory,
    ) {
        $this->entityManager = $entityManager;
        $this->exchangeRateLogFactory = $exchangeRateLogFactory;
        $this->exchangeRateFactory = $exchangeRateFactory;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Updates exchange rates')
            ->setHelp('This command allows you to update exchange rates')
            ->addArgument('currencies', InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $currencies = $input->getArgument('currencies');

        if (count($currencies) == 0) {
            $output->write('Please provide Currency code');

            return 0;
        }
        $url = self::$serviceUrl;
        foreach ($currencies as $currency) {
            $cr = $this->entityManager->getRepository(Currency::class)->findOneBy(['code' => $currency]);
            if (!$cr instanceof Currency) {
                $output->write('Couldn\t find currency with code ' . $currency . ' in your Currency list. Create one or choose one you have');

                return 0;
            }
            $url .= $currency . '||';
        }
        $xrates = file_get_contents($url);
        $xrates = json_decode($xrates);

        foreach ($xrates as $xrate) {
            $exchangeRate = $this->entityManager->getRepository(ExchangeRate::class)->findBySourceCode($xrate->code);
            $addedRateFee = $this->entityManager->getRepository(Config::class)->findOneBy(['code' => Config::CURRENCY_RATE]);
            $rate = (float) $xrate->rate_float + (float) $addedRateFee->getValue();

            if (!$exchangeRate instanceof ExchangeRate) {
                $exchangeRate = $this->exchangeRateFactory->createWithTarget($xrate->code, $rate);
                $this->entityManager->persist($exchangeRate);
            } else {
                $exchangeRate->setRatio($rate);
                $exchangeRate->setUpdatedAt(new \DateTime());
            }
            $log = $this->exchangeRateLogFactory->writeLog($exchangeRate->getTargetCurrency(), $exchangeRate->getSourceCurrency(), $exchangeRate->getRatio());
        }

        $this->entityManager->flush();
        $output->write('Exchange rates updated.');

        return 0;
    }
}
