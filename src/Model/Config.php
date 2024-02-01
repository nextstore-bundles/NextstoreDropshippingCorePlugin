<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

use Nextstore\SyliusDropshippingCorePlugin\Model\ConfigInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class Config implements ConfigInterface
{
    use TimestampableTrait;

    public const ALLOWED_WEBSITES = 'allowed_website';
    public const SERVICE_FEE = 'service_fee';
    public const CURRENCY_RATE = 'currency_rate';
    public const COMMISSION = 'commission_percentage';

    protected ?int $id = null;

    private ?string $code;

    private ?string $name;

    private string $value;

    private ?string $content;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
