<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\InspectionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'user_id',
        'work_order_id',
        'city_id',
        'tank_id',
        'date',
        'address',
        'light_intensity',
        'humidity',
        'temperature',
        'latitude',
        'longitude',
        'observation',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = InspectionTransformer::class;

    /**
     * Obtiene el estado asociado a la inspección.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el usuario asociado a la inspección.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene la orden de trabajo asociada a la inspección.
     */
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    /**
     * Obtiene la ciudad asociada a la inspección.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Obtiene el tanque asociado a la inspección.
     */
    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }

    /**
     * Obtiene los archivos asociados a una inspección.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
