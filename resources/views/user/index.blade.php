<?php
/** @var \App\Models\User $user */
?>

@extends("layouts.main")

@section("title", "Perfil")

@section("main")
    <h1 class="text-center p-3">Mi Perfil</h1>

    @if($user)
        <h2 class="mb-3">Datos:</h2>

        <p>Hola {{ $user->nombre ? $user->nombre : $user->email }} {{$user->id}}, aca debajo vas a poder ver y editar los datos que tenemos cargados sobre vos.</p>

        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled">
                    <li class="mb-3"><b>Nombre:</b> {{ $user->nombre }}</li>
                    <li class="mb-3"><b>Apellido:</b> {{ $user->apellido }}</li>
                    <li class="mb-3"><b>Telefono:</b> {{ $user->telefono }}</li>
                    <li class="mb-3"><b>Email:</b> {{ $user->email }}</li>
                </ul>
            </div>
        </div>

        <form action="POST">
            <a href="{{ route('user.formUpdate')}}" class="btn btn-sm btn-primary mb-3">Modificar Datos</a>
        </form>

        {{-- Mostrar detalles de las compras --}}

        @if($compras->count() > 0)
            <h3>Detalles de Compras</h3>

            <table class="table table-responsive table-striped-table-bordered">
                <thead>
                    <tr>
                        <th>Compra ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th width="20%">Foto</th>
                        <th>Monto Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compras as $compra)
                        <tr>
                            <td>{{ $compra->id }}</td>
                            @foreach($compra->bicicletas as $bicicleta)
                                <td>{{ $bicicleta->marca }}</td>
                                <td>{{ $bicicleta->modelo }}</td>
                                <td>{{ $bicicleta->color->nombre }}</td>
                                <td>${{ $bicicleta->precio }}</td>
                                <td>{{ $bicicleta->pivot->cantidad }}</td>
                                <td><img class="w-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"></td>
                            @endforeach
                            <td>${{ $compra->monto_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No has realizado ninguna compra.</p>
        @endif
    @else
        <p>Todavia no cargaste tus datos, hace click en el botón.</p>
    @endif
@endsection