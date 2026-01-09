<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'table'])
            ->where('status', 'pending')
            ->get();

        return view('cashier.dashboard', compact('orders'));
    }
}
