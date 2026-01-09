<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orderStats = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailyOrders->pluck('date')->map(
            fn ($d) => Carbon::parse($d)->format('d M')
        );

        $dailyTotals = $dailyOrders->pluck('total');

        $problemOrders = Order::with('table')
            ->where('status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(10))
            ->get();

        return view('admin.dashboard', [
            'totalUsers'      => User::count(),
            'totalOrders'     => Order::count(),
            'todayOrders'     => Order::whereDate('created_at', now())->count(),
            'availableTables' => Table::where('status', 'available')->count(),

            'recentOrders' => Order::with('table')
                ->latest()
                ->take(5)
                ->get(),

            'orderStats'    => $orderStats,
            'dailyLabels'   => $dailyLabels,
            'dailyTotals'   => $dailyTotals,
            'problemOrders' => $problemOrders,
        ]);
    }
}
