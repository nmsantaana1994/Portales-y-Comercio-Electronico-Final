<?php
use Illuminate\Support\Facades\Storage; 
/** @var \App\Models\Bicicleta $bicicleta */
?>
<section>
    <div class="d-flex flex-row-reverse gap-3 mb-3">
        <div class="col-9 mb-3">
            <h1 class="mb-3">{{ $bicicleta->marca . " " . $bicicleta->modelo }}</h1>

            <dl>
                <dt>Precio</dt>
                <dd>$ {{ $bicicleta->precio }}</dd>
                <dt>Color</dt>
                <dd>{{ $bicicleta->color->nombre }}</dd>
            </dl>
        </div>
        <div class="col-3">
            @if ($bicicleta->foto !== null && Storage::has("img/" . $bicicleta->foto))
                <img class="mw-100" src="{{ Storage::url('img/'. $bicicleta->foto) }}" alt="{{ $bicicleta->fotoAlt }}"> 
            @else
                <p>Acá iría una imagen diciendo que no hay imagen.</p>
            @endif
        </div>
    </div>

    <h2 class="mb-3">Descripción</h2>
    <p>{{ $bicicleta->descripcion }}</p>
    @auth
        <form action="{{ route('cart.processAddItem', ['id' => $bicicleta->bicicletas_id]) }}" method="POST" class="row">
            @csrf
            <div class="col-6 d-flex align-items-center">
                <label for="q" class="fw-bold me-2">Cantidad: </label>
                <input type="number" class="form-control" value="1" name="q" id="q">
            </div>
            <div class="col-6">
                <input type="submit" value="AGREGAR AL CARRITO" class="btn btn-primary w-100">
            </div>
        </form>
    @endauth
</section>