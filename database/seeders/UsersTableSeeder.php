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
            ["email" => "Solochevy_@hotmail.com"],
            [
                "name" => "Administrador",
                "password" => Hash::make("solochevy@2025"),
                "identification" => "999999999",
                "phone" => "0999999999",
                "user_id" => 1
            ]
        );
        
        $roleu = Role::updateOrCreate([
            "name" => "usuario"
        ]);
        
        $rolem = Role::updateOrCreate([
            "name" => "mecanico"
        ]);
        
        $role = Role::updateOrCreate([
            "name" => "administrador"
        ]);



        $user->assignRole($role);

        $user = User::updateOrCreate(
            ["email" => "admin2@admin.com"],
            [
                "name" => "Pablo",
                "password" => Hash::make("admin2leen"),
                "identification" => "2300566276",
                "phone" => "0999999999",
                "user_id" => 2
            ]
        );

        $user->assignRole($rolem);

        $user = User::updateOrCreate(
            ["email" => "admin3@admin.com"],
            [
                "name" => "leo",
                "password" => Hash::make("adminuser"),
                "identification" => "999999999",
                "phone" => "0999999999",
                "user_id" => 3
            ]
        );

        $user->assignRole($roleu);
    }
}
