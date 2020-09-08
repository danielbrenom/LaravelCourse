<?php

namespace App\Policies;

use App\Domain\Models\Tables\Product;
use App\Traits\VerifyAdmin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization, VerifyAdmin;

    public function addCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }


    public function deleteCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }
}
