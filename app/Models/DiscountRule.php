<?php

namespace App\Models;

use App\DiscountRule\PercentageDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'value',
        'condition',
    ];

    protected $casts = [
        'condition' => 'array', // JSON formatındaki şartları dizi olarak döndür
    ];

}
