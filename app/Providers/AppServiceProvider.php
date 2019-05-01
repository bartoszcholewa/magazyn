<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Option;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $program_NAME = Option::find(3)->option_VALUE;
        $program_VERSION = Option::find(4)->option_VALUE;
        View::share('program_NAME', $program_NAME);
        View::share('program_VERSION', $program_VERSION);
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
