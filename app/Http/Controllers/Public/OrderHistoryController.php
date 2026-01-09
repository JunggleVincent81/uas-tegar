<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('table')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('public.orders', compact('orders'));
    }
}
