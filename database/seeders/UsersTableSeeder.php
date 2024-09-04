<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ["email" => "admin"],
            [
                "name" => "Administrador",
                "password" => Hash::make("admin"),
                "identification"=>"999999999",
                "phone"=>"0999999999"
            ]
        );
    }
}
