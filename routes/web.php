<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/delete-account', function () {
    return view('delete');
})->name('delete-account');

Route::post('/delete-account', [\App\Http\Controllers\UserController::class, 'deleteAccount'])->name('delete.account');
Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy-policy');
