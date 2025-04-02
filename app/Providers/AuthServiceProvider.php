<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function($user,$ability){
            if($user->type == 'super-admin'|| $user->type =='admin'){
                return true;
            }
        });
        // تم عمل العمليه داخل الكونترولر الخاص بالبوست
        //Gates
        Gate::define('posts.create',function($user){
            // return true;
           return $user->role->abilities()->where('code','posts.create')->exists();
        });
        Gate::define('posts.update',function($user){
            return $user->role->abilities()->where('code','posts.update')->exists();
            // return false;
        });
        Gate::define('posts.delete',function($user){
            return $user->role->abilities()->where('code','posts.delete')->exists();
            // return false;
        });
    }
}
