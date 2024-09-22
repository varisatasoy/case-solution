<?php

namespace App\Http\Requests;

use App\Rules\ProductStock;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer' => 'required|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
               new ProductStock(),
            ],
        ];
    }

    public function messages()
    {
        return [
            'customer.required' => 'Müşteri alanı zorunludur.',
            'customer.exists' => 'Seçtiğiniz müşteri geçerli değil.',
            'items.required' => 'Sipariş ürünleri zorunludur.',
            'items.array' => 'Sipariş ürünleri bir dizi olmalıdır.',
            'items.min' => 'Sipariş ürünleri en az bir öğe içermelidir.',
            'items.*.product_id.required' => 'Ürün kimliği zorunludur.',
            'items.*.product_id.exists' => 'Seçtiğiniz ürün geçerli değil.',
            'items.*.quantity.required' => 'Miktar zorunludur.',
            'items.*.quantity.integer' => 'Miktar bir tamsayı olmalıdır.',
            'items.*.quantity.min' => 'Miktar 1 veya daha büyük olmalıdır.',
        ];
    }

}
