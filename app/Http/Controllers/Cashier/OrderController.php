<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
    {
        return Order::with(['user','table'])
            ->where('status', 'pending')
            ->get();
    }

   public function confirm(Request $request, $id)
{
    $request->validate([
        'method' => ['required','string'],
    ]);

    $order = Order::findOrFail($id);

    if ($order->status !== 'pending') {
        return redirect()->back()->with('error', 'Order sudah diproses.');
    }

    Payment::create([
        'order_id' => $order->id,
        'method'   => $request->method,
        'status'   => 'success',
    ]);

    $order->update([
        'status' => 'paid',
    ]);

    return redirect()
        ->route('cashier.dashboard')
        ->with('success', 'Pembayaran berhasil dikonfirmasi.');
}


}
