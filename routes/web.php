<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BalitaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GiziBalitaController;
use App\Http\Controllers\Admin\GiziIbuHamilController;
use App\Http\Controllers\Admin\IbuHamilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Admin\OperatorController;
use App\Http\Controllers\Admin\RekapanController;
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

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/login', [BerandaController::class, 'login'])->name('login');
Route::post('/login', [BerandaController::class, 'loginProcess'])->name('loginProcess');
Route::get('/dashboard', [BerandaController::class, 'dashboard'])->name('dashboard')->middleware('auth:web,admin');
Route::get('/logout', [BerandaController::class, 'logout'])->name('logout')->middleware('auth:web,admin');
Route::get('/data-balita', [BerandaController::class, 'getDataBalita'])->name('balita')->middleware('auth:web,admin');

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:admin')->group(function () {
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
    //Data Operator
    Route::resource('operator', OperatorController::class);

    Route::get('rekapan/ibu-hamil', [RekapanController::class, 'getBumilRekap']);
    Route::get('rekapan/balita', [RekapanController::class, 'getBalitaRekap']);
});
