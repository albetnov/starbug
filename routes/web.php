<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileManager;
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
});

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth')->group(function () {
    Route::group(['as' => 'owner.', 'prefix' => 'owner'], function () {
        Route::view('dashboard', 'owner.dashboard')->name('dashboard');
    });

    Route::controller(ProfileManager::class)->group(function () {
        Route::get('/profile', 'show')->name('profile');
        Route::post('/profile', 'edit');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
