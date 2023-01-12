<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Target;

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

        // Defines if User has access to given target
        Gate::define('target_access', function(User $user, Target $target) {
            if($user->role === 'agent'){
                return $user->id == $target->agent_id;
            }
            if($user->role === 'officer'){
                return $user->id == $target->officer_id;
            }
            return $user->role === 'admin';
        });


        // Defines if any kind of user has access to Agent
        Gate::define('agent_access', function(User $user, $agent_id){
            if($user->role === 'agent'){
                return $user->id == $agent_id;
            }
            if($user->role === 'officer'){
                $agent = User::find($agent_id);
                return $agent->officer_id == $user->id;
            }
            return $user->role === 'admin';
        });
        


        // Defines if Officer has access to Agent
        Gate::define('officer-to-agent', function(User $user, $agent_id){
            if($user->role === 'officer'){
                $agent = User::find($agent_id);
                return $agent->officer_id == $user->id;
            }
            return $user->role === 'admin';
        });


        // Defines if Officer has access to Agent
        Gate::define('officer-to-officer', function(User $user, $officer_id){
            if($user->role === 'officer'){
                return $user->id == $officer_id;
            }
            return $user->role === 'admin';
        });


    }
}
