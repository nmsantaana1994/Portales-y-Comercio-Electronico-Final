<?php 
/** @var \App\Models\Noticia $noticia */
?>

@extends("layouts.admin")

@section("title", "$noticia->titulo")

@section("main")
    <h1 class="mb-3">{{$noticia->titulo}}</h1>

    <h2 class="h5">{{$noticia->subtitulo}}</h2>

    <hr>

    <p>{{$noticia->fecha}}</p>

    @if ($noticia->foto !== null && Storage::has("img/" . $noticia->foto))
        <div class="d-flex justify-content-center mb-3">
            <img class="mw-100" src="{{ Storage::url('img/'. $noticia->foto) }}" alt="{{ $noticia->fotoAlt }}"> 
        </div>
    @else
        <p>Acá iría una imagen diciendo que no hay imagen.</p>
    @endif

    <p>{{$noticia->contenido}}</p>

@endsection