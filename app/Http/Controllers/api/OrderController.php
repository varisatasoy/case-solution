<?php

namespace App\Http\Controllers\Api;

use App\DiscountRule\BuyXGetYDiscount;
use App\DiscountRule\CategoryDiscount;
use App\DiscountRule\PercentageDiscount;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\DiscountRule;
use App\Models\Order;
use App\Models\Product;
use App\Services\DiscountFactory;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {

        $order = Order::create([
            'customer'=>$request->customer,
            'total'=>$this->calculateTotal($request->items)
        ]);

        $items = collect($request->items)->map(function($item) {
            $product = Product::findOrFail($item['product_id']);
            return [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unitPrice' => $product->price,
                'total' => $item['quantity'] * $product->price,
            ];
        });
        $order->items()->createMany($items->toArray());
       $this->applyDiscounts($order);

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(StoreOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->discounts()->delete();
        $order->items()->delete();

        $order->delete();
        return response()->json(['message'=>'Sipariş başarıyla silindi.'], 204);
    }

    private function calculateTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }
        return $total;
    }

    public function applyDiscounts(Order $order)
    {
        $discounts = DiscountRule::all();
        $totalDiscount = 0;
        foreach ($discounts as $discountRule) {
            $discountHandler = DiscountFactory::create($discountRule);
            $discountHandler->apply($order, $discountRule);

            $totalDiscount += $discountHandler->getAppliedDiscountAmount();

        }

        // Toplam indirim ve indirimli toplamı hesapla
        $order->totalDiscount = $totalDiscount; // Toplam indirim
        $order->discountedTotal = $order->total - $totalDiscount; // İndirimli toplam

        // Sipariş kaydını güncelle
        $order->save();
    }
}
