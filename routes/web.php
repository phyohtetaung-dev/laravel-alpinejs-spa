<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('posts.index');
});

Route::controller(PostController::class)->group(function () {
    Route::get('posts/get-all', 'getAll');
    Route::get('posts', 'index')->name('posts.index');
    Route::post('posts/store', 'store');
    Route::put('posts/{post}', 'update');
    Route::delete('posts/{post}', 'destroy');
});
