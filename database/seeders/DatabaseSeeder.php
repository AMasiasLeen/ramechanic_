<?php

namespace Database\Seeders;

use App\Models\Record;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(VehicleModelsTableSeeder::class);


        // Vehicle::factory()->count(500)->create();
        // Record::factory()->count(100)->create();
    }
}
