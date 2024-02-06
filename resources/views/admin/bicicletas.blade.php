@extends('layouts.admin')

@section('title', 'Tablero de Bicicletas')

@section('main')
<h2 class="mb-3">Tablero de Bicicletas</h2>

    <div class="mb-3">
        <a href="{{ route('bicicletas.trashed.index') }}" class="btn btn-primary btn-sm w-100 mb-3 fs-6">Ver Bicicletas Eliminadas</a>
        <a href="{{ route('bicicletas.formNew') }}" class="btn btn-primary btn-sm w-100 mb-3 fs-6">Publicar una Nueva Bicicleta</a>
    </div>
    
    <section class="mb-3">
        <h2 class="mb-3">Buscador</h2>
        <form action="{{ route('admin.bicicletas') }}" method="GET">
            <div class="mb-3">
                <label for="searchModelo" class="form-label">Modelo</label>
                <input type="text" id="searchModelo" name="m" class="form-control" value="{{ $searchParams->getModelo() }}">
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>
    </section>

    <h2 class="visually-hidden">Lista de bicicletas</h2>

    @if($searchParams->getModelo())
        <p class="mb-3">Mostrando los resultados para el modelo <b>{{ $searchParams->getModelo() }}.</b></p>
    @endif

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
                            @endforeach
                        </td>
                        <td>{{ $bicicleta->modelo }}</td>
                        <td>{{ $bicicleta->color->nombre }}</td>
                        <td>{{ $bicicleta->precio }}</td>
                        <td>{{ $bicicleta->descripcion }}</td>
                        <td><img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.bicicletas_view' , ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-primary">Ver</a>
                                <a href="{{ route('bicicletas.formUpdate' , ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-primary">Editar</a>
                                <a href="{{ route('bicicletas.confirmDelete' , ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-danger">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- links() es un método que se agrega cuando buscamos los registros con paginate(), y retorna el HTML
        de una paginación de resultados. La misma puede personalizarse de ser necesario. --}}
    {!! $bicicletas->links() !!}
    @else
        <p>No se encontraron bicicletas con esos criterios de búsqueda.</p>
    @endif
@endsection