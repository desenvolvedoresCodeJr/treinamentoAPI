<?php

use App\Http\Controllers\Api\ArturBarberShopController;
use App\Http\Controllers\Api\ArturProductController;
use App\Http\Controllers\Api\ArturUserController;
use App\Http\Controllers\Api\BayletPublicationController;
use App\Http\Controllers\Api\BressanProductController;
use App\Http\Controllers\Api\DuTrainingController;
use App\Http\Controllers\Api\DuUserController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\PauloCreditCardController;
use App\Http\Controllers\Api\PauloUserController;
use App\Http\Controllers\Api\RomuloProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/identities', [IdentityController::class, 'index']);

// Rotas de api do Paulo
Route::post('/paulo/user', [PauloUserController::class, 'store']);
Route::get('/paulo/user/{id}', [PauloUserController::class, 'show']);
Route::put('/paulo/user/{id}', [PauloUserController::class, 'update']);
Route::delete('/paulo/user/{id}', [PauloUserController::class, 'destroy']);

Route::post('/paulo/creditCard', [PauloCreditCardController::class, 'store']);
Route::put('/paulo/creditCard/{id}', [PauloCreditCardController::class, 'update']);
Route::delete('/paulo/creditCard/{id}', [PauloCreditCardController::class, 'destroy']);

// Rotas de api do Du
Route::post('/du/user', [DuUserController::class, 'store']);
Route::put('/du/user/{id}', [DuUserController::class, 'update']);
Route::delete('/du/user/{id}', [DuUserController::class, 'destroy']);
Route::get('/du/user/{id}', [DuUserController::class, 'show']);

Route::post('/du/training', [DuTrainingController::class, 'store']);
Route::put('/du/training/{id}', [DuTrainingController::class, 'update']);
Route::delete('/du/training/{id}', [DuTrainingController::class, 'destroy']);

// Rotas de api do Artur
Route::post('/artur/user', [ArturUserController::class, 'store']);
Route::put('/artur/user/{id}', [ArturUserController::class, 'update']);
Route::delete('/artur/user/{id}', [ArturUserController::class, 'destroy']);
Route::get('/artur/user/{id}', [ArturUserController::class, 'show']);

Route::post('/artur/barberShop', [ArturBarberShopController::class, 'store']);
Route::put('/artur/barberShop/{id}', [ArturBarberShopController::class, 'update']);
Route::delete('/artur/barberShop/{id}', [ArturBarberShopController::class, 'destroy']);
Route::get('/artur/barberShop/{id}', [ArturBarberShopController::class, 'show']);

Route::post('/artur/product', [ArturProductController::class, 'store']);
Route::put('/artur/product/{id}', [ArturProductController::class, 'update']);
Route::delete('/artur/product/{id}', [ArturProductController::class, 'destroy']);

Route::prefix('/romulo')->group(function () {
    Route::get('/products', [RomuloProductController::class, 'index']);
    Route::post('/products', [RomuloProductController::class, 'store']);
    Route::get('/products/{id}', [RomuloProductController::class, 'show']);
    Route::put('/products/{id}', [RomuloProductController::class, 'update']);
    Route::delete('/products/{id}', [RomuloProductController::class, 'delete']);
});

Route::prefix('/bressan')->group(function () {
    Route::get('/products', [BressanProductController::class, 'index']);
    Route::post('/products', [BressanProductController::class, 'store']);
    Route::get('/products/{id}', [BressanProductController::class, 'show']);
    Route::put('/products/{id}', [BressanProductController::class, 'update']);
    Route::delete('/products/{id}', [BressanProductController::class, 'destroy']);
});

Route::prefix('/baylet')->group(function () {
    Route::get('/publications', [BayletPublicationController::class, 'index']);
    Route::post('/publications', [BayletPublicationController::class, 'store']);
    Route::get('/publications/{id}', [BayletPublicationController::class, 'show']);
    Route::put('/publications/{id}', [BayletPublicationController::class, 'update']);
    Route::delete('/publications/{id}', [BayletPublicationController::class, 'destroy']);
});
