<?php 
use Illuminate\Support\Facades\Storage; 
/** @var \App\Models\Bicicleta[] | \Illuminate\Database\Eloquent\Collection $bicicletas */
/** @var \App\SearchParams\BicicletaSearchParams $searchParams */
?>

@extends("layouts.main")

@section("title", "Listado de Bicicletas")

@section("main")
    <h1 class="mb-3">Bicicletas</h1>

    
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
            @foreach($bicicletas as $bicicleta)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{$bicicleta->marca}} {{$bicicleta->modelo}}</h2>
                        <img src="{{ Storage::url('img/'. $bicicleta->foto) }}" class="card-img-top" alt="{{ $bicicleta->fotoAlt }}">
                        <h3 class="mb-3">Precio: ${{$bicicleta->precio}}</h3>
                        <p class="card-text">{{$bicicleta->descripcion}}</p>
                        <p><b>Color:</b> {{ $bicicleta->color->nombre }}</p>
                    </div>
                    <div class="card-footer">
                        <p class="fw-bold">Marcas que componen la bicicleta:</p>
                        <div class="mb-3">
                            @foreach($bicicleta->marcas as $marca) 
                                <span class="badge bg-secondary">{{ $marca->nombre }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('bicicletas.view' , ['id' => $bicicleta->bicicletas_id]) }}" class="btn btn-primary mb-3 w-100">Ver</a>
                        <form action="{{ route('bicicletas.processConsult', ['id' => $bicicleta->bicicletas_id])}}" method="POST">
                            @csrf
                            <hr>

                            <label for="emailConsulta" class="form-label fw-bold">Ingrese un mail para enviar la confirmación de su consulta:</label>
                            <input 
                                type="text" 
                                id="emailConsulta" 
                                name="emailConsulta" 
                                class="form-control mb-3"
                                {{-- @error ('marca') aria-describedby="error-marca" @enderror --}}
                                value="{{ old('emailConsulta') }}"
                            >

                            <button type="submit" class="btn btn-secondary w-100">Consultar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {!! $bicicletas->links() !!}

@endsection