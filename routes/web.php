<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\OrderController as AdminOrder;

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrder::class, 'index']);
    Route::get('/orders/{id}/{status}', [AdminOrder::class, 'updateStatus']);
    Route::delete('/orders/{id}/delete', [AdminOrder::class, 'destroy']); // TAMBAHKAN INI
    //game
    Route::get('/games', [\App\Http\Controllers\Admin\GameController::class, 'index']);
    Route::get('/games/create', [\App\Http\Controllers\Admin\GameController::class, 'create']);
    Route::post('/games', [\App\Http\Controllers\Admin\GameController::class, 'store']);
    Route::get('/games/{id}/edit', [\App\Http\Controllers\Admin\GameController::class, 'edit']);
    Route::put('/games/{id}', [\App\Http\Controllers\Admin\GameController::class, 'update']);
    Route::delete('/games/{id}', [\App\Http\Controllers\Admin\GameController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/payment/{id}', [PaymentController::class, 'show']);
    Route::post('/payment/{id}', [PaymentController::class, 'confirm']);
});

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrder::class, 'index']);
    Route::get('/orders/{id}/{status}', [AdminOrder::class, 'updateStatus']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/game/{id}', [HomeController::class, 'detail']);

Route::post('/topup', [TopUpController::class, 'store'])->middleware('auth');
Route::get('/my-orders', [HomeController::class, 'myOrders'])->middleware('auth');

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
