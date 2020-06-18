<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
        'duration',
        'transport',
        'feeding',
        'hotel',
        'lodging',
    ];

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
}
