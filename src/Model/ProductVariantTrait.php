<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait ProductVariantTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="image_url")
     */
    private $imageUrl;

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }
}
