<?php

declare(strict_types=1);

namespace Nextstore\SyliusDropshippingCorePlugin\Validator;

use Webmozart\Assert\Assert;

class ValidatorOrderItem
{
    /**
     * @param array<int,mixed> $array
     */
    public function validateAddToCartManually(array $array): void
    {
        $productName = (isset($array['productName']) && !empty($array['productName'])) ? $array['productName'] : null;
        $price = (isset($array['price']) && !empty($array['price'])) ? (float) $array['price'] : null;
        $quantity = (isset($array['quantity']) && !empty($array['quantity'])) ? $array['quantity'] : null;
        $size = (isset($array['size']) && !empty($array['size'])) ? $array['size'] : null;
        $color = (isset($array['color']) && !empty($array['color'])) ? $array['color'] : null;
        $description = (isset($array['description']) && !empty($array['description'])) ? $array['description'] : null;
        $webUrl = (isset($array['webUrl']) && !empty($array['webUrl'])) ? $array['webUrl'] : null;

        Assert::notNull($webUrl);
        Assert::notNull($productName);
        Assert::notNull($price);
        Assert::notNull($size);
        Assert::notNull($color);
        Assert::notNull($quantity);
        Assert::integer($quantity);
        Assert::float($price);
    }
}
