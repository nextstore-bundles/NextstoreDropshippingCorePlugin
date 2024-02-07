<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ConfigType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
            ])
            ->add('value', TextType::class, [
                'label' => 'sylius.ui.value',
            ])
            ->add('content', TextType::class, [
                'label' => 'sylius.ui.content',
            ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_dropshipping_core_config';
    }
}
