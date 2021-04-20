<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class OptionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('option', \App\Models\Option::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            Option::whereAutoload(true)->each(function (Option $option) {
                Config::set('settings.'.$option->key, $option->value);
            });
        }
    }
}
