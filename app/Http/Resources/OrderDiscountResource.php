<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderId'=>$this->id,
            'discounts'=>DiscountsResource::collection($this->discounts),
            'totalDiscount'=>$this->totalDiscount,
            'discountedTotal'=>$this->discountedTotal
        ];
    }
}
