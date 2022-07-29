<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setlocale('fr');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

}
