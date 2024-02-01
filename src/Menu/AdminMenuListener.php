<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $configMenu = $menu->getChild('configuration');
        $configMenu
            ->addChild('core_configs', ['route' => 'nextstore_sylius_dropshipping_core_admin_config_index'])
            ->setLabel('nextstore_sylius_dropshipping_core.ui.config')
            ->setLabelAttribute('icon', 'code');
        $configMenu
            ->addChild('online_stores', ['route' => 'nextstore_sylius_dropshipping_core_admin_online_store_index'])
            ->setLabel('nextstore_sylius_dropshipping_core.ui.online_store')
            ->setLabelAttribute('icon', 'desktop');
    }
}
