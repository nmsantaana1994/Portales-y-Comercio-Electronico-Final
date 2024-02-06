<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

// Para poder hacer uso de las facultades de autenticación de Laravel con un modelo de Eloquent, necesitamos
// que este herede de la clase [Illuminate\Foundation\Auth\User].
// Además, vamos a querer agregar el trait "Notifiable".
/**
 * App\Models\User
 *
 * @property int $user_id
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @mixin \Eloquent
 */
class User extends BaseUser
{
    // use HasFactory;
    use Notifiable;

    protected $primaryKey = "user_id";

    protected $hidden = ["password", "remember_token"];

    protected $fillable = ['email', 'password', 'rol', 'nombre', 'apellido', 'telefono'];

    // protected $casts = [
    //     'rol' => 'user',
    // ];

    // protected function rol():Attribute {
    //     return new Attribute(
    //         get: fn($value) => ["rol"][$value],
    //         set: fn($value) => ["rol"]["user"],
    //     );
    // }

    public function bicicletas(): BelongsToMany {
        return $this->belongsToMany(
            Bicicleta::class,
            "users_has_bicicletas",
            "user_id",
            "bicicletas_id",
            "user_id",
            "bicicletas_id",
        );
    }
}
