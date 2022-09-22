<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class UsersProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('users', function(){
            return new \App\Libraries\Users;
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
