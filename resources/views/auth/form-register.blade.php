@extends('layouts.main')

@section('title', 'Registrarse')

@section('main')
    <h1 class="mb-3">Registrarse</h1>

    <form action="{{ route('auth.processRegister')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control"
                @error ('email') aria-describedby="error-email" @enderror
                value="{{ old("email") }}"
            >

            @error("email")
                <div class="text-danger" id="error-email">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-control"
                value="{{ old("") }}"
            >

            @error("password")
                <div class="text-danger" id="error-password">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                class="form-control"
                value="{{ old("") }}"
            >

            @error("nombre")
                <div class="text-danger" id="error-nombre">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input 
                type="text" 
                name="apellido" 
                id="apellido" 
                class="form-control"
                value="{{ old("") }}"
            >

            @error("apellido")
                <div class="text-danger" id="error-apellido">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input 
                type="text" 
                name="telefono" 
                id="telefono" 
                class="form-control"
                value="{{ old("") }}"
            >

            @error("telefono")
                <div class="text-danger" id="error-telefono">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
    </form>
@endsection