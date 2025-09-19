<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.member');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('handleRegister');


Route::group([
    'controller' => SocialiteAuthController::class,
    'prefix' => 'auth'
], function (){
    Route::get('/{prodiver}/login', 'providerLogin')->name('auth.provider');
    Route::get('/{prodiver}/redirect-callback', 'providerAuthentication')->name('auth.provider-callback');
});
