<?php
/** @var \App\Models\User $user */
?>

@extends("layouts.main")

@section("title", "Modificar Perfil")

@section("main")
    <h1 class="text-center my-3">Modificar Datos</h1>

    <form action="{{ route('user.processUpdate')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold fw-bold">Nombre</label>
            <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                class="form-control"
                @if ($errors->has('nombre')) aria-describedby="error-nombre" @endif
                value="{{ old('nombre', $user->nombre) }}"
            >

            @if ($errors->has('nombre'))
                <div class="text-danger" id="error-nombre">{{ $errors->first('nombre')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label fw-bold fw-bold">Apellido</label>
            <input 
                type="text" 
                id="apellido" 
                name="apellido" 
                class="form-control"
                @if ($errors->has('apellido')) aria-describedby="error-apellido" @endif
                value="{{ old('apellido', $user->apellido) }}"
            >

            @if ($errors->has('apellido'))
                <div class="text-danger" id="error-apellido">{{ $errors->first('apellido')}}</div>
            @endif
        </div>
        {{-- <div class="mb-3">
            <label for="email" class="form-label fw-bold fw-bold">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control"
                @if ($errors->has('email')) aria-describedby="error-email" @endif
                value="{{ old('email', $user->email) }}"
            >

            @if ($errors->has('email'))
                <div class="text-danger" id="error-email">{{ $errors->first('email')}}</div>
            @endif
        </div> --}}
        <div class="mb-3">
            <label for="telefono" class="form-label fw-bold fw-bold">Telefono</label>
            <input 
                type="text" 
                id="telefono" 
                name="telefono" 
                class="form-control"
                @if ($errors->has('telefono')) aria-describedby="error-telefono" @endif
                value="{{ old('telefono', $user->telefono) }}"
            >

            @if ($errors->has('telefono'))
                <div class="text-danger" id="error-telefono">{{ $errors->first('telefono')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100">Grabar</button>
    </form>
@endsection