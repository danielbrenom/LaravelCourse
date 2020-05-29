<?php

namespace Modules\Buyer\Providers;

use Illuminate\Support\ServiceProvider;

class BuyerServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/../routes/buyer.php');
    }
}
