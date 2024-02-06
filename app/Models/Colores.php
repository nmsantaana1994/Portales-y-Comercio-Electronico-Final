<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Colores
 *
 * @property int $color_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Colores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Colores whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colores whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colores whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Colores extends Model
{
    //use HasFactory;

    protected $primaryKey = "color_id";
}
