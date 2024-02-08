<?php

declare(strict_types=1);

namespace Tests\Nextstore\SyliusDropshippingCorePlugin\Application\src\Entity\Order;

use Nextstore\SyliusDropshippingCorePlugin\Model\OrderItemInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\OrderItemTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\OrderItem as BaseOrderItem;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_order_item")
 */
class OrderItem extends BaseOrderItem implements OrderItemInterface
{
    use OrderItemTrait;
}
