<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'blog')->name('blog');
Route::view("/profile", "profile")->name("profile");
Route::view("/about", "about")->name("about");  
