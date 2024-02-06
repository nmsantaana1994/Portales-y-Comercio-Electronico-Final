<?php

namespace Tests\Unit;

use App\Cart\CartItem;
use App\Models\Bicicleta;
use PHPUnit\Framework\TestCase;

/**
 * Toda clase que vaya a contener tests debe incluir en su nombre el sufijo "Test".
 * Además, debe heredar de la clase TestCase de phpUnit.
 * 
 * Dentro de la clase vamos a poder definir los métodos para los tests. Cada test se define con un método
 * diferente.
 * No todos los métodos de la clase van a necesariamente ser tests. Por eso es que los que si lo sean deben
 * incluir en su nombre el prefijo "test".
 * 
 * Por convención, los nombres de los tests deberían describir de la manera más clara posible lo que están
 * testeando, sin preocuparse por la longitud del nombre del método.
 * Laravel propone como convención que para los nombres de las clases usemos "snake_case".
 */
class CartItemTest extends TestCase
{
    public function createBicicleta(int $id = 1, int $precio = 14240000, ) {
        // $bicicleta = new Bicicleta;
        // $bicicleta->bicicleta_id = $id;
        // $bicicleta->precio = $precio;
        // return $bicicleta;

        return new Bicicleta([
            "bicicleta_id" => $id,
            "precio" => $precio,
        ]);
    }

    /**
     * Como primer test, vamos a verificar que podamos instanciar un CartItem con solo una bicicleta, y que
     * esto le de una cantidad por defecto en 1.
     */
    public function test_can_instantiate_a_cartitem_with_a_bicicleta_and_a_default_quantity_of_1(): void
    {
        // Anatomía de un test.
        // Los tests suelen tener 3 partes:
        // 1. Definición de variables y configuración del entorno.
        // 2. Ejecución del método o función a testear.
        // 3. Verificación de expectativas.

        // 1. Definimos la bicicleta que necesitamos para instanciar el CartItem.
        // $bicicleta = new Bicicleta();
        // $bicicleta->bicicleta_id = 1;
        // $bicicleta->color_id = 1;
        // $bicicleta->modelo = "Control";
        // $bicicleta->precio = 14240000;
        // $bicicleta->marca = "Cult";
        // $bicicleta->descripcion = "La Cult Control es una BMX de gama media. La Control tiene un cuadro con tubo superior de 20.75 hecho con un triángulo delantero 100% de cromo, horquillas y barras de cromo. Se ha montado con piezas sólidas de calidad del mercado de accesorios, buje trasero de cassette de 9t sellado, juego de dirección sellado, bielas de cromo con BB medio sellado, neumáticos de 2,4 Cult X Vans neumáticos, freno trasero 990 U-Brake, potencia forjada Salvation y mucho más.";
        // $bicicleta->foto = "cult_control.png";
        // $bicicleta->fotoAlt = "Bicicleta Cult Control";
        $bicicleta = $this->createBicicleta();

        // 2. Instanciamos la clase.
        $item = new \App\Cart\CartItem($bicicleta);

        // 3. Verificación de expectativas.
        // Las verificaciones las hacemos generalmente con ayuda de métodos de "assertions" ("verificación" o
        // "afirmación").
        // La clase TestCase incluye múltiples métodos que empiezan con "assert", y sirven para realizar
        // las verificaciones. Si las verificaciones fallan, el test se reporta como fallido con un mensaje
        // acorde.
        // En este caso vamos a verificar 3 cosas:
        // 1. Que $item sea una instancia de CartItem (esto es completamente innecesario, ya que salvo que
        // falle el "new", siempre va a ser una instancia de CartItem).
        // 2. Que el getProduct() de $item nos retorne la misma exacta instancia de Bicicleta que le proveimos en
        // el constructor.
        // 3. Que getQuantity() nos retorne un 1.
        $this->assertInstanceOf(\App\Cart\CartItem::class, $item);
        // assertSame hace la comparación con ===. Y en el caso de objetos, compara que sean ambos valores
        // una referencia al mismo objeto.
        $this->assertSame($bicicleta, $item->getProduct());
        // assertsEquals hace la comparación con ==.
        $this->assertEquals(1, $item->getQuantity());
    }

    public function test_can_instantiate_a_cartitem_with_a_bicicleta_and_a_custom_quantity() {
        // $bicicleta = new Bicicleta;
        // $bicicleta->bicicleta_id = 1;
        // $bicicleta->precio = 14240000;
        $quantity = 3;

        $item = new CartItem($this->createBicicleta(), $quantity);

        $this->assertEquals($quantity, $item->getQuantity());
    }

    public function test_can_set_the_cartitem_quantity(): void {
        // $bicicleta = new Bicicleta;
        // $bicicleta->bicicleta_id = 1;
        // $bicicleta->precio = 14240000;
        
        $item = new CartItem($this->createBicicleta());
        $quantity = 4;

        $item->setQuantity($quantity);

        $this->assertEquals($quantity, $item->getQuantity());
    }

    public function test_can_increase_the_cartitem_quantity_by_a_default_amount_of_1(): void {
        // $bicicleta = new Bicicleta;
        // $bicicleta->bicicleta_id = 1;
        // $bicicleta->precio = 14240000;

        $item = new CartItem($this->createBicicleta());

        $item->increaseQuantity();

        $this->assertEquals(2, $item->getQuantity());
    }

    public function test_can_increase_the_cartitem_quantity_by_a_custom_amount(): void {
        $item = new CartItem($this->createBicicleta());

        $item->increaseQuantity(3);

        $this->assertEquals(4, $item->getQuantity());
    }

    public function test_can_decrease_the_cartitm_quantity_by_a_default_amount_of_1(): void {
        $item = new CartItem($this->createBicicleta(), 4);

        $item->decreaseQuantity();

        $this->assertEquals(3, $item->getQuantity());
    }

    public function test_can_decrease_the_cartitem_quantity_by_a_custom_amount(): void {
        $item = new CartItem($this->createBicicleta(), 3);

        $item->decreaseQuantity(2);

        $this->assertEquals(1, $item->getQuantity());
    }

    public function test_can_get_the_cartitem_subtotal(): void {
        $item = new CartItem($this->createBicicleta(1, 14240000), 2);
        $expectedSubtotal = 14240000 * 2; // 28480000

        $this->assertEquals($expectedSubtotal, $item->getSubtotal());
    }
}
