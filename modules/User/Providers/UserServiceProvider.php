<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/users.php');
        $this->loadTranslationsFrom(__DIR__. '/../Resources/lang', 'user');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'user');
    }
}
