<?php

namespace App;

use App\Transformers\TankTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tank extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'client_id',
        'internal_serial_number',
        'serial_number',
        'maker',
        'fabrication_year',
        'capacity',
        'large',
        'diameter',
        'head_thickness',
        'body_thickness',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = TankTransformer::class;

    /**
     * Obtiene el estado asociado a un tanque.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el cliente asociado a un tanque.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Obtiene las inspecciones asociadas a un tanque.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
