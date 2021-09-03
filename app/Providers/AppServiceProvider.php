<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        if ($this->app->environment('local') && isset($_SERVER['HTTP_X_ORIGINAL_HOST'])) {
            $this->app['url']->forceRootUrl(
                $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_X_ORIGINAL_HOST']
            );
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
