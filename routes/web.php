<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BalitaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GiziBalitaController;
use App\Http\Controllers\Admin\GiziIbuHamilController;
use App\Http\Controllers\Admin\IbuHamilController;
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

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
    });
    //Data Balita
    Route::resource('balita', BalitaController::class);
    //Data Ibu Hamil
    Route::resource('ibu-hamil', IbuHamilController::class);
    //Data Gizi Balita
    Route::resource('gizi-balita', GiziBalitaController::class);
    //Data Gizi Ibu Hamil
    Route::resource('gizi-ibu-hamil', GiziIbuHamilController::class);
});
