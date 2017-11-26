<?php

namespace manifoldco\envy;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache as SystemCache;
use manifoldco\envy\API;
use manifoldco\envy\Cache;
use manifoldco\envy\Core;
use manifoldco\envy\Commands\Refresh;

class envyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/manifold.php' => config_path('manifold.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Refresh::class,
            ]);
        }

        $core = new Core;
        //normal boot
        $core->load_configs();
        //forcing reload of fresh data
        // $core->refresh();

    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}