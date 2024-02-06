@extends('layouts.main')

@section('title', 'Págiona no encontrada')

@section('main')
    <h1 class="mb-3">Página no encontrada</h1>

    <p>¡El gato pincho la rueda de la bici!</p>
    <p>Afortunadamente, <a href="{{ url("bicicletas/listado") }}">tenemos muchas otras para ofrecerte</a></p>
@endsection
