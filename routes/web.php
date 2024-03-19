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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/dudi-nib', function () {
    return view('manage.dudi_nib.index');
});
Route::get('/dudi-nib', function () {
    return view('manage.dudi_nib.index');
});
Route::get('/dudi-non-nib', function () {
    return view('manage.dudi_non_nib.index');
});


Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');

Route::prefix('dudiNonNIb')->group(function () {
    Route::get('/', [DuDiController::class, 'dudiNonNib'])->name('dudiNonNib.show');
    Route::get('/index', [DuDiController::class, 'dudiNonNibindex'])->name('dudiNonNib.index');
    Route::post('/store', [DuDiController::class, 'store'])->name('dudiNonNib.store');
    Route::get('{id}/edit', [DuDiController::class, 'edit'])->name('dudiNonNib.edit');
    Route::put('{id}/update', [DuDiController::class, 'update'])->name('dudiNonNib.update');
    Route::get('{id}/destroy', [DuDiController::class, 'destroy'])->name('dudiNonNib.destroy');
});

Route::prefix('kerjasama')->group(function () {
    Route::get('/', [DuDiController::class, 'show'])->name('kerjasama.show');
    Route::get('/index', [DuDiController::class, 'index'])->name('kerjasama.index');
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
