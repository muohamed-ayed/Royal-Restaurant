<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{meal}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{meal}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{meal}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return auth()->user()->isAdmin() ? redirect()->route('dashboard') : redirect()->route('home');
    })->name('profile.edit');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);
    Route::resource('meals', MealController::class)->except(['show', 'create']);
});

require __DIR__.'/auth.php';
