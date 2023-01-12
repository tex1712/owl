<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class SourcesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sources', function(){
            return new \App\Libraries\Sources;
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
