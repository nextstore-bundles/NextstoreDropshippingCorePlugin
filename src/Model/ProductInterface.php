<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\ProductInterface as BaseProductInterface;

interface ProductInterface extends BaseProductInterface
{
    public const TYPE_SIMPLE = 'simple';
    public const TYPE_MANUAl = 'manual';
    public const ORDER_TYPE_READY = 'ready';
    public const ORDER_TYPE_ORDER = 'order';

    public function getExternalVendorId(): ?string;

    public function setExternalVendorId(?string $externalVendorId): void;

    public function getWebUrl(): ?string;

    public function setWebUrl(string $webUrl): void;

    public function getExternalProductId(): ?string;

    public function setExternalProductId(?string $externalProductId): void;

    public function getProductType(): string;

    public function setProductType(string $productType): void;

    public function getImageUrl(): ?string;

    public function setImageUrl(string $imageUrl): void;

    public function getProviderType(): ?string;

    public function setProviderType(string $providerType): void;

    public function getOrderType(): ?string;

    public function setOrderType(string $orderType): void;
}
