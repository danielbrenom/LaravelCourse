<?php

namespace Modules\Seller\Providers;

use Illuminate\Support\ServiceProvider;

class SellerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/sellers.php');
    }
}
