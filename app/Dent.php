<?php

namespace App;

use App\Transformers\DentTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dent extends Model
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
        'large',
        'width',
        'average',
        'observation',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = DentTransformer::class;

    /**
     * Obtiene el estado asociado a la abolladura.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene la inspección asociada a una abolladura.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * Obtiene los archivos asociados a una abolladura.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
