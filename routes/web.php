<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return redirect()->route('customer.index');
});

/* task 1 */
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/list', [CustomerController::class, 'index'])->name('index');
    Route::post('/import', [CustomerController::class, 'import'])->name('import');
});

/* task 2 */
Route::prefix('file')->name('file.')->group(function () {
    Route::get('/index', [FileController::class, 'index'])->name('index');
    Route::post('/upload', [FileController::class, 'store'])->name('upload');
});
