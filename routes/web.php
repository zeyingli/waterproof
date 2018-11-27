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
    
    Route::get('/dashboard', 'FrontendController@dashboard')->name('User Dashboard');
    Route::get('/pickup/{id}', 'FrontendController@pickup')->name('Pickup Umbrella');
    
    Route::get('/account', 'FrontendController@account')->name('My Account');
    Route::get('/account/recharge', 'FrontendController@recharge')->name('Recharge Account');
    Route::post('/account/recharge', 'FrontendController@addbalance')->name('Add Balance');
    Route::get('/account/history', 'FrontendController@history')->name('Payment History');
});

