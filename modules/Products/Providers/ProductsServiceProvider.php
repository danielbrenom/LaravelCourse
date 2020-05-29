<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/products.php');
    }
}
