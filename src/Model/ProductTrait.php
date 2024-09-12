<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait ProductTrait
{
    /** @ORM\Column(type="string", nullable=true, name="external_vendor_id") */
    private ?string $externalVendorId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, name="external_product_id")
     */
    private $externalProductId;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="web_url")
     */
    private $webUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, name="product_type", options={"default": "simple"})
     */
    private $productType = ProductInterface::TYPE_SIMPLE;


    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="image_url")
     */
    private $imageUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, name="provider_type")
     */
    private $providerType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, name="order_type")
     */
    private $orderType;

    public function getExternalVendorId(): ?string
    {
        return $this->externalVendorId;
    }

    public function setExternalVendorId(?string $externalVendorId): void
    {
        $this->externalVendorId = $externalVendorId;
    }

    public function getWebUrl(): ?string
    {
        return $this->webUrl;
    }

    public function setWebUrl(string $webUrl): void
    {
        $this->webUrl = $webUrl;
    }

    public function getExternalProductId(): ?string
    {
        return $this->externalProductId;
    }

    public function setExternalProductId(?string $externalProductId): void
    {
        $this->externalProductId = $externalProductId;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    public function setProductType(string $productType): void
    {
        $this->productType = $productType;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getProviderType(): ?string
    {
        return $this->providerType;
    }

    public function setProviderType(string $providerType): void
    {
        $this->providerType = $providerType;
    }

    public function getOrderType(): ?string
    {
        return $this->providerType;
    }

    public function setOrderType(string $providerType): void
    {
        $this->providerType = $providerType;
    }
}
