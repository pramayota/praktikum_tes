<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Toko;
use Illuminate\Support\Facades\Auth;

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
});
Auth::routes(['verify'=>true]);


Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::get('login',[Login::class,'login'])->name('login');
        Route::get('register',[Login::class,'register'])->name('register');
        route::post('registers_proses',[Login::class,'proses_register'])->name('register_proses');
        route::post('logins_proses',[Login::class,'proses_login'])->name('login_proses');
    });
    Route::middleware(['auth:web'])->group(function(){
        Route::view('home','user.home')->middleware('verified')->name('home');
        Route::view('profile',[Login::class,'profile'])->name('profile');
        Route::post('/logout',[Login::class,'logout'])->name('logout');
        // route::get('toko',[Toko::class,'toko'])->name('home');
    });

});

Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest:admin'])->group(function(){
            Route::get('login',[Admin::class,'login'])->name('login');
            route::post('logins_proses',[Admin::class,'proses_login'])->name('login_proses');
        });
        Route::middleware(['auth:admin'])->group(function(){
            Route::view('home','admin.home')->name('home');
            Route::post('/logout',[Admin::class,'logout'])->name('logout');
            // route::get('toko',[Toko::class,'toko'])->name('home');
        });

});














Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
