<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\LaboController;
use App\Http\Controllers\users\ProfilController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profils')->group(function () {
        Route::get('', [ProfilController::class, 'index'])->name('profil.index');
        Route::get('/create', [ProfilController::class,'create'])->name('profil.create');
        Route::post('', [ProfilController::class,'store'])->name('profil.store');
        Route::get('/{profil}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/{profil}', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/{profil}/operation',[ProfilController::class,'operation'])->name('profil.operation');
    });
});

Route::get('/labo', [LaboController::class, 'index'])->name('labo.index');
