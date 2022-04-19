<?php

namespace App\Providers;

use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        \Jenssegers\Date\Date::setLocale(config('app.locale'));
        Carbon::setLocale(config('app.locale'));
    }
}
