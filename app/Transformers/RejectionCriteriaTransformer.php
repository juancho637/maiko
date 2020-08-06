<?php

namespace App\Transformers;

use App\RejectionCriteria;
use League\Fractal\TransformerAbstract;

class RejectionCriteriaTransformer extends TransformerAbstract
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
    public function transform(RejectionCriteria $rejection_criteria)
    {
        return [
            'id' => (int)$rejection_criteria->id,
            'inspection' => (int)$rejection_criteria->inspection_id,
            'name' => (string)$rejection_criteria->criteria,
            'created' => (string)$rejection_criteria->created_at,
            'updated' => (string)$rejection_criteria->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'inspection' => 'inspection_id',
            'criteria' => 'criteria',
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
            'criteria' => 'criteria',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
