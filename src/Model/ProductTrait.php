<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait ProductTrait
{
    /** @ORM\Column(type="string", nullable=true, name="external_vendor_id") */
    private ?string $externalVendorId;

    public function getExternalVendorId(): ?string
    {
        return $this->externalVendorId;
    }

    public function setExternalVendorId(?string $externalVendorId): void
    {
        $this->externalVendorId = $externalVendorId;
    }
}
