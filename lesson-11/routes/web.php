<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello, Laravel!';
});

Route::resource('users', UserController::class);
Route::get('/users/{user}/articles/create', [ArticleController::class, 'create']);
Route::post('/users/{user}/articles', [ArticleController::class, 'store']);
