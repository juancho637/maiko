<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tank extends Model
{
    use SoftDeletes;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'client_id',
        'internal_serial_number',
        'serial_number',
        'maker',
        'fabrication_year',
        'capacity',
        'long',
        'diameter',
        'head_thickness',
        'body_thickness',
    ];

    /**
     * Obtiene el estado asociado a un tanque.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el cliente asociado a un tanque.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
