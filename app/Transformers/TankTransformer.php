<?php

namespace App\Transformers;

use App\Tank;
use League\Fractal\TransformerAbstract;

class TankTransformer extends TransformerAbstract
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
    public function transform(Tank $tank)
    {
        return [
            'id' => (int)$tank->id,
            'status' => (int)$tank->status_id,
            'client' => (int)$tank->client_id,
            'internal_serial_number' => (string)$tank->internal_serial_number,
            'serial_number' => (string)$tank->serial_number,
            'maker' => (string)$tank->maker,
            'fabrication_year' => (string)$tank->fabrication_year,
            'capacity' => (string)$tank->capacity,
            'long' => (string)$tank->long,
            'diameter' => (string)$tank->diameter,
            'head_thickness' => (string)$tank->head_thickness,
            'body_thickness' => (string)$tank->body_thickness,
            'created' => (string)$tank->created_at,
            'updated' => (string)$tank->updated_at,
        ];
    }
}
