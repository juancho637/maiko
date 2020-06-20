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
}
