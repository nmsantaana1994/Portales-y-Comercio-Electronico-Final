<?php

namespace Database\Seeders;

use App\Models\Bicicleta;
use App\Models\Compra;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        // Buscar al usuario "sara@za.com" en la base de datos
        $user = User::where('email', 'sara@za.com')->first();

        // Si el usuario existe, podemos proceder a crear una compra para él
        if ($user) {
            // Supongamos que queremos crear una compra con dos bicicletas
            $bicicleta1 = Bicicleta::findOrFail(1); // Reemplaza 1 con el ID de la primera bicicleta que deseas comprar
            $bicicleta2 = Bicicleta::findOrFail(2); // Reemplaza 2 con el ID de la segunda bicicleta que deseas comprar

            // Si las bicicletas existen, creamos la compra
            if ($bicicleta1 && $bicicleta2) {
                $compra = Compra::create([
                    'user_id' => $user->user_id,
                    'monto_total' => $bicicleta1->precio + $bicicleta2->precio,
                ]);

                // Adjuntar la primera bicicleta a la compra con cantidad 1
                $compra->bicicletas()->attach($bicicleta1->id, [
                    'cantidad' => 1,
                    // 'precio_unitario' => $bicicleta1->precio,
                ]);

                // Adjuntar la segunda bicicleta a la compra con cantidad 2
                $compra->bicicletas()->attach($bicicleta2->id, [
                    'cantidad' => 2,
                    // 'precio_unitario' => $bicicleta2->precio,
                ]);

                // La compra se ha creado exitosamente
            } else {
                // Una o ambas bicicletas con los IDs especificados no existen, mostrar mensaje de error o realizar alguna acción de manejo de errores
            }
        } else {
            // El usuario con el correo electrónico "sara@za.com" no existe, mostrar mensaje de error o realizar alguna acción de manejo de errores
        }
    }
}