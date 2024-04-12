<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Service;

use Nextstore\SyliusDropshippingCorePlugin\Exception\FailedToAddToCartException;
use Nextstore\SyliusDropshippingCorePlugin\Factory\Order\OrderItemFactory;
use Nextstore\SyliusDropshippingCorePlugin\Factory\Product\ProductFactory;
use Nextstore\SyliusDropshippingCorePlugin\Validator\ValidatorOrderItem;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Core\Model\Order;

class OrderItemService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorOrderItem $validatorOrderItem,
        private ProductFactory $productFactory,
        private OrderItemFactory $orderItemFactory,
    ) {
    }

    /**
     * @param array<int,mixed> $params
     */
    public function addToCartManually(Order $cart, array $params): Order
    {
        try {
            $this->validatorOrderItem->validateAddToCartManually($params);

            $product = $this->productFactory->createProductManually($params, 'manual');

            $order = $this->orderItemFactory->createManually($product, $cart, $params);

            return $order;
        } catch (\Exception $e) {
            throw new FailedToAddToCartException($e->getMessage(), $e->getCode());
        }
    }
}
