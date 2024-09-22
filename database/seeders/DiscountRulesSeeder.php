<?php

namespace Database\Seeders;

use App\Models\DiscountRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discountRules = [
            [
                'name' => 'Yüzde 10 İndirim',
                'type' => 'percentage',
                'value' => 10.00,
                'condition' => json_encode(['min_order_value' => 1000]),
            ],
            [
                'name' => 'Kategori 2 de 5 Al, 1 Bedava',
                'type' => 'buy_x_get_y',
                'value' => 1,
                'condition' => json_encode(['buy' => 5,'get'=>1,'category_id'=>2]),
            ],
            [
                'name' => 'Kategori 1 de %20 İndirim',
                'type' => 'category_discount',
                'value' => 20.00,
                'condition' => json_encode(['category_id' => 1]),
            ],
        ];

        foreach ($discountRules as $rule) {
            DiscountRule::create($rule);
        }
    }
}
