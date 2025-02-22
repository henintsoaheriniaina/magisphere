<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController; // Ajouté ce contrôleur
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::name('public.')->group(function () {
    Route::get('/', function () {
        return view('pages.index');
    })->name('index');

    // Theme
    Route::get('theme', [UsersController::class, 'toggleTheme'])->name('toggleTheme');

    // Posts index
    Route::get('posts/', [PostController::class, 'index'])->name('posts.index');
    Route::get('annonces/', [PostController::class, 'announcements'])->name('announcements.index');

    // Profil 
    Route::get('profiles/{user}', [UsersController::class, 'showProfile'])->name('profiles.show');
});

// Auth
Route::prefix('auth')->group(function () {
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

// Dashboard , profil
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', function () {
            return view('pages.users.dashboard.index');
        })->name('index');
    });
    Route::get('/edit-profile', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profile', [UsersController::class, 'update'])->name('profile.update');
    Route::put('/update-profile-image', [UsersController::class, 'updateProfileImage'])->name('profile.profileImage');
});
