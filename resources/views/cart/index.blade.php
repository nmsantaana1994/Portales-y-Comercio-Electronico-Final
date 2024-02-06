<?php
/** @var \App\Cart\Cart[] | \Illuminate\Database\Eloquent\Collection $cart */
/** @var \App\PaymentProviders\MercadoPagoPayment $payment */

// use App\Cart\Cart;
// use App\Cart\CartItem;

//dd($cart);

?>

@extends("layouts.main")

@section("title", "Carrito")

@push("js")
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>        
        const mp = new MercadoPago("<?= $payment->getPublicKey();?>");
        
        mp.bricks().create("wallet", "mp-cobro", {
            initialization: {
                preferenceId: "<?= $payment->preferenceId();?>",
            },
        });

    </script>
@endpush

@section("main")
    <h1 class="text-center p-3">Carrito</h1>

    @if ($cart && count($cart->getItems()) > 0)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Marca y Modelo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->getItems() as $cartItem)
                <tr>
                    <td><p class="my-3">{{ $cartItem->getProduct()->marca }} {{ $cartItem->getProduct()->modelo }}</p></td>
                    <td><p class="my-3">${{ $cartItem->getProduct()->precio }}</p></td>                
                    <td>
                        <form action="{{ route('cart.processLessItem') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cartItem->getProduct()->bicicletas_id }}">
                            <button type="submit" class="btn">
                                <i class="material-icons">expand_more</i>
                            </button>
                        </form>

                        <span class="mx-3">{{ $cartItem->getQuantity() }}</span>

                        <form action="{{ route('cart.processPlusItem') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cartItem->getProduct()->bicicletas_id }}">
                            <button type="submit" class="btn">
                                <i class="material-icons">expand_less</i>
                            </button>
                        </form>

                        <form action="{{ route('cart.deleteItem') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="id" value="{{ $cartItem->getProduct()->bicicletas_id }}">
                            <button type="submit" class="btn">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        </form>
                    </td>
                    <td class="text-end"><p class="my-3">${{ $cartItem->getSubtotal() }}</p></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-12">
                <p class="text-end"><b>Total: ${{ $cart->getTotal() }}</b></p>
            </div>
        </div>

        <div id="mp-cobro"></div>
    @else
        <p class="text-center p-3 h2">No hay items dentro.</p>
        
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <b>El carrito está vacío.</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection