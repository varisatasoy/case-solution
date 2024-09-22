<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DiscountRulesSeeder::class);
        $categories = [
            'Elektronik',
            'Mobilya',
            'Giyim',
            'Kitap',
            'Spor Malzemeleri'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'=>$category
            ]);
        }

        $customers = [
            ['name' => 'Ahmet', 'surname' => 'Yılmaz'],
            ['name' => 'Elif', 'surname' => 'Kaya'],
            ['name' => 'Mehmet', 'surname' => 'Demir'],
            ['name' => 'Ayşe', 'surname' => 'Çelik'],
            ['name' => 'Fatma', 'surname' => 'Şahin'],
        ];


        foreach ($customers as $customer) {
            Customer::create([
               'name'=>$customer["name"],
               'surname'=>$customer["surname"]
            ]);
        }


        $products = [
            // Elektronik
            [
                'name' => 'Laptop',
                'price' => 1500.00,
                'stock' => 50,
                'category' => 'Elektronik'
            ],
            [
                'name' => 'Akıllı Telefon',
                'price' => 1000.00,
                'stock' => 150,
                'category' => 'Elektronik'
            ],
            [
                'name' => 'Tablet',
                'price' => 600.00,
                'stock' => 70,
                'category' => 'Elektronik'
            ],
            [
                'name' => 'Bluetooth Kulaklık',
                'price' => 100.00,
                'stock' => 300,
                'category' => 'Elektronik'
            ],
            [
                'name' => 'Smart TV',
                'price' => 2000.00,
                'stock' => 40,
                'category' => 'Elektronik'
            ],
            // Mobilya
            [
                'name' => 'Koltuk Takımı',
                'price' => 800.00,
                'stock' => 30,
                'category' => 'Mobilya'
            ],
            [
                'name' => 'Yemek Masası',
                'price' => 450.00,
                'stock' => 25,
                'category' => 'Mobilya'
            ],
            [
                'name' => 'Gardırop',
                'price' => 600.00,
                'stock' => 15,
                'category' => 'Mobilya'
            ],
            [
                'name' => 'Çalışma Masası',
                'price' => 200.00,
                'stock' => 60,
                'category' => 'Mobilya'
            ],
            [
                'name' => 'Kitaplık',
                'price' => 150.00,
                'stock' => 50,
                'category' => 'Mobilya'
            ],
            // Giyim
            [
                'name' => 'Tişört',
                'price' => 20.00,
                'stock' => 200,
                'category' => 'Giyim'
            ],
            [
                'name' => 'Kot Pantolon',
                'price' => 50.00,
                'stock' => 100,
                'category' => 'Giyim'
            ],
            [
                'name' => 'Ceket',
                'price' => 100.00,
                'stock' => 80,
                'category' => 'Giyim'
            ],
            [
                'name' => 'Eşofman Takımı',
                'price' => 70.00,
                'stock' => 120,
                'category' => 'Giyim'
            ],
            [
                'name' => 'Şapka',
                'price' => 15.00,
                'stock' => 150,
                'category' => 'Giyim'
            ],
            // Kitap
            [
                'name' => 'Roman Kitap',
                'price' => 15.00,
                'stock' => 100,
                'category' => 'Kitap'
            ],
            [
                'name' => 'Bilim Kurgu Kitap',
                'price' => 20.00,
                'stock' => 90,
                'category' => 'Kitap'
            ],
            [
                'name' => 'Kişisel Gelişim Kitap',
                'price' => 25.00,
                'stock' => 70,
                'category' => 'Kitap'
            ],
            [
                'name' => 'Çocuk Kitabı',
                'price' => 10.00,
                'stock' => 120,
                'category' => 'Kitap'
            ],
            [
                'name' => 'Tarih Kitabı',
                'price' => 30.00,
                'stock' => 60,
                'category' => 'Kitap'
            ],
            // Spor Malzemeleri
            [
                'name' => 'Koşu Ayakkabısı',
                'price' => 120.00,
                'stock' => 75,
                'category' => 'Spor Malzemeleri'
            ],
            [
                'name' => 'Futbol Topu',
                'price' => 30.00,
                'stock' => 150,
                'category' => 'Spor Malzemeleri'
            ],
            [
                'name' => 'Yoga Matı',
                'price' => 25.00,
                'stock' => 100,
                'category' => 'Spor Malzemeleri'
            ],
            [
                'name' => 'Dambıl Seti',
                'price' => 80.00,
                'stock' => 50,
                'category' => 'Spor Malzemeleri'
            ],
            [
                'name' => 'Basketbol Potası',
                'price' => 250.00,
                'stock' => 20,
                'category' => 'Spor Malzemeleri'
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();

            Product::create([
                'name' => $productData['name'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'category' => $category->id
            ]);
        }

    }
}
