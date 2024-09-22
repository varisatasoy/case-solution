<?php

namespace App\Interfaces;

use App\Models\DiscountRule;
use App\Models\Order;

interface DiscountTypeInterface
{
    public function apply(Order $order, DiscountRule $discount);
    public function getAppliedDiscountAmount();
}
