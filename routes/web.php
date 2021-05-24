<?php

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

Route::middleware('auth')->group(function () {

    Route::get('/', [\App\Http\Controllers\BookController::class, 'index'])->name('home');

    Route::resource('books', \App\Http\Controllers\BookController::class);

    Route::post('/borrowings/{borrowing}/return', [\App\Http\Controllers\BorrowingController::class, 'return'])->name('borrowings.return');

});

require __DIR__.'/auth.php';
