<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



// Auth
Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'loginPage'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::get('register', [AuthController::class, 'registerPage'])->name('register');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });
    Route::middleware(['auth', 'approved'])->delete('logout', [AuthController::class, 'logout'])->name('logout');
});
// email
Route::get('/email/verify', [AuthController::class, 'verifyEmailPage'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'handleVerifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendEMailVerification'])->middleware(['auth'])->name('verification.send');

// users
Route::middleware(['auth', 'verified', 'approved'])->group(function () {

    // Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/',  function () {
            return redirect()->route('index');
        });
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::patch('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');

    // Theme
    Route::get('theme', [AuthController::class, 'toggleTheme'])->name('toggleTheme');

    // Profil
    Route::get('profile/{user}', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::get('/edit-profile', [AuthController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profile', [AuthController::class, 'update'])->name('profile.update');
    Route::put('/update-profile-image', [AuthController::class, 'updateProfileImage'])->name('profile.updateProfileImage');
    Route::get('/delete-profile-image', [AuthController::class, 'deleteProfileImage'])->name('profile.deleteProfileImage');
});

// Admin
Route::prefix('admin')->name("admin.")->middleware('verified')->group(function () {
    Route::middleware(['auth', 'role:admin|verificator|moderator', 'approved'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des utilisateurs
    Route::middleware(['auth', 'role:admin|verificator|moderator', 'approved'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('/users/{user}/status', [UserController::class, 'setStatus'])->name('users.setStatus');
    });

    // Gestion des publications
    Route::middleware(['auth', 'role:admin|moderator', 'approved'])->group(function () {
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::post('/post/{post}/status', [\App\Http\Controllers\Admin\PostController::class, 'setStatus'])->name('posts.setStatus');
    });

    // Modération des posts
    Route::middleware(['auth', 'role:admin|moderator', 'approved'])->group(function () {
        Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation');
        Route::post('/moderation/{post}/approve', [ModerationController::class, 'approve'])->name('moderation.approve');
        Route::post('/moderation/{post}/reject', [ModerationController::class, 'reject'])->name('moderation.reject');
    });
});
