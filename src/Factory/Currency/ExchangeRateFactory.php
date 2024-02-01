<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Currency;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Context\CurrencyNotFoundException;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ExchangeRateFactory implements FactoryInterface
{

    public function __construct(
        private FactoryInterface $decoratedFactory,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function createNew()
    {
        return $this->decoratedFactory->createNew();
    }

    public function createWithTarget(string $code, float $ratio)
    {
        $rate = $this->decoratedFactory->createNew();

        $target = $this->entityManager->getRepository(Currency::class)->findOneBy(['code' => 'MNT']);
        $source = $this->entityManager->getRepository(Currency::class)->findOneBy(['code' => $code]);

        if (!$target instanceof Currency) {
            throw new CurrencyNotFoundException('MNT target Currency not found');
        }
        if (!$source instanceof Currency) {
            throw new CurrencyNotFoundException($code . ' source Currency not found');
        }

        $rate->setTargetCurrency($target);
        $rate->setSourceCurrency($source);
        $rate->setRatio($ratio);

        $this->entityManager->persist($rate);
        $this->entityManager->flush();

        return $rate;
    }
}
