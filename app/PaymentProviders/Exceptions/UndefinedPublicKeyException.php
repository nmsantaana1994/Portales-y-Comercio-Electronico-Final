<?php

namespace App\PaymentProviders\Exceptions;


class UndefinedPublicKeyException extends \Exception
{
    public function __construct(string $message = 'No está configurado la clave pública de Mercado Pago.')
    {
        parent::__construct($message);
    }
}
