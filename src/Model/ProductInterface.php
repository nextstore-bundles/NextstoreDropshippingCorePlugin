<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\ProductInterface as BaseProductInterface;

interface ProductInterface extends BaseProductInterface
{
    public function getExternalVendorId(): ?string;

    public function setExternalVendorId(?string $externalVendorId): void;

    public function getWebUrl(): ?string;

    public function setWebUrl(string $webUrl): void;

    public function getExternalProductId(): ?string;

    public function setExternalProductId(?string $externalProductId): void;
}
