<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Repository\Currency;

use Sylius\Bundle\CurrencyBundle\Doctrine\ORM\ExchangeRateRepository as BaseExchangeRateRepository;
use Sylius\Component\Currency\Model\ExchangeRateInterface;

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

    public function findOneBySourceAndTarget(string $firstCurrencyCode, string $secondCurrencyCode): ?ExchangeRateInterface
    {
        $expr = $this->getEntityManager()->getExpressionBuilder();

        return $this->createQueryBuilder('o')
            ->addSelect('sourceCurrency')
            ->addSelect('targetCurrency')
            ->innerJoin('o.sourceCurrency', 'sourceCurrency')
            ->innerJoin('o.targetCurrency', 'targetCurrency')
            ->andWhere(
                'sourceCurrency.code = :firstCurrency AND targetCurrency.code = :secondCurrency',
            )
            ->setParameter('firstCurrency', $firstCurrencyCode)
            ->setParameter('secondCurrency', $secondCurrencyCode)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
