<?php

namespace App\Cart;

use App\Models\Bicicleta;

class Cart
{
    /** @var array|CartItem[] */    
    private array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function addItem(CartItem $newItem): void {
        foreach ($this->items as $item) {
            if ($item->getProduct()->bicicletas_id === $newItem->getProduct()->bicicletas_id) {
                $item->increaseQuantity();

                // Ya encontramos la bicicleta, asi que terminamos la ejecución del método.
                return;
            }
        }

        $this->items[] = $newItem;
    }
    
    public function removeItem(int $id) {
        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->bicicletas_id === $id) {
                // Para borrar el item, hicimos un unset de la clave del array.
                // Esto es necesario para que funcione.
                unset($this->items[$key]);

                // Alguien podría pensar que tal vez fuese posible hacer un unset de $item, que es la variables
                // que generamos para el valor en el foreach.
                // unset($item);
                // Sin embargo, eso no funciona.
                // El motivo es que el unset está eliminando la variable $item, pero no el valor almacenado
                // en el array.
                return;
            }
        }    
    }

    public function getItem(int $id) {
        foreach ($this->items as $item) {
            if ($item->getProduct()->bicicletas_id === $id) {
                return $item;
            }
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function getTotal(): int {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }

        return $total;
    }
}