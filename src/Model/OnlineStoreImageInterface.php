<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\ImageInterface;

interface OnlineStoreImageInterface extends ImageInterface
{
    /**
     * @return OnlineStoreInterface|null
     */
    public function getOnlineStore(): ?OnlineStoreInterface;

    /**
     * @param OnlineStoreInterface|null $onlineStore
     */
    public function setOnlineStore(?OnlineStoreInterface $onlineStore): void;
}
