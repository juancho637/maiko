<?php

namespace App;

use App\Transformers\StatusTransformer;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'abbreviation',
        'type',
    ];

    /**
     * Obtiene los usuarios asociados a un estado.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Alcance una consulta para incluir los estados de tipo especificado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAbbreviation($query, $abbreviation)
    {
        return $query->where('abbreviation', $abbreviation)->first();
    }

    /**
     * Alcance una consulta para incluir los estados de tipo especificado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByType($query, $types)
    {
        return $query->whereIn('type', $types)->whereNotIn('abbreviation', ['gen-del']);
    }
}
