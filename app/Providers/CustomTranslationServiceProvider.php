<?php

namespace App\Providers;

use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;

class CustomTranslationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('translator', function ($app) {
            $loader = new FileLoader(new Filesystem(), base_path('lang/vendor/adminlte'));
            return new Translator($loader, $app['config']['app.locale']);
        });
    }
}
