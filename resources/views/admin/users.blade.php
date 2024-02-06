@extends('layouts.admin')

@section('title', 'Tablero de Usuarios')

@section('main')
<h2 class="mb-3">Tablero de Usuarios</h2>

    @if ($users->isEmpty())
        <p>No hay usuarios registrados en el sistema</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Rol</th>
                    <th width="35%">Compras</th>
                    <th>Creado el</th>
                    <th>Actualziado el</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol }}</td>
                        <td>
                            @if ($user->bicicletas->isEmpty())
                                <p>No ha comprado ningúna bicicleta</p> 
                            @else
                                @foreach ($user->bicicletas as $bicicleta)
                                <div>
                                    <p  class="h5">Bicicleta {{ $bicicleta->marca }} {{ $bicicleta->modelo }}</p>
                                    <ul class="list-unstyled">
                                        <li><img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"></li>
                                        <li><b>Precio: $</b>{{ $bicicleta->precio }}</li>
                                    </ul>
                                </div>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.noticias_view' , ['id' => $user->user_id]) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ route('noticias.formUpdate' , ['id' => $user->user_id]) }}" class="btn btn-primary">Editar</a>
                                <a href="{{ route('noticias.confirmDelete' , ['id' => $user->user_id]) }}" class="btn btn-danger">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection