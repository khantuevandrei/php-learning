<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [GameController::class, 'index']);
    Route::get('/games/{game}', [GameController::class, 'show']);
    Route::post('/games/{game}', [GameController::class, 'store']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);

    Route::get('/collection', [CollectionController::class, 'index']);
    Route::get('/collection/{game}/edit', [CollectionController::class, 'edit']);
    Route::patch('/collection/{game}', [CollectionController::class, 'update']);
});

require __DIR__ . '/auth.php';
