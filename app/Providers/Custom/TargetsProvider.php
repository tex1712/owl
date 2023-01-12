<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class TargetsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('targets', function(){
            return new \App\Libraries\Targets;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
