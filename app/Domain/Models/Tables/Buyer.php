<?php

namespace App\Domain\Models\Tables;

use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends User
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
