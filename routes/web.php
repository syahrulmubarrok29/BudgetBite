<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Search Page (Frontend User)
Route::get('/search', function () {
    return view('search');
})->middleware('auth');

// Static Pages
Route::get('/about', function () {
    return view('about');
})->middleware('auth');

Route::get('/privacy', function () {
    return view('privacy');
})->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
})->middleware('auth');

// Recipe Detail Page
Route::get('/recipe/{id}', function ($id) {
    return view('recipe-detail', ['id' => $id]);
})->middleware('auth');

// Admin Dashboard
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Review Routes (pakai session auth, bukan API guard)
    Route::post('/recipes/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}/like', [ReviewController::class, 'toggleLike'])->name('reviews.like');
});

