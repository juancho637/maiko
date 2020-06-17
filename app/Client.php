<?php

namespace App;

use App\Transformers\ClientTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'company_id',
        'city_id',
        'name',
        'address',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = ClientTransformer::class;

    /**
     * Obtiene el estado asociado a la empresa.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene la empresa asociada al cliente.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Obtiene la ciudad asociada a la empresa.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Obtiene los tanques asociados a un cliente.
     */
    public function tanks()
    {
        return $this->hasMany(Tank::class);
    }
}
