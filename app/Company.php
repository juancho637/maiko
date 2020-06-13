<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'city_id',
        'name',
        'address',
        'contact_name',
        'contact_number',
    ];

    /**
     * Obtiene la ciudad asociada a la empresa.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Obtiene el estado asociado a la empresa.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
