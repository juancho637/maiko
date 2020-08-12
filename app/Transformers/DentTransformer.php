<?php

namespace App\Transformers;

use App\Dent;
use League\Fractal\TransformerAbstract;

class DentTransformer extends TransformerAbstract
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
    public function transform(Dent $dent)
    {
        return [
            'id' => (int)$dent->id,
            'status' => (int)$dent->status_id,
            'inspection' => (int)$dent->inspection_id,
            'large' => (int)$dent->large,
            'width' => (int)$dent->width,
            'average' => (int)$dent->average,
            'observation' => isset($dent->observation) ? (string)$dent->observation : null,
            'created' => (string)$dent->created_at,
            'updated' => (string)$dent->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'inspection' => 'inspection_id',
            'large' => 'large',
            'width' => 'width',
            'average' => 'average',
            'answers' => 'answers',
            'observation' => 'observation',
            'created' => 'created_at',
            'updated' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'status_id' => 'status',
            'inspection_id' => 'inspection',
            'large' => 'large',
            'width' => 'width',
            'average' => 'average',
            'answers' => 'answers',
            'observation' => 'observation',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
