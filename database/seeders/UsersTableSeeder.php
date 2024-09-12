<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ["email" => "admin@admin.com"],
            [
                "name" => "Administrador",
                "password" => Hash::make("admin"),
                "identification" => "999999999",
                "phone" => "0999999999",
                "user_id" => 1
            ]
        );
        
        $role = Role::updateOrCreate([
            "name" => "admin"
        ]);

        $roleu = Role::updateOrCreate([
            "name" => "user"
        ]);

        $user->assignRole($role);

        $user = User::updateOrCreate(
            ["email" => "admin2@admin.com"],
            [
                "name" => "erick",
                "password" => Hash::make("admin"),
                "identification" => "999999999",
                "phone" => "0999999999",
                "user_id" => 2
            ]
        );

        $user->assignRole($roleu);

        $user = User::updateOrCreate(
            ["email" => "admin3@admin.com"],
            [
                "name" => "leo",
                "password" => Hash::make("admin"),
                "identification" => "999999999",
                "phone" => "0999999999",
                "user_id" => 3
            ]
        );

        $user->assignRole($roleu);
    }
}
