<?php

namespace App;

use Illuminate\Support\Str;
use App\Transformers\UserTransformer;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'full_name',
        'email',
        'password',
        'verification_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = UserTransformer::class;

    /**
     * Generación del token para la verificación del usuario.
     */
    public static function generate_verification_token()
    {
        return Str::random(40);
    }

    /**
     * Obtiene el estado asociado al usuario.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
