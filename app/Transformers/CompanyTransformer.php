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
            'identificator' => (int)$company->id,
            'status' => (int)$company->status_id,
            'name' => (string)$company->name,
            'address' => (string)$company->address,
            'contact_name' => (string)$company->contact_name,
            'contact_number' => (string)$company->contact_number,
            'created' => (string)$company->created_at,
            'updated' => (string)$company->updated_at,
        ];
    }
}
