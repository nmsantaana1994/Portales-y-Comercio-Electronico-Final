<?php 
// Laravel crea en todas las vistas de Blade, automáticamente, una variable $errors de tipo ViewErrorBag.
// Esta variable contiene los mensajes de error que hayan ocurrido, en caso de haberlos.

/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Colores[]|\Illuminate\Database\Eloquent\Collection $colores */
/** @var \App\Models\Marca[]|\Illuminate\Database\Eloquent\Collection $marcas */
?>

@extends("layouts.admin")

@section("title", "Alta de Bicicletas")

@section("main")
    <h1>Alta de Bicicletas</h1>

    <form action="{{ route('bicicletas.processNew') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="marca" class="form-label fw-bold">Marca</label>
            <input 
                type="text" 
                id="marca" 
                name="marca" 
                class="form-control"
                @error ('marca') aria-describedby="error-marca" @enderror
                value="{{ old('marca') }}"
            >

            @error("marca")
                <div class="text-danger" id="error-marca">{{ $message }}</div>
            @enderror

        </div>

        <fieldset class="mb-3">
            <label class="d-block form-label fw-bold">Marcas</label>

            @foreach($marcas as $marca)
                <div class="form-check-inline">
                    <label class="form-check-label">
                    <input
                        type="checkbox"
                        name="marca_id[]"
                        class="form-check-input"
                        value="{{ $marca->marca_id }}"
                        @checked(in_array($marca->marca_id, old("marca_id", [])))
                    >
                    {{ $marca->nombre }}
                </label>
                </div>
            @endforeach
        </fieldset>

        <div class="mb-3">
            <label for="modelo" class="form-label fw-bold">Modelo</label>
            <input 
                type="text" 
                id="modelo" 
                name="modelo" 
                class="form-control"
                @error ('modelo') aria-describedby="error-modelo" @enderror
                value="{{ old('modelo') }}"
            >

            @error("modelo")
                <div class="text-danger" id="error-modelo">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input 
                type="text" 
                id="precio" 
                name="precio" 
                class="form-control"
                @error ('precio') aria-describedby="error-precio" @enderror
                value="{{ old('precio') }}"
            >

            @error("precio")
                <div class="text-danger" id="error-precio">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color_id" class="form-label fw-bold">Color</label>
            <select
                name="color_id"
                id="color_id"
                class="form-control"
                @error ('color_id') aria-describedby="error-color_id" @enderror
            >
                <option value=""></option>
                @foreach($colores as $color)
                    <option
                        value="{{ $color->color_id }}"
                        @selected(old("color_id") == $color->color_id)
                    >{{ $color->nombre }}</option>
                @endforeach
            </select>

            @error("color_id")
                <div class="text-danger" id="error-color_id">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea 
                id="descripcion" 
                name="descripcion" 
                class="form-control"
                @error ('descripcion') aria-describedby="error-descripcion" @enderror
            >{{ old('descripcion') }}</textarea>

            @if ($errors->has('descripcion'))
                <div class="text-danger" id="error-modelo">{{ $errors->first('descripcion')}}</div>
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
            <label for="fotoAlt" class="form-label fw-bold">Descripción de la foto</label>
            <input 
                type="text" 
                id="fotoAlt" 
                name="fotoAlt" 
                class="form-control"
                @error ('fotoAlt') aria-describedby="error-fotoAlt" @enderror
                value="{{ old('fotoAlt') }}"
            >

            @if ($errors->has('fotoAlt'))
                <div class="text-danger" id="error-fotoAlt">{{ $errors->first('fotoAlt')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100">Publicar</button>
    </form>
@endsection