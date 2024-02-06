<?php 
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Noticia $noticia */
?>

@extends("layouts.admin")

@section("title", "Editar noticia")

@section("main")

    <h1 class="my-3">Edición nota: "{{$noticia->titulo}}"</h1>

    <form action="{{ route('noticias.processUpdate', ['id' => $noticia->noticias_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-control"
                value="{{old('titulo', $noticia->titulo)}}"
                @error('titulo') aria-describedby="error-titulo" @enderror
            >

            @error('titulo')
                <div class="text-danger" id="error-titulo">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="subtitulo" class="form-label fw-bold">Subtítulo:</label>
            <textarea
                id="subtitulo"
                name="subtitulo"
                class="form-control"
                @error('subtitulo') aria-describedby="error-subtitulo" @enderror
            >{{old('subtitulo', $noticia->subtitulo)}}</textarea>

            @error('subtitulo')
                <div class="text-danger" id="error-subtitulo">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label fw-bold">Fecha de publicación:</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                class="form-control"
                value="{{old('fecha', $noticia->fecha)}}"
                @error('fecha') aria-describedby="error-fecha" @enderror
            >

            @error('fecha')
                <div class="text-danger" id="error-fecha">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="resumen" class="form-label fw-bold">Resumen:</label>
            <textarea
                id="resumen"
                name="resumen"
                class="form-control"
                @error('resumen') aria-describedby="error-resumen" @enderror
            >{{old('resumen', $noticia->resumen)}}</textarea>

            @error('resumen')
                <div class="text-danger" id="error-resumen">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="contenido" class="form-label fw-bold">Contenido:</label>
            <textarea
                id="contenido"
                name="contenido"
                class="form-control"
                @error('contenido') aria-describedby="error-contenido" @enderror
            >{{old('contenido', $noticia->contenido)}}</textarea>

            @error('contenido')
                <div class="text-danger" id="error-contenido">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <p class="fw-bold">Imagen actual</p>

            @if ($noticia->foto !== null && Storage::has("img/" . $noticia->foto))
                <img class="mw-100" src="{{ Storage::url('img/'. $noticia->foto) }}" alt="{{ $noticia->fotoAlt }}"> 
            @else
                <p>Acá iría una imagen diciendo que no hay imagen.</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label fw-bold">Foto</label>
            <input 
                type="file" 
                id="foto" 
                name="foto" 
                class="form-control"
                @error ('foto') aria-describedby="error-foto" @enderror
            >

            @if ($errors->has('foto'))
                <div class="text-danger" id="error-foto">{{ $errors->first('foto')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="fotoAlt" class="form-label fw-bold">Descripción de foto:</label>
            <input
                type="text"
                id="fotoAlt"
                name="fotoAlt"
                class="form-control"
                value="{{old('fotoAlt', $noticia->fotoAlt)}}"
                @error ('fotoAlt') aria-describedby="error-fotoAlt" @enderror
            >

            @if ($errors->has('fotoAlt'))
                <div class="text-danger" id="error-fotoAlt">{{ $errors->first('fotoAlt')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100">Grabar</button>
    </form>
@endsection