<?php

namespace App\PaymentProviders;

use App\Cart\CartItem;
use App\Cart\Cart;
use App\Models\Bicicleta;
use App\PaymentProviders\Exceptions\UndefinedAccessTokenException;
use App\PaymentProviders\Exceptions\UndefinedPublicKeyException;
use Illuminate\Database\Eloquent\Collection;
use MercadoPago\Item;
use MercadoPago\Preference;
use Illuminate\Support\Facades\Log;

class MercadoPagoPayment {

    protected Preference $preference;

    protected array $items = [];

    protected array $backUrls = [];

    protected bool $autoReturn = false;

    protected string $publicKey;

    public function __construct()
    {
        if(empty(config('mercadopago.accessToken'))) {
            throw new UndefinedAccessTokenException();
        }
        if(empty(config('mercadopago.publicKey'))) {
            throw new UndefinedPublicKeyException();
        }

        \MercadoPago\SDK::setAccessToken(config("mercadopago.accessToken"));
        $this->publicKey = config("mercadopago.publicKey");
        $this->preference = new Preference();
    }

    /**
     * @param Cart $cart
     * @return self
     */
    public function addItems(Cart $cart): self {
        $items = $cart->getItems();

        foreach($items as $cartItem) {
            //Log::debug($cartItem);

            $this->addItem($cartItem);
        }

        return $this;
    }

    public function addItem(CartItem $bicicleta): self {
        $item = new Item();
        
        $item->title = $bicicleta->getProduct()->modelo;
        $item->unit_price = $bicicleta->getProduct()->precio;
        $item->quantity = $bicicleta->getQuantity();

        $this->items[] = $item;

        return $this;
    }

    public function withBackUrls(?string $success = null, ?string $pending = null, ?string $failure = null): self {
        if($success !== null) $this->backUrls["success"] = $success;
        if($pending !== null) $this->backUrls["pending"] = $pending;
        if($failure !== null) $this->backUrls["failure"] = $failure;
        
        return $this;
    }

    public function withAutoReturn(): self {
        $this->autoReturn = true;

        return $this;
    }

    public function save(): self {
        $this->preference->items = $this->items;
        $this->preference->back_urls = $this->backUrls;
        if($this->autoReturn) $this->preference->auto_return = "approved";

        $this->preference->save();

        return $this;
    }

    public function getPublicKey(): string {
        return $this->publicKey;
    }

    public function preferenceId(): string {
        if ($this->preference->id === null) {
            // Si la preferencia aún no tiene un ID asignado, devolvemos una cadena vacía.
            // También podrías lanzar una excepción aquí si lo prefieres, dependiendo de cómo quieras manejar el caso de la preferencia sin ID.
            return '';
        }
        
        return $this->preference->id;
    }
}