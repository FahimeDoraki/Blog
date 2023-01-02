<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
    public function boot(Gate $gate)
    {
        $this->registerPolicies($gate);

        // $gate->define('isAdmin',function($user){
        //     return $user->user_type == '2';
        // });
        
        // $gate->define('isManager',function($user){
        //     return $user->user_type == '1';
        // });
 
        // $gate->define('isUser',function($user){
        //     return $user->user_type == '0';
        // });
    }
}
