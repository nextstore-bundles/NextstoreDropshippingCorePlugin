<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Order;

use Nextstore\SyliusDropshippingCorePlugin\Model\OrderItemInterface as NextstoreOrderItemInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Factory\CartItemFactoryInterface;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\OrderItemUnit;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariant;

class OrderItemFactory implements CartItemFactoryInterface
{
    public function __construct(
        private CartItemFactoryInterface $decoratedFactory,
        private EntityManagerInterface $em,
        private ChannelContextInterface $channelContext,
    ) {
    }

    public function createNew(): NextstoreOrderItemInterface
    {
        return $this->decoratedFactory->createNew();
    }

    public function createForProduct(ProductInterface $product): OrderItemInterface
    {
        return $this->decoratedFactory->createForProduct($product);
    }

    public function createForCart(OrderInterface $order): OrderItemInterface
    {
        return $this->decoratedFactory->createForCart($order);
    }

    public function createManually(ProductInterface $product, Order $order, ?array $array): Order
    {
        /** @var NextstoreOrderItemInterface $orderItem */
        $orderItem = $this->createForProduct($product);
        /** @var ProductVariant $variant */
        $variant = $product->getVariants()[0];
        $channel = $this->channelContext->getChannel();

        array_key_exists('color', $array) && $orderItem->setColor($array['color']);
        array_key_exists('size', $array) && $orderItem->setSize($array['size']);
        array_key_exists('description', $array) && $orderItem->setDescription($array['description']);
        $orderItem->setVariant($variant);
        $orderItem->setVariantName($variant->getName());
        $orderItem->setProductName($variant->getProduct()->getName());
        $orderItem->setUnitPrice($variant->getChannelPricingForChannel($channel)->getPrice());
        $orderItem->setOriginalUnitPrice($variant->getChannelPricingForChannel($channel)->getOriginalPrice());

        for ($i = 0; (int) $array['quantity'] > $i; ++$i) {
            $unit = new OrderItemUnit($orderItem);
            $orderItem->addUnit($unit);

            $this->em->persist($unit);
        }

        $order->addItem($orderItem);

        $this->em->persist($orderItem);
        $this->em->flush();

        return $order;
    }
}
