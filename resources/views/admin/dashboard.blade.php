@extends('layouts.admin')

@section('title', 'Tablero')

@section('main')
    <h1 class="mb-3 text-center">¡Bienvenido Admin!</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bicicleta más vendida</h5>
            @if($bicicletaMasVendida)
                <p class="card-text">ID de la bicicleta: {{ $bicicletaMasVendida->bicicletas_id }}</p>
                <p class="card-text fw-semibold">{{ $bicicletaMasVendida->marca }} {{ $bicicletaMasVendida->modelo }}</p>
                <img class="w-25" src="{{ Storage::url('img/'. $bicicletaMasVendida->foto) }}" alt="{{ $bicicletaMasVendida->fotoAlt }}">
                <p class="card-text"><b>Cantidad vendida:</b> {{ $cantidadTotalVendida }}</p>
                <p class="card-text"><b>Total recaudado:</b> ${{ number_format($totalRecaudadoBicicletaMasVendida, 2) }}</p>
                <!-- Agrega aquí cualquier otro detalle que desees mostrar -->
            @else
                <p class="card-text">No hay datos disponibles</p>
            @endif 
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <p class="h5 card-title">Total recaudado</p>
            <p class="card-text">${{ number_format($totalRecaudado, 2) }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Detalles de compras por usuario</h5>
            <ul class="list-group">
                @foreach($detallesComprasPorUsuario as $detalle)
                    <li class="list-group-item">{{ $detalle->nombre }} compró {{ $detalle->cantidad }} de {{ $detalle->marca }} {{ $detalle->modelo }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection