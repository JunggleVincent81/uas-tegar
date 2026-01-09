<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    public function index()
    {
        $order = Order::with('table')
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('public.order-status', compact('order'));
    }
}
