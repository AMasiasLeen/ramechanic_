<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use Database\Factories\VehiclesFactory;
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


        Vehicle::factory(VehiclesFactory::class)->make(1000);
    }
}
