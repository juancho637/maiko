<?php

namespace App\Transformers;

use App\Status;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
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
    public function transform(Status $status)
    {
        return [
            'id' => (int)$status->id,
            'name' => (string)$status->name,
            'type' => (string)$status->type,
            'created' => (string)$status->created_at,
            'updated' => (string)$status->updated_at
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'abbreviation' => 'abbreviation',
            'type' => 'type',
            'created' => 'created_at',
            'updated' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
