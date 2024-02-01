<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Repository\Currency;

use Sylius\Bundle\CurrencyBundle\Doctrine\ORM\ExchangeRateRepository as BaseExchangeRateRepository;

class ExchangeRateRepository extends BaseExchangeRateRepository
{
    public function findBySourceCode(string $code)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.sourceCurrency', 's')
            ->andWhere('s.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
