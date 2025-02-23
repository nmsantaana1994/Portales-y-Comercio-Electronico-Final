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
                    <th>Actualizado el</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol }}</td>
                        <td>
                            @if ($user->compras->isEmpty())
                                <p>No ha realizado ninguna compra</p>
                            @else
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    @foreach ($user->compras as $compra)
                                        <div class="accordion-item">
                                            <p class="h2 accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                Compra ID: {{ $compra->id }}
                                            </button>
                                            </p>
                                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <ul class="list-unstyled mb-1">
                                                        @foreach ($compra->bicicletas as $bicicleta)
                                                            <li>
                                                                <p class="text-secondary fw-semibold mb-1">Bicicleta {{ $bicicleta->marca }} {{ $bicicleta->modelo }}</p>
                                                                <ul>
                                                                    <li><b>Precio:</b> ${{ $bicicleta->precio }}</li>
                                                                    <li><b>Cantidad:</b> {{ $bicicleta->pivot->cantidad }}</li>
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <p class="fw-bold mb-1">Monto Total: {{ $compra->monto_total }}</p>
                                                </div>
                                            </div>
                                        </div>    
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection