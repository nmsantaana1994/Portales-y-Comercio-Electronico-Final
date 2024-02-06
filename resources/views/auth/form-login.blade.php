@extends('layouts.main')

@section('title', 'Ingresar a tu Cuenta')

@section('main')
    <h1 class="mb-3">Ingresar a tu cuenta</h1>

    <form action="{{ route('auth.processLogin')}}" method="POST">
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
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
@endsection