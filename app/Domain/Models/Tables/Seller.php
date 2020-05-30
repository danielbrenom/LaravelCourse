<?php

namespace App\Domain\Models\Tables;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends User
{
    protected static function booted()
    {
        static::addGlobalScope('seller', static function (Builder $builder) {
            $builder->has('transactions');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
