<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Model;

trait OrderTrait
{

    /** @ORM\Column(type="string", nullable=true, name="ot_order_id") */
    private $otOrderId;

    public function getOtOrderId(): ?string
    {
        return $this->otOrderId();
    }

    public function setOtOrderId(?string $otOrderId): void
    {
        $this->otOrderId = $otOrderId;
    }
}
