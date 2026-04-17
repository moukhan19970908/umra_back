<?php

use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get-content-category', [\App\Http\Controllers\ContentController::class, 'getCategories']);
    Route::get('/get-content-by-category/{id}', [\App\Http\Controllers\ContentController::class, 'getContentByCategory']);
    Route::get('/get-content-all-category', [\App\Http\Controllers\ContentController::class, 'getContentAllCategory']);

    Route::get('/surah', [\App\Http\Controllers\SurahController::class, 'surah']);
    Route::get('/surah/{id}', [\App\Http\Controllers\SurahController::class, 'surahGetId']);

    Route::get("/add/verses", [\App\Http\Controllers\SurahController::class, 'verses']);
    Route::get('/get/tours', [TourController::class, 'getTours']);
    Route::get('/get/tour/{id}', [TourController::class, 'getTourById']);
});
