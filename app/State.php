<?php

namespace App;

use App\Transformers\StateTransformer;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'country_id',
        'name',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = StateTransformer::class;

    /**
     * Obtiene el estado asociado al usuario.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el país asociado al estado/departamento.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Obtiene las ciudades asociadas a un estado/departamento.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Busqueda por nombre del estado/departamento.
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', '%'.$name.'%');
    }
}
