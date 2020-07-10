<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
     * Tranforma los atributos originales en atributos personalizados.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'status' => (int)$user->status_id,
            'full_name' => (string)$user->full_name,
            'email' => (string)$user->email,
            'email_verified' => isset($user->email_verified_at) ? (string)$user->email_verified_at : null,
            'created' => (string)$user->created_at,
            'updated' => (string)$user->updated_at,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'id' => 'id',
            'status' => 'status_id',
            'full_name' => 'full_name',
            'email' => 'email',
            'email_verified' => 'email_verified',
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
            'full_name' => 'full_name',
            'email' => 'email',
            'email_verified' => 'email_verified',
            'created_at' => 'created',
            'updated_at' => 'updated',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
