<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use function PHPUnit\Framework\assertJson;

/**
 * # Cómo funcionan los tests hacia una API
 * Lo primero que vamos a notar de todos los tests de Feature, es que no heredan de la clase TestCase nativa
 * de phpUnit, sino de una de Laravel, que a su vez hereda de la de phpUnit.
 * Esta clase de Laravel agrega un montón de funcionalidades y assertions a phpUnit que se integran mucho
 * mejor con la estructura propia del framework.
 *
 * Por ejemplo, agregan varios métodos para testear peticiones de HTTP contra nuestra aplicación.
 * Si bien no simulan realmente un browser (es decir, no son aptas para E2E testing), sí simulan realizar
 * peticiones de HTTP igual a un browser, e incluso agregan acciones que podemos realizar sobre el HTML
 * resultante, como ver el contenido, hacer clicks, y algunas cositas.
 *
 * Por ejemplo, si queremos hacer peticiones a la web, podemos usar métodos que se llaman igual que los
 * métodos de HTTP que ejecutan:
 * - get
 * - post
 * - put
 * - patch
 * - delete
 * - options
 *
 * Asimismo, si queremos correr peticiones hacia una API REST hecha en Laravel (cuyas rutas habitualmente
 * están definidas en el archivo [routes/api.php]), los métodos incluyen el sufijo "Json":
 * - getJson
 * - postJson
 * - putJson
 * - patchJson
 * - deleteJson
 * - optionsJson
 *
 * Las primeras simulan peticiones de un browser común, y las segundas simulan peticiones de Ajax o
 * equivalente.
 *
 * A nosotros nos interesan las segundas.
 *
 * Ambos grupos de peticiones retornan un objeto de Response, que agrega algunos métodos de ayuda para
 * depuración (dump, dumpHeaders y dumpSession), y varias assertions para verificar el contenido.
 */
class BicicletasAdminAPITest extends TestCase
{
    // El trait RefreshDatabase pide que se corran las migrations antes de los test de esta clase.
    // No corre los seeders. Si queremos que lo haga (sino la base queda vacia), tenemos que indicarlo
    // con la propiedad restringida "$seed" en true.
    use RefreshDatabase;

    protected bool $seed = true;

    public function asUser(): self {
        $user = new User();
        $user->user_id = 1;
        //$user->role_id = "admin";
        return $this->actingAs($user);
    }

    /**
     * A basic feature test example.
     */
    public function test_making_a_get_request_to_the_bicicletas_api_root_returns_all_the_bicicletas(): void
    {
        // Por defecto, todas las rutas del archivo [route/api.php], que es donde se definen habitualmente
        // las rutas para una API JSON, incluyen el prefijo de la URL "api/".
        $response = $this->asUser()->getJson('/api/bicicletas');

        // Si queremos ver el contenido completo de lo que la petición obtuvo, incluyendo algunos datos de
        // la propia petición, podemos usar el método dump() de la respuesta.
        // $response->dump();

        /**
         * Noten que las assertions las hacemos no sobre $this, sino sobre la respuesta que obtuvimos de
         * ejecutar la petición.
         * Este objeto de respuesta soporta una interfaz fluida de métodos para las assertions.
         *
         * En este caso, vamos a traer las bicicletas como un JSON con el siguiente formato:
         *  {
         *      status: 0,
         *      data: [
         *          {
         *              bicicletas_id: 1,
         *              modelo: '...',
         *              ...
         *          },
         *          ...
         *      ]
         *  }
         *
         * status lo vamos a usar para indicar que todo salió bien (valor 0) o si algo salió mal (cualquier
         * otro número).
         * data va a contener los resultados que se incluyen como respuesta a la petición. En este caso, un
         * array de las bicicletas.
         *
         * Si la cosa sale bien, deberíamos observar que:
         * - La petición vuelve con un código de HTTP 200.
         * - El status tiene un valor 0.
         * - data es un array de 3 elementos.
         * - Esos elementos tienen como propiedades los campos de las bicicletas (bicicletas_id, etc).
         */
        $response
            ->assertStatus(200)
            ->assertJsonPath("status", 0)
            ->assertJsonCount(3, "data")
            ->assertJsonStructure([
                // Pedimos que tenga un campo status, de cualquier valor.
                "status",
                // Pedimos que tenga un campo data, que sea un objeto o array.
                "data" => [
                    // Indicamos que debe ser un array de objetos.
                    "*" => [
                        // Indicamos los campos que esos objetos deben tener.
                        "bicicletas_id",
                        "color_id",
                        "modelo",
                        "precio",
                        "marca",
                        "descripcion",
                        "foto",
                        "fotoAlt",
                        "created_at",
                        "updated_at",
                        "deleted_at"
                    ]
                ]
            ]);
    }

    public function test_making_a_get_request_to_the_bicicletas_api_root_without_being_authenticated_returns_401(){
        $response = $this->getJson("/api/bicicletas");

        $response->assertStatus(401);
    }

    public function test_making_a_get_request_to_bicicletas_with_an_id_returns_the_requested_bicicleta(){
        $id = 1;
        $response = $this->asUser()->getJson("/api/bicicletas/" . $id);

        $response
            ->assertStatus(200)
            // Vamos a verificar el JSON, pero en vez de usar los metodos assertJsonSarza de arriba, vamos
            // a usar la "nueva" API de assertions para JSON: assertJson().
            // Esta forma utiliza las arrow functions para hacer una interfaz mucho más práctica.
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where("status", 0)
                    ->where("data.bicicletas_id", $id)
                    // Indicamos los tipos de datos que deben tener las otras propiedades
                    ->whereAllType([
                        "status" => "integer",
                        "data.bicicletas_id" => "integer",
                        "data.color_id" => "integer",
                        "data.modelo" => "string",
                        "data.precio" => "integer|double",
                        "data.marca" => "string",
                        "data.descripcion" => "string",
                        "data.foto" => "string",
                        "data.fotoAlt" => "string",
                        "data.created_at" => "string",
                        "data.updated_at" => "string",
                        "data.deleted_at" => "string|null",
                    ])
            );

    }

    public function test_making_a_get_request_to_bicicletas_with_an_id_that_doesnt_exists_returns_a_404() {
        $user = new User();
        $user->user_id = 1;
        $response = $this->actingAs($user)->getJson("/api/bicicletas/4");

        $response->assertStatus(404);
    }

    public function test_making_a_post_request_whit_valid_data_create_a_new_bicicleta() {
        $data = [
            "color_id" => 1,
            "modelo" => "Test",
            "precio" => 222222,
            "marca" => "Prueba",
            "descripcion" => "Probando el alta de una bicicleta con un Test",
        ];

        $response = $this->asUser()->postJson("/api/bicicletas", $data);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where("status", 0),
            );

        //Para verificar que la bicicleta se creo, vamos a hacer una petición que lea la noticia (sería la
        // 4) y verifique que los datos sean los mismos que enviamos.

        $response = $this->getJson("/api/bicicletas/4");

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where("status", 0)
                    ->where("data.color_id", $data["color_id"])
                    ->where("data.modelo", $data["modelo"])
                    ->where("data.precio", $data["precio"])
                    ->where("data.marca", $data["marca"])
                    ->where("data.descripcion", $data["descripcion"])
                    ->where("data.foto", null)
                    ->where("data.fotoAlt", null)
                    // etc() sirve para decirle a Laravel que puede haber otras cosas en el JSON, y que está
                    // bien.
                    ->etc()
            );
    }
} 
