<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
            Route::get('/', function () {
                return redirect('/login');
    });


        // Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
            /**
            * Register Routes
            */
            Route::get('/register', 'RegisterController@show')->name('register.show');
            Route::post('/register', 'RegisterController@register')->name('register.perform');

            /**
            * Login Routes
            */
            Route::get('/login', 'LoginController@show')->name('login.show');
            Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
            /**
            * Logout Routes
            */
            Route::get('/logout', 'LogoutController@logout')->name('logout.perform');
            Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
            Route::get('/transaction/new', 'TransactionController@newtransaction')->name('transaction.new');
            Route::get('/transaction/pending', 'PendingController@pendingtransaction')->name('transaction.pending');
            Route::get('/transaction/approved', 'ApprovedController@approvedtransaction')->name('transaction.approved');
           
           
    });
      
           
});