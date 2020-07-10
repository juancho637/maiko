<?php

namespace App\Transformers;

use App\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
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
    public function transform(File $file)
    {
        return [
            'id' => (int)$file->id,
            'option' => isset($file->option) ? (string)$file->option : null,
            'created' => (string)$file->created_at,
            'updated' => (string)$file->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'option' => 'option',
            'created' => 'created_at',
            'updated' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'option' => 'option',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
