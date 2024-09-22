<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductStock implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $productId = request()->input(substr($attribute, 0, strrpos($attribute, '.')) . '.product_id');
        $stock = Product::find($productId)->stock;

        if ($value > $stock) {
            $fail('Seçtiğiniz miktar, stok miktarından fazla olamaz.');
        }
    }
}
