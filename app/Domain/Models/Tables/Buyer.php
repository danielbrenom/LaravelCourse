<?php

namespace App\Domain\Models\Tables;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends User
{
    protected static function booted()
    {
        static::addGlobalScope('buyer', static function (Builder $builder) {
            $builder->has('transactions');
        });
    }


    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
