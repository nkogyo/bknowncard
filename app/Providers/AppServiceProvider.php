<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Uploadcare\Api;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Api::class, function ($app) {
            return new Api(
                config('services.uploadcare.public_key'),
                config('services.uploadcare.secret_key')
            );
        });
    }

    public function boot(): void
    {
        //
    }
}