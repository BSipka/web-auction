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



Route::get('/', 'App\Http\Controllers\AuctionsController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('auctions', App\Http\Controllers\AuctionsController::class);

Route::middleware(['auth'])->group(function () {
    
    Route::get('orders.sales',[App\Http\Controllers\OrdersController::class,'sales'])->name('orders.sales');
    Route::get('offers.count',[App\Http\Controllers\OffersController::class,'get_offers'])->name('offers.count');
    Route::get('offers.bids',[App\Http\Controllers\OffersController::class,'get_bids'])->name('offers.bids');
    Route::get('users.details',[App\Http\Controllers\UsersController::class,'index'])->name('users.details');
    Route::get('orders/create/{id}', [
        'as' => 'orders.create',
        'uses' => 'App\Http\Controllers\OrdersController@create'
    ]);
    
    Route::resource('users', App\Http\Controllers\UsersController::class);
    Route::resource('orders', App\Http\Controllers\OrdersController::class,['except' => 'create']);
    Route::resource('items',   App\Http\Controllers\ItemsController::class);
    Route::resource('offers',   App\Http\Controllers\OffersController::class);
    
});
