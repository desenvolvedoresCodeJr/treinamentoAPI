<?php

use App\Http\Controllers\Api\ArturBarberShopController;
use App\Http\Controllers\Api\ArturProductController;
use App\Http\Controllers\Api\ArturUserController;
use App\Http\Controllers\Api\BressanProductController;
use App\Http\Controllers\Api\DuTrainingController;
use App\Http\Controllers\Api\DuUserController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\PauloCreditCardController;
use App\Http\Controllers\Api\PauloUserController;
use App\Http\Controllers\Api\RomuloProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/identities', [IdentityController::class, 'index']);



use App\Http\Controllers\BrunoProductController;
use App\Http\Controllers\BrunoCartItemController;

use App\Http\Controllers\HadassaCategoryController;
use App\Http\Controllers\HadassaPostController;

use App\Http\Controllers\LuanPlatformController;
use App\Http\Controllers\LuanGenreController;
use App\Http\Controllers\LuanGameController;
use App\Http\Controllers\LuanReviewController;

Route::prefix('/bruno')->group(function () {
    Route::apiResource('products', BrunoProductController::class);
    Route::apiResource('cart-items', BrunoCartItemController::class);
});

Route::prefix('/hadassa')->group(function () {
    Route::apiResource('categories', HadassaCategoryController::class);
    Route::apiResource('posts', HadassaPostController::class);
});

Route::prefix('/luan')->group(function () {
    Route::apiResource('platforms', LuanPlatformController::class);
    Route::apiResource('genres', LuanGenreController::class);
    Route::apiResource('games', LuanGameController::class);
    Route::apiResource('reviews', LuanReviewController::class);
});
