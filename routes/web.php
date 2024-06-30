<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AdminController::class, 'login_']);

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'list'])->name('list');
    Route::get('/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/show/{id}', [AdminController::class, 'show']);
    Route::get('/hidden/{id}', [AdminController::class, 'hidden']);
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

});