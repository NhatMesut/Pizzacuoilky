<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soles')->insert([
            ['name' => 'Rubber'],
            ['name' => 'Leather'],
            ['name' => 'Canvas'],
        ]);
    }
}
