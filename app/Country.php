<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'name',
        'short_name',
        'phone_code',
    ];

    /**
     * Obtiene el estado asociado al usuario.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene los estados/departamentos asociados a un país.
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
