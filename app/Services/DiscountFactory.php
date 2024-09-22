<?php

namespace App\Services;

use App\DiscountRule\BuyXGetYDiscount;
use App\DiscountRule\CategoryDiscount;
use App\DiscountRule\PercentageDiscount;
use App\Models\DiscountRule;
use Exception;

class DiscountFactory
{
    public static function create(DiscountRule $discountRule)
    {
        switch ($discountRule->type) {
            case 'percentage':
                return new PercentageDiscount();
            case 'buy_x_get_y':
                return new BuyXGetYDiscount();
            case 'category_discount':
                return new CategoryDiscount();
            default:
                throw new Exception("Unknown discount type: {$discountRule->type}");
        }
    }
}
