<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Nextstore\SyliusDropshippingCorePlugin\Model\ExchangeRateLogInterface;
use Sylius\Component\Currency\Model\CurrencyInterface;

class ExchangeRateLog implements ExchangeRateLogInterface
{
    protected ?int $id = null;

    // /** @ORM\Column(type="decimal", precision=10, scale=5, nullable=false) */
    private float $ratio;

    private \DateTime $createdAt;

    protected CurrencyInterface $sourceCurrency;

    protected CurrencyInterface $targetCurrency;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRatio(): ?float
    {
        return is_string($this->ratio) ? (float) $this->ratio : $this->ratio;
    }

    public function setRatio(float $ratio): self
    {
        $this->ratio = $ratio;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getSourceCurrency(): ?CurrencyInterface
    {
        return $this->sourceCurrency;
    }

    public function setSourceCurrency(CurrencyInterface $currency): void
    {
        $this->sourceCurrency = $currency;
    }

    public function getTargetCurrency(): ?CurrencyInterface
    {
        return $this->targetCurrency;
    }

    public function setTargetCurrency(CurrencyInterface $currency): void
    {
        $this->targetCurrency = $currency;
    }
}
