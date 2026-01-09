<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-yellow-400">

    <!-- PAGE CONTENT -->
    <main class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md p-8 rounded-2xl
            bg-white/10 backdrop-blur-xl
            border border-white/20 shadow-2xl">
            @yield('content')
        </div>
    </main>

</body>
</html>
