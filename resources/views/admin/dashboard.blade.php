@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-8">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="p-5 rounded-xl bg-white/10 border border-white/20">
        <p class="text-sm opacity-70">Total User</p>
        <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
    </div>

    <div class="p-5 rounded-xl bg-white/10 border border-white/20">
        <p class="text-sm opacity-70">Total Order</p>
        <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
    </div>

    <div class="p-5 rounded-xl bg-white/10 border border-white/20">
        <p class="text-sm opacity-70">Order Hari Ini</p>
        <p class="text-3xl font-bold mt-2">{{ $todayOrders }}</p>
    </div>

    <div class="p-5 rounded-xl bg-white/10 border border-white/20">
        <p class="text-sm opacity-70">Meja Tersedia</p>
        <p class="text-3xl font-bold mt-2">{{ $availableTables }}</p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">

    {{-- STATUS ORDER --}}
    <div class="p-6 rounded-xl bg-white/10 border border-white/20">
        <h2 class="text-lg font-semibold mb-4">Status Order</h2>

        @if ($orderStats->count())
            <div class="relative h-64">
                <canvas id="orderChart"></canvas>
            </div>
        @else
            <p class="opacity-70 text-sm">Belum ada data order</p>
        @endif
    </div>

    {{-- ORDER 7 HARI --}}
    <div class="p-6 rounded-xl bg-white/10 border border-white/20">
        <h2 class="text-lg font-semibold mb-4">Order 7 Hari Terakhir</h2>

        @if (count($dailyLabels))
            <div class="relative h-64">
                <canvas id="dailyChart"></canvas>
            </div>
        @else
            <p class="opacity-70 text-sm">Belum ada data</p>
        @endif
    </div>

</div>

<div class="p-6 rounded-xl bg-white/10 border border-white/20 mb-10">

    <h2 class="text-xl font-semibold mb-4">Order Terakhir</h2>

    <table class="w-full text-sm">
        <thead class="opacity-70">
            <tr>
                <th class="p-2 text-left">ID</th>
                <th class="p-2 text-left">Meja</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $order)
            <tr class="border-t border-white/10">
                <td class="p-2">#{{ $order->id }}</td>
                <td class="p-2">{{ $order->table?->number ?? '-' }}</td>
                <td class="p-2 capitalize">{{ $order->status }}</td>
                <td class="p-2 text-xs opacity-70">
                    {{ $order->created_at->format('d M Y H:i') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 opacity-70 text-center">
                    Belum ada order
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@if ($problemOrders->count())
<div class="p-6 rounded-xl bg-red-500/10 border border-red-400 mb-10">
    <h2 class="text-lg font-semibold mb-4 text-red-400">
        ⚠️ Order Pending Terlalu Lama
    </h2>

    <table class="w-full text-sm">
        <thead class="opacity-80">
            <tr>
                <th class="p-2 text-left">Order</th>
                <th class="p-2 text-left">Meja</th>
                <th class="p-2 text-left">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($problemOrders as $order)
            <tr class="border-t border-red-400/20">
                <td class="p-2 font-semibold">#{{ $order->id }}</td>
                <td class="p-2">{{ $order->table?->number ?? '-' }}</td>
                <td class="p-2 text-sm text-red-300">
                    {{ $order->created_at->diffForHumans() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<script>
@if ($orderStats->count())
new Chart(document.getElementById('orderChart'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($orderStats->keys()) !!},
        datasets: [{
            data: {!! json_encode($orderStats->values()) !!},
            backgroundColor: ['#3b82f6','#facc15','#22c55e','#ef4444'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: 'white',
                    boxWidth: 12
                }
            }
        }
    }
});
@endif

@if (count($dailyLabels))
new Chart(document.getElementById('dailyChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($dailyLabels) !!},
        datasets: [{
            label: 'Jumlah Order',
            data: {!! json_encode($dailyTotals) !!},
            borderColor: '#22c55e',
            backgroundColor: 'rgba(34,197,94,0.15)',
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { labels: { color: 'white' } }
        },
        scales: {
            x: { ticks: { color: 'white' } },
            y: { ticks: { color: 'white' } }
        }
    }
});
@endif
</script>

@endsection
