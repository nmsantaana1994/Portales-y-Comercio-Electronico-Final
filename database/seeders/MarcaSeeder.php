<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("marcas")->insert([
            [
                "marca_id" => 1,
                "nombre" => "Primo",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 2,
                "nombre" => "We the People",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 3,
                "nombre" => "Animal",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 4,
                "nombre" => "Salt",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 5,
                "nombre" => "Cult",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 6,
                "nombre" => "DRB",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 7,
                "nombre" => "Eighties",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 8,
                "nombre" => "Federal",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 9,
                "nombre" => "Fitbikeco",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 10,
                "nombre" => "Stranger",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "marca_id" => 11,
                "nombre" => "S&M",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
