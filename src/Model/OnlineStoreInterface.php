<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Addressing\Model\CountryInterface;

interface OnlineStoreInterface extends ResourceInterface
{
    public function getWebUrl(): string;

    public function setWebUrl(string $webUrl): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getLogo(): ?string;

    public function setLogo(?string $logo): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    public function getCreatedAt(): \DateTime;

    public function setCreatedAt(\DateTime $createdAt): void;

    public function getCountry(): ?CountryInterface;

    public function setCountry(?CountryInterface $country): void;

    public function getPosition(): ?int;

    public function setPosition(?int $position): void;
}
