<?php

namespace App\DiscountRule;

use App\Interfaces\DiscountTypeInterface;
use App\Models\DiscountRule;
use App\Models\Order;

class ProductIDDiscount implements DiscountTypeInterface
{


    public function apply(Order $order, DiscountRule $discount)
    {
        // TODO: Implement apply() method.
    }
}
