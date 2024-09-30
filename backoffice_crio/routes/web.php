<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::get('/gallery', [ImageController::class, 'index']);
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('image.destroy');
Route::post('/images/{id}', [ImageController::class, 'update'])->name('image.update');


