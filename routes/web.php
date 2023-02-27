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

Route::get('/', function () {
    return redirect('/books');
});

Auth::routes(['register' => false]);
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('books', App\Http\Controllers\BookController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books', [App\Http\Controllers\BookController::class, 'get_books'])->name('book-list');
Route::get('/books/{book:slug}', [App\Http\Controllers\BookController::class, 'show_book'])->name('book.detail');
