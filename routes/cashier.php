<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cashier\DashboardController;
use App\Http\Controllers\Cashier\OrderController;

Route::middleware(['auth', 'role:cashier'])->group(function () {

    Route::get('/cashier', [DashboardController::class, 'index'])
        ->name('cashier.dashboard');

    Route::post('/cashier/orders/{id}/confirm', [OrderController::class, 'confirm']);
});