<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Repository\Config;

use Nextstore\SyliusDropshippingCorePlugin\Model\Config;
use Nextstore\SyliusDropshippingCorePlugin\Repository\Config\ConfigRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class ConfigRepository extends EntityRepository implements ConfigRepositoryInterface
{
    public function getAllowedWebSites()
    {
        $result = $this->createQueryBuilder('c')
            ->select('c.value as site')
            ->andWhere('c.code = :code')
            ->setParameter('code', Config::ALLOWED_WEBSITES)
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'site');
    }
}
