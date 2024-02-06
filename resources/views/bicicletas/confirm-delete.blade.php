<?php 
/** @var \App\Models\Bicicleta $bicicleta */
?>

@extends("layouts.admin")

@section("title", "Confirmación para Eliminar la bicicleta" . $bicicleta->marca . " " . $bicicleta->modelo)

@section("main")

    <x-bicicleta-data :bicicleta="$bicicleta"/>

    <hr>

    <form action="{{ route('bicicletas.processDelete', ['id' => $bicicleta->bicicletas_id]) }}" method="post">
        @csrf
        <h2 class="mb-3">Confirmacion Necesaria</h2>

        <p class="mb-3">¿Estás seguro que querés eliminar esta bicicleta?</p>

        <button type="submit" class="btn btn-danger">Si, eliminarla</button>
    </form>

@endsection