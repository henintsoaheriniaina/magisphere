<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Pages publiques
Route::name('public.')->group(function () {
    Route::get('/', function () {
        return view('pages.index');
    })->name('index');
    // Theme
    Route::get('theme', [UsersController::class, 'toggleTheme'])->name('toggleTheme');

    // Posts index
    Route::get('posts/', [PostController::class, 'index'])->name('posts.index');
});

// Auth
Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [UsersController::class, 'loginPage'])->name('login');
        Route::post('login', [UsersController::class, 'login'])->name('login');

        Route::get('register', [UsersController::class, 'registerPage'])->name('register');
        Route::post('register', [UsersController::class, 'register'])->name('register');
    });
    Route::middleware('auth')->delete('logout', [UsersController::class, 'logout'])->name('logout');
});

// Posts
Route::middleware('auth')->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });
});
