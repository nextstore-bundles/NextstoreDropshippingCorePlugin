<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Form\Type;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class OnlineStoreType extends AbstractResourceType
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
            ->add('webUrl', UrlType::class, [
                'label' => 'nextstore_sylius_dropshipping_core.ui.web_url',
            ])
            ->add('description', TextType::class, [
                'label' => 'sylius.ui.description',
            ])
            ->add('position', NumberType::class, [
                'label' => 'sylius.ui.position',
            ])
            ->add('country', EntityType::class, [
                'class' => CountryInterface::class,
                'required' => false,
                'label' => 'sylius.ui.country'
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => OnlineStoreImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'sylius.ui.images',
            ]);;
    }

    /**
     * @inheritdoc
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_dropshipping_core_online_store';
    }
}
