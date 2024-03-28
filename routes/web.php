<?php

use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\DuDiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\ProdiController;
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

Route::get('/chart', [KerjasamaController::class, 'chartLingkup']);
Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::prefix('dudiNonNIb')->group(function () {
    Route::get('/', [DuDiController::class, 'dudiNonNib'])->name('dudiNonNib.show');
    Route::get('/index', [DuDiController::class, 'dudiNonNibindex'])->name('dudiNonNib.index');
    Route::post('/store', [DuDiController::class, 'storeDudDiNonNib'])->name('dudiNonNib.store');
    Route::post('/import', [DuDiController::class, 'importDudDiNonNib'])->name('dudiNonNib.import');
    Route::get('{id}/edit', [DuDiController::class, 'editDudDiNonNib'])->name('dudiNonNib.edit');
    Route::put('{id}/update', [DuDiController::class, 'updateDudDiNonNib'])->name('dudiNonNib.update');
    Route::get('{id}/destroy', [DuDiController::class, 'destroyDudDiNonNib'])->name('dudiNonNib.destroy');
});

Route::prefix('dudiNIB')->group(function () {
    Route::get('/', [DuDiController::class, 'dudiNib'])->name('dudiNib.show');
    Route::get('/index', [DuDiController::class, 'dudiNibindex'])->name('dudiNib.index');
    Route::post('/store', [DuDiController::class, 'storeDudDiNib'])->name('dudiNib.store');
    Route::post('/import', [DuDiController::class, 'importDudDiNib'])->name('dudiNib.import');
    Route::get('{id}/edit', [DuDiController::class, 'editDudDiNib'])->name('dudiNib.edit');
    Route::put('{id}/update', [DuDiController::class, 'updateDudDiNib'])->name('dudiNib.update');
    Route::get('{id}/destroy', [DuDiController::class, 'destroyDudDiNib'])->name('dudiNib.destroy');
});

Route::prefix('kerjasama')->group(function () {
    Route::get('/', [KerjasamaController::class, 'show'])->name('kerjasama.show');
    Route::get('/index', [KerjasamaController::class, 'index'])->name('kerjasama.index');
    Route::post('/store', [KerjasamaController::class, 'store'])->name('kerjasama.store');
});



Route::prefix('prodi')->group(function () {
    Route::get('/', [ProdiController::class, 'show'])->name('prodi.show');
    Route::get('/index', [ProdiController::class, 'index'])->name('prodi.index');
    Route::post('/store', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('{id}/update', [ProdiController::class, 'update'])->name('prodi.update');
    Route::get('{id}/destroy', [ProdiController::class, 'destroy'])->name('prodi.destroy');
});

Route::resource('/dudi', DuDiController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
