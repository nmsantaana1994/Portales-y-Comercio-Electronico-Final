<?php

namespace App\PaymentProviders\Exceptions;


class UndefinedAccessTokenException extends \Exception
{
    public function __construct(string $message = 'No está configurado el token de acceso de Mercado Pago.')
    {
        parent::__construct($message);
    }
}
