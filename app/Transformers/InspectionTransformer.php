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
            'tank' => isset($inspection->tank_id) ? (int)$inspection->tank_id : null,
            'date' => (string)$inspection->date,
            'address' => isset($inspection->address) ? (string)$inspection->address : null,
            'light_intensity' => isset($inspection->light_intensity) ? (string)$inspection->light_intensity : null,
            'humidity' => isset($inspection->humidity) ? (string)$inspection->humidity : null,
            'temperature' => isset($inspection->temperature) ? (string)$inspection->temperature : null,
            'latitude' => (string)$inspection->latitude,
            'longitude' => (string)$inspection->longitude,
            'observation' => isset($inspection->observation) ? (string)$inspection->observation : null,
            'created' => (string)$inspection->created_at,
            'updated' => (string)$inspection->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'user' => 'user_id',
            'work_order' => 'work_order_id',
            'city' => 'city_id',
            'tank' => 'tank_id',
            'date' => 'date',
            'address' => 'address',
            'light_intensity' => 'light_intensity',
            'humidity' => 'humidity',
            'temperature' => 'temperature',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'observation' => 'observation',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'client' => 'client_id',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'status_id' => 'status',
            'user_id' => 'user',
            'work_order_id' => 'work_order',
            'city_id' => 'city',
            'tank_id' => 'tank',
            'date' => 'date',
            'address' => 'address',
            'light_intensity' => 'light_intensity',
            'humidity' => 'humidity',
            'temperature' => 'temperature',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'observation' => 'observation',
            'created_at' => 'created',
            'updated_at' => 'updated',
            'client_id' => 'client',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
