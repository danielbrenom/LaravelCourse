<?php

namespace App\Providers;

use App\Domain\Models\Tables\Product;
use App\Domain\Observers\Tables\ProductObserver;
use App\Domain\Observers\Tables\UserObserver;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(197);
        Product::observe(ProductObserver::class);
        User::observe(UserObserver::class);
    }
}
