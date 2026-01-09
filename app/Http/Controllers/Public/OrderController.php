<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promo;
use App\Models\Payment;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        return view('public.checkout');
    }

    public function store(Request $request)
{
    $request->validate([
        'menu_id' => ['required','integer'],
        'qty'     => ['required','integer','min:1'],
        'price'   => ['required','integer'],
        'promo'   => ['nullable','string'],
        'payment_method' => ['required','string'],
    ]);

    $table = Table::where('status', 'available')
        ->inRandomOrder()
        ->first();

    if (!$table) {
        return back()->withErrors([
            'table' => 'Meja sedang penuh, silakan tunggu.',
        ]);
    }

    $table->update(['status' => 'occupied']);

    $subtotal = $request->price * $request->qty;
    $discount = 0;

    if ($request->promo) {
        $promo = Promo::where('code', $request->promo)
            ->where('is_active', true)
            ->first();

        if ($promo) {
            $discount = ($subtotal * $promo->discount) / 100;
        }
    }

    $total = $subtotal - $discount;

    $order = Order::create([
        'user_id'     => Auth::id(),
        'table_id'    => $table->id,
        'total_price' => $total,
        'status'      => 'pending',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'menu_id'  => $request->menu_id,
        'qty'      => $request->qty,
        'price'    => $request->price,
    ]);

    Payment::create([
        'order_id' => $order->id,
        'method'   => $request->payment_method,
        'status'   => 'success',
    ]);

 return view('public.checkout', [
    'order' => $order
]);
}

}
