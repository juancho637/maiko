<?php

namespace App\Transformers;

use App\Question;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Question $question)
    {
        return [
            'id' => (int)$question->id,
            'module' => (string)$question->module,
            'question' => (string)$question->question,
            'response_type' => (string)$question->response_type,
            'possible_response' => (string)$question->possible_response,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'module' => 'module',
            'question' => 'question',
            'response_type' => 'response_type',
            'possible_response' => 'possible_response',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'deleted' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
