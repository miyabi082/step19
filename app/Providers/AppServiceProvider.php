<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('test',function(User $user){
            if($user->id === 1) {
                return true;//
            }
            return false;//
        });
    }

    /*
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
