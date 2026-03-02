<?php

use App\Http\Controllers\Api\ArturBarberShopController;
use App\Http\Controllers\Api\ArturProductController;
use App\Http\Controllers\Api\ArturUserController;
use App\Http\Controllers\Api\BalduttiCategoryController;
use App\Http\Controllers\Api\BayletPublicationController;
use App\Http\Controllers\Api\BressanProductController;
use App\Http\Controllers\Api\DuTrainingController;
use App\Http\Controllers\Api\DuUserController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\PauloCreditCardController;
use App\Http\Controllers\Api\PauloUserController;
use App\Http\Controllers\Api\RichardCharacterController;
use App\Http\Controllers\Api\RomuloProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/identities', [IdentityController::class, 'index']);

Route::prefix('/baylet')->group(function () {
    Route::get('/publications', [BayletPublicationController::class, 'index']);
    Route::post('/publications', [BayletPublicationController::class, 'store']);
    Route::get('/publications/{id}', [BayletPublicationController::class, 'show']);
    Route::put('/publications/{id}', [BayletPublicationController::class, 'update']);
    Route::delete('/publications/{id}', [BayletPublicationController::class, 'destroy']);
});

Route::prefix('/baldutti')->group(function () {
    Route::get('/categories', [BalduttiCategoryController::class, 'index']);
    Route::post('/categories', [BalduttiCategoryController::class, 'store']);
    Route::get('/categories/{id}', [BalduttiCategoryController::class, 'show']);
    Route::put('/categories/{id}', [BalduttiCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [BalduttiCategoryController::class, 'destroy']);
});

Route::prefix('/richard')->group(function () {
    Route::get('/characters', [RichardCharacterController::class, 'index']);
    Route::post('/characters', [RichardCharacterController::class, 'store']);
    Route::get('/characters/{id}', [RichardCharacterController::class, 'show']);
    Route::put('/characters/{id}', [RichardCharacterController::class, 'update']);
    Route::delete('/characters/{id}', [RichardCharacterController::class, 'destroy']);
});
