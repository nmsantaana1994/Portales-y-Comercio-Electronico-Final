<?php
/** @var \App\Models\Bicicleta $bicicleta */
?>
<section>
    <div class="d-flex flex-row-reverse">
        <div class="col-9 mb-3">
            <h1 class="mb-3">{{ $bicicleta->marca . " " . $bicicleta->modelo }}</h1>

            <dl>
                <dt>Precio</dt>
                <dd>$ {{ $bicicleta->precio }}</dd>
            </dl>
        </div>
        <div class="col-3">
            <p>Aca estaria la imagen</p>
        </div>
    </div>

    <h2 class="mb-3">Descripción</h2>
    <p>{{ $bicicleta->descripcion }}</p>
</section>

