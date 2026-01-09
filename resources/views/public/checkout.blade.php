@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">

<h1 class="text-2xl font-bold mb-6 text-center">
    Checkout
</h1>

<form method="POST" action="{{ route('order.store') }}" class="space-y-4">
    @csrf

    <input type="hidden" name="menu_id" value="1">
    <input type="hidden" name="price" value="25000">

    <input
        type="number"
        name="qty"
        value="1"
        min="1"
        class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white">

    <input
        type="text"
        name="promo"
        placeholder="Kode Promo (opsional)"
        class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 text-white">

    <select
        name="payment_method"
        class="w-full px-4 py-3 rounded-xl
               bg-white/20 backdrop-blur-md
               border border-white/30
               text-white">

        <option value="cash" class="bg-gray-900 text-white">Cash</option>
        <option value="qris" class="bg-gray-900 text-white">QRIS</option>
        <option value="debit" class="bg-gray-900 text-white">Debit</option>
    </select>

    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20">
        <h3 class="font-semibold mb-2">Informasi Meja</h3>
        <p class="text-sm opacity-80">
            Nomor meja akan ditentukan otomatis setelah pembayaran berhasil.
        </p>
    </div>

    <div class="space-y-3">
        <button
            type="submit"
            class="w-full py-3 rounded-xl bg-primary font-semibold hover:bg-blue-700 transition">
            Bayar Sekarang
        </button>

        <a
            href="/"
            class="block w-full text-center py-3 rounded-xl
                   bg-white/20 border border-white/30
                   hover:bg-white/30 transition">
            ← Kembali ke Menu
        </a>
    </div>
</form>
@if (isset($order))
<div
    x-data="{ open: true }"
    x-show="open"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

    <div
        class="w-full max-w-sm rounded-2xl
               bg-white/20 backdrop-blur-xl
               border border-white/30 p-6 text-white text-center">

        <h2 class="text-xl font-bold mb-4">
            Nomor Meja Anda
        </h2>

        <div class="text-6xl font-extrabold mb-4 text-yellow-400">
            {{ $order->table->number }}
        </div>

        <p class="text-sm opacity-80 mb-6">
            Silakan menuju meja tersebut.<br>
            Pesanan Anda sedang diproses.
        </p>

        <a
            href="/"
            class="inline-block px-4 py-2 rounded-xl bg-white/20 hover:bg-white/30">
            Kembali ke Menu
        </a>
    </div>
</div>
@endif

</div>
@endsection
