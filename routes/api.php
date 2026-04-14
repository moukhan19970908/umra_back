<?php

use Illuminate\Support\Facades\Route;

Route::get('/get-content-category', [\App\Http\Controllers\ContentController::class,'getCategories']);
Route::get('/get-content-by-category/{id}',[\App\Http\Controllers\ContentController::class,'getContentByCategory']);
Route::get('/get-content-all-category',[\App\Http\Controllers\ContentController::class,'getContentAllCategory']);

Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::get('/surah',[\App\Http\Controllers\SurahController::class,'surah']);
Route::get('/surah/{id}',[\App\Http\Controllers\SurahController::class,'surahGetId']);

Route::get("/add/verses",[\App\Http\Controllers\SurahController::class,'verses']);
