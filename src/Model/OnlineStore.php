<?php

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

class OnlineStore implements OnlineStoreInterface
{
    use ImagesAwareTrait {
        ImagesAwareTrait::__construct as private __imagesAwareTraitConstruct;
    }

    protected ?int $id = null;

    private string $webUrl;

    private string $name;

    private string $code;

    private ?string $description;

    /** @var \DateTime  */
    private $createdAt;

    private ?string $countryCode;

    private ?int $position;

    public function __construct()
    {
        $this->__imagesAwareTraitConstruct();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function setWebUrl(string $webUrl): void
    {
        $this->webUrl = $webUrl;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }
}
