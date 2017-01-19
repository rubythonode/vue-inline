<?php

/*
 * This file is part of the VueInline package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gocanto\VueInline;

use Illuminate\Support\ServiceProvider;

class VueInlineServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishVueInlineResources();
        }
    }

    /**
     * Publish the VueInline resources files.
     *
     * @return void
     */
    protected function publishVueInlineResources()
    {
        $this->publishes([
            __DIR__ . '/../config/' => config_path()
        ], 'vueinline');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['vue-inline'];
    }
}