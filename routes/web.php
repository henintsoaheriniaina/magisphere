<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::patch('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');

    // Theme
    Route::get('theme', [UsersController::class, 'toggleTheme'])->name('toggleTheme');

    // Profil
    Route::get('profile/{user}', [UsersController::class, 'showProfile'])->name('profile.show');
    Route::get('/edit-profile', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profile', [UsersController::class, 'update'])->name('profile.update');
    Route::put('/update-profile-image', [UsersController::class, 'updateProfileImage'])->name('profile.updateProfileImage');
    Route::get('/delete-profile-image', [UsersController::class, 'deleteProfileImage'])->name('profile.deleteProfileImage');
});

// Admin
Route::middleware(['auth', 'role:admin|verificator|moderator'])->prefix('admin')->name("admin.")->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des utilisateurs (Admin + Vérificateurs)
    Route::middleware('role:admin|verificator')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('/users/{user}/status', [UserController::class, 'setStatus'])->name('users.setStatus');
    });
    // Gestion des publications (Admin + Moderators)
    Route::middleware('role:admin|moderator')->group(function () {
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    });



    // Modération des posts (Admin + Moderator)
    Route::middleware('role:admin|moderator')->group(function () {
        Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation');
        Route::post('/moderation/{post}/approve', [ModerationController::class, 'approve'])->name('moderation.approve');
        Route::post('/moderation/{post}/reject', [ModerationController::class, 'reject'])->name('moderation.reject');
    });
});
