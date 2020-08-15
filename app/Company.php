<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\CompanyTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'city_id',
        'name',
        'nit',
        'address',
        'contact_name',
        'contact_number',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = CompanyTransformer::class;

    /**
     * Obtiene el estado asociado a la empresa.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene la ciudad asociada a la empresa.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Obtiene los clientes asociados a la empresa.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Obtiene las ordenes de trabajo asociadas a la empresa.
     */
    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
