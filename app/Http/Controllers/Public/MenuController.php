<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $lastOrder = Order::where('user_id', Auth::id())
            ->latest()
            ->first();

        return view('public.menu', compact('lastOrder'));
    }
}
