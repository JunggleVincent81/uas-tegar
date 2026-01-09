<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;

class KitchenController extends Controller
{

    public function start($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'paid') {
            return back()->with('error', 'Order belum dibayar.');
        }

        $order->update([
            'status' => 'cooking',
        ]);

        return back()->with('success', 'Pesanan mulai dimasak.');
    }

    public function finish($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'cooking') {
            return back()->with('error', 'Pesanan belum dimasak.');
        }

        // buka meja
        if ($order->table_id) {
            Table::where('id', $order->table_id)
                ->update(['status' => 'available']);
        }

        $order->delete();

        return back()->with('success', 'Pesanan selesai, meja dibuka.');
    }
}
