<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Admin\AdminRecipeController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// =====================
// Public API Routes (User)
// =====================
Route::prefix('recipes')->group(function () {
    // Pencarian resep berdasarkan budget
    Route::get('/search', [RecipeController::class, 'searchByBudget']);
    
    // Get all recipes
    Route::get('/', [RecipeController::class, 'index']);
    
    // Get single recipe
    Route::get('/{id}', [RecipeController::class, 'show']);

    // Reviews
    Route::get('/{id}/reviews', [\App\Http\Controllers\ReviewController::class, 'index']);
    Route::post('/{id}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->middleware('auth');
});

Route::post('/reviews/{id}/like', [\App\Http\Controllers\ReviewController::class, 'toggleLike'])->middleware('auth');

// =====================
// Admin API Routes
// =====================
Route::prefix('admin')->group(function () {

    // Categories CRUD
    Route::apiResource('categories', CategoryController::class);

    // Ingredients CRUD
    Route::apiResource('ingredients', IngredientController::class);

    // Recipes CRUD
    Route::apiResource('recipes', AdminRecipeController::class);

    // Reviews
    Route::get('reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index']);
    Route::delete('reviews/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy']);
    Route::post('reviews/{id}/reply', [\App\Http\Controllers\Admin\ReviewController::class, 'reply']);

    // User Management
    Route::get('users', [AdminUserController::class, 'index']);
    Route::put('users/{id}', [AdminUserController::class, 'update']);
    Route::delete('users/{id}', [AdminUserController::class, 'destroy']);
});