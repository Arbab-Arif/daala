<?php

namespace App\Providers;

use App\Models\City;
use App\Models\CityArea;
use App\Models\Country;
use App\Models\Page;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('pages')) {
            view()->share('headerLinks', Page::whereType(Page::HEADER)->get());
            if (Schema::hasColumn('pages', 'parent_id')) {
                view()->share('footerLinks', Page::whereType(Page::FOOTER)->whereParentId(0)->get());
            }
        }

        view()->composer(['admin.customer.create', 'admin.customer.edit', 'admin.driver.create', 'admin.driver.edit'], function ($view) {
            if (Schema::hasTable('cities')) {
                $view->with([
                    'countries' => Country::all(),
                    'cities'    => City::all(),
                    'areas'     => CityArea::all()
                ]);
            }
        });
    }

}
