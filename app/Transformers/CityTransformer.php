<?php

namespace App\Transformers;

use App\City;
use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
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
    public function transform(City $city)
    {
        return [
            'id' => (int)$city->id,
            'status' => (int)$city->status_id,
            'state' => (int)$city->state_id,
            'name' => (string)$city->name,
            'created' => (string)$city->created_at,
            'updated' => (string)$city->updated_at,
            'deleted' => isset($city->deleted) ? (string)$city->deleted : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'state' => 'state_id',
            'name' => 'name',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'deleted' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
