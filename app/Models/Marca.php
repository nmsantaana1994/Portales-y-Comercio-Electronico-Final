<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Marca
 *
 * @property int $marca_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marca whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Marca extends Model
{
    //use HasFactory;
    protected $primaryKey = "marca_id";
}
