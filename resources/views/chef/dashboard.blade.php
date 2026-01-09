@extends('chef.layout')

@section('content')
<div
    x-data="{
        open:false,
        order:null
    }"
>

<h1 class="text-2xl font-bold mb-6">Antrian Dapur</h1>

<table class="w-full border border-white/20">
    <thead class="bg-white/10">
        <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Customer</th>
            <th class="p-3 text-left">Meja</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr class="border-t border-white/10">
            <td class="p-3">#{{ $order->id }}</td>
            <td class="p-3">{{ $order->user?->name ?? 'Guest' }}</td>
            <td class="p-3">{{ $order->table?->number ?? '-' }}</td>
            <td class="p-3 capitalize">{{ $order->status }}</td>

            <td class="p-3">
                @if ($order->status === 'paid')
                <button
                    @click="open=true; order={{ $order }}"
                    class="px-3 py-1 bg-yellow-500 rounded text-black">
                    Mulai Masak
                </button>
                @endif

                @if ($order->status === 'cooking')
                <button
                    @click="open=true; order={{ $order }}"
                    class="px-3 py-1 bg-green-600 rounded">
                    Selesai
                </button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div
    x-cloak
    x-show="open"
    x-transition
    @click.self="open=false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
>
    <div
        class="w-full max-w-sm rounded-2xl
               bg-white/20 backdrop-blur-xl
               border border-white/30 p-6 text-white">

        <h2 class="text-xl font-bold mb-4 text-center">
            Konfirmasi Pesanan
        </h2>

        <div class="text-sm space-y-2 mb-6" x-show="order">
            <p>Order : <b x-text="'#'+order.id"></b></p>
            <p>Customer : <b x-text="order.user?.name ?? 'Guest'"></b></p>
            <p>Meja : <b x-text="order.table?.number ?? '-'"></b></p>
            <p>Status : <b class="capitalize" x-text="order.status"></b></p>
        </div>

        <div class="flex gap-3">
            <template x-if="order && order.status === 'paid'">
                <form
                    method="POST"
                    :action="`/chef/orders/${order.id}/start`"
                    class="flex-1">
                    @csrf
                    <button class="w-full py-2 rounded-xl bg-yellow-500 text-black">
                        Konfirmasi
                    </button>
                </form>
            </template>

            <template x-if="order && order.status === 'cooking'">
                <form
                    method="POST"
                    :action="`/chef/orders/${order.id}/finish`"
                    class="flex-1">
                    @csrf
                    <button class="w-full py-2 rounded-xl bg-green-600">
                        Konfirmasi
                    </button>
                </form>
            </template>

            <button
                type="button"
                @click="open=false"
                class="flex-1 py-2 rounded-xl bg-white/20 hover:bg-white/30">
                Cancel
            </button>
        </div>
    </div>
</div>

</div>
@endsection
