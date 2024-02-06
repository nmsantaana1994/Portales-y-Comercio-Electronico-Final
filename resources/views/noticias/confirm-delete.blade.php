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

    <hr>

    <form action="{{ route('noticias.processDelete', ['id' => $noticia->noticias_id]) }}" method="post">
        @csrf
        <h2 class="mb-3">Confirmacion Necesaria</h2>

        <p class="mb-3">¿Estás seguro que querés eliminar esta noticia?</p>

        <button type="submit" class="btn btn-danger">Si, eliminarla</button>
    </form>

@endsection