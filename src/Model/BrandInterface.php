<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Loevgaard\SyliusBrandPlugin\Model\BrandInterface as BaseBrandInterface;

interface BrandInterface extends BaseBrandInterface
{
    public const PROVIDER_TAOBAO = 'taobao';

    public function getExternalId(): ?string;

    public function setExternalId(?string $externalId): void;

    public function getProviderType(): ?string;

    public function setProviderType(?string $providerType): void;

    public function getPictureUrl(): ?string;

    public function setPictureUrl(?string $pictureUrl): void;
}
