<?php

namespace App;

use App\Transformers\CityTransformer;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'state_id',
        'name',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = CityTransformer::class;

    /**
     * Obtiene el estado asociado al la ciudad.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el estado/departamento asociado a la ciudad.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Obtiene las empresas asociadas a una ciudad.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Obtiene los clientes asociados a una ciudad.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Obtiene las inspecciones asociadas a una ciudad.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Busqueda por nombre de la ciudad.
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', '%'.$name.'%');
    }
}
