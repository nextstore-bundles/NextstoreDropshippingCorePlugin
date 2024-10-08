<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Form\Extension;

use Nextstore\SyliusDropshippingCorePlugin\Model\ProductInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class NextstoreDropshippingCoreProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('webUrl', TextType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.web_url',
            ])
            ->add('externalProductId', TextType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.external_product_id',
            ])
            ->add('orderType', ChoiceType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.product_order_type',
                'choices' => [
                    'nextstore_sylius_dropshipping_core.ui.order_type_ready' => ProductInterface::ORDER_TYPE_READY,
                    'nextstore_sylius_dropshipping_core.ui.order_type_order' => ProductInterface::ORDER_TYPE_ORDER,
                ]
            ])
            ->add('priceOt', TextType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.price_ot',
                'required' => false,
            ])
            ->add('originalPriceOt', TextType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.original_price_ot',
                'required' => false,
            ])
            ->add('tmall')
        ;

    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
