<?php

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Addressing\Model\CountryInterface;

class OnlineStore implements OnlineStoreInterface
{
    protected ?int $id = null;

    private string $webUrl;

    private string $name;

    private ?string $logo;

    private ?string $description;

    /** @var \DateTime  */
    private $createdAt;

    private ?CountryInterface $country;

    private ?int $position;

    public function __construct()
    {
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    // public function getLogoFile()
    // {
    //     return $this->logoFile;
    // }
    //
    // public function setLogoFile(?File $logoFile): void
    // {
    //     $this->logoFile = $logoFile;
    // }

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

    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }

    public function setCountry(?CountryInterface $country): void
    {
        $this->country = $country;
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
