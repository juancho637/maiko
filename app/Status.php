<?php

namespace App;

use App\Transformers\StatusTransformer;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'abbreviation',
        'type',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = StatusTransformer::class;

    /**
     * Obtiene los usuarios asociados a un estado.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Obtiene las empresas asociadas a un estado.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Obtiene los clientes asociados a un estado.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Obtiene los tanques asociados a un estado.
     */
    public function tanks()
    {
        return $this->hasMany(Tank::class);
    }

    /**
     * Obtiene las ordenes de trabajo asociadas a un estado.
     */
    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    /**
     * Obtiene las inspecciones asociadas a un estado.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Alcance una consulta para incluir los estados de tipo especificado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAbbreviation($query, $abbreviation)
    {
        return $query->where('abbreviation', $abbreviation)->first();
    }

    /**
     * Alcance una consulta para incluir los estados de tipo especificado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByType($query, $types)
    {
        return $query->whereIn('type', $types)->whereNotIn('abbreviation', ['gen-del']);
    }
}
