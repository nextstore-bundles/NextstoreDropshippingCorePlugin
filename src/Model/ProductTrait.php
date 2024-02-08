<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait ProductTrait
{
    /** @ORM\Colum(type="string", nullable=true) */
    private $externalVendorId;

    public function getExternalVendorId(): ?string
    {
        return $this->externalVendorId;
    }

    public function setExternalVendorId(?string $externalVendorId): void
    {
        $this->externalVendorId = $externalVendorId;
    }
}
