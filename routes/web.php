<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('landing');
})->name('Landing Page');

// Authenticated & Verified Route
Auth::routes(['verify' => true]);

Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('User Logout');

Route::group(['middleware' => ['auth', 'verified']], function() {
    
    // Menu
    Route::get('/dashboard', 'FrontendController@dashboard')->name('User Dashboard');
    Route::get('/account', 'FrontendController@account')->name('My Account');
    Route::get('/help', 'FrontendController@help')->name('Live Help');

    // Dashboard Multi-tabs
    Route::get('/pickup/{id}', 'FrontendController@pickup')->name('Pickup Umbrella');
    Route::post('/pickup/{id}', 'FrontendController@pickupUmbrella')->name('Picking up Umbrella');
    Route::get('/dropoff/{id}', 'FrontendController@dropoff')->name('Dropoff Umbrella');
    Route::post('/dropoff/{id}', 'FrontendController@dropoffUmbrella')->name('Droping off Umbrella');
    Route::get('/ontrip', 'FrontendController@ontrip')->name('On Trip');
    
    // User Account
    Route::get('/account/recharge', 'FrontendController@recharge')->name('Recharge Account');
    Route::post('/account/recharge', 'FrontendController@addbalance')->name('Add Balance');
    Route::get('/account/history', 'FrontendController@history')->name('Payment History');
    Route::post('/account/pay/{id}', 'FrontendController@payOverduedOrder')->name('Pay Overdued Order');
});

