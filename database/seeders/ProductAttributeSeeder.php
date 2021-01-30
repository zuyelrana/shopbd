<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttribute::updateOrCreate([
            'id' => 1,
            'product_id' => 1,
            'size' => "Small",
            'price' => 100,
            'stock' => 10,
            'sku' => 'BTCOO1',
            'status' => true,
        ]);

        ProductAttribute::updateOrCreate([
            'id' => 2,
            'product_id' => 1,
            'size' => "Medium",
            'price' => 110,
            'stock' => 10,
            'sku' => 'BTCO1',
            'status' => true,
        ]);
        ProductAttribute::updateOrCreate([
            'id' => 3,
            'product_id' => 1,
            'size' => "Large",
            'price' => 120,
            'stock' => 10,
            'sku' => 'BTC1O1',
            'status' => true,
        ]);
    }
}
