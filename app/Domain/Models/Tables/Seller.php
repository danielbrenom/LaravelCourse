<?php

namespace App\Domain\Models\Tables;

use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends User
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
