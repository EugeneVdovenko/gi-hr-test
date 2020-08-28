<?php

namespace App\Providers;

use App\Services\FileService;
use App\Services\ParseService;
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
        $this->app->singleton(ParseService::class, function ($app) {
            return new ParseService();
        });

        $this->app->singleton(FileService::class, function ($app) {
            return new FileService();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
