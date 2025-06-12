<?php

namespace lyhiving\ragflow\Laravel;

use Illuminate\Support\ServiceProvider;
use lyhiving\ragflow\Client;

class RagflowServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ragflow', function ($app) {
            $config = $app['config']['ragflow'];
            return new Client(
                $config['api_key'],
                $config['api_endpoint'],
                $config['request_timeout'] ?? 30.0
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/ragflow.php' => config_path('ragflow.php'),
        ], 'ragflow-config');
    }

    public function provides()
    {
        return ['ragflow'];
    }
}