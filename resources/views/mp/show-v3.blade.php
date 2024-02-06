<?php
/** @var \App\Cart\Cart[]|Illuminate\Database\Eloquent\Collection $cart*/
/** @var \App\PaymentProviders\MercadoPagoPayment $payment */
?>
@extends('layouts.main')

@section('title', "Ejemplo de Integración con Mercado Pago")

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
    <h1>Integración con Mercado Pago</h1>

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
            @foreach($cart as $cartItem)
            <tr>
                <td>{{ $cartItem->getProduct()->marca }} {{ $cartItem->getProduct()->modelo }}</td>
                <td>${{ $cartItem->getProduct()->precio }}</td>                
                <td>
                    <?php
                        $bicicletaId = $cartItem->getProduct()->bicicletas_id;
                        $quantity = $cartItem->getQuantity()
                    ?>

                    <form action="{{ route('cart.processLessItem') }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn">
                            <i class="material-icons">expand_more</i>
                        </button>
                    </form>
                    
                    <span class="mx-3">{{ $cartItem->getQuantity() }}</span>

                    <form action="{{ route('cart.processPlusItem') }}" method="POST" class="d-inline-block">
                        @csrf    
                        <button class="btn">
                            <i class="material-icons">expand_less</i>
                        </button>
                    </form>
                </td>
                <td>${{ $cartItem->getSubtotal() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="mp-cobro"></div>
@endsection