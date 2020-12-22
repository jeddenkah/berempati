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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();



Route::middleware('auth')->group(function(){
    Route::middleware('role:admin')->prefix('admin')->group(function(){
        Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
        

        Route::resource('crowdfund', 'CrowdfundController');
        Route::resource('crowdfund.donation', 'DonationController');
        Route::resource('crowdfund.auction', 'AuctionController')->shallow();
        Route::resource('auction.bid', 'BidController');
        Route::resource('crowdfund.report', 'ReportController');

        Route::get('manage-user', 'UserController@index')->name('user.index');
        Route::get('manage-user/{id}/edit', 'UserController@edit')->name('user.edit');
        Route::patch('manage-user/{id}/update', 'UserController@update')->name('user.update');
        Route::delete('manage-user/{id}/destroy', 'UserController@destroy')->name('user.destroy');
    });

});
