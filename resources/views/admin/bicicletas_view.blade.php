<?php 
/** @var \App\Models\Bicicleta $bicicleta */
?>

@extends("layouts.admin")

@section("title", "Detalle de " . $bicicleta->marca . " " . $bicicleta->modelo)

@section("main")

    <x-bicicleta-data :bicicleta="$bicicleta"/>

@endsection