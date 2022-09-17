<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class DeltaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('delta', function(){
            return new \App\Libraries\Delta;
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
