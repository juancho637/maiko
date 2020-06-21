<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\CountryTransformer;

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
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = CountryTransformer::class;

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
