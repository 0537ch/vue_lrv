<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::get('/', function () {
    return view('blog');
})->name('blog');

Route::view("/profile", "profile")->name("profile");
Route::view("/about", "about")->name("about");

// Untuk handling artikel
Route::get('/artikel/{id}', [PostController::class, 'show'])->name('artikel.show');
