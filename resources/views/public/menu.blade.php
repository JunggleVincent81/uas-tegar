<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Makanan</title>
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

        <div class="text-xl font-bold tracking-wide">
            🍽️ BlueBite Restaurant
        </div>

        <div class="flex items-center gap-4" x-data="{ open: false }">

            @auth
<button
    @click="open = !open"
    class="px-4 py-2 rounded-xl
           bg-white/20 border border-white/30
           hover:bg-white/30 transition">
    Halo, <b>{{ auth()->user()->name }}</b>
</button>
@else
<a href="{{ route('login') }}"
   class="px-4 py-2 rounded-xl
          bg-white/20 border border-white/30
          hover:bg-white/30 transition">
   Login
</a>
@endauth


            <div
                x-show="open"
                @click.outside="open = false"
                x-transition
                class="absolute right-28 top-20 w-56
                       bg-white/20 backdrop-blur-xl
                       border border-white/30 rounded-xl overflow-hidden">

                    <a href="{{ route('orders.history') }}"
                     class="block px-4 py-3 hover:bg-white/30 transition">
                         📜 Riwayat Pesanan
                    </a>

                    <a href="{{ route('order.status') }}"
                       class="block px-4 py-3 hover:bg-white/30 transition">
                        📦 Status Pesanan
                    </a>
                
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 transition">
                    Logout
                </button>
            </form>

        </div>
    </div>
</header>

<h1 class="text-3xl font-bold mb-10 text-center">
    Menu Makanan
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-6 pb-20">

    @php
        $menus = [
            ['name'=>'Nasi Goreng Spesial','desc'=>'Nasi goreng dengan telur dan ayam suwir.'],
            ['name'=>'Ayam Geprek Korek','desc'=>'Ayam crispy dengan sambal korek pedas.'],
            ['name'=>'Mie Goreng Jawa','desc'=>'Mie goreng manis gurih khas Jawa.'],
            ['name'=>'Chicken Katsu Rice','desc'=>'Ayam katsu crispy dengan saus.'],
            ['name'=>'Beef Teriyaki Bowl','desc'=>'Daging sapi saus teriyaki.'],
            ['name'=>'Spaghetti Bolognese','desc'=>'Pasta dengan saus daging tomat.'],
        ];
    @endphp

    @foreach ($menus as $menu)
    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20
                hover:scale-[1.02] transition">

        <div class="h-32 rounded-xl bg-white/20 mb-4"></div>

        <h2 class="font-semibold text-lg">{{ $menu['name'] }}</h2>
        <p class="text-sm opacity-80">{{ $menu['desc'] }}</p>

        <div class="flex justify-between items-center mt-4">
            <span class="font-bold">Rp 25.000</span>
            <a href="{{ route('checkout') }}"
               class="px-4 py-2 rounded-lg bg-primary hover:bg-blue-700 transition">
                Pesan
            </a>
        </div>
    </div>
    @endforeach

</div>

</body>
</html>
