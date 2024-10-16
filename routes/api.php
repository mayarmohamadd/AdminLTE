<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JWTAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);



// Categories Routes
Route::get('categories',[CategoryController::class,'index']);
Route::post('categories',[CategoryController::class,'store']);
Route::post('category/{id}',[CategoryController::class,'update']);
Route::delete('category/{id}',[CategoryController::class,'delete']);

//Article Routes
Route::get('articles',[ArticleController::class,'index']);
Route::delete('articles/{id}',[ArticleController::class,'destroy']);
Route::post('articles',[ArticleController::class,'store'])->middleware('auth:api');
Route::post('articles/{id}',[ArticleController::class,'update'])->middleware('auth:api');
