<?php

namespace App\Policies;

use App\Traits\VerifyAdmin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization, VerifyAdmin;

    public function view(User $authenticateduser, User $user)
    {
        return $authenticateduser->id === $user->id;
    }

    public function update(User $authenticateduser, User $user)
    {
        return $authenticateduser->id === $user->id;
    }

    public function delete(User $authenticateduser, User $user)
    {
        return $authenticateduser->id === $user->id &&
            $authenticateduser->token()->client->personal_access_client;
    }

}
