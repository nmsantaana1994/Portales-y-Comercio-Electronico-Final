<?php
/** @var \App\Models\Bicicleta[]|Illuminate\Database\Eloquent\Collection $bicicletas*/
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
            @foreach($bicicletas as $bicicleta)
            <tr>
                <td>{{ $bicicleta->marca }} {{ $bicicleta->modelo }}</td>
                <td>${{ $bicicleta->precio }}</td>
                <td>1</td>
                <td>${{ $bicicleta->precio }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="mp-cobro"></div>
@endsection