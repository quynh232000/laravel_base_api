<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TourController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::get('/get_country', [AuthController::class, 'get_city']);
Route::get('/get_province', [AuthController::class, 'get_province']);
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::prefix('/auth')->group(function () {
        Route::post('/update_profile', [AuthController::class, 'update_profile']);
        Route::post('/change_password', [AuthController::class, 'change_password']);
    });

    Route::prefix('tour')->group(function () {
        Route::post('create', [TourController::class, 'create']);
        Route::get('like/{tour_id}', [TourController::class, 'like']);
        // Route::get('detail/{id}',[TourController::class,'detail']);
    });
    Route::prefix('/order')->group(function () {
        Route::get('/history', [TourController::class, 'history']);
        Route::get('/{id}', [TourController::class, 'order_detail']);

    });
   
});
Route::prefix('/tour')->group(function () {
    Route::get('list_tour', [TourController::class, 'list_tour']);
    Route::get('/{slug}', [TourController::class, 'getDetail']);

});
Route::prefix('/order')->group(function () {
    Route::post('/checkout', [TourController::class, 'checkout']);
});
Route::prefix('/news')->group(function () {
    Route::get('list_news', [NewsController::class, 'list_news']);
    Route::get('/{slug}', [NewsController::class, 'news_detail']);
});
