<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\OrderController;

Route::get('/checkout', [OrderController::class, 'create'])
    ->name('checkout');

Route::post('/order', [OrderController::class, 'store'])
    ->name('order.store');
