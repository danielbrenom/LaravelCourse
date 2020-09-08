<?php

namespace App\Policies;

use App\Traits\VerifyAdmin;
use App\User;
use App\Domain\Models\Tables\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization, VerifyAdmin;

    public function view(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    public function sale(User $user, User $seller)
    {
        return $user->id === $seller->id;
    }

    public function update(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    public function edit(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    public function delete(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }
}
