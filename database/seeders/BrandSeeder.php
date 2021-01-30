<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::updateOrCreate([
            'id' => 1,
            'name' => "Demo1",
            'status' => true,
        ]);
        Brand::updateOrCreate([
            'id' => 2,
            'name' =>"Demo2",
            'status' => true,
        ]);
        Brand::updateOrCreate([
            'id' => 3,
            'name' => "Demo3",
            'status' => true,
        ]);
        Brand::updateOrCreate([
            'id' => 4,
            'name' => "Demo4",
            'status' => true,
        ]);
        Brand::updateOrCreate([
            'id' => 5,
            'name' => "Demo5",
            'status' => true,
        ]);
    }
}
