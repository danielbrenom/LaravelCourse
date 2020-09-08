<?php

namespace App\Policies;

use App\Traits\VerifyAdmin;
use App\User;
use App\Domain\Models\Tables\Buyer;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
{
    use HandlesAuthorization, VerifyAdmin;

    public function before($user, $ability){
        if($user->isAdmin()){
            return true;
        }
    }

    public function view(User $user, Buyer $buyer): bool
    {
        return $user->id === $buyer->id;
    }

    public function purchase(User $user, Buyer $buyer): bool
    {
        return $user->id === $buyer->id;
    }
}
