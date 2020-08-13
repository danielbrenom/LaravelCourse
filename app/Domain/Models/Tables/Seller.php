<?php

namespace App\Domain\Models\Tables;

use App\Transformers\SellerTransformer;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends User
{
    public $transformer = SellerTransformer::class;

    protected static function booted()
    {
        static::addGlobalScope('seller', static function (Builder $builder) {
            $builder->has('products');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
