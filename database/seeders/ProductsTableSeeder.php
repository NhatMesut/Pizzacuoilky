<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'short_description' => 'Short description for Product 1',
                'detailed_description' => 'Detailed description for Product 1',
                'original_price' => 100,
                'sale_price' => 80,
                'image' => 'product1.jpg',
                'slug' => Str::slug('Product 1'),
                'quantity' => 10,
                'tags' => 'tag1,tag2',
                'category_id' => 1, // Ensure that this category ID exists
            ],
            [
                'name' => 'Product 2',
                'short_description' => 'Short description for Product 2',
                'detailed_description' => 'Detailed description for Product 2',
                'original_price' => 150,
                'sale_price' => 120,
                'image' => 'product2.jpg',
                'slug' => Str::slug('Product 2'),
                'quantity' => 15,
                'tags' => 'tag2,tag3',
                'category_id' => 2, // Ensure that this category ID exists
            ],
        ]);
    }
}
