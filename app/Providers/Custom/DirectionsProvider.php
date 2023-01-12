<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class DirectionsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('directions', function(){
            return new \App\Libraries\Directions;
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
