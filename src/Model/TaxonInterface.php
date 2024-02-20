<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Core\Model\TaxonInterface as BaseTaxonInterface;

interface TaxonInterface extends BaseTaxonInterface
{
    public function getExternalId(): ?string;

    public function setExternalId(?string $externalId): void;

    public function getProviderType(): ?string;

    public function setProviderType(?string $providerType): void;
}
