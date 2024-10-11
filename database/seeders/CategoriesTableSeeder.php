<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Category 1', 'image' => 'category1.jpg', 'slug' => 'category-1'],
            ['name' => 'Category 2', 'image' => 'category2.jpg', 'slug' => 'category-2'],
            ['name' => 'Category 3', 'image' => 'category3.jpg', 'slug' => 'category-3'],
        ]);
    }
}
