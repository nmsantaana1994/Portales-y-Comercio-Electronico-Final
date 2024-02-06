<?php 

namespace App\Cart;

use App\Models\Bicicleta;

class CartItem
{
    public function __construct(
        private Bicicleta $bicicleta,
        private int $quantity = 1
    ){}

    public function getProduct(): Bicicleta
    {
        return $this->bicicleta;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function increaseQuantity(int $increaseBy = 1): void {
        $this->quantity += $increaseBy;
    }

    public function decreaseQuantity(int $decreaseBy = 1): void {
        $this->quantity -= $decreaseBy;
    }

    public function getSubtotal(): int|float {
        return $this->getProduct()->precio * $this->quantity;
    }
}