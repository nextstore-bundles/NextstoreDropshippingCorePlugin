<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait BrandTrait
{
    /** @ORM\Column(type="string", nullable=true, name="external_id") */
    private ?string $externalId;

    /** @ORM\Column(type="string", nullable=true, name="provider_type") */
    private ?string $providerType;

    /** @ORM\Column(type="string", nullable=true, name="picture_url") */
    private ?string $pictureUrl;

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function getProviderType(): ?string
    {
        return $this->providerType;
    }

    public function setProviderType(?string $providerType): void
    {
        $this->providerType = $providerType;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): void
    {
        $this->pictureUrl = $pictureUrl;
    }
}
