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

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true, name="price_ot")
     */
    private $priceOt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true, name="original_price_ot")
     */
    private $originalPriceOt;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true, name="tmall", options={"default": 0})
     */
    private $tmall = false;

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
        return $this->orderType;
    }

    public function setOrderType(string $orderType): void
    {
        $this->orderType = $orderType;
    }

    public function getPriceOt(): ?int
    {
        return $this->priceOt;
    }

    public function setPriceOt(?int $priceOt): void
    {
        $this->priceOt = $priceOt;
    }

    public function getOriginalPriceOt(): ?int
    {
        return $this->originalPriceOt;
    }

    public function setOriginalPriceOt(?int $originalPriceOt): void
    {
        $this->originalPriceOt = $originalPriceOt;
    }

    public function getTmall(): ?bool
    {
        return $this->tmall;
    }

    public function setTmall(?bool $tmall): void
    {
        $this->tmall = (bool) $tmall;
    }
}
