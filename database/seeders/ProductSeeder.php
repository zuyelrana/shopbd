<?php

namespace Database\Seeders;

use App\Models\Product;
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
        Product::updateOrCreate([
            'id'=>1,
            'category_id' => 1,
            'section_id' => 1,
            'brand_id' => 1,
            'product_name' => 'Red T-Shirt',
            'product_code' => 'B-C100',
            'product_color' => 'Red',
            'product_price' => 2000,
            'product_discount' => 5,
            'product_weight' => 3,
            'main_image' => "",
            'description' => "Description",
            'wash_care' => "",
            'fabric' => "",
            'pattern' => "",
            'sleeve' => "",
            'fit' => "",
            'ocassion' => "",
            'meta_title' => "",
            'meta_description' => "",
            'meta_keywords' => "",
            'is_featured' => "Yes",
            'slug' => "red-t-shirt",
            'status' => true,
        ]);

        Product::updateOrCreate([
            'id' => 2,
            'category_id' => 1,
            'section_id' => 1,
            'brand_id' => 1,
            'product_name' => 'Blue T-Shirt',
            'product_code' => 'B-C210',
            'product_color' => 'Blue',
            'product_price' => 2000,
            'product_discount' => 5,
            'product_weight' => 2,
            'main_image' => "",
            'description' => "Description",
            'wash_care' => "",
            'fabric' => "",
            'pattern' => "",
            'sleeve' => "",
            'fit' => "",
            'ocassion' => "",
            'meta_title' => "",
            'meta_description' => "",
            'meta_keywords' => "",
            'is_featured' => "Yes",
            'status' => true,
            'slug' => "blue-t-shirt",
        ]);

    }
}
