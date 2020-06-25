<?php

namespace App\Transformers;

use App\Inspection;
use League\Fractal\TransformerAbstract;

class InspectionTransformer extends TransformerAbstract
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
    public function transform(Inspection $inspection)
    {
        return [
            'id' => (int)$inspection->id,
            'status' => (int)$inspection->status_id,
            'user' => (int)$inspection->user_id,
            'work_order' => (int)$inspection->work_order_id,
            'city' => isset($inspection->city_id) ? (int)$inspection->city_id : null,
            'tank' => isset($inspection->city_id) ? (int)$inspection->tank_id : null,
            'date' => (string)$inspection->date,
            'address' => isset($inspection->city_id) ? (string)$inspection->address : null,
            'light_intensity' => isset($inspection->city_id) ? (string)$inspection->light_intensity : null,
            'humidity' => isset($inspection->city_id) ? (string)$inspection->humidity : null,
            'temperature' => isset($inspection->city_id) ? (string)$inspection->temperature : null,
            'latitude' => (string)$inspection->latitude,
            'longitude' => (string)$inspection->longitude,
            'observation' => isset($inspection->city_id) ? (string)$inspection->observation : null,
            'created' => (string)$inspection->created_at,
            'updated' => (string)$inspection->updated_at,
        ];
    }
}
