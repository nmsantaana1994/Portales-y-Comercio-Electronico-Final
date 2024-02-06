<?php

namespace Tests\Unit;

use App\Cart\Cart;
use App\Cart\CartItem;
use App\Models\Bicicleta;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function createItem(int $id = 1, int $precio = 14240000, int $quantity = 1) {
        $bicicleta = new Bicicleta();
        $bicicleta->bicicleta_id = $id;
        $bicicleta->precio = $precio;
        return new CartItem($bicicleta, $quantity);
    }

    public function test_can_add_a_cartitem_to_the_cart(): Cart
    {
        $id = 1;
        // $bicicleta = new Bicicleta();
        // $bicicleta->bicicleta_id = $id;
        // $bicicleta->precio = 14240000;
        // $item = new CartItem($bicicleta);
        $item = $this->createItem($id);
        $cart = new \App\Cart\Cart;

        $cart->addItem($item);

        $this->assertCount(1, $cart->getItems());
        $this->assertSame($item, $cart->getItems($id)[0]);
        $this->assertSame($item, $cart->getItem($id));

        // Retornamos la instancia del Cart.
        // Esto va a permitir que otro test utilice como una dependencia el retorno de este test.
        // En el método que sigue, podemos ver como pedir recibir este valor.
        return $cart;
    }

    // Declaramos la dependencia del test.
    // Para hacer esta declaración, debemos utilizar el Attribute "Depends" de phpUnit. Está función debe
    // recibir como argumento el nombre, como string, del método del cual queremos depender.
    // Al hacerlo, el método que estamos creando va a recibir como argumento lo que el método que
    // referenciamos retorne.
    // ¿Qué son los Attributes?
    // Los Attributes son una estructura que agrega php 8 que son similar a lo que antes se lograban usando
    // las llamadas "Annotations".
    // En esencia, son meta-data que podemos agregar a una función o método al momento de su definición para
    // modificar su comportamiento, agregar nueva funcionalidad o simplemente normalizar/documentar algo.
    // La sinxtaxis es:
    //  #[Attribute(parameters)]
    #[Depends('test_can_add_a_cartitem_to_the_cart')]
    public function test_can_add_another_different_cartitem_to_the_array_to_include_it_in_the_items(Cart $cart): Cart {
        $id = 2;
        $item = $this->createItem($id);

        $cart->addItem($item);

        $this->assertCount(2, $cart->getItems());
        $this->assertSame($item, $cart->getItems()[1]);
        $this->assertSame($item, $cart->getItem($id));

        return $cart;
    }

    #[Depends('test_can_add_another_different_cartitem_to_the_array_to_include_it_in_the_items')]
    public function test_can_add_an_alredy_included_item_to_increase_its_quantity_instead_of_adding_a_new_item_to_the_cart(Cart $cart) {
        $id = 2;

        // Agregamos una segunda vez el item para el id 2.
        $cart->addItem($this->createItem($id));

        $this->assertCount(2, $cart->getItems());
        $this->assertSame(2, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_add_an_alredy_included_item_to_increase_its_quantity_instead_of_adding_a_new_item_to_the_cart')]
    public function test_can_remove_item_included_in_the_cart(Cart $cart) {
        $id = 1;

        $cart->removeItem($id);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals(null, $cart->getItem($id));
    }

    public function test_can_get_the_cart_total_cost() {
        $cart = new Cart();
        $cart->addItem($this->createItem(1, 14240000, 2));
        $cart->addItem($this->createItem(2, 12500000, 1));
        $expectatedResult = (14240000 * 2) + 12500000;

        $this->assertSame($expectatedResult, $cart->getTotal());
    }
}
