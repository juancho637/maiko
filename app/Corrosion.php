<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\CorrosionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corrosion extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'inspection_id',
        'corrosion_type',
        'remaining_thickness',
        'area',
        'large',
        'thickness',
        'depth',
        'observation',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = CorrosionTransformer::class;

    /**
     * Posibles tipos de corrosiones que una corrosión puede tener.
     */
    const CORROSION_TYPES = [
        'general corrosion',
        'isolated corrosion',
        'online corrosion',
    ];

    /**
     * Obtiene el estado asociado a la corrosión.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene la inspección asociada a la corrosión.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * Obtiene los archivos asociados a una corrosión.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Obtiene las respuestas asociadas a una corrosión.
     */
    public function answers()
    {
        return $this->morphMany(Answer::class, 'answerable');
    }
}
