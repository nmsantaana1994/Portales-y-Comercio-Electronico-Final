<?php 
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Noticia $noticia */
?>

@extends("layouts.admin")

@section("title", "Alta noticia")

@section("main")

    <h1 class="my-3">Alta noticia</h1>

    <form action="{{route('noticias.processNew')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-control"
                aria-describedby="tituloHelp"
                value="{{old('titulo')}}"
                @if ($errors->has('titulo')) aria-describedby="error-titulo" @endif
            >
            <div id="tituloHelp" class="form-text">Debe contener un mínimo de 15 caracteres.</div>

            @if ($errors->has('titulo'))
                <div class="text-danger" id="error-titulo">{{ $errors->first('titulo')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="subtitulo" class="form-label fw-bold">Subtítulo:</label>
            <textarea
                id="subtitulo"
                name="subtitulo"
                class="form-control"
                @error ('subtitulo') aria-describedby="error-subtitulo" @enderror
            >{{old('subtitulo')}}</textarea>

            @if ($errors->has('subtitulo'))
                <div class="text-danger" id="error-modelo">{{ $errors->first('subtitulo')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label fw-bold">Fecha de publicación:</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                class="form-control"
                aria-describedby="fechaHelp"
                value="{{old('fecha')}}"
                @error ('fecha') aria-describedby="error-fecha" @enderror
            >
            <div id="fechaHelp" class="form-text">La fecha es obligatoria.</div>

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
                @error ('resumen') aria-describedby="error-resumen" @enderror
            >{{old('resumen')}}</textarea>

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
                aria-describedby="contenidoHelp"
                @error ('contenido') aria-describedby="error-contenido" @enderror
            >{{old('contenido')}}</textarea>
            <div id="contenidoHelp" class="form-text">Debe contener un mínimo de 600 caracteres.</div>
            @error('contenido')
                <div class="text-danger" id="error-contenido">{{ $message }}</div>
            @enderror
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
                value="{{old('fotoAlt')}}"
                @error ('fotoAlt') aria-describedby="error-fotoAlt" @enderror
            >

            @error('fotoAlt')
                <div class="text-danger" id="error-fotoAlt">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Grabar</button>
    </form>
@endsection