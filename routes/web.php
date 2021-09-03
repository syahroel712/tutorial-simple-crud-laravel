<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BukuController;
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

Route::prefix('app-admin')->group(function () {
    Route::middleware(['belum_login'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('login');
        Route::post('/aksilogin', [DashboardController::class, 'aksiLogin'])->name('aksiLogin');
        Route::get('/register', [DashboardController::class, 'register'])->name('register');
        Route::post('/aksiregister', [DashboardController::class, 'aksiRegister'])->name('aksiRegister');
    });

    Route::middleware(['sudah_login'])->group(function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
        
        // buku
        Route::get('/buku', [BukuController::class, 'index'])->name('buku');
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{buku}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('buku.delete');

    });

});
