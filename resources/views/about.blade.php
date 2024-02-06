@extends("layouts.main")

@section("title", "Quienes Somos")

@section("main")
    <section class="row">
        <h1 class="p-3">¿Quiénes Somos?</h1>

        <p>BMX Street, nace en Buenos Aires en 2011, pensada como una tienda donde los Bikers puedan conseguir las cosas que consumen habitualmente, todas en un solo lugar. Esto incluye tanto el material deportivo (hard) de BMX como las zapas e Indumentaria. Por supuesto BMX Street abastece a clientes que no practican este deporte, pero la idea es no ser una tienda de indumentaria y calzado mas...</p>
        <p>¿Por qué? Porque quienes trabajamos aca nos dedicamos a estos deportes desde hace muchos años y entendemos que todo lo que trabajamos forma parte de nuestro estilo de vida. Nuestro STAFF esta conformado por riders que conocen bien el uso del producto que vendemos.</p>

        <img src={{Storage::url('img/banner.jpg')}} alt="Persona haciendo pirueta en BMX" class="d-block mx-auto">
    </section>
@endsection