<?php

use Illuminate\Support\Facades\Route;

Route::get('/get-content-category', [\App\Http\Controllers\ContentController::class,'getCategories']);
Route::get('/get-content-by-category/{id}',[\App\Http\Controllers\ContentController::class,'getContentByCategory']);

Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
