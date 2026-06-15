<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/{game}', [GameController::class, 'show']);
    Route::post('/games/{game}', [GameController::class, 'store']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);
});
