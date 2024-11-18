<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ArticleController;

Route::resource('/articles', ArticleController::class);

Route::get('/blog', function () {return view('blog');})->name('blog');

Route::view("/profile", "profile")->name("profile");
Route::view("/", "about")->name("about");

// Untuk handling artikel
Route::get('/artikel/{id}', [PostController::class, 'show'])->name('artikel.show');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profiles', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profiles', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profiles', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
