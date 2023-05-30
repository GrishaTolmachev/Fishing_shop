<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 5; $i++) 
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            'title' => 'Category',
            'description' => 'Отличный товар',
            'alias' => 'ydilisha',
        ]);
    }
}
