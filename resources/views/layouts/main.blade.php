<?php
use Illuminate\Support\Facades\Storage;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield("title") :: BMX Street</title>
    <link rel="shortcut icon" href="{{ Storage::url('img/favicon.svg') }}" />

    <!--Fuentes de Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route("home") }} " class="m-3"><img src="{{ Storage::url('img/logo.png') }}" alt="BMX Street Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav indexH ms-auto">
                        <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('about') }}">¿Quienes somos?</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('bicicletas.index') }}">Bicicletas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('noticias.index') }}">Noticias</a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('contact') }}">Contacto</a>
                        </li>
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->email }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item nav-link text-center" href="{{ route('cart.index') }}"><i class="material-icons shopping-cart">shopping_cart</i></a>
                                </li>
                                <li class="text-center">
                                    <a class="dropdown-item nav-link text-center" href="{{ route('user.index') }}">Mi Perfil</a>
                                </li>
                                <li class="text-center">
                                    <form action="{{ route('auth.processLogout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <form action="{{ route('auth.processLogout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn nav-link text-white">{{ auth()->user()->email }} (Cerrar Sesión)</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.formLogin') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.formRegister') }}">Registrarse</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container py-3">
            
            @if(Session::has('feedback.message')) 

                <div class="alert alert-{{ Session::get('feedback.type', 'success') }} alert-dismissible fade show" role="alert">
                    {!! Session::get('feedback.message') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
            @endif

            @yield("main")
        </main>

        <footer class="footer">
            <p>&copy;Da Vinci 2023 - Portales y Comercio Electrónico</p>
        </footer>
    </div>

    <script src="{{ url('bootstrap.bundle.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    @stack("js")
</body>
</html>