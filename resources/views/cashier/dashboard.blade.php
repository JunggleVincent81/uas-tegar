@extends('cashier.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pesanan Menunggu Pembayaran</h1>

@if (session('success'))
<div class="mb-4 p-4 rounded-xl bg-green-500/20 border border-green-400">
    {{ session('success') }}
</div>
@endif

<table class="w-full border border-white/20">
    <thead class="bg-white/10">
        <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Customer</th>
            <th class="p-3 text-left">Meja</th>
            <th class="p-3 text-left">Total</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr class="border-t border-white/10" x-data="{ open:false, method:'cash' }">
            <td class="p-3">#{{ $order->id }}</td>
            <td class="p-3">{{ $order->user?->name ?? 'Guest' }}</td>
            <td class="p-3">{{ $order->table?->number ?? '-' }}</td>
            <td class="p-3">Rp {{ number_format($order->total_price) }}</td>
            <td class="p-3">
                <div class="flex gap-2">
                    <select
                        x-model="method"
                        class="bg-black/40 border p-2 rounded">
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="debit">Debit</option>
                    </select>

                    <button
                        type="button"
                        @click="open = true"
                        class="px-3 py-1 bg-green-600 rounded">
                        Bayar
                    </button>
                </div>

                <div
    x-show="open"
    x-cloak
    x-transition
    @click.self="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
>

                    <div
                        class="w-full max-w-sm rounded-2xl
                               bg-white/20 backdrop-blur-xl
                               border border-white/30 p-6 text-white">

                        <h2 class="text-xl font-bold mb-4 text-center">
                            Konfirmasi Pembayaran
                        </h2>

                        <div class="text-sm space-y-2 mb-6">
                            <p>Order : <b>#{{ $order->id }}</b></p>
                            <p>Customer : <b>{{ $order->user?->name ?? 'Guest' }}</b></p>
                            <p>Meja : <b>{{ $order->table?->number ?? '-' }}</b></p>
                            <p>Total : <b>Rp {{ number_format($order->total_price) }}</b></p>
                            <p>Metode : <b x-text="method.toUpperCase()"></b></p>
                        </div>

                        <form
                            method="POST"
                            action="/cashier/orders/{{ $order->id }}/confirm"
                            class="flex gap-3">
                            @csrf
                            <input type="hidden" name="method" :value="method">

                            <button
                                type="submit"
                                class="flex-1 py-2 rounded-xl bg-green-600 hover:bg-green-700">
                                Konfirmasi
                            </button>

                            <button
                                type="button"
                                @click="open = false"
                                class="flex-1 py-2 rounded-xl bg-white/20 hover:bg-white/30">
                                Cancel
                            </button>
                        </form>

                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if ($orders->isEmpty())
<p class="mt-6 opacity-70">Tidak ada pesanan pending.</p>
@endif
@endsection
