<?php

namespace App\Services;

use App\Models\DiscountRule;
use App\Models\Order;

class DiscountService
{
    private $rules;

    public function __construct()
    {
        $this->rules = DiscountRule::all();
    }

    public function applyDiscounts(): array
    {
        $order = Order::first();
        $discounts = [];
        $totalDiscount = 0;

        foreach ($this->rules as $rule) {
            if ($rule->supports($order)) {
                $discount = $rule->apply($order);
                if (!empty($discount)) {
                    $discounts[] = $discount;
                    $totalDiscount += floatval($discount['discountAmount']);
                }
            }
        }

        return [
            'discounts' => $discounts,
            'totalDiscount' => number_format($totalDiscount, 2),
            'discountedTotal' => number_format($order['total'] - $totalDiscount, 2),
        ];
    }
}
