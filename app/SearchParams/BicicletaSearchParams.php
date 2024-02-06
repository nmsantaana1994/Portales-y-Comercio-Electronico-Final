<?php

namespace App\SearchParams;

/**
 * Representa los parámetros de busqueda del formulario del listado de bicicletas
 */
class BicicletaSearchParams {
    private ?string $modelo = null;

    /**
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->modelo = $params['m'] ?? null;
    }

    /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }
}