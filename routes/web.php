<?php
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('admin/login', [AuthController::class, 'login'])->name('postLogin');
Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
});

