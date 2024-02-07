<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Command;

use Nextstore\SyliusDropshippingCorePlugin\Factory\Currency\ExchangeRateFactory;
use Nextstore\SyliusDropshippingCorePlugin\Factory\Currency\ExchangeRateLogFactory;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\Config;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Nextstore\SyliusDropshippingCorePlugin\Repository\Currency\ExchangeRateRepository;
use Sylius\Component\Currency\Model\ExchangeRateInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Webmozart\Assert\Assert;

class UpdateExchangeRateCommand extends Command
{
    protected static $defaultName = 'nextstore:update-exchange-rate';

    protected static $serviceUrl = 'https://continentl.com/api/currency-exchange';

    /** @var Client */
    private $client;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ExchangeRateLogFactory $exchangeRateLogFactory,
        private ExchangeRateFactory $exchangeRateFactory,
        private ExchangeRateRepository $exchangeRateRepository,
        private ParameterBag $parameterBag
    ) {
        parent::__construct();
        $this->client = new Client();
    }

    protected function configure()
    {
        $this
            ->setDescription('Updates exchange rates')
            ->setHelp('This command allows you to update exchange rates')
            ->addArgument('sourceCurrency', InputOption::VALUE_REQUIRED)
            ->addArgument('targetCurrency', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sourceCurrencyCode = $input->getArgument('sourceCurrency');
        $targetCurrencyCode = $input->getArgument('targetCurrency');

        $key = $this->parameterBag->get('currency_api_key');
        $url = self::$serviceUrl .  '?key=' . $key . '&base=' . $sourceCurrencyCode . '&foreign=' . $targetCurrencyCode;

        $sourceCurrency = $this->entityManager->getRepository(CurrencyInterface::class)->findOneBy(['code' => $sourceCurrencyCode]);
        $targetCurrency = $this->entityManager->getRepository(CurrencyInterface::class)->findOneBy(['code' => $targetCurrencyCode]);
        Assert::isInstanceOf(
            $targetCurrency,
            CurrencyInterface::class,
            'Couldn\t find currency with code ' . $targetCurrencyCode . ' in your Currency list. Create one or choose one you have'
        );
        Assert::isInstanceOf(
            $sourceCurrency,
            CurrencyInterface::class,
            'Couldn\t find currency with code ' . $sourceCurrencyCode . ' in your Currency list. Create one or choose one you have'
        );

        try {
            $response = $this->client->get($url);
            $xrates = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $output->write($e->getMessage());
        }

        $exchangeRate = $this->exchangeRateRepository->findOneBySourceAndTarget($xrates['base']['code'], $xrates['foreign']["code"]);
        $addedRateFeeConfig = $this->entityManager->getRepository(Config::class)->findOneBy(['code' => Config::CURRENCY_RATE]);

        $addedRateFee = 0;
        if ($addedRateFeeConfig instanceof Config) {
            $addedRateFee = $addedRateFeeConfig->getValue();
        }

        $rate = (float) $xrates['foreign']['amount'] + (float) $addedRateFee;

        if (!$exchangeRate instanceof ExchangeRateInterface) {
            $exchangeRate = $this->exchangeRateFactory->createWithTarget($xrates['foreign']['code'], $xrates['base']['code'], $rate);
            $this->entityManager->persist($exchangeRate);
        } else {
            $exchangeRate->setRatio($rate);
            $exchangeRate->setUpdatedAt(new \DateTime());
        }
        $this->exchangeRateLogFactory->writeLog($exchangeRate->getTargetCurrency(), $exchangeRate->getSourceCurrency(), $exchangeRate->getRatio());

        $this->entityManager->flush();
        $output->write('Exchange rates updated.');

        return 0;
    }
}
