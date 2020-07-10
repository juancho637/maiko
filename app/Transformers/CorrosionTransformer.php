<?php

namespace App\Transformers;

use App\Corrosion;
use League\Fractal\TransformerAbstract;

class CorrosionTransformer extends TransformerAbstract
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
    public function transform(Corrosion $corrosion)
    {
        return [
            'id' => (int)$corrosion->id,
            'status' => (int)$corrosion->status_id,
            'inspection' => (int)$corrosion->inspection_id,
            'corrosion_type' => (string)$corrosion->corrosion_type,
            'remaining_thickness' => (int)$corrosion->remaining_thickness,
            'area' => (int)$corrosion->area,
            'large' => (int)$corrosion->large,
            'thickness' => (int)$corrosion->thickness,
            'depth' => (int)$corrosion->depth,
            'observation' => isset($corrosion->observation) ? (string)$corrosion->observation : null,
            'created' => (string)$corrosion->created_at,
            'updated' => (string)$corrosion->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'inspection' => 'inspection_id',
            'corrosion_type' => 'corrosion_type',
            'remaining_thickness' => 'remaining_thickness',
            'area' => 'area',
            'large' => 'large',
            'thickness' => 'thickness',
            'depth' => 'depth',
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
            'corrosion_type' => 'corrosion_type',
            'remaining_thickness' => 'remaining_thickness',
            'area' => 'area',
            'large' => 'large',
            'thickness' => 'thickness',
            'depth' => 'depth',
            'observation' => 'observation',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
