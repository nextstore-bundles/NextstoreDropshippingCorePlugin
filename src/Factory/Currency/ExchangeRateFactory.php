<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Currency;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Currency\Model\CurrencyInterface;
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

    public function createWithTarget(string $targetCode, string $code, float $ratio)
    {
        $rate = $this->decoratedFactory->createNew();

        $target = $this->entityManager->getRepository(CurrencyInterface::class)->findOneBy(['code' => $targetCode]);
        $source = $this->entityManager->getRepository(CurrencyInterface::class)->findOneBy(['code' => $code]);

        if (!$target instanceof CurrencyInterface) {
            throw new CurrencyNotFoundException($targetCode . ' target Currency not found');
        }
        if (!$source instanceof CurrencyInterface) {
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
