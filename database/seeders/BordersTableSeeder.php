<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BordersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('borders')->insert([
            ['name' => 'Rounded'],
            ['name' => 'Flat'],
            ['name' => 'Pointed'],
        ]);
    }
}
