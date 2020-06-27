<?php

namespace App\Transformers;

use App\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
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
    public function transform(Company $company)
    {
        return [
            'id' => (int)$company->id,
            'status' => (int)$company->status_id,
            'name' => (string)$company->name,
            'address' => (string)$company->address,
            'contact_name' => (string)$company->contact_name,
            'contact_number' => (string)$company->contact_number,
            'created' => (string)$company->created_at,
            'updated' => (string)$company->updated_at,
            'deleted' => isset($company->deleted) ? (string)$company->deleted : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'name' => 'name',
            'address' => 'address',
            'contact_name' => 'contact_name',
            'contact_number' => 'contact_number',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'deleted' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
