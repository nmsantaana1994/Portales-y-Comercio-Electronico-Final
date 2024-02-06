<?php
/** @var App\Models\Bicicleta  $bicicleta*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consulta Realizada</title>
</head>
<body>
    <h1>Tu consulta se realizó con éxito</h1>

    <x-bicicleta-data :bicicleta="$bicicleta"></x-bicicleta-data>

    <p>Guarda este email como comprobante</p>

    <p>Saludos,<br>
    tus amigos de BMX Street.</p>
</body>
</html>