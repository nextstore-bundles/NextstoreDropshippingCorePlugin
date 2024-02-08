<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Controller\Api\Action;

use Nextstore\SyliusDropshippingCorePlugin\Exception\FailedToAddToCartException;
use Nextstore\SyliusDropshippingCorePlugin\Service\OrderItemService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sylius\Component\Core\Model\Order;
use Sylius\Component\Order\Context\CartNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AddToCartManuallyAction extends AbstractController
{
    public function __construct(
        private OrderItemService $orderItemService,
        private EntityManagerInterface $em,
        private NormalizerInterface $normalizer,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        if ($request->request->all()) {
            $params = $request->request->all();
        } else {
            $params = json_decode($request->getContent(), true);
        }

        $token = $request->attributes->get('token');
        $cart = $this->em->getRepository(Order::class)->findOneBy(['tokenValue' => $token, 'state' => Order::STATE_CART]);
        if (!$cart instanceof Order) {
            throw new CartNotFoundException();
        }

        try {
            $order = $this->orderItemService->addToCartManually($cart, $params);
            $res = $this->normalizer->normalize($order, null, ['groups' => 'shop:cart:read']);

            return new JsonResponse($res);
        } catch (Exception $e) {
            throw new FailedToAddToCartException($e->getMessage(), $e->getCode());
        }
    }
}
