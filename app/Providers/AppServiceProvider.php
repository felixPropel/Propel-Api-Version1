<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\UserInterface','App\Repositories\UserRepository');
        $this->app->bind('App\Interfaces\PersonInterface','App\Repositories\PersonRepository');
        $this->app->bind('App\Interfaces\HrmDepartmentInterface','App\Repositories\HRM\HrmDepartmentRepository');
        $this->app->bind('App\Interfaces\HrmHumanResourceTypeInterface','App\Repositories\HRM\HrmHumanResourceTypeRepository');
        $this->app->bind('App\Interfaces\HrmDesignationInterface','App\Repositories\HRM\HrmDesignationRepository');


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Passport::withoutCookieSerialization();
    }
}
