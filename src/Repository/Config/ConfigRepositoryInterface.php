<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Repository\Config;

use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ConfigRepositoryInterface extends RepositoryInterface
{
    public function getAllowedWebSites();
}
