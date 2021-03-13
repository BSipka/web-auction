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

    Route::resource('users', App\Http\Controllers\UsersController::class);
    Route::resource('items',   App\Http\Controllers\ItemsController::class);
    
});
