<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MarcaSeeder::class);
        $this->call(ColoresSeeder::class);
        $this->call(NoticiaSeeder::class);
        $this->call(BicicletaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ComprasSeeder::class);
        $this->call(CompraBicicletaSeeder::class);
    }
}
