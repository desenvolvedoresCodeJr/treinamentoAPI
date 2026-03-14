<?php

use App\Http\Controllers\Api\ArturBarberShopController;
use App\Http\Controllers\Api\ArturProductController;
use App\Http\Controllers\Api\ArturUserController;
use App\Http\Controllers\Api\BalduttiProductController;
use App\Http\Controllers\Api\BayletCategoryController;
use App\Http\Controllers\Api\BayletPublicationController;
use App\Http\Controllers\Api\BayletUserController;
use App\Http\Controllers\Api\DelioAlbumController;
use App\Http\Controllers\Api\DelioRatingController;
use App\Http\Controllers\Api\DelioTrackController;
use App\Http\Controllers\Api\DelioUserController;
use App\Http\Controllers\Api\BressanProductController;
use App\Http\Controllers\Api\DuTrainingController;
use App\Http\Controllers\Api\DuUserController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\PauloCreditCardController;
use App\Http\Controllers\Api\PauloUserController;
use App\Http\Controllers\Api\RichardArtifactController;
use App\Http\Controllers\Api\RichardBuildController;
use App\Http\Controllers\Api\RichardCharacterController;
use App\Http\Controllers\Api\RichardWeaponController;
use App\Http\Controllers\Api\RomuloProductController;
use App\Http\Controllers\DelioAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/identities', [IdentityController::class, 'index']);

Route::prefix('/baylet')->group(function () {
    Route::get('/users', [BayletUserController::class, 'index']);
    Route::get('/users/{id}', [BayletUserController::class, 'show']);

    Route::get('/categories', [BayletCategoryController::class, 'index']);
    Route::get('/categories/{id}', [BayletCategoryController::class, 'show']);

    Route::get('/publications', [BayletPublicationController::class, 'index']);
    Route::post('/publications', [BayletPublicationController::class, 'store']);
    Route::get('/publications/{id}', [BayletPublicationController::class, 'show']);
    Route::put('/publications/{id}', [BayletPublicationController::class, 'update']);
    Route::delete('/publications/{id}', [BayletPublicationController::class, 'destroy']);
});

Route::prefix('/baldutti')->group(function () {
    Route::get('/products', [BalduttiProductController::class, 'index']);
    Route::post('/products', [BalduttiProductController::class, 'store']);
    Route::get('/products/{id}', [BalduttiProductController::class, 'show']);
    Route::put('/products/{id}', [BalduttiProductController::class, 'update']);
    Route::delete('/products/{id}', [BalduttiProductController::class, 'destroy']);
});

Route::prefix('/richard')->group(function () {
    Route::get('/builds', [RichardBuildController::class, 'index']);
    Route::get('/builds/{id}', [RichardBuildController::class, 'show']);

    Route::get('/weapons', [RichardWeaponController::class, 'index']);
    Route::get('/weapons/{id}', [RichardWeaponController::class, 'show']);

    Route::get('/artifacts', [RichardArtifactController::class, 'index']);
    Route::get('/artifacts/{id}', [RichardArtifactController::class, 'show']);

    Route::get('/characters', [RichardCharacterController::class, 'index']);
    Route::post('/characters', [RichardCharacterController::class, 'store']);
    Route::get('/characters/{id}', [RichardCharacterController::class, 'show']);
    Route::put('/characters/{id}', [RichardCharacterController::class, 'update']);
    Route::delete('/characters/{id}', [RichardCharacterController::class, 'destroy']);
});

Route::prefix('/delio')->group(function () {
    Route::post('/login', [DelioAuthController::class, 'login']);

    Route::get('/users', [DelioUserController::class, 'index']);
    Route::post('/users', [DelioUserController::class, 'store']);
    Route::get('/users/{id}/ratings', [DelioUserController::class, 'ratings']);
    Route::get('/users/{id}', [DelioUserController::class, 'show']);
    Route::put('/users/{id}', [DelioUserController::class, 'update']);
    Route::delete('/users/{id}', [DelioUserController::class, 'destroy']);

    Route::get('/albums', [DelioAlbumController::class, 'index']);
    Route::post('/albums', [DelioAlbumController::class, 'store']);
    Route::get('/albums/all', [DelioAlbumController::class, 'showByUser']);
    Route::get('/albums/latest', [DelioAlbumController::class, 'latest']);
    Route::get('/albums/top-rated', [DelioAlbumController::class, 'topRated']);
    Route::get('/albums/carousel', [DelioAlbumController::class, 'carousel']);
    Route::get('/albums/{id}', [DelioAlbumController::class, 'show']);

    Route::get('/ratings', [DelioRatingController::class, 'index']);
    Route::get('/ratings/album/{albumId}', [DelioRatingController::class, 'getRatingsByAlbum']);
    Route::get('/ratings/album/{albumId}/user/{userId}', [DelioRatingController::class, 'getRatingsByAlbumAndUser']);
    Route::get('/ratings/user/{userId}', [DelioRatingController::class, 'getRatingsByUser']);
    Route::get('/ratings/{id}', [DelioRatingController::class, 'show']);

    Route::get('/tracks', [DelioTrackController::class, 'index']);
    Route::post('/tracks', [DelioTrackController::class, 'store']);
    Route::get('/tracks/{id}', [DelioTrackController::class, 'show']);
    Route::put('/tracks/{id}', [DelioTrackController::class, 'update']);
    Route::delete('/tracks/{id}', [DelioTrackController::class, 'destroy']);
});
