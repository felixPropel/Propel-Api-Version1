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
        // $this->app->bind('App\Interfaces\UserInterface','App\Repositories\UserRepository');
        // $this->app->bind('App\Interfaces\PersonInterface','App\Repositories\PersonRepository');
        // $this->app->bind('App\Interfaces\HrmDepartmentInterface','App\Repositories\HRM\HrmDepartmentRepository');
        // $this->app->bind('App\Interfaces\HrmHumanResourceTypeInterface','App\Repositories\HRM\HrmHumanResourceTypeRepository');
        // $this->app->bind('App\Interfaces\HrmDesignationInterface','App\Repositories\HRM\HrmDesignationRepository');
         $this->app->bind('App\Interfaces\CommonInterface','App\Repositories\Common\CommonRepository');
        // $this->app->bind('App\Interfaces\Organization\OrganizationInterface','App\Repositories\Organization\OrganizationRepository');
       
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Person\PersonInterface','App\Http\Controllers\version1\Repositories\Person\PersonRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Common\commonInterface','App\Http\Controllers\version1\Repositories\Common\commonRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\User\UserInterface','App\Http\Controllers\version1\Repositories\User\UserRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Common\SmsInterface','App\Http\Controllers\version1\Repositories\Common\SmsRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface','App\Http\Controllers\version1\Repositories\Organization\OrganizationRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Organization\OrganizationInterface','App\Http\Controllers\version1\Repositories\Organization\OrganizationRepository');
        
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDepartmentInterface','App\Http\Controllers\version1\Repositories\Hrm\Master\HrmDepartmentRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmDesignationInterface','App\Http\Controllers\version1\Repositories\Hrm\Master\HrmDesignationRepository');
        $this->app->bind('App\Http\Controllers\version1\Interfaces\Hrm\Master\HrmHumanResourceTypeInterface','App\Http\Controllers\version1\Repositories\Hrm\Master\HrmHumanResourceTypeRepository');

        $this->app->bind('App\Http\Controllers\version1\Interfaces\Hrm\Transaction\HrmResourceInterface','App\Http\Controllers\version1\Repositories\Hrm\Transaction\HrmResourceRepository');

        $this->app->bind('App\Http\Controllers\version1\Interfaces\POC\CategoryInterface','App\Http\Controllers\version1\Repositories\POC\CategoryRepository');

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
