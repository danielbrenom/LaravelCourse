<?php

namespace App\Domain\Observers\Tables;

use App\Domain\Models\Tables\Product;

class ProductObserver
{
    public function updated(Product $product){
        if($product->quantity === 0 && $product->isAvailable()){
            $product->status = Product::STATUS_UNAVAILABLE;
            $product->save();
        }
    }
}