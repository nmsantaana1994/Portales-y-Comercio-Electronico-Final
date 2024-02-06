<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'user_id',
        'monto_total',
        'preference_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bicicletas()
    {
        return $this->belongsToMany(Bicicleta::class,'compra_bicicleta', 'compra_id', 'bicicletas_id')
        ->withPivot('cantidad'/*, 'precio_unitario'*/)
        ->withTimestamps();
    }
}
