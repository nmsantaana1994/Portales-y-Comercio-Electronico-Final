<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompraBicicleta;
use App\Models\Compra;
use App\Models\User;
use App\Models\Bicicleta;
use Illuminate\Support\Facades\Log;

class CompraBicicletaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar al usuario "sara@za.com" en la base de datos
        $user = User::where('email', 'sara@za.com')->first();

        // Si el usuario existe, podemos proceder a crear una compra para él
        if ($user) {
            // Supongamos que queremos crear una compra con dos bicicletas
            $bicicleta1 = Bicicleta::findOrFail(1); // Reemplaza 1 con el ID de la primera bicicleta que deseas comprar
            $bicicleta2 = Bicicleta::findOrFail(2); // Reemplaza 2 con el ID de la segunda bicicleta que deseas comprar

            // Si las bicicletas existen, creamos la compra_bicicleta
            if ($bicicleta1 && $bicicleta2) {
                // Crear la compra_bicicleta para la primera bicicleta
                CompraBicicleta::create([
                    'compra_id' => 1, // Reemplaza 1 con el ID de la compra que deseas asociar
                    'bicicletas_id' => $bicicleta1->bicicletas_id,
                    'cantidad' => 1,
                    // Agrega más datos según tus necesidades
                ]);

                // Crear la compra_bicicleta para la segunda bicicleta
                CompraBicicleta::create([
                    'compra_id' => 1, // Reemplaza 1 con el ID de la compra que deseas asociar
                    'bicicletas_id' => $bicicleta2->bicicletas_id,
                    'cantidad' => 2,
                    // Agrega más datos según tus necesidades
                ]);

                // La compra_bicicleta se ha creado exitosamente
            } else {
                // Una o ambas bicicletas con los IDs especificados no existen, mostrar mensaje de error o realizar alguna acción de manejo de errores
            }
        } else {
            // El usuario con el correo electrónico "sara@za.com" no existe, mostrar mensaje de error o realizar alguna acción de manejo de errores
        }


        // Log::debug('Buscando una compra existente...');
        // $compra = Compra::first();

        // if ($compra) {
        //     Log::debug('Compra encontrada:', ['id' => $compra->id]);
            
        //     // Resto del código para adjuntar bicicletas
        //     // Adjuntar una bicicleta a la compra con cantidad y precio
        //     $bicicleta = Bicicleta::findOrFail(1);
        //     $compra->bicicletas()->attach($bicicleta->id, [
        //         'cantidad' => 1,
        //         'precio_unitario' => $bicicleta->precio,
        //     ]);

        //     // Adjuntar otra bicicleta a la misma compra
        //     $bicicleta = Bicicleta::findOrFail(2);
        //     $compra->bicicletas()->attach($bicicleta->id, [
        //         'cantidad' => 2,
        //         'precio_unitario' => $bicicleta->precio,
        //     ]);
        // } else {
        //     Log::debug('No se encontró ninguna compra existente.');
        // }
    }
}
