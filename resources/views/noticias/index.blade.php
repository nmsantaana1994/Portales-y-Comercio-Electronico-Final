<?php
use Illuminate\Support\Facades\Storage;
/** @var \App\Models\Noticia[] | \Illuminate\Database\Eloquent\Collection $noticias*/
?>

@extends("layouts.main")

@section("title", "Blog de Noticias")

@section("main")
    <h1 class="mb-3">Noticias</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($noticias as $noticia)
        <div class="col">
          <div class="card">
            <img src="{{ Storage::url('img/'. $noticia->foto) }}" class="card-img-top" alt="{{ $noticia->fotoAlt }}">
            <div class="card-body">
              <h2 class="card-title">{{$noticia->titulo}}</h2>
              <h3 class="h6">{{$noticia->subtitulo}}</h3>
              <p class="card-text">{{$noticia->resumen}}</p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">Publicado el {{$noticia->fecha}}</small>
            </div>
            <div class="d-flex justify-content-center gap-4 my-3">
                <a href="{{ route('noticias.view' , ['id' => $noticia->noticias_id]) }} " class="btn btn-primary w-25">Ver</a>
            </div>
          </div>
        </div>
        @endforeach
    </div>

@endsection