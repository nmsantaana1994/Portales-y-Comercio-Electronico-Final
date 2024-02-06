@extends('layouts.admin')

@section('title', 'Tablero de Noticias')

@section('main')
<h2 class="mb-3">Tablero de Noticias</h2>

    <div class="mb-3">
        <a href="{{ route('noticias.formNew') }}" class="btn btn-primary btn-sm w-100 mb-3 fs-6">Publicar una Nueva Noticia</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Resumen</th>
                <th>Contenido</th>
                <th>Fecha</th>
                <th width="20%">Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($noticias as $noticia)
                <tr>
                    <td>{{ $noticia->titulo }}</td>
                    <td>{{ $noticia->subtitulo }}</td>
                    <td>{{ $noticia->resumen }}</td>
                    <td>{{ $noticia->contenido }}</td>
                    <td>{{ $noticia->fecha }}</td>
                    <td><img class="mw-100" src="{{ Storage::url('img/'. $noticia->foto) }}" alt="{{ $noticia->fotoAlt }}"></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.noticias_view' , ['id' => $noticia->noticias_id]) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('noticias.formUpdate' , ['id' => $noticia->noticias_id]) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('noticias.confirmDelete' , ['id' => $noticia->noticias_id]) }}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection