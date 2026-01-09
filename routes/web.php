<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MenuController;
use App\Http\Controllers\Public\OrderHistoryController;
use App\Http\Controllers\Public\OrderStatusController;


Route::get('/', [MenuController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderHistoryController::class, 'index'])
        ->name('orders.history');
});
Route::middleware('auth')->group(function () {
    Route::get('/order/status', [OrderStatusController::class, 'index'])
        ->name('order.status');
});

require __DIR__.'/auth.php';
require __DIR__.'/cashier.php';
require __DIR__.'/chef.php';
require __DIR__.'/public.php';
require __DIR__.'/admin.php';
