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
    Route::resource('borrowings', \App\Http\Controllers\BorrowingController::class);

    Route::resource('borrowers', \App\Http\Controllers\BorrowerController::class);
    Route::get('/borrowers.json', [\App\Http\Controllers\BorrowerController::class, 'available'])->name('borrowers.available');

    Route::get('/qrcodes', [\App\Http\Controllers\BookController::class, 'qrcodeList'])->name('qrcodes.list');
    Route::get('/qrcodes/print', [\App\Http\Controllers\BookController::class, 'qrcodePrint'])->name('qrcodes.print');
});

require __DIR__.'/auth.php';
