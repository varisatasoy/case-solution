<?php

namespace App\DiscountRule;

use App\Interfaces\DiscountTypeInterface;
use App\Models\DiscountRule;
use App\Models\Order;
use App\Models\OrderDiscount;

class CategoryDiscount implements DiscountTypeInterface
{

    protected $discountAmount = 0; // Uygulanan indirim miktarı

    public function apply(Order $order, DiscountRule $discount)
    {
        $conditions = json_decode($discount->condition, true);
        foreach ($order->items as $item) {
            $total = $order->total;
            if ($item->product->category == $conditions['category_id']) {
                $this->discountAmount = $item->unitPrice * ($discount->value / 100);
                $total -= $this->discountAmount;
                OrderDiscount::create([
                    'order_id'=>$order->id,
                    'discount_reason' => 'CATEGORY_1_DISCOUNT',
                    'discount_amount' => floatval($this->discountAmount),
                    'subtotal' => floatval($total),
                ]);
            }
        }
    }

    public function getAppliedDiscountAmount()
    {
        return $this->discountAmount;
    }
}
