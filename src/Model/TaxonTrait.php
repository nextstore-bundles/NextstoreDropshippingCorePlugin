<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait ProductTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, name="external_id")
     */
    private $externalId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, name="provider_type")
     */
    private $providerType = ProductInterface::TYPE_SIMPLE;

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
}
