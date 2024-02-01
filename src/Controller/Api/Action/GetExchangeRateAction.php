<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Controller\Api\Action;

use Sylius\Component\Currency\Model\ExchangeRate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Webmozart\Assert\Assert;

class GetExchangeRateAction extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NormalizerInterface $normalizer
    ) {
    }

    public function __invoke(Request $request)
    {
        $sourceCode = $request->get('source', null);
        $targetCode = $request->get('target', null);

        Assert::notNull($sourceCode);
        Assert::notNull($targetCode);

        $exchangeRate = $this->entityManager->getRepository(ExchangeRate::class)->findOneWithCurrencyPair($sourceCode, $targetCode);
        if ($exchangeRate instanceof ExchangeRate) {
            $result = $this->normalizer->normalize($exchangeRate, null, ['groups' => 'shop:exchange_rate:read']);
            return new JsonResponse($result);
        }

        throw new NotFoundHttpException('Exchange rate not found');
    }
}
