<?php
/** @var \App\Models\User $user */
?>

@extends("layouts.main")

@section("title", "Perfil")

@section("main")
    <h1 class="text-center p-3">Mi Perfil</h1>

    @if($user)
        <h2 class="mb-3">Datos:</h2>

        <p>Hola {{ $user->nombre ? $user->nombre : $user->email }}, aca debajo vas a poder ver y editar los datos que tenemos cargados sobre vos.</p>

        <ul>
            <li>Nombre: {{ $user->nombre }}</li>
            <li>Email: {{ $user->email }}</li>
            <li>Telefono: {{ $user->telefono }}</li>
        </ul>

        {{-- Mostrar detalles de las compras --}}
        @if($compras->count() > 0)
            <h3>Detalles de Compras</h3>
            @foreach($compras as $compra)
                <p>Compra ID: {{ $compra->id }}</p>
                <p>Monto Total: {{ $compra->monto_total }}</p>

                <ul>
                    @foreach($compra->bicicletas as $bicicleta)
                        <li>
                            <p>Bicicleta ID: {{ $bicicleta->bicicletas_id }}</p>
                            <p>Modelo: {{ $bicicleta->modelo }}</p>
                            <p>Precio Unitario: {{ $bicicleta->precio }}</p>
                            <p>Cantidad: {{ $bicicleta->pivot->cantidad }}</p>
                            <img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}">
                            {{-- Agrega más detalles según tus necesidades --}}
                        </li>
                    @endforeach
                </ul>
            @endforeach
        @else
            <p>No has realizado ninguna compra.</p>
        @endif
    @else
        <p>Todavia no cargaste tus datos, hace click en el botón.</p>
    @endif

    <form action="POST">
        <button type="submit" class="btn btn-primary">Cargar/Modificar Datos</button>
    </form>
@endsection