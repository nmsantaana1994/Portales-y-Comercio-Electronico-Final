<?php 
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Bicicleta $bicicleta */
/** @var \App\Models\Colores[]|\Illuminate\Database\Eloquent\Collection $colores */
/** @var \App\Models\Marca[]|\Illuminate\Database\Eloquent\Collection $marcas */
?>

@extends("layouts.admin")

@section("title", "Editar bicicleta: " . $bicicleta->marca . " " . $bicicleta->modelo)

@section("main")
    <h1>Editar bicicleta '{{ $bicicleta->marca }} {{ $bicicleta->modelo }}'</h1>

    <form action="{{ route('bicicletas.processUpdate', ['id' => $bicicleta->bicicletas_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="marca" class="form-label fw-bold fw-bold">Marca</label>
            <input 
                type="text" 
                id="marca" 
                name="marca" 
                class="form-control"
                @if ($errors->has('marca')) aria-describedby="error-marca" @endif
                value="{{ old('marca', $bicicleta->marca) }}"
            >

            @if ($errors->has('marca'))
                <div class="text-danger" id="error-marca">{{ $errors->first('marca')}}</div>
            @endif

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
                        @checked(in_array($marca->marca_id, old("marca_id", $bicicleta->getMarcasIds())))
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
                @if ($errors->has('modelo')) aria-describedby="error-modelo" @endif
                value="{{ old('modelo', $bicicleta->modelo) }}"
            >

            @if ($errors->has('modelo'))
                <div class="text-danger" id="error-modelo">{{ $errors->first('modelo')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input 
                type="text" 
                id="precio" 
                name="precio" 
                class="form-control"
                @error ('precio') aria-describedby="error-precio" @enderror
                value="{{ old('precio', $bicicleta->precio) }}"
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
                        @selected(old("color_id", $bicicleta->color_id) == $color->color_id)
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
            >{{ old('descripcion', $bicicleta->descripcion) }}</textarea>

            @if ($errors->has('descripcion'))
                <div class="text-danger" id="error-modelo">{{ $errors->first('descripcion')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <p class="fw-bold">Imagen actual</p>
            
            @if ($bicicleta->foto !== null && Storage::has("img/" . $bicicleta->foto))
                <img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"> 
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
            <label for="fotoAlt" class="form-label fw-bold">Descripción de la foto</label>
            <input 
                type="text" 
                id="fotoAlt" 
                name="fotoAlt" 
                class="form-control"
                @error ('fotoAlt') aria-describedby="error-fotoAlt" @enderror
                value="{{ old('fotoAlt', $bicicleta->fotoAlt) }}"
            >

            @if ($errors->has('fotoAlt'))
                <div class="text-danger" id="error-fotoAlt">{{ $errors->first('fotoAlt')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Grabar</button>
    </form>
@endsection