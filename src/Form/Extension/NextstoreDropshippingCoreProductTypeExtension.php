<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Form\Extension;

use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
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
        ;

    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
