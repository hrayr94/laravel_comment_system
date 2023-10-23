<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Display comments
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

// Store a new comment
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// Store a reply
Route::post('/comments/{id}', [CommentController::class, 'reply'])->name('comments.reply');

Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);



Route::get('/', function () {
    return view('welcome');
});
