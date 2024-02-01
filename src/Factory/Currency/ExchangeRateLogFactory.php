<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Currency;

use Doctrine\ORM\EntityManagerInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\ExchangeRateLogInterface;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ExchangeRateLogFactory implements FactoryInterface
{
    public function __construct(
        private FactoryInterface $decoratedFactory,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function createNew(): ExchangeRateLogInterface
    {
        return $this->decoratedFactory->createNew();
    }

    public function writeLog(CurrencyInterface $target, CurrencyInterface $source, float $ratio): ExchangeRateLogInterface
    {
        $log = $this->createNew();

        $log->setTargetCurrency($target);
        $log->setSourceCurrency($source);
        $log->setRatio($ratio);

        $this->entityManager->persist($log);
        $this->entityManager->flush();

        return $log;
    }
}
