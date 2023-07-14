<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * /vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php
     */
    public function register(): void
    {
        // set the public path to this directory
        // $this->app->bind('path.public', function () {
        //     return base_path() . '/public_html';
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        //
        Paginator::useBootstrapFour();
    }
}
