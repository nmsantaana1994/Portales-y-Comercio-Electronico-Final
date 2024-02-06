<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraBicicleta extends Model
{
    protected $table = 'compra_bicicleta';

    protected $fillable = [
        'compra_id',
        'bicicleta_id',
        'cantidad',
        // Puedes agregar más columnas según tus necesidades
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id', 'compra_id');
    }

    public function bicicletas()
    {
        return $this->belongsTo(Bicicleta::class, 'bicicletas_id', 'bicicletas_id');
    }
}
