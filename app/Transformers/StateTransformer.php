<?php

namespace App\Transformers;

use App\State;
use League\Fractal\TransformerAbstract;

class StateTransformer extends TransformerAbstract
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
    public function transform(State $state)
    {
        return [
            'id' => (int)$state->id,
            'status' => (int)$state->status_id,
            'country' => (int)$state->country_id,
            'name' => (string)$state->name,
            'created' => (string)$state->created_at,
            'updated' => (string)$state->updated_at,
            'deleted' => isset($state->deleted) ? (string)$state->deleted : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'country' => 'country_id',
            'name' => 'name',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'deleted' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
