<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('results', 'HomeController@search')->name('search');

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

        Route::get('artisan/storagelink', function(){
            Artisan::call('storage:link');
        });
        Route::get('artisan/migrate', function(){
            Artisan::call('migrate');
        });
        Route::get('artisan/cacheclear', function(){
            Artisan::call('cache:clear');
        });
        Route::get('artisan/viewclear', function(){
            Artisan::call('view:clear');
        });
        Route::get('artisan/configcache', function(){
            Artisan::call('config:cache');
        });
    });


    Route::get('crowdfund/create', 'CrowdfundController@createUser')->name('crowdfund.createUser');
    Route::post('crowdfund/store', 'CrowdfundController@store')->name('crowdfund.storeUser');
    Route::get('crowdfund/{id}', 'CrowdfundController@showUser')->name('crowdfund.showUser');
    Route::get('crowdfund/{id}/edit', 'CrowdfundController@editUser')->name('crowdfund.editUser');
    Route::patch('crowdfund/{id}/update', 'CrowdfundController@updateUser')->name('crowdfund.updateUser');

    Route::post('crowdfund/{id}/donation', 'DonationController@store')->name('donation.storeUser');

    Route::post('crowdfund/{id}/report', 'ReportController@store')->name('report.storeUser');

    Route::get('crowdfund/{id}/auction/create', 'AuctionController@createUser')->name('auction.createUser');
    Route::post('crowdfund/{id}/auction/create/store', 'AuctionController@store')->name('auction.storeUser');
    
    Route::get('auction/{id}', 'AuctionController@showUser')->name('auction.showUser');
    Route::get('auction/{id}/edit', 'AuctionController@editUser')->name('auction.editUser');
    Route::patch('auction/{id}/update', 'AuctionController@updateUser')->name('auction.updateUser');
    Route::post('auction/{id}/bid', 'BidController@store')->name('bid.storeUser');
    
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::patch('profile/update', 'UserController@updateUser')->name('user.updateUser');
    Route::post('profile/changePassword','UserController@changePassword')->name('user.changePassword');

});
