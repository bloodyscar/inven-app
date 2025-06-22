<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/barang', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item.index');
Route::post('/barang', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('item.store');
Route::get('/barang/{item}/edit', [ItemController::class, 'edit'])->middleware(['auth', 'verified'])->name('item.edit');
Route::put('/barang/{item}', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->name('item.update');
Route::delete('/barang/{item}', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('item.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
