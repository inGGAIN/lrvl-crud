<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Models\Product([
            'name' => 'Product #1',
            'detail' => 'Product #1 details'
        ]);
        $product->save();

        $product = new \App\Models\Product([
            'name' => 'Product #2',
            'detail' => 'Product #2 details'
        ]);
        $product->save();

        $product = new \App\Models\Product([
            'name' => 'Product #3',
            'detail' => 'Product #3 details'
        ]);
        $product->save();

        $product = new \App\Models\Product([
            'name' => 'Product #4',
            'detail' => 'Product #4 details'
        ]);
        $product->save();
    }
}
