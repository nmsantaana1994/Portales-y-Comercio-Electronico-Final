<?php 
/** @var \App\Models\Bicicleta $bicicleta */
?>

@extends("layouts.admin")

@section("title", "Detalle de la bicicleta eliminada " . $bicicleta->marca . " " . $bicicleta->modelo)

@section("main")

    <p>Nota: Está bicicleta está eliminada.</p>

    <x-bicicleta-data :bicicleta="$bicicleta"/>

@endsection