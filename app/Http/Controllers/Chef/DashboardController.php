<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        return view('chef.dashboard', [
            'orders' => Order::with(['user','table'])
                ->whereIn('status', ['paid','cooking'])
                ->orderBy('created_at')
                ->get()
        ]);
    }
}
