<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\Image;

class OnlineStoreImage extends Image implements OnlineStoreImageInterface
{
    public const TYPE_LOGO = 'logo';

    public function isLogo(): bool
    {
        return $this->getType() === self::TYPE_LOGO;
    }

    /**
     * {@inheritdoc}
     */
    public function getOnlineStore(): ?OnlineStoreInterface
    {
        /** @var OnlineStoreInterface|null $onlineStore */
        $onlineStore= $this->getOwner();

        return $onlineStore;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnlineStore(?OnlineStoreInterface $onlineStore): void
    {
        $this->setOwner($onlineStore);
    }
}
