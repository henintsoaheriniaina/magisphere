<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('index');
Route::prefix('aut/')->name('auth.')->controller(UsersController::class)->group(function () {
    Route::get('login', 'loginPage')->name('login');
    Route::post('login', 'login')->name('login');
    Route::get('register', 'registerPage')->name('register');
    Route::post('register', 'register')->name('register');
    Route::delete('logout', 'logout')->name('logout');
});
