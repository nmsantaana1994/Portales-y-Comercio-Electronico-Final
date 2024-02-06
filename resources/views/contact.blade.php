@extends("layouts.main")

@section("title", "Contacto")

@section("main")
<section class="row" id="contacto">
    <div class="col-12">
        <h1 class="p-3">Contactanos</h1>
    </div>

    <div class="col-12">
        <p class="text-center mb-4">¿Queres conocernos? Ponete en contacto con nostros a través del formulario o pasate por el local a dar una vuelta. Te esperamos!</p>
    </div>

    <div class="col-12">
        <form action="" method="POST">
            <div class="row">
                <div class="col-lg">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3283.846171205937!2d-58.3724664845917!3d-34.6080511652347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a3352cbe276f75%3A0xe16921ef0545f86d!2sCasa%20Rosada!5e0!3m2!1ses!2sar!4v1656466014802!5m2!1ses!2sar" class="medida-iframe w-100 h-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-lg">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
                            </div>
                        </div>
    
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Ingrese su apellido" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email:</label>
                                <input type="email" name="mail" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Ingrese su email" required>
                                <div id="emailHelp" class="form-text">Nunca compartimeros tu email con nadie más.</div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono:</label>
                                <input type="text" name="telefono" class="form-control" id="telefono" aria-describedby="telefonoHelp" placeholder="Ingrese su telefono">
                                <div id="telefonoHelp" class="form-text">11-xxxx-xxxx (sin el 15)</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="comentarios" class="form-label">Comentarios:</label>
                                <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary d-block ms-auto mb-3 w-100">Enviar</button>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection