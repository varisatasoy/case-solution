<?php

namespace App\DiscountRule;

use App\Interfaces\DiscountTypeInterface;
use App\Models\DiscountRule;
use App\Models\Order;
use App\Models\OrderDiscount;

class PercentageDiscount implements DiscountTypeInterface
{
    protected $discountAmount = 0; // Uygulanan indirim miktarı

    public function apply(Order $order, DiscountRule $discount)
    {
        $conditions = json_decode($discount->condition, true);
        $total = $order->total;

        if ($total >= $conditions['min_order_value']) {
            $this->discountAmount = $total * ($discount->value / 100);
            $total -= $this->discountAmount;

            OrderDiscount::create([
                'order_id' => $order->id,
                'discount_reason' => '10_PERCENT_OVER_1000',
                'discount_amount' => floatval($this->discountAmount),
                'subtotal' => floatval($total),
            ]);
        }
    }


    public function getAppliedDiscountAmount()
    {
        return $this->discountAmount;
    }
}
