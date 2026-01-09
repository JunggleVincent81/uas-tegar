<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole']);
});

