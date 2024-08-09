<?php

use App\Http\Controllers\admin\AdminNewsController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

use Illuminate\Support\Facades\Route;




// Route::get('/api/documentation', function () {
//     return redirect('/api/documentation/index.html');
// });
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AdminController::class, 'login_']);

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'list'])->name('list');
    Route::get('/list_orders', [AdminController::class, 'orderlist'])->name('orderlist');
    Route::prefix('news')->group(function(){
        Route::get('/', [AdminNewsController::class, 'list'])->name('newslist');
     
        Route::get('/delete/{id}', [AdminNewsController::class, 'delete']);
        Route::get('/show/{id}', [AdminNewsController::class, 'show']);
        Route::get('/hidden/{id}', [AdminNewsController::class, 'hidden']);
    });
    Route::prefix('user')->group(function(){
        Route::get('/', [AdminUserController::class, 'list'])->name('user');
    });

    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/create', [AdminController::class, 'create_'])->name('create_');

    Route::get('/create_news', [AdminController::class, 'create_news'])->name('create_news');
    Route::post('/create_news', [AdminController::class, 'create_news_'])->name('create_news_');


    Route::get('/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/show/{id}', [AdminController::class, 'show']);
    Route::get('/hidden/{id}', [AdminController::class, 'hidden']);
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

});

Route::get('/mail', function () {
    return view('mail1');
});
Route::get('/changepassword', function () {
    return view('mailchangepassword1');
});