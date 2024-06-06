<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

final class AdminProductFormMenuListener
{
    /**
     * @param ProductMenuBuilderEvent $event
     */
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('external')
            ->setAttribute('template', '@NextstoreSyliusDropshippingCorePlugin/Admin/Product/_external.html.twig')
            ->setLabel('nextstore_sylius_dropshipping_core.ui.external')
        ;

    }
}
