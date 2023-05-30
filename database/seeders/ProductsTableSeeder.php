<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 11; $i++) 
        \Illuminate\Support\Facades\DB::table('products')->insert([
            'code' => 1,
            'name' => 'Product '.$i,
            'price' => rand(50,1500),
            'description' => 'Удочка',
            'image' => 'img/image1.png',
        ]);
    }
}
