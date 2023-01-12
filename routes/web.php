<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\UserController;


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

// Authentication
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function() {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Target
    Route::post('/target/filter', [TargetController::class, 'filter'])->name('target.filter');
    Route::get('/target/filtered', [TargetController::class, 'filter'])->name('target.filtered');
    Route::post('/target/{id}/status', [TargetController::class, 'changeStatus'])->name('target.change.status');
    Route::resource('/target', TargetController::class);

    // Users
    Route::resource('/users', UserController::class)->middleware('check-users-access');
});
