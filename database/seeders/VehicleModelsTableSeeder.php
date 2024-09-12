<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleModel::create(["name" => "D-max", "brand_id" => 1,  "user_id" => 1]);
        VehicleModel::create(["name" => "Tacoma",  "brand_id" => 2, "user_id" => 1]);
        VehicleModel::create(["name" => "Spark Life", "brand_id" => 1, "user_id" => 1]);
        VehicleModel::create(["name" => "Spark Life AC", "brand_id" => 1, "user_id" => 1]);
        VehicleModel::create(["name" => "Spark GT", "brand_id" => 1, "user_id" => 1]);
        VehicleModel::create(["name" => "D-Max DOHC 2.4L", "brand_id" => 1, "user_id" => 1]);

    }
}
