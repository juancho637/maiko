<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\AccesoryTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accesory extends Model
{
    use SoftDeletes;

    protected $table = 'tmp_accesories';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'inspection_id',
        'name',
        'measure',
        'serial',
        'date',
        'brand',
        'cant',
        'according',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = AccesoryTransformer::class;

    /**
     * Obtiene la inspección asociada al accesorio.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}
