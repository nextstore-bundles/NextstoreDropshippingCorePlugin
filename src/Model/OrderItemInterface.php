<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\OrderItemInterface as BaseOrderItemInterface;

interface OrderItemInterface extends BaseOrderItemInterface
{
    public const STATE_NEW = 'new';

    public function getState(): ?string;

    public function setState(?string $state): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getColor(): ?string;

    public function setColor(?string $color): void;

    public function getSize(): ?string;

    public function setSize(?string $size): void;

    public function getTrackingCode(): ?string;

    public function setTrackingCode(?string $trackingCode): void;

    public function getExternalProductCode(): ?string;

    public function setExternalProductCode(?string $externalProductCode): void;

    public function getWebUrl(): ?string;

    public function setWebUrl(string $webUrl): void;

    public function getPromotionId(): ?string;

    public function setPromotion(string $promotionId): void;
}
