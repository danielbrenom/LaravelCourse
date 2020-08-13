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
        ];
    }
}
