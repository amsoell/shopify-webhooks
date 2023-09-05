<?php

namespace Amsoell\ShopifyWebhooks;

use Illuminate\Support\ServiceProvider;

class ShopifyWebhooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shopify-webhooks.php'),
            ], 'laravel-assets');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shopify-webhooks');
    }
}
