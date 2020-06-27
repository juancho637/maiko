<?php

namespace App\Transformers;

use App\WorkOrder;
use League\Fractal\TransformerAbstract;

class WorkOrderTransformer extends TransformerAbstract
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
    public function transform(WorkOrder $work_order)
    {
        return [
            'id' => (int)$work_order->id,
            'status' => (int)$work_order->status_id,
            'company' => (string)$work_order->company_id,
            'quotation' => (string)$work_order->quotation,
            'start' => (string)$work_order->start,
            'duration' => (string)$work_order->duration,
            'transport' => (string)$work_order->transport,
            'feeding' => (string)$work_order->feeding,
            'hotel' => (string)$work_order->hotel,
            'lodging' => (string)$work_order->lodging,
            'created' => (string)$work_order->created_at,
            'updated' => (string)$work_order->updated_at,
            'deleted' => isset($work_order->deleted) ? (string)$work_order->deleted : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'company' => 'company_id',
            'quotation' => 'quotation',
            'start' => 'start',
            'duration' => 'duration',
            'transport' => 'transport',
            'feeding' => 'feeding',
            'hotel' => 'hotel',
            'lodging' => 'lodging',
            'created' => 'created_at',
            'updated' => 'updated_at',
            'deleted' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
