<?php

namespace Test\Package;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('package', \Test\Package\Middleware\PackageMiddleware::class);

        $this->publishes([
            __DIR__.'/Config/package.php' => config_path('package.php'),
        ], 'package_config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'package');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/package'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'package');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/package'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/package'),
        ], 'package_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Test\Package\Commands\PackageCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.php', 'package'
        );
    }
}
