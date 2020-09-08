<?php

namespace App\Policies;

use App\Domain\Models\Tables\Transaction;
use App\Traits\VerifyAdmin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization, VerifyAdmin;

    public function view(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->buyer->id ||
            $user->id === $transaction->product->seller->id;
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Transaction $transaction)
    {
        //
    }


    public function delete(User $user, Transaction $transaction)
    {
        //
    }
}
