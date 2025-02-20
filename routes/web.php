<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::name('public.')->group(function () {
    Route::get('/', function () {
        return view('pages.index');
    })->name('index');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [UsersController::class, 'loginPage'])->name('login');
        Route::post('login', [UsersController::class, 'login'])->name('login');

        Route::get('register', [UsersController::class, 'registerPage'])->name('register');
        Route::post('register', [UsersController::class, 'register'])->name('register');
    });

    Route::middleware('auth')->delete('logout', [UsersController::class, 'logout'])->name('logout');
});

Route::get('theme', [UsersController::class, 'toggleTheme'])->name('toggleTheme');
