<?php

namespace App;

use App\Transformers\FileTransformer;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'fileable_id',
        'fileable_type',
        'path',
        'option',
    ];

    /**
     * Asigna las tranformaciones correspondientes.
     */
    public $transformer = FileTransformer::class;

    /**
     * Get the owning fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
