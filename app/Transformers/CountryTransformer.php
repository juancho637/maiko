<?php

namespace App\Transformers;

use App\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
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
    public function transform(Country $country)
    {
        return [
            'id' => (int)$country->id,
            'status' => (int)$country->status_id,
            'name' => (string)$country->name,
            'short_name' => (string)$country->short_name,
            'phone_code' => (string)$country->phone_code,
            'created' => (string)$country->created_at,
            'updated' => (string)$country->updated_at,
        ];
    }
}
