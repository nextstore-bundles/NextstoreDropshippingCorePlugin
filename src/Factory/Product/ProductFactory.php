<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Factory\Product;

use Nextstore\SyliusDropshippingCorePlugin\Model\ProductInterface as NextstoreProductInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelPricing;
use Sylius\Component\Core\Model\ProductVariant;
use Sylius\Component\Core\Model\Taxon;
use Sylius\Component\Product\Factory\ProductFactoryInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProductFactory implements ProductFactoryInterface
{
    public function __construct(
        private ProductFactoryInterface $decoratedFactory,
        private ChannelContextInterface $channelContext,
        private ParameterBagInterface $parameterBag,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function createNew(): NextstoreProductInterface
    {
        return $this->decoratedFactory->createNew();
    }

    public function createWithVariant(): NextstoreProductInterface
    {
        return $this->decoratedFactory->createWithVariant();
    }

    public function createProductManually(array $array, string $type): NextstoreProductInterface
    {
        $channel = $this->channelContext->getChannel();
        $taxon = $this->entityManager->getRepository(Taxon::class)->findOneBy(['code' => 'link']);

        $productCode = $this->generateProductCode();

        /** @var NextstoreProductInterface $product */
        $product = $this->createWithVariant();
        $product->setCode($productCode);
        $product->setName($array['productName']);
        $product->setSlug($productCode);
        $product->setWebUrl($array['webUrl']);
        $product->setProductType($type);
        isset($array['description']) && $product->setDescription($array['description']);

        $product->addChannel($channel);
        $product->setMainTaxon($taxon);

        /** @var ProductVariant $variant */
        $variant = $product->getVariants()[0];
        $variant->setCode($product->getCode());
        $variant->setName($array['productName']);
        $variant->setTracked(false);
        $cp = $this->createChannelPricing($variant, (int) $array['price'], (int) $array['price']);
        $variant->addChannelPricing($cp);

        $this->entityManager->persist($variant);
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }

    public function createChannelPricing(ProductVariant $variant, int $price): ChannelPricing
    {
        $channel = $this->channelContext->getChannel();

        $cp = new ChannelPricing();
        $cp->setChannelCode($channel->getCode());
        $cp->setMinimumPrice(0);
        $cp->setOriginalPrice($price * 100);
        $cp->setPrice($price * 100);
        $cp->setProductVariant($variant);

        $this->entityManager->persist($cp);

        return $cp;
    }

    public function generateProductCode(?string $prefix = null): string
    {
        $code = md5(uniqid('', true));
        if (!empty($prefix) && $prefix !== null) {
            return $prefix . '-' . $code;
        }

        return $code;
    }
}
