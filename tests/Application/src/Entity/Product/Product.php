<?php

declare(strict_types=1);

namespace Tests\Nextstore\SyliusDropshippingCorePlugin\Application\src\Entity\Product;

use Nextstore\SyliusDropshippingCorePlugin\Model\ProductInterface;
use Nextstore\SyliusDropshippingCorePlugin\Model\ProductTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product")
 */
class Product extends BaseProduct implements ProductInterface
{
    use ProductTrait;
}
