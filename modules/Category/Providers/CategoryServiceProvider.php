<?php

namespace Modules\Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/category.php');
    }
}
