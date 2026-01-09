<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>[x-cloak]{display:none!important}</style>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex bg-gray-900 text-white">

    <aside class="w-64 bg-black/40 p-6">
        <h2 class="text-xl font-bold mb-6">ADMIN</h2>

        <nav class="space-y-3">
            <a href="/admin" class="block hover:underline">Dashboard</a>
            <a href="/admin/users" class="block hover:underline">Users</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-6 text-red-400 hover:underline">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>
