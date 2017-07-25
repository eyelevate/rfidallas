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
            $companies_count = \App\Company::countCompanies();
            $fee_count = \App\Fee::countFees();
            $service_count = \App\Service::countServices();
            $vendor_count = \App\Vendor::countVendors();
            $plan_count = \App\Plan::countPlans();
            $view->with('asset_issues', $issues)
                 ->with('asset_items_count', $asset_items_count)
                 ->with('companies_count', $companies_count)
                 ->with('customer_count',$customer_count)
                 ->with('employee_count',$employee_count)
                 ->with('manager_count',$manager_count)
                 ->with('partner_count',$partner_count)
                 ->with('fee_count',$fee_count)
                 ->with('service_count',$service_count)
                 ->with('vendor_count',$vendor_count)
                 ->with('plan_count',$plan_count);
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
