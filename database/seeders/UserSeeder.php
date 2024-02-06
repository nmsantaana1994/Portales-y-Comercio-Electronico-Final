<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "user_id" => 1,
                "email" => "sara@za.com",
                "password" => Hash::make("asdasd"),
                "rol" => "user",
                "nombre" => "Sara",
                "apellido" => "Za",
                "telefono" => "1122334455",
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 2,
                "email" => "admin@admin.com",
                "password" => Hash::make("admin"),
                "rol" => "admin",
                "nombre" => "Nico",
                "apellido" => "Santa Ana",
                "telefono" => "1132160381",
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);

        DB::table('users_has_bicicletas')->insert([
            [
                'user_id' => 1,
                'bicicletas_id' => 1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
    }
}
