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
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'identifier' => (string)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'is_verified' => (bool)$user->verified,
            'is_admin' => (bool)$user->admin,
            'creation_date' => $user->created_at,
            'last_update' => $user->updated_at ?? '',
            'deletion_date' => $user->deleted_at ?? '',
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id),
                ],
            ],
        ];
    }

    public static function originalAttributes($index): ?string
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'is_verified' => 'verified',
            'is_admin' => 'admin',
            'creation_date' => 'created_at',
            'last_update' => 'updated_at',
            'deletion_date' => 'deleted_at',
        ];
        return data_get($attributes, $index, null);
    }
    
    public static function transformedAttributes($index): ?string
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'email' => 'email',
            'verified' => 'is_verified',
            'admin' => 'is_admin',
            'created_at' => 'creation_date',
            'updated_at' => 'last_update',
            'deleted_at' => 'deletion_date',
        ];
        return data_get($attributes, $index, null);
    }
}
