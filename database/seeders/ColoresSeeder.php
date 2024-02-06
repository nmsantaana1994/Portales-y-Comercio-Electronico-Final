<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colores')->insert([
            [
                'color_id' => 1,
                'nombre' => 'Rojo',
            ],
            [
                'color_id' => 2,
                'nombre' => 'Plateado',
            ],
            [
                'color_id' => 3,
                'nombre' => 'Amarillo',
            ],
            [
                'color_id' => 4,
                'nombre' => 'Negro',
            ],
            [
                'color_id' => 5,
                'nombre' => 'Gris',
            ],
        ]);
    }
}
