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
    Route::post('withgoogle', [AuthController::class, 'googleAuthentication']);
    Route::post('forgotpassword', [AuthController::class, 'forgotpassword']);
    Route::post('changepassword', [AuthController::class, 'changepassword']);
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
    Route::get('filterproducts', [TourController::class, 'filterProducts']);
    Route::get('/{slug}', [TourController::class, 'getDetail']);

});
Route::prefix('/order')->group(function () {
    Route::post('/checkout', [TourController::class, 'checkout']);
    Route::post('/checkout-vnpay', [TourController::class, 'checkoutVnpay']);
    Route::post('/checkout-vnpay-result', [TourController::class, 'checkoutVnpayResult']);
});
Route::prefix('/news')->group(function () {
    Route::get('list_news', [NewsController::class, 'list_news']);
    Route::get('/{slug}', [NewsController::class, 'news_detail']);
});


// test
Route::get('/test', function (Request $request, Response $response) {
    $url = $request->url;

    preg_match('/v=([^&]+)/', $url, $matches);
    $videoId = $matches[1];

    // Your API key
    $apiKey = 'AIzaSyCSFs6e_EoIB5Mgl_XFIwqobphR-lnrTxA';

    // API endpoint to get video details
    $apiUrl = 'https://www.googleapis.com/youtube/v3/videos';

    // Make the request to the YouTube Data API
    $response = Http::get($apiUrl, [
        'id' => $videoId,
        'part' => 'contentDetails',
        'key' => $apiKey,
    ]);

    $time = "";
    if ($response->successful()) {
        $videoDetails = $response->json();

        $duration = $videoDetails['items'][0]['contentDetails']['duration'];

        // Convert ISO 8601 duration to seconds
        $interval = new \DateInterval($duration);
        $seconds = ($interval->h * 3600) + ($interval->i * 60) + $interval->s;

        $time = $seconds;
    }



    return response()->json(['message' => 'This is a test route', 'time' => $time]);
});
Route::get('/get-info-video', function (Request $request) {
    $youtubeUrl = $request->url;
    preg_match('/v=([^&]+)/', $youtubeUrl, $matches);
    if (!isset($matches[1])) {
        return null;
    }
    $videoId = $matches[1];

    // Your API key
    $apiKey = 'AIzaSyCSFs6e_EoIB5Mgl_XFIwqobphR-lnrTxA';

    // API endpoint to get video details
    $apiUrl = 'https://www.googleapis.com/youtube/v3/videos';

    // Make the request to the YouTube Data API
    $response = Http::get($apiUrl, [
        'id' => $videoId,
        'part' => 'snippet,contentDetails,statistics',
        'key' => $apiKey,
    ]);

    if ($response->successful()) {
        $videoDetails = $response->json();

        if (!empty($videoDetails['items'])) {
            $videoInfo = $videoDetails['items'][0];
            $snippet = $videoInfo['snippet'];
            $contentDetails = $videoInfo['contentDetails'];
            $statistics = $videoInfo['statistics'];

            // Convert ISO 8601 duration to seconds
            $interval = new \DateInterval($contentDetails['duration']);
            $durationInSeconds = ($interval->h * 3600) + ($interval->i * 60) + $interval->s;

            $data =  [
                'title' => $snippet['title'],
                'description' => $snippet['description'],
                'published_at' => $snippet['publishedAt'],
                'duration' => $durationInSeconds,
                'views' => $statistics['viewCount'],
                'likes' => $statistics['likeCount'],
                'dislikes' => $statistics['dislikeCount'] ??0,
                'comments' => $statistics['commentCount'],
            ];
            return response()->json(['data'=>$data]);
        }
    }

    return null;
});

