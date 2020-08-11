<?php

namespace App;

use Illuminate\Support\Str;
use App\Transformers\UserTransformer;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
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
        'email_verified_at',
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Generación del token para la verificación del usuario.
     */
    public static function generate_verification_token()
    {
        return Str::random(40);
    }

    /**
     * Validación para ver si el usuario ya fue verificado.
     */
    public function verified_user()
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Obtiene el estado asociado al usuario.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene las inspecciones asociadas a un usuario.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Obtiene las ordenes de trabajo asociadas a un usuario.
     */
    public function work_orders()
    {
        return $this->belongsToMany(WorkOrder::class);
    }
}
