<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait OrderTrait
{

    /** @ORM\Column(type="string", nullable=true, name="taobao_order_id") */
    private $taobaoOrderId;

    /** @ORM\Column(type="string", nullable=true, name="alibaba1688_order_id") */
    private $alibaba1688OrderId;

    public function getTaobaoOrderId(): ?string
    {
        return $this->taobaoOrderId;
    }

    public function setTaobaoOrderId(?string $taobaoOrderId): void
    {
        $this->taobaoOrderId = $taobaoOrderId;
    }

    public function getAlibaba1688OrderId(): ?string
    {
        return $this->alibaba1688OrderId;
    }

    public function setAlibaba1688OrderId(?string $alibaba1688OrderId): void
    {
        $this->alibaba1688OrderId = $alibaba1688OrderId;
    }
}
