<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController; // Ajouté ce contrôleur
use App\Models\Affiliation;
use Illuminate\Support\Facades\Route;



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

Route::middleware('auth')->group(function () {
    // Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');

    // Theme
    Route::get('theme', [UsersController::class, 'toggleTheme'])->name('toggleTheme');

    // Posts index
    Route::get('posts/', [PostController::class, 'index'])->name('posts.index');
    Route::get('annonces/', [PostController::class, 'announcements'])->name('announcements.index');

    // Profil
    Route::get('profile/{user}', [UsersController::class, 'showProfile'])->name('profile.show');

    Route::get('/edit-profile', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profile', [UsersController::class, 'update'])->name('profile.update');
    Route::put('/update-profile-image', [UsersController::class, 'updateProfileImage'])->name('profile.updateProfileImage');
    Route::get('/delete-profile-image', [UsersController::class, 'deleteProfileImage'])->name('profile.deleteProfileImage');
});

Route::get('/test', function () {
    return view('test');
})->name('test');
