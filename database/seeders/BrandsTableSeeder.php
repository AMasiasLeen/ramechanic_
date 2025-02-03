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
    $brands = [
        "Chevrolet", "Toyota", "Kia", "Chery", "Hyundai", "Suzuki", "Renault",
        "Nissan", "Mazda", "Volkswagen", "Ford", "Honda", "Mitsubishi", "Great Wall",
        "JAC", "DFSK", "Dongfeng", "Zotye", "BYD", "Foton", "Jeep", "Subaru", "Peugeot",
        "Citroën", "Fiat", "BMW", "Mercedes-Benz", "Audi", "Volvo", "Land Rover",
        "Jaguar", "Porsche", "Ram", "Dodge", "Chrysler", "Lexus", "Infiniti", "Mini",
        "MG", "Isuzu", "Haval", "BAIC", "JMC", "Geely", "FAW", "Cadillac", "Buick",
        "Lincoln", "Opel", "SEAT", "Skoda", "Tata", "Mahindra", "Scania", "MAN",
        "Iveco", "Kenworth", "Hino", "Mack", "Tesla"
    ];

    foreach ($brands as $brand) {
        Brand::create(["name" => $brand, "user_id" => 1]);
    }
}
}
