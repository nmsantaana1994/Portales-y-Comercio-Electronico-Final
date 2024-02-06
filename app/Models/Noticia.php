<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Noticia
 *
 * @property int $noticias_id
 * @property string $titulo
 * @property string|null $subtitulo
 * @property string $resumen
 * @property string $contenido
 * @property string $fecha
 * @property string|null $foto
 * @property string|null $fotoAlt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereContenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereFotoAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereNoticiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereResumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereSubtitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Noticia extends Model
{
    protected $primaryKey = "noticias_id";

    protected $fillable = ["titulo","subtitulo", "resumen" , "contenido", "fecha", "foto", "fotoAlt"];

    public static function validationRules(): array {

        return [
            'titulo' => 'required|min:15',
            'contenido' => 'required|min:600',
            'fecha'=> 'required',
        ];
    }

    public static function validationMessages(): array {
        return [
            'titulo.required' => "Tenes que escribir el título de la noticia.",
            'titulo.min' => "El título debe tener al menos :min caracteres",
            'contenido.required' => "Tenes que escribir el contenidod de la noticia.",
            'contenido.min' => "El contenido de la noticia debe tener como mínimo :min caracteres",
            'fecha.required' => "Tenes que escribir la feceha de la noticia",
        ];
    }
}
