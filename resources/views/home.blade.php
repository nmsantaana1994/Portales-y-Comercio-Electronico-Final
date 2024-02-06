@extends("layouts.main")

@section("title", "Home")

@section("main")
<section class="row mb-3">
    <h1 class="text-center p-3">¡Bienvenidos a BMX Street! </br><span class="titulo"> - LIFESTYLE & CORE SHOP - </span></h1>

    <div class="col-12 col-md-6 d-flex align-items-center">
        <p>El BMX es más que un deporte, es una manera de viajar, de ser creativo, de disfrutar de la vida. No importa quién eres, dónde vives o lo bueno que eres, coge tu bici y únete al club. El esfuerzo, empeño, dedicación o llámale como quieras, es fundamental. Si quieres progresar necesitas dedicarle muchas horas para cada truco, no temer a las lesiones, entrenar mental y físicamente...</p>
    </div>

    <div class="col-12 col-md-6 d-flex">
        <div class="imagenFondo rounded" style="background-image: url(img/banner_960.jpg);" title="Persona haciendo truco en skatepark"></div>
    </div>
</section>

<section class="row">
    <div class="col-12">
        <h2 class="py-3">ACERCA DEL DEPORTE</h2>
    </div>

    <div class="col-12">
        <p>Como definición, se puede decir que el BMX es una modalidad del ciclismo que se practica con unas bicis más pequeñas que las habituales y que tienen unas ruedas de unas 20 pulgadas de diámetro.</p>
    </div>

    <div class="col-12 text-center">
        <div class="imagenFondo rounded d-flex" style="background-image: url(img/banner_2.jpg);" title="Persona haciendo un truco en blanco y negro"></div>
    </div>

    <div class="col-12">
        <h3 class="py-3">BMX: Siglas e historia</h3>
    </div>

    <div class="col-12">
        <p>Las siglas BMX significan Bicycle MotoCross y tienen que ver con la historia de este deporte, que se remonta a 1969. Fue entonces cuando en California los jóvenes empezaron a usar sus bicis en pistas de Motocross para imitar a sus ídolos motorizados. Viendo la tendencia, un fabricante empezó a producir bicis parecidas a las motos y el deporte se expandiría. Existen dos grandes disciplinas o modalidades de BMX: Race y Freestyle.</p>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <div class="card mincard">
                    <h3 class="text-center">BMX Race</h3>
                    <iframe height="400" src="https://www.youtube.com/embed/juYmdN-mWAg" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="card-body">
                        <p class="card-text">Dado el lugar y el motivo de su nacimiento, la modalidad original es el BMX Race, que consiste en carreras por pistas parecidas a las de Motocross. Con una diferencia: la tierra en lugar de húmeda es arena arcillosa compacta para evitar incrustaciones en las ruedas de la bici. El objetivo no es otro que el de cualquier otra carrera: ser más rápido que el rival, ya sea compitiendo de manera simultánea como en contrarreloj.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <div class="card mincard">
                    <h3 class="text-center">BMX Freestyle</h3>
                    <iframe height="400" src="https://www.youtube.com/embed/hHOttB2enSQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="card-body">
                        <p class="card-text">Con la aparición de los skateparks, los bikers que usaban BMX empezaron también a tomar estos spots y a probar ‘trucos’. Aquí nació el BMX Freestyle, que consiste en realizar trucos con la bici. Esta disciplina tiene varias subdisciplinas: Dirt Jump, Flatland, Park/Bowl, Street, Vert y Big Air.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
