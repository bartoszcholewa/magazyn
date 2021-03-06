<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Option;
use Config;


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
        $options = Option::all()->pluck('option_VALUE', 'option_NAME')->toArray();
        config()->set('options', $options);
        //dd("provider");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Config::set('mail.driver', config('options.maildriver'));
        Config::set('mail.host', config('options.mailhost'));
        Config::set('mail.port', config('options.mailport'));
        Config::set('mail.from.address', config('options.mailfromaddress'));
        Config::set('mail.from.name', config('options.mailfromname'));
        Config::set('mail.encryption', config('options.mailencryption'));
        Config::set('mail.username', config('options.mailusername'));
        Config::set('mail.password', config('options.mailpassword'));

    }
}
