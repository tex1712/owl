<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeltaController;
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

    // Delta
    Route::post('/delta/filter', [DeltaController::class, 'filter'])->name('delta.filter');
    Route::get('/delta/filtered', [DeltaController::class, 'filter'])->name('delta.filtered');
    Route::resource('/delta', DeltaController::class);

    // Users
    Route::resource('/users', UserController::class)->middleware('check-users-access');
});
