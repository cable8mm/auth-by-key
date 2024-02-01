<?php

namespace Cable8mm\AuthByKey;

use Cable8mm\AuthByKey\Console\Commands\ActivateApiKey;
use Cable8mm\AuthByKey\Console\Commands\DeactivateApiKey;
use Cable8mm\AuthByKey\Console\Commands\DeleteApiKey;
use Cable8mm\AuthByKey\Console\Commands\GenerateApiKey;
use Cable8mm\AuthByKey\Console\Commands\ListApiKeys;
use Cable8mm\AuthByKey\Http\Middleware\AuthorizeApiKey;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ApiKeyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Router $router): void
    {
        $router->middlewareGroup('auth.apikey', [AuthorizeApiKey::class]);
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../stubs/ApiKey.stub' => $this->app->basePath('app/Nova/ApiKey.php'),
        ], 'auth-by-key-nova');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ActivateApiKey::class,
                DeactivateApiKey::class,
                DeleteApiKey::class,
                GenerateApiKey::class,
                ListApiKeys::class,
            ]);
        }
    }
}
