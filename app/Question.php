<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\QuestionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'module',
        'question',
        'response_type',
        'possible_response',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = QuestionTransformer::class;

    /**
     * Posibles módulos a la que una pregunta puede pertenecer.
     */
    const MODULES = [
        'inspección externa',
        'inspación interna',
        'corrosión',
        'abolladura',
    ];
    const MODULE_EXTERNAL = 'inspección externa';
    const MODULE_INTERNAL = 'inspación interna';
    const MODULE_CORROSION = 'corrosión';
    const MODULE_DENT = 'abolladura';

    /**
     * Posibles tipos de respuesta que una pregunta puede tener.
     */
    const RESPONSE_TYPES = [
        'multiple choice with single answer',
    ];

    /**
     * Obtiene las respuestas asociadas a una pregunta.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Busqueda para incluir las preguntas de un módulo específico.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByModule($query, $module)
    {
        return $query->where('module', $module);
    }
}
