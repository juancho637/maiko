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
        ];
    }
}
