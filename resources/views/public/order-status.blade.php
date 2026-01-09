<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pesanan</title>
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
            📦 Status Pesanan
        </div>

        <a href="/"
           class="px-4 py-2 rounded-xl bg-white/20 hover:bg-white/30 transition">
            ← Kembali ke Menu
        </a>
    </div>
</header>

<div class="max-w-xl mx-auto px-6 pb-20">

@if (!$order)
    <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 text-center">
        <p class="opacity-80">Belum ada pesanan.</p>
    </div>
@else

    <div class="mb-6 p-6 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20">
        <h2 class="text-lg font-bold mb-2">
            Order #{{ $order->id }}
        </h2>
        <p class="text-sm opacity-80">
            Meja {{ $order->table?->number ?? '-' }} ·
            Total Rp {{ number_format($order->total_price) }}
        </p>
    </div>

    @php
        $steps = [
            'paid'    => 'Pesanan Dibayar',
            'cooking' => 'Sedang Dimasak',
            'done'    => 'Pesanan Siap / Selesai',
        ];

        $currentIndex = array_search($order->status, array_keys($steps));
    @endphp

    <div class="space-y-4">
        @foreach ($steps as $key => $label)
            @php
                $index = array_search($key, array_keys($steps));
                $active = $index <= $currentIndex;
            @endphp

            <div class="flex items-center gap-4">
                <div class="w-10 h-10 flex items-center justify-center rounded-full
                            {{ $active ? 'bg-green-500' : 'bg-white/20' }}">
                    {{ $active ? '✓' : $index + 1 }}
                </div>

                <div class="flex-1 p-4 rounded-xl
                            {{ $active ? 'bg-white/20' : 'bg-white/10' }}
                            backdrop-blur-xl border border-white/20">
                    <p class="font-semibold">{{ $label }}</p>
                </div>
            </div>
        @endforeach
    </div>

    @if ($order->status === 'done')
        <div class="mt-6 p-5 rounded-2xl bg-green-500/20 border border-green-400 text-center">
            <p class="font-semibold">
                Pesanan Anda telah selesai.  
                Silakan dinikmati 🍽️
            </p>
        </div>
    @endif

@endif

</div>

</body>
</html>
