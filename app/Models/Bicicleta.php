<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Bicicleta
 *
 * @property int $bicicletas_id
 * @property string $modelo
 * @property int $precio
 * @property string $marca
 * @property string $descripcion
 * @property string|null $foto
 * @property string|null $fotoAlt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereBicicletasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereFotoAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereUpdatedAt($value)
 * @property int $color_id
 * @property-read \App\Models\Colores $color
 * @method static \Illuminate\Database\Eloquent\Builder|Bicicleta whereColorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Marca> $marcas
 * @property-read int|null $marcas_count
 * @mixin \Eloquent
 */
class Bicicleta extends Model
{
    // SoftDeletes indica que el modelo utilice esta metodologia para borrar.
    use SoftDeletes;

    protected $primaryKey = "bicicletas_id";

    protected $fillable = ["color_id", "marca", "precio", "modelo", "descripcion", "foto", "fotoAlt"];

    public static function validationRules(): array {

        return [
            'marca' => 'required|min:2', // Versión String
            'modelo' => 'required|min:2',
            'precio'=> 'required|numeric',
            "descripcion" => 'required',
            "color_id" => "required|numeric|exists:colores",
        ];
    }

    public static function validationMessages(): array {

        return [
            'marca.required' => "Tenés que escribir la marca de la bicicleta",
            'marca.min' => "La marca de la bicicleta debe tener como mínimo :min caracteres",
            'modelo.required' => "Tenés que escribir el modelo de la bicicleta",
            'modelo.min' => "El modelo de la bicicleta debe tener como mínimo :min caracteres",
            'precio.required' => "Tenés que escribir el precio de la bicicleta",
            'precio.numeric' => "El precio tiene que ser un número",
            'descripcion.required' => "Tenés que escribir la descripcion de la bicicleta",
            'color_id.required' => "Tenés que escribir el color de la bicicleta",
            'color_id.numeric' => "El color de la bicicleta debe ser un número entero",
            'color_id.exists' => "El color provisto no existe",
        ];
    }

    public function getMarcasIds(): array {
        return $this->marcas->pluck("marca_id")->all();
    }

    protected function precio(): Attribute {
        return Attribute::make(
            get: fn (int $value): float  => $value /100,
            set: fn (float $value)       => $value * 100,
        );
    }

    public function color(): BelongsTo {
        return $this->belongsTo(Colores::class, "color_id", "color_id");
    }

    public function marcas(): BelongsToMany {
        return $this->belongsToMany(
            Marca::class,
            "bicicletas_has_marcas",
            "bicicletas_id",
            "marca_id",
            "bicicletas_id",
            "marca_id",
        );
    }

    public function compras()
    {
        return $this->belongsToMany(Compra::class,'compra_bicicleta', 'bicicletas_id', 'compra_id')
            ->withPivot('cantidad'/*, 'precio_unitario'*/)
            ->withTimestamps();
    }
}
