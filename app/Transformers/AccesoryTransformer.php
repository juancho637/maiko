<?php

namespace App\Transformers;

use App\Accesory;
use League\Fractal\TransformerAbstract;

class AccesoryTransformer extends TransformerAbstract
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
    public function transform(Accesory $accesory)
    {
        return [
            'id' => (int)$accesory->id,
            'inspection' => (int)$accesory->inspection_id,
            'name' => (string)$accesory->name,
            'measure' => isset($accesory->measure) ? (string)$accesory->measure : null,
            'serial' => isset($accesory->serial) ? (string)$accesory->serial : null,
            'date' => isset($accesory->date) ? (string)$accesory->date : null,
            'brand' => isset($accesory->brand) ? (string)$accesory->brand : null,
            'cant' => isset($accesory->cant) ? (string)$accesory->cant : null,
            'according' => isset($accesory->according) ? (string)$accesory->according : null,
            'created' => (string)$accesory->created_at,
            'updated' => (string)$accesory->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'inspection' => 'inspection_id',
            'name' => 'name',
            'measure' => 'measure',
            'serial' => 'serial',
            'date' => 'date',
            'brand' => 'brand',
            'cant' => 'cant',
            'according' => 'according',
            'created' => 'created_at',
            'updated' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'inspection_id' => 'inspection',
            'name' => 'name',
            'measure' => 'measure',
            'serial' => 'serial',
            'date' => 'date',
            'brand' => 'brand',
            'cant' => 'cant',
            'according' => 'according',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
