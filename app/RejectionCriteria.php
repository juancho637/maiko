<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\RejectionCriteriaTransformer;

class RejectionCriteria extends Model
{
    use SoftDeletes;

    protected $table = 'tmp_rejection_criterias';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'inspection_id',
        'criteria',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = RejectionCriteriaTransformer::class;

    /**
     * Obtiene la inspección asociada al criterio de rechazo.
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }
}
