<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::get('/pegawai/{pegawai}/edit/', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::patch('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create');
    Route::get('/cuti/{cuti}/edit/', [CutiController::class, 'edit'])->name('cuti.edit');
    Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store');
    Route::patch('/cuti/{cuti}', [CutiController::class, 'update'])->name('cuti.update');
    Route::delete('/cuti/{cuti}', [CutiController::class, 'destroy'])->name('cuti.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/{user}/edit/', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::patch('/admin/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


require __DIR__ . '/auth.php';
