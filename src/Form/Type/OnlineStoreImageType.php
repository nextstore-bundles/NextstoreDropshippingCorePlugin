<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class OnlineStoreImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'nextstore_sylius_dropshipping_core_online_store_image';
    }
}
