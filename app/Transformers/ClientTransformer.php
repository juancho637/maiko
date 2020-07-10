<?php

namespace App\Transformers;

use App\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
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
    public function transform(Client $client)
    {
        return [
            'id' => (int)$client->id,
            'status' => (int)$client->status_id,
            'company' => (int)$client->company_id,
            'city' => (int)$client->city_id,
            'name' => (string)$client->name,
            'address' => (string)$client->address,
            'created' => (string)$client->created_at,
            'updated' => (string)$client->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'company' => 'company_id',
            'city' => 'city_id',
            'name' => 'name',
            'address' => 'address',
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
            'company_id' => 'company',
            'city_id' => 'city',
            'name' => 'name',
            'address' => 'address',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
