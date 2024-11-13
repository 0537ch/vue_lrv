<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::view('/', 'blog')->name('blog');
Route::view("/profile", "profile")->name("profile");
Route::view("/about", "about")->name("about");
Route::get('/artikel/{id}', [PostController::class, 'show'])->name('artikel.show');
