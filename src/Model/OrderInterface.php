<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\OrderItemInterface as BaseOrderItemInterface;

interface OrderInterface extends BaseOrderItemInterface
{
    public function getOtOrderId(): ?string;

    public function setOtOrderId(?string $otOrderId): void;
}
