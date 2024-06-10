<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\OrderInterface as BaseOrderInterface;

interface OrderInterface extends BaseOrderInterface
{
    public function getTaobaoOrderId(): ?string;

    public function setTaobaoOrderId(?string $taobaoOrderId): void;

    public function getAlibaba1688OrderId(): ?string;

    public function setAlibaba1688OrderId(?string $alibaba1688OrderId): void;
}
