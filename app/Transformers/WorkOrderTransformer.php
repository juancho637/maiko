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
            'company' => (int)$work_order->company_id,
            'quotation' => (string)$work_order->quotation,
            'start' => (string)$work_order->start,
            'work_order_number' => (string)$work_order->work_order_number,
            'address' => (string)$work_order->address,
            'city' => (int)$work_order->city_id,
            'contact_name' => (string)$work_order->contact_name,
            'contact_number' => (string)$work_order->contact_number,
            'inspection_type' => (string)$work_order->inspection_type,
            'certificate_name' => (string)$work_order->certificate_name,
            'owner_email' => (string)$work_order->owner_email,
            'emails' => (string)$work_order->emails,
            'invoice_name' => (string)$work_order->invoice_name,
            'invoice_nit' => (string)$work_order->invoice_nit,
            'invoice_contact_name' => (string)$work_order->invoice_contact_name,
            'invoice_mail' => (string)$work_order->invoice_mail,
            'r_mkc_002' => (bool)$work_order->r_mkc_002,
            'r_mkc_031' => (bool)$work_order->r_mkc_031,
            'r_mkc_032' => (bool)$work_order->r_mkc_032,
            'r_mkc_033' => (bool)$work_order->r_mkc_033,
            'r_mkc_045' => (bool)$work_order->r_mkc_045,
            'r_mkc_046' => (bool)$work_order->r_mkc_046,
            'r_mkc_090' => (bool)$work_order->r_mkc_090,
            'tape_measure' => (bool)$work_order->tape_measure,
            'caliper' => (bool)$work_order->caliper,
            'multimeter' => (bool)$work_order->multimeter,
            'videoscopio' => (bool)$work_order->videoscopio,
            'photometer' => (bool)$work_order->photometer,
            'thermohygometer' => (bool)$work_order->thermohygometer,
            'bridge_cam_gauge' => (bool)$work_order->bridge_cam_gauge,
            'depth_gauge' => (bool)$work_order->depth_gauge,
            'gauge' => (bool)$work_order->gauge,
            'thickness_gauge_ex' => (bool)$work_order->thickness_gauge_ex,
            'reference_block_ladder_ex' => (bool)$work_order->reference_block_ladder_ex,
            'caliper_bagel' => (bool)$work_order->caliper_bagel,
            'thickness_gauge_in' => (bool)$work_order->thickness_gauge_in,
            'reference_block_ladder_in' => (bool)$work_order->reference_block_ladder_in,
            'thermometer' => (bool)$work_order->thermometer,
            'gas_multidetector' => (bool)$work_order->gas_multidetector,
            'harness' => (bool)$work_order->harness,
            'mask' => (bool)$work_order->mask,
            'slings' => (bool)$work_order->slings,
            'lifeline' => (bool)$work_order->lifeline,
            'atmospheremeter' => (bool)$work_order->atmospheremeter,
            'observation' => (string)$work_order->observation,
            'transport' => (string)$work_order->transport,
            'hospitals' => (string)$work_order->hospitals,
            'created' => (string)$work_order->created_at,
            'updated' => (string)$work_order->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'company' => 'company_id',
            'quotation' => 'quotation',
            'start' => 'start',
            'work_order_number' => 'work_order_number',
            'address' => 'address',
            'city' => 'city_id',
            'contact_name' => 'contact_name',
            'contact_number' => 'contact_number',
            'inspection_type' => 'inspection_type',
            'certificate_name' => 'certificate_name',
            'owner_email' => 'owner_email',
            'emails' => 'emails',
            'invoice_name' => 'invoice_name',
            'invoice_nit' => 'invoice_nit',
            'invoice_contact_name' => 'invoice_contact_name',
            'invoice_mail' => 'invoice_mail',
            'r_mkc_002' => 'r_mkc_002',
            'r_mkc_031' => 'r_mkc_031',
            'r_mkc_032' => 'r_mkc_032',
            'r_mkc_033' => 'r_mkc_033',
            'r_mkc_045' => 'r_mkc_045',
            'r_mkc_046' => 'r_mkc_046',
            'r_mkc_090' => 'r_mkc_090',
            'tape_measure' => 'tape_measure',
            'caliper' => 'caliper',
            'multimeter' => 'multimeter',
            'videoscopio' => 'videoscopio',
            'photometer' => 'photometer',
            'thermohygometer' => 'thermohygometer',
            'bridge_cam_gauge' => 'bridge_cam_gauge',
            'depth_gauge' => 'depth_gauge',
            'gauge' => 'gauge',
            'thickness_gauge_ex' => 'thickness_gauge_ex',
            'reference_block_ladder_ex' => 'reference_block_ladder_ex',
            'caliper_bagel' => 'caliper_bagel',
            'thickness_gauge_in' => 'thickness_gauge_in',
            'reference_block_ladder_in' => 'reference_block_ladder_in',
            'thermometer' => 'thermometer',
            'gas_multidetector' => 'gas_multidetector',
            'harness' => 'harness',
            'mask' => 'mask',
            'slings' => 'slings',
            'lifeline' => 'lifeline',
            'atmospheremeter' => 'atmospheremeter',
            'observation' => 'observation',
            'transport' => 'transport',
            'hospitals' => 'hospitals',
            'lodging' => 'lodging',
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
            'quotation' => 'quotation',
            'start' => 'start',
            'address' => 'address',
            'city_id' => 'city',
            'contact_name' => 'contact_name',
            'contact_number' => 'contact_number',
            'inspection_type' => 'inspection_type',
            'certificate_name' => 'certificate_name',
            'owner_email' => 'owner_email',
            'emails' => 'emails',
            'invoice_name' => 'invoice_name',
            'invoice_nit' => 'invoice_nit',
            'invoice_contact_name' => 'invoice_contact_name',
            'invoice_mail' => 'invoice_mail',
            'r_mkc_002' => 'r_mkc_002',
            'r_mkc_031' => 'r_mkc_031',
            'r_mkc_032' => 'r_mkc_032',
            'r_mkc_033' => 'r_mkc_033',
            'r_mkc_045' => 'r_mkc_045',
            'r_mkc_046' => 'r_mkc_046',
            'r_mkc_090' => 'r_mkc_090',
            'tape_measure' => 'tape_measure',
            'caliper' => 'caliper',
            'multimeter' => 'multimeter',
            'videoscopio' => 'videoscopio',
            'photometer' => 'photometer',
            'thermohygometer' => 'thermohygometer',
            'bridge_cam_gauge' => 'bridge_cam_gauge',
            'depth_gauge' => 'depth_gauge',
            'gauge' => 'gauge',
            'thickness_gauge_ex' => 'thickness_gauge_ex',
            'reference_block_ladder_ex' => 'reference_block_ladder_ex',
            'caliper_bagel' => 'caliper_bagel',
            'thickness_gauge_in' => 'thickness_gauge_in',
            'reference_block_ladder_in' => 'reference_block_ladder_in',
            'thermometer' => 'thermometer',
            'gas_multidetector' => 'gas_multidetector',
            'harness' => 'harness',
            'mask' => 'mask',
            'slings' => 'slings',
            'lifeline' => 'lifeline',
            'atmospheremeter' => 'atmospheremeter',
            'observation' => 'observation',
            'transport' => 'transport',
            'hospitals' => 'hospitals',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
