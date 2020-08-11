<?php

namespace App\Domain\Observers\Tables;

use App\Mail\UserMailUpdate;
use App\Mail\UserVerification;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        Mail::to($user)->send(new UserVerification($user));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('email')) {
            Mail::to($user)->send(new UserMailUpdate($user));
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
