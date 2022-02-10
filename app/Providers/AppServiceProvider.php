<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Controllers\HttpConnectionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        \App::bind(HttpConnectionHandler::class, function () {
//            return new \App\HttpConnectionHandler();
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
