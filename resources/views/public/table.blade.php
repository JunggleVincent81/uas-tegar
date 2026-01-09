<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Meja</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl p-6 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20">

    <h1 class="text-2xl font-bold mb-6 text-center">
        Pilih Meja
    </h1>

    <div class="grid grid-cols-4 gap-4">
        @for ($i = 1; $i <= 12; $i++)
            <div class="p-4 text-center rounded-xl bg-white/20 hover:bg-primary cursor-pointer">
                Meja {{ $i }}
            </div>
        @endfor
    </div>

</div>

</body>
</html>
