<?php

use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * Actually what I found happens is that the route is matched to site root url.
 *
 * This line:
 * $route = app('router')->getRoutes()->match($request); (HttpConnectionHandler:73)
 *
 * Seems to match the root url when we request the locale prefix.
 * This route is incorrectly matched to the root of the site, but if you need to log in or if it doesn't exist it will 404 or break.
 *
 * The 404 NotFoundHttpException is caught, but the fix in the catch block is not working because the variables are in the wrong order.
 *
 * Uncomment this section to see the problem. In action with the authentication problem. And leave de root view commented out to see the 404 error.
 */

// This will demo the livewire break because of the login page redirect.
//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//    Route::get('/', function () {
//        return view('index');
//    });
//});

// Leave this commented out to demo the NotFoundHttpException not being handled correctly.
//Route::get('/', function () {
//    return view('index');
//});

/**
 * Use this route to test the component and see the behaviour.
 */
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/welcome', Welcome::class);

});
