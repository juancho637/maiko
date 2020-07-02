<?php

namespace App;

use App\Transformers\AnswerTransformer;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'answerable_id',
        'answerable_type',
        'value',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = AnswerTransformer::class;

    /**
     * Obtiene el modelo propietario de la respuesta.
     */
    public function answerable()
    {
        return $this->morphTo();
    }

    /**
     * Obtiene la pregunta asociada a la respuesta.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
