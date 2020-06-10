<?php

namespace App;

use App\Transformers\StateTransformer;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'country_id',
        'name',
    ];

    /**
     * Obtiene el estado asociado al usuario.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Obtiene el país asociado al estado/departamento.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
