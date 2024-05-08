<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\OrderInterface as BaseOrderInterface;

interface OrderInterface extends BaseOrderInterface
{
    public function getOtOrderId(): ?string;

    public function setOtOrderId(?string $otOrderId): void;
}
