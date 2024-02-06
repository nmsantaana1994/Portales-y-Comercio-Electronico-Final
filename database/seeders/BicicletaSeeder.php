<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BicicletaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bicicletas")->insert([
            [
                "bicicletas_id" => 1,
                "color_id" => 1,
                "modelo" => "Control",
                "precio"=> 21564500,
                "marca"=> "Cult",
                "descripcion"=> "La Cult Control es una BMX de gama media. La Control tiene un cuadro con tubo superior de 20.75 hecho con un triángulo delantero 100% de cromo, horquillas y barras de cromo. Se ha montado con piezas sólidas de calidad del mercado de accesorios, buje trasero de cassette de 9t sellado, juego de dirección sellado, bielas de cromo con BB medio sellado, neumáticos de 2,4 Cult X Vans neumáticos, freno trasero 990 U-Brake, potencia forjada Salvation y mucho más.",
                "foto"=> "cult_control.png",
                "fotoAlt"=> "Bicicleta Cult Control",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "bicicletas_id" => 2,
                "color_id" => 2,
                "modelo" => "Gateway",
                "precio"=> 32730000,
                "marca"=> "Cult",
                "descripcion"=> "La bicicleta Gateway de Cult es la base de la linea, ideal para principiantes y con un diseño caracteristico de la marca. Bike Check: Cuadro: Triangulo frontal TT Cromo - 20.5 Puños: Ricany x ODI Grips Stem: Top Load Juego de dirección: Integrado Pedales: CULT Nylon Palancas: CROMO 3 pc 170mm Heat Treated Caja: Sealed Mid Bottom Bracket Cadenas: CULT 410 Maza Delantera: Sealed Front Hub Maza Trasera: Sealed Rear 9T Cassette Hub Engranaje: 25T Member style Sprocket Asientos: 1pc Padded Seat w/ CULT logo Cubiertas: 2.40 SLICK Tires Frenos: 990 U-Brake Colores: Black Frame w/ ALL Black Parts - Chrome Frame w/ ALL Black Parts'",
                "foto"=> "cult_gateway.jpg",
                "fotoAlt"=> "Bicicleta Cult Gateway",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "bicicletas_id" => 3,
                "color_id" => 3,
                "modelo" => "Highway",
                "precio"=> 24860000,
                "marca"=> "DRB",
                "descripcion"=> "HIGHWAY es una de las grandes novedades para 2022, este modelo de DRB Bikes es una gran opción para principiantes en BMX. Con calidad y el mejor costo y beneficio del mercado. La geometría de este modelo es adecuada a los estándares mundiales de Bmx. Los componentes son fáciles de reemplazar, lo que permite actualizaciones a piezas profesionales. Como dirección integrada, mov MID central, tija de sillín 25.4, mesa Ahead-Set (over) etc; el Frame tiene refuerzos en el tubo superior e inferior dando mayor resistencia; Ratio de 25 (corona) 9 (cog), Neumáticos 2.35 con un perfil ancho, reforzado y resistente",
                "foto"=> "drb_highway.jpg",
                "fotoAlt"=> "Bicicleta DRB Highway",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "bicicletas_id" => 4,
                "color_id" => 4,
                "modelo" => "Freeway",
                "precio"=> 26860000,
                "marca"=> "DRB",
                "descripcion"=> "La DRB Freeway es la mejor opción para los ciclistas de AM BMX. Geometría adecuada a los estándares mundiales y utilizada por la mayoría de los ciclistas de BMX. Utiliza varios componentes de la línea PRO, lo que facilita futuras actualizaciones y ayuda a la evolución del ciclista.",
                "foto"=> "drb_freeway.jpg",
                "fotoAlt"=> "Bicicleta DRB Freeway",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "bicicletas_id" => 5,
                "color_id" => 5,
                "modelo" => "Fourway",
                "precio"=> 26860000,
                "marca"=> "DRB",
                "descripcion"=> "El modelo FOURWAY es justo lo que todo rider de Street (calle) desea: Una BMX sin frenos, con manubrio 4 piezas y una estética de lujo. Con calidad de una BMX importada y el mejor costo-beneficio del mercado. El cuadro cuenta con refuerzos en el tubo superior e inferior dando mayor resistencia; La relación de transmisión es de 25 (plato) 9 (driver) y posee
                Cubiertas Anchas de 2.40 pulgadas con un perfil ancho, reforzado y resistente.",
                "foto"=> "drb_fourway.jpg",
                "fotoAlt"=> "Bicicleta DRB Fourway",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
        ]);

        DB::table("bicicletas_has_marcas")->insert([
            [
                "bicicletas_id" => 1,
                "marca_id" => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 1,
                "marca_id" => 8,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 1,
                "marca_id" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 2,
                "marca_id" => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 2,
                "marca_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 2,
                "marca_id" => 11,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 3,
                "marca_id" => 6,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 3,
                "marca_id" => 3,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 3,
                "marca_id" => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 4,
                "marca_id" => 11,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 4,
                "marca_id" => 10,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 5,
                "marca_id" => 8,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "bicicletas_id" => 5,
                "marca_id" => 7,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
