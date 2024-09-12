<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(["name" => "Chevrolet", "user_id" => 1]);
        Brand::create(["name" => "Toyota", "user_id" => 1]);
        Brand::create(["name" => "Kia", "user_id" => 1]);
        Brand::create(["name" => "Chery", "user_id" => 1]);
        Brand::create(["name" => "Hyundai", "user_id" => 1]);
        Brand::create(["name" => "Suzuki", "user_id" => 1]);
        Brand::create(["name" => "Renault", "user_id" => 1]);
    }
}
