<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileManager;
use App\Http\Controllers\SubcriptionsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;
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

Route::controller(GuestController::class)->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
});

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});


Route::middleware('auth')->group(function () {
    Route::view('/disabled', 'disabled')->name('disabled')->middleware('role:disabled');

    Route::group(['as' => 'owner.', 'prefix' => 'owner', 'middleware' => 'role:owner', 'controller' => OwnerController::class], function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');

        Route::get('users', 'users')->name('users');
        Route::get('users/create', 'createUser')->name('users.create');
        Route::post('users/create', 'performcreateUser');
        Route::get('users/edit/{user}', 'editUser')->name('users.edit');
        Route::post('users/edit/{user}', 'performEditUser');
        Route::post('users/delete/{user}', 'performDelUser')->name('users.delete');
        Route::post('users/upgrade/{user}', 'upgradeUser')->name('users.upgrade');

        Route::get('cafe', 'cafe')->name('cafe');
        Route::post('cafe', 'editCafe');

        Route::get('categories', 'showCategory')->name('category');
        Route::get('categories/create', 'createCategory')->name('category.create');
        Route::post('categories/create', 'performCreateCategory');
        Route::get('categories/edit/{category}', 'editCategory')->name('category.edit');
        Route::post('categories/edit/{category}', 'performEditCategory');
        Route::post('categories/delete/{category}', 'performDelCategory')->name('category.delete');

        Route::resource('menu', MenuController::class)->except('show')->names(['index' => 'menu', 'destroy' => 'menu.delete']);
        Route::resource('tables', TableController::class)->except('show')->names(['index' => 'tables', 'destroy' => 'tables.delete']);
        Route::resource('subcription', SubcriptionsController::class)->except('show')->names(['index' => 'subcription', 'destroy' => 'subcription.delete']);
        Route::resource('customers', CustomersController::class)->except('show')->names(['index' => 'customers', 'destroy' => 'customers.delete']);
        Route::resource('transaction', TransactionController::class)->except('show')->names(['index' => 'transaction', 'destroy' => 'transaction.delete']);
    });

    Route::controller(ProfileManager::class)->group(function () {
        Route::get('/profile', 'show')->name('profile');
        Route::post('/profile', 'edit');
        Route::post('/profile/delete', 'delete')->name('profile.delete');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
