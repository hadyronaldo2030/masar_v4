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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Rouls Polices
        $this->registerPolicies();

        // Conditions Admin
       Gate::define('isAdmin',function($user){
        return $user->role == 'admin';
       });

        // Conditions Manger
       Gate::define('isManager',function($user){
        return $user->role == 'manager';
       });

        // Conditions Hr
       Gate::define('isHr',function($user){
        return $user->role == 'hr';
       });

        // Conditions Finance
       Gate::define('isFinance',function($user){
        return $user->role == 'finance';
       });

        // Conditions Employee
       Gate::define('isEmployee',function($user){
        return $user->role == 'employee';
       });

        // Conditions DataEntry
       Gate::define('isDataEntry',function($user){
        return $user->role == 'dataentry';
       });


    //    Gate::define('view-profile', function ($user, $profileUser) {
    //     return $user->id === $profileUser->id;
    // });

    }
}
