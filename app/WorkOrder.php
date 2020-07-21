<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\WorkOrderTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'company_id',
        'quotation',
        'start',
        'work_order_number',
        'address',
        'city_id',
        'contact_name',
        'contact_number',
        'inspection_type',
        'certificate_name',
        'owner_email',
        'emails',
        'invoice_name',
        'invoice_nit',
        'invoice_contact_name',
        'invoice_mail',
        'r_mkc_002',
        'r_mkc_031',
        'r_mkc_032',
        'r_mkc_033',
        'r_mkc_045',
        'r_mkc_046',
        'r_mkc_090',
        'tape_measure',
        'caliper',
        'multimeter',
        'videoscopio',
        'photometer',
        'thermohygometer',
        'bridge_cam_gauge',
        'depth_gauge',
        'gauge',
        'thickness_gauge_ex',
        'reference_block_ladder_ex',
        'caliper_bagel',
        'thickness_gauge_in',
        'reference_block_ladder_in',
        'thermometer',
        'gas_multidetector',
        'harness',
        'mask',
        'slings',
        'lifeline',
        'atmospheremeter',
        'observation',
        'transport',
        'hospitals',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = WorkOrderTransformer::class;

    /**
     * Obtiene el estado asociado a un tanque.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene la empresa asociado a una orden de trabajo.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Obtiene la ciudad asociada a la orden de trabajo.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Obtiene las inspecciones asociadas a una orden de trabajo.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Obtiene los usuarios asociados a una orden de trabajo.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
