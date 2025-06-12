<?php

namespace lyhiving\ragflow;

use Illuminate\Support\ServiceProvider;
use lyhiving\ragflow\Exception\ragflowException;

class ragflowServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ragflow.php', 'ragflow');

        $this->app->singleton(client::class, function ($app) {
            $config = $app['config']['ragflow'];

            if (empty($config['api_key']) || empty($config['base_url'])) {
                throw new ragflowException('RagFlow API key and Base URL must be configured in config/ragflow.php or .env file.');
            }

            return new client(
                $config['api_key'],
                $config['base_url'],
                (float) $config['timeout']
            );
        });

        $this->app->alias(client::class, 'ragflow');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ragflow.php' => config_path('ragflow.php'),
            ], 'ragflow-config');
        }
    }
}