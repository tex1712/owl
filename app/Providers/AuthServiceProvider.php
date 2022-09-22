<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Delta;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('agent', function(User $user) {
            return ($user->role === 'admin' || $user->role === 'agent');
        });

        Gate::define('officer', function(User $user) {
            return ($user->role === 'admin' || $user->role === 'officer');
        });

        Gate::define('delta_view', function(User $user, Delta $delta) {
            if($user->role === 'agent'){
                return $user->id == $delta->agent_id;
            }
            if($user->role === 'officer'){
                return $user->id == $delta->officer_id;
            }
            return $user->role === 'admin';
        });

        Gate::define('delta_manage', function(User $user, Delta $delta) {
            if($user->role === 'agent'){
                return $user->id == $delta->agent_id;
            }
            return $user->role === 'admin';
        });


    }
}
