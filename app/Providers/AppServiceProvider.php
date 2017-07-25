<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Send asset issues data globally to sidebar 
        view()->composer('layouts.partials.backend-sidebar', function($view) {
            $customer_count = \App\User::countMembers(4);
            $employee_count = \App\User::countMembers(3);
            $manager_count = \App\User::countMembers(2);
            $partner_count = \App\User::countMembers(1);
            $issues = \App\AssetItem::countIssues();
            $asset_items_count = \App\AssetItem::countItems();
            $view->with('asset_issues', $issues)
                 ->with('asset_items_count', $asset_items_count)
                 ->with('customer_count',$customer_count)
                 ->with('employee_count',$employee_count)
                 ->with('manager_count',$manager_count)
                 ->with('partner_count',$partner_count);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
