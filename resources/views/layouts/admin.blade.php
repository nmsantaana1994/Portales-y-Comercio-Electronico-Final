<?php
use Illuminate\Support\Facades\Storage;
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') :: Panel de Administración de BMX Street</title>
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
        <header class="bg-primary d-flex align-items-center justify-content-center">
            <p class="h1 text-white">Panel de Administración</p>
        </header>
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar-background col-2">
                    <a class="navbar-brand my-5 d-flex justify-content-center" href="{{ route("home") }}" ><img src="{{ Storage::url('img/logo.png') }}" alt="BMX Street Logo"></a>
                    <ul class="nav flex-column indexH vh-100">
                        <li class="nav-item mb-3">
                            <a class="nav-link" aria-current="page" href="/admin">Tablero</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link" href="/admin/bicicletas">Bicicletas</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link" href="/admin/noticias">Noticias</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link" href="/admin/users">Usuarios</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link" href="/">Ir al Sitio</a>
                        </li>
                        <li class="nav-item mb-3">
                            <form action="{{ route('auth.processLogout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn nav-link">{{ auth()->user()->email }} (Cerrar Sesión)</button>
                            </form>
                        </li>
                    </ul>
                </nav>
                <div class="col-10">
                    <main class="container py-3">
                        @if(Session::has('feedback.message')) 

                            <div class="alert alert-{{ Session::get('feedback.type', 'success') }} alert-dismissible fade show" role="alert">
                                {!! Session::get('feedback.message') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        
                            
                        @endif
        
                        @yield('main')
                    </main>
                </div>
            </div>
        </div>
        <footer class="footer">
            <p>Da Vinci &copy; 2023</p>
        </footer>
    </div>

    <script src="{{ url('bootstrap.bundle.js') }}"></script>
</body>
</html>
