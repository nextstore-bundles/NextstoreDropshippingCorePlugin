<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ExchangeRateLogInterface extends ResourceInterface
{
    public function getRatio(): ?float;

    public function setRatio(float $ratio): self;

    public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt(?\DateTimeInterface $createdAt): void;

    public function getSourceCurrency(): ?CurrencyInterface;

    public function setSourceCurrency(CurrencyInterface $currency): void;

    public function getTargetCurrency(): ?CurrencyInterface;

    public function setTargetCurrency(CurrencyInterface $currency): void;
}
