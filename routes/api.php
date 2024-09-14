<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes for Author
Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index']); 
    Route::get('{id}', [AuthorController::class, 'show']); 
    Route::post('/', [AuthorController::class, 'store']); 
    Route::put('{id}', [AuthorController::class, 'update']); 
    Route::delete('{id}', [AuthorController::class, 'destroy']); 
});

// Routes for Book
Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']); 
    Route::get('{id}', [BookController::class, 'show']); 
    Route::post('/', [BookController::class, 'store']); 
    Route::put('{id}', [BookController::class, 'update']); 
    Route::delete('{id}', [BookController::class, 'destroy']); 
});