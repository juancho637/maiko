<?php

namespace App\Transformers;

use App\Answer;
use League\Fractal\TransformerAbstract;

class AnswerTransformer extends TransformerAbstract
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
    public function transform(Answer $answer)
    {
        return [
            'id' => (int)$answer->id,
            'question' => (int)$answer->question_id,
            'value' => (string)$answer->value,
            'created' => (string)$answer->created_at,
            'updated' => (string)$answer->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'question' => 'question_id',
            'value' => 'value',
            'created' => 'created_at',
            'updated' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'question_id' => 'question',
            'value' => 'value',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
