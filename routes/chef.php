<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chef\DashboardController;
use App\Http\Controllers\Chef\KitchenController;

Route::middleware(['auth','role:chef'])->group(function () {

    Route::get('/chef', [DashboardController::class, 'index']);
    Route::post('/chef/orders/{id}/start', [KitchenController::class, 'start']);
    Route::post('/chef/orders/{id}/finish', [KitchenController::class, 'finish']);

});
