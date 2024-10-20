<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JWTAuthController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Auth Routes
Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);

// Categories Routes
// Route::get('categories',[CategoryController::class,'index']);
// Route::get('category/{id}',[CategoryController::class,'show']);
// Route::post('categories',[CategoryController::class,'store']);
// Route::post('category/{id}',[CategoryController::class,'update']);
// Route::delete('category/{id}',[CategoryController::class,'delete']);

//Article Routes
// Route::get('articles',[ArticleController::class,'index']);
// Route::get('news',[ArticleController::class,'index2']);
// Route::delete('articles/{id}',[ArticleController::class,'destroy']);
// Route::post('articles/create',[ArticleController::class,'store'])->middleware('auth:api');
// Route::post('articles/{id}',[ArticleController::class,'update'])->middleware('auth:api');


// Categories Routes using middleware
Route::middleware(['auth:api', CheckRole::class . ':admin'])->group(function () {
    // Routes only admin can do
    Route::get('categories', [CategoryController::class, 'index']);
    Route::delete('category/{id}', [CategoryController::class, 'delete']);
    Route::get('category/{id}',[CategoryController::class,'show']);
});
Route::middleware(['auth:api', CheckRole::class . ':manager'])->group(function () {
    // Routes only managers can use
    Route::post('categories', [CategoryController::class, 'store']);
    Route::post('category/{id}', [CategoryController::class, 'update']);
});


//Article Routes using Middleware
Route::middleware(['auth:api', CheckRole::class . ':admin'])->group(function () {
    // Routes only admin can do
    Route::get('articles',[ArticleController::class,'index']);
    Route::get('news',[ArticleController::class,'index2']);
    Route::delete('articles/{id}',[ArticleController::class,'destroy']);
});
Route::middleware(['auth:api', CheckRole::class . ':manager'])->group(function () {
    // Routes only managers can do
    Route::post('articles/create',[ArticleController::class,'store']);
    Route::post('articles/{id}',[ArticleController::class,'update']);
});
