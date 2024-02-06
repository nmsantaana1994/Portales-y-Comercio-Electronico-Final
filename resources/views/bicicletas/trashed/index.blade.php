<?php 
use Illuminate\Support\Facades\Storage; 
/** @var \App\Models\Bicicleta[] | \Illuminate\Database\Eloquent\Collection $bicicletas */
?>

@extends("layouts.admin")

@section("title", "Listado de Bicicletas")

@section("main")
    <h1 class="mb-3">Bicicletas Eliminadas</h1>

    @auth
        <div class="mb-3">
            <a href="{{ route('admin.bicicletas') }}" class="btn btn-primary btn-sm w-100 mb-3 fs-6">Volver a las Bicicletas</a>
        </div>

        <h2 class="visually-hidden">Lista de bicicletas</h2>

        @if(!$bicicletas->isEmpty())
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Marcas Compuestas</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th width="20%">Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bicicletas as $bicicleta)
                        <tr>
                            <td>{{ $bicicleta->marca }}</td>
                            <td>
                                @foreach($bicicleta->marcas as $marca) 
                                    <span class="badge bg-secondary">{{ $marca->nombre }}</span>
                                @endforeach</td>
                            <td>{{ $bicicleta->modelo }}</td>
                            <td>{{ $bicicleta->color->nombre }}</td>
                            <td>{{ $bicicleta->precio }}</td>
                            <td>{{ $bicicleta->descripcion }}</td>
                            <td><img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('bicicletas.trashed.view', ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-primary">Ver</a>
                                    <a href="{{ route('bicicletas.formUpdate', ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-primary">Editar</a>
                                    {{-- TODO: Pedir confirmación antes de restaurar --}}
                                    <form action="{{ route('bicicletas.trashed.processRestore', ['id' => $bicicleta->bicicletas_id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Restaurar</button>
                                    </form>
                                    {{-- TODO: Eliminar definitivamente --}}
                                    <a href="{{ route('bicicletas.confirmDelete', ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-danger">Eliminar Definitivamente</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        {{-- links() es un método que se agrega cuando buscamos los registros con paginate(), y retorna el HTML
            de una paginación de resultados. La misma puede personalizarse de ser necesario. --}}
        {{-- {!! $bicicletas->links() !!} --}}
        @else
            <p>No hay bicicletas eliminadas.</p>
        @endif
    @endauth
@endsection