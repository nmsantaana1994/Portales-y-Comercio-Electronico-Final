<?php 
// Como todo archivo de configuración, debemos retornar un array

return [
    // Las valores de las claves de este array van a poder obtenerse con la función config() usando
    // como parámetro un string con el formato "archivo.clave".
    // Por ejemplo, si en este archivo "mercadopago.php" tenemos una clave "publicKey", la accederiamos
    // usando config("mercadopago.publicKey").
    "publicKey" => env("MERCADOPAGO_PUBLIC_KEY"),
    "accessToken" => env("MERCADOPAGO_ACCESS_TOKEN"),
];