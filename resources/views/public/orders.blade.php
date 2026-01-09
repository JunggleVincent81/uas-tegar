<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-yellow-400">

<header class="sticky top-0 z-40 mb-10">
    <div class="max-w-7xl mx-auto px-6 py-4
                bg-white/20 backdrop-blur-xl
                border-b border-white/30
                rounded-b-2xl flex items-center justify-between">

        <div class="text-xl font-bold">
            📜 Riwayat Pesanan
        </div>

        <a href="/"
           class="px-4 py-2 rounded-xl bg-white/20 hover:bg-white/30 transition">
            ← Kembali ke Menu
        </a>
    </div>
</header>

<div class="max-w-4xl mx-auto px-6 pb-20">

    @forelse ($orders as $order)
    <div class="mb-4 p-5 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20">

        <div class="flex justify-between items-center mb-3">
            <div>
                <p class="font-semibold">Order #{{ $order->id }}</p>
                <p class="text-sm opacity-70">
                    {{ $order->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            {{-- STATUS BADGE --}}
            @php
                $statusColor = match($order->status) {
                    'paid' => 'bg-yellow-400 text-black',
                    'cooking' => 'bg-blue-500',
                    'done' => 'bg-green-600',
                    default => 'bg-gray-500'
                };
            @endphp

            <span class="px-3 py-1 rounded-full text-sm {{ $statusColor }}">
                {{ strtoupper($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="opacity-70">Nomor Meja</p>
                <p class="font-semibold text-lg">
                    {{ $order->table?->number ?? '-' }}
                </p>
            </div>

            <div>
                <p class="opacity-70">Total Bayar</p>
                <p class="font-semibold text-lg">
                    Rp {{ number_format($order->total_price) }}
                </p>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center p-10 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20">
        <p class="opacity-80">Belum ada pesanan.</p>
    </div>
    @endforelse

</div>

</body>
</html>
