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
}
