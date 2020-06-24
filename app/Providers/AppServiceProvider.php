<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('super_admin', function () {
            if(auth()->user() && auth()->user()->role_id == 1){
                return 1;
            }
            return 0;
        });
        Blade::if('admin', function () {
            if(auth()->user() && (auth()->user()->role_id == 2)){
                return 1;
            }
            return 0;
        });
        Blade::if('non_admin', function () {
            if(auth()->user() && auth()->user()->role_id == 3){
                return 1;
            }
            return 0;
        });
        Blade::if('non_super_admin', function () {
            if(auth()->user() && auth()->user()->role_id != 1){
                return 1;
            }
            return 0;
        });
    }
}
