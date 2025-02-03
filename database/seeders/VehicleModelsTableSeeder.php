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
    $models = [
        ["name" => "D-Max", "brand_id" => 1],
        ["name" => "Spark Life", "brand_id" => 1],
        ["name" => "Spark GT", "brand_id" => 1],
        ["name" => "Aveo Emotion", "brand_id" => 1],
        ["name" => "Onix", "brand_id" => 1],
        ["name" => "Cruze", "brand_id" => 1],
        ["name" => "Captiva", "brand_id" => 1],
        ["name" => "Colorado", "brand_id" => 1],

        ["name" => "Hilux", "brand_id" => 2],
        ["name" => "Tacoma", "brand_id" => 2],
        ["name" => "Corolla", "brand_id" => 2],
        ["name" => "Yaris", "brand_id" => 2],
        ["name" => "Fortuner", "brand_id" => 2],
        ["name" => "Land Cruiser", "brand_id" => 2],
        ["name" => "RAV4", "brand_id" => 2],
        ["name" => "Prado", "brand_id" => 2],

        ["name" => "Sportage", "brand_id" => 3],
        ["name" => "Sorento", "brand_id" => 3],
        ["name" => "Rio", "brand_id" => 3],
        ["name" => "Cerato", "brand_id" => 3],
        ["name" => "Seltos", "brand_id" => 3],
        ["name" => "Sonet", "brand_id" => 3],
        ["name" => "Picanto", "brand_id" => 3],

        ["name" => "Tiggo 2", "brand_id" => 4],
        ["name" => "Tiggo 3", "brand_id" => 4],
        ["name" => "Tiggo 7", "brand_id" => 4],
        ["name" => "Arrizo 5", "brand_id" => 4],
        ["name" => "QQ", "brand_id" => 4],

        ["name" => "Tucson", "brand_id" => 5],
        ["name" => "Santa Fe", "brand_id" => 5],
        ["name" => "Creta", "brand_id" => 5],
        ["name" => "Grand i10", "brand_id" => 5],
        ["name" => "Elantra", "brand_id" => 5],
        ["name" => "Kona", "brand_id" => 5],

        ["name" => "Vitara", "brand_id" => 6],
        ["name" => "Swift", "brand_id" => 6],
        ["name" => "S-Cross", "brand_id" => 6],
        ["name" => "Ertiga", "brand_id" => 6],
        ["name" => "Celerio", "brand_id" => 6],

        ["name" => "Duster", "brand_id" => 7],
        ["name" => "Kwid", "brand_id" => 7],
        ["name" => "Stepway", "brand_id" => 7],
        ["name" => "Logan", "brand_id" => 7],

        ["name" => "Versa", "brand_id" => 8],
        ["name" => "March", "brand_id" => 8],
        ["name" => "Frontier", "brand_id" => 8],
        ["name" => "Kicks", "brand_id" => 8],

        ["name" => "Mazda 2", "brand_id" => 9],
        ["name" => "Mazda 3", "brand_id" => 9],
        ["name" => "CX-5", "brand_id" => 9],
        ["name" => "BT-50", "brand_id" => 9],

        ["name" => "Polo", "brand_id" => 10],
        ["name" => "Gol", "brand_id" => 10],
        ["name" => "Tiguan", "brand_id" => 10],
        ["name" => "Jetta", "brand_id" => 10],

        ["name" => "Ranger", "brand_id" => 11],
        ["name" => "Explorer", "brand_id" => 11],
        ["name" => "EcoSport", "brand_id" => 11],
        ["name" => "F-150", "brand_id" => 11],

        ["name" => "Civic", "brand_id" => 12],
        ["name" => "CR-V", "brand_id" => 12],
        ["name" => "HR-V", "brand_id" => 12],

        ["name" => "L200", "brand_id" => 13],
        ["name" => "Outlander", "brand_id" => 13],
        ["name" => "Montero", "brand_id" => 13],

        ["name" => "Haval H2", "brand_id" => 14],
        ["name" => "Haval H6", "brand_id" => 14],

        ["name" => "E10X", "brand_id" => 15],
        ["name" => "T3", "brand_id" => 15],

        ["name" => "Q7", "brand_id" => 28],
        ["name" => "Q5", "brand_id" => 28],
        ["name" => "A4", "brand_id" => 28],
        ["name" => "A3", "brand_id" => 28],

        ["name" => "X1", "brand_id" => 27],
        ["name" => "X5", "brand_id" => 27],
        ["name" => "Serie 3", "brand_id" => 27],
        ["name" => "Serie 5", "brand_id" => 27],

        ["name" => "Model 3", "brand_id" => 56],
        ["name" => "Model Y", "brand_id" => 56],
        ["name" => "Model S", "brand_id" => 56],
        ["name" => "Model X", "brand_id" => 56]
    ];

    foreach ($models as $model) {
        VehicleModel::create(["name" => $model["name"], "brand_id" => $model["brand_id"], "user_id" => 1]);
    }
}
}
