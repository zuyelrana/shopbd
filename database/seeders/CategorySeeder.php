<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'id'=>1,
            'parent_id' => 0,
            'section_id' => 1,
            'category_name' => 'T-Shirt',
            'category_image' => '',
            'category_discount' => 5,
            'description' => "Category Description",
            'url' => "t-shirt",
            'status' => true,
        ]);

        Category::updateOrCreate([
            'id' => 2,
            'parent_id' => 1,
            'section_id' => 1,
            'category_name' => 'Casual T-Shirt',
            'category_image' => '',
            'category_discount' => 10,
            'description' => "Category Description",
            'url' => "casual-t-shirt",
            'status' => true,
        ]);
    }
    
}
