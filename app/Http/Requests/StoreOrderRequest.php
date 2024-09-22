<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer' => 'required|exists:customers,id',
            'total'=>'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'customer.required' => 'Müşteri alanı zorunludur.',
            'customer.exists' => 'Seçtiğiniz müşteri geçerli değil.',
            'total.required' => 'Toplam alanı zorunludur.',
            'total.numeric' => 'Toplam bir sayı olmalıdır.',
        ];
    }
}
