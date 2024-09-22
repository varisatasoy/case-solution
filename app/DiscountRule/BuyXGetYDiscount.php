<?php

namespace App\DiscountRule;

use App\Interfaces\DiscountTypeInterface;
use App\Models\DiscountRule;
use App\Models\Order;
use App\Models\OrderDiscount;

class BuyXGetYDiscount implements DiscountTypeInterface
{
    protected $discountAmount = 0; // Uygulanan indirim miktarı

    public function apply(Order $order, DiscountRule $discount)
    {
        $conditions = json_decode($discount->condition, true);

        foreach ($order->items as $item) {
            $total = $order->total;
            if ($item->product->category == $conditions['category_id'] && $item->quantity >= $conditions['buy']) {
                $this->discountAmount = $item->product->price * $conditions['get'];
                $total -= $this->discountAmount;

                OrderDiscount::create([
                    'order_id'=>$order->id,
                    'discount_reason' => 'BUY_5_GET_1',
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
