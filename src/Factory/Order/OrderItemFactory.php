<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Order;

use Nextstore\SyliusDropshippingCorePlugin\Model\OrderItemInterface as NextstoreOrderItemInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Factory\CartItemFactoryInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariant;
use Sylius\Component\Order\Factory\OrderItemUnitFactoryInterface;

class OrderItemFactory implements CartItemFactoryInterface
{
    public function __construct(
        private CartItemFactoryInterface $decoratedFactory,
        private EntityManagerInterface $em,
        private ChannelContextInterface $channelContext,
        private OrderItemUnitFactoryInterface $orderItemUnitFactory,
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

    public function createManually(ProductInterface $product, OrderInterface $order, ?array $array): OrderInterface
    {
        /** @var NextstoreOrderItemInterface $orderItem */
        $orderItem = $this->createForCart($order);
        /** @var ProductVariant $variant */
        $variant = $product->getVariants()[0];
        $orderItem->setVariant($variant);

        array_key_exists('color', $array) && $orderItem->setColor($array['color']);
        array_key_exists('size', $array) && $orderItem->setSize($array['size']);
        array_key_exists('description', $array) && $orderItem->setDescription($array['description']);
        array_key_exists('externalProductCode', $array) && $orderItem->setExternalProductCode($array['externalProductCode']);
        $orderItem->setVariant($variant);
        $orderItem->setVariantName($variant->getName());
        $orderItem->setProductName($variant->getProduct()->getName());
        $orderItem->setUnitPrice((int) $array['price'] * 100);
        $orderItem->setOriginalUnitPrice((int) $array['price'] * 100);

        for ($i = 0; (int) $array['quantity'] > $i; ++$i) {
            $unit = $this->orderItemUnitFactory->createForItem($orderItem);

            $this->em->persist($unit);
        }
        $this->em->persist($orderItem);
        $this->em->flush();

        return $order;
    }
}
