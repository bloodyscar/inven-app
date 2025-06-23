<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/barang', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item.index');
Route::post('/barang', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('item.store');
Route::put('/barang/{item}', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->name('item.update');
Route::delete('/barang/delete/{item}', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('item.destroy');

Route::get('/kategori', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('category.index');
Route::post('/kategori', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('category.store');
Route::put('/kategori/update/{category}', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('category.update');
Route::delete('/kategori/delete/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('category.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
