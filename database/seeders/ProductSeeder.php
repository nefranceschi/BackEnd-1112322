<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productData = [
            'name'        =>    'MacBook Pro 13.3 Retina [MYD82] M1 Chip 256 GB - Space Gray',
            'description' =>    '', 
            'image'       =>    'apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg', 
            'brand'       =>    'Apple', 
            'price'       =>    2000, 
            'price_sale'  =>    1950, 
            'category'    =>    'Mackbook Pro', 
            'stock'       =>    5 
        ];
        $product = new Product($productData);
        $product->save();
    }
}
