<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("noticias")->insert([
            [
                "noticias_id" => 1,
                "titulo" => "Los trucos de Viki Gómez, con más color y brillo que nunca entre tulipanes",
                "subtitulo"=> "No solo la región del Bollenstreek cae ante el hechizo de las flores. También lo hace el atleta de BMX Viki Gómez, que muestra sus trucos en un colorido campo de tulipanes en Zevenhoven.",
                "resumen"=>'La manera de ver el BMX Flatland de Viki Gómez es casi filosófica. Mucho más que trucos en bici. Describe su deporte como "una batalla entre tu mente, la gravedad y la física pura; una forma de empujar los límites de tu imaginación". Viki es leyenda en España y en el mundo.',
                "contenido"=> 'La manera de ver el BMX Flatland de Viki Gómez es casi filosófica. Mucho más que trucos en bici. Describe su deporte como "una batalla entre tu mente, la gravedad y la física pura; una forma de empujar los límites de tu imaginación". Viki es leyenda en España y en el mundo.

                Lleva en la cima de su disciplina durante más de 20 años, ganando tres campeonatos del mundo, tres NORA Cup y tres de las cuatro ediciones del Red Bull Circle of Balance. Y como uno de los pocos profesionales del BMX Flatland, compagina las competiciones y proyectos por todo el mundo con su trabajo como empresario.
                
                El BMX Flatland es el arte de girar y equilibrarse sobre la bici en diferentes posiciones, sin tocar el suelo con los pies. La bici tiene algunos elementos especiales, como los pegs, que contribuyen a este propósito.

                Y si podías que no podía ser más espectacular, estás muy equivocado. Viki se saca de la manga en este último vídeo un nuevo truco, un 360 Bikeflip. Consiste en dar la vuelta a su bici por completo y recuperarla sin usar los pies.',
                "fecha"=> "2023-04-26",
                "foto"=> "fotoNoticia.jpg",
                "fotoAlt"=> "Viki Gomez entre tulipanes",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "noticias_id" => 2,
                "titulo" => "Así es la bici BSD Freedom que usó Kriss Kyle para Don’t Look Down",
                "subtitulo"=> "El rider escocés de BMX ha pasado a otro nivel (literalmente) en su último edit. Chequea todos los detalles sobre la bici que ha usado en Don't Look Down.",
                "resumen"=>"El último edit de Kriss Kyle, Don't Look Down, le ha llevado a un park en el cielo suspendido de un globo aerostático. Sí, tal y como lo lees. El escocés suma otro hito en su carrera, cargada de Vídeos y edits de BMX durante la última década.",
                "contenido"=> "El último edit de Kriss Kyle, Don't Look Down, le ha llevado a un park en el cielo suspendido de un globo aerostático. Sí, tal y como lo lees.
                
                El escocés suma otro hito en su carrera, cargada de Vídeos y edits de BMX durante la última década.
                
                Con 31 años, el rider de Stranraer, Escocia, acumula un catálogo de vídeos del que pocos -o ninguno- pueden presumir. Desde saltar desde un helicóptero a un quarterpipe en lo alto del Burj Khalifa a una espectacular sesión en Legoland, Dinamarca.
                
                Su último edit, Don’t Look Down, es seguramente uno de los proyectos que marcará su carrera. Algo que nadie ha hecho antes, conquistando el cielo en un bowl especial de fibra de carbono, suspendido del mayor globo aerostático del Reino Unido. Aunque montar a gran altura no fue un problema, que fuera capaz de tirar algunos trucos como el tyre tap te deja con el corazón en un puño.
                
                Para el proyecto, Kriss necesitó una bici que le diera confianza. En su mente había solo un cuadro posible: el modelo BSD Freedom. Diseñado para conquistar desde bowls hasta trails, la tubería Sanko Japanese 4130 CrMo le daba ligereza y agilidad, pero también la fuerza para sobrevivir a la caídas que pudiera encontrarse en el camino.
                El resto de los componentes se los dejó a su patrocinador con sede en Glasgow, con un pequeño extra. Para el edit, Kriss optó por usar un freno trasero de la americana Odyssey, en lugar de su habitual bici sin frenos.
                
                De color naranja, el cuadro hizo brillar más todavía su riding.",
                "fecha"=> "2023-04-13",
                "foto"=> "fotoNoticia2.jpg",
                "fotoAlt"=> "Bicicleta BSD Freedom",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
            [
                "noticias_id" => 3,
                "titulo" => "Los colombianos dominan los titulares en Red Bull Guanajuato Cerro Abajo",
                "subtitulo"=> "Doble éxito de Colombia en la carrera y en la lucha por el título absoluto al concluir en las calles de Guanajuato la carrera final de la serie de descenso urbano Red Bull Cerro Abajo.",
                "resumen"=>"La última carrera de la serie de carreras de descenso urbano Red Bull Cerro Abajo en Guanajuato, México, fue un final apropiado para el primer año de la competición, con el colombiano Camilo Sánchez saliendo a la cabeza para llevarse la corona de Red Bull Guanajuato Cerro Abajo.",
                "contenido"=> "La última carrera de la serie de carreras de descenso urbano Red Bull Cerro Abajo en Guanajuato, México, fue un final apropiado para el primer año de la competición, con el colombiano Camilo Sánchez saliendo a la cabeza para llevarse la corona de Red Bull Guanajuato Cerro Abajo.

                Sánchez registró un tiempo de 1m 55.766s, y fue 2.2s más rápido que el canadiense especialista en descenso de la Copa del Mundo UCI Jackson Goldstone dejándolo en el segundo lugar. El chileno Felipe Agurto se quedó en el tercer puesto. Sánchez, que se había caído en la última jornada en Medellín, le sacó partido al circuito mexicano.",
                "fecha"=> "2023-03-27",
                "foto"=> "fotoNoticia3.jpg",
                "fotoAlt"=> "Podio Red Bull Guanajuato Cerro Bajo",
                "created_at"=> now(),
                "updated_at"=> now(),
            ],
        ]);
    }
}
