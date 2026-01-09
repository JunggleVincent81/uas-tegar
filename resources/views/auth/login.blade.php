@extends('layouts.app')

@section('content')

<div
    x-data="{ open: true }"
    x-cloak
    x-show="open"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

    <div
        class="w-full max-w-lg p-6 rounded-2xl
               bg-blue-600
               border border-white/20 text-white shadow-2xl">

        <h2 class="text-xl font-bold mb-2 text-center">
            🔐 Informasi Akun Demo
        </h2>

        <p class="text-sm opacity-90 mb-5 text-center">
            Gunakan akun berikut untuk mengakses seluruh fitur sistem
        </p>

        <div class="space-y-3 text-sm">

            <div class="p-3 rounded-xl bg-blue-700/60 border border-white/20">
                <b>Admin</b><br>
                Email: <span class="font-mono">admin@admin.com</span><br>
                Password: <span class="font-mono">admin123</span>
            </div>

            <div class="p-3 rounded-xl bg-blue-700/60 border border-white/20">
                <b>Kasir</b><br>
                Email: <span class="font-mono">kasir@kasir.com</span><br>
                Password: <span class="font-mono">kasir123</span>
            </div>

            <div class="p-3 rounded-xl bg-blue-700/60 border border-white/20">
                <b>Chef</b><br>
                Email: <span class="font-mono">chef@chef.com</span><br>
                Password: <span class="font-mono">chef123</span>
            </div>

            <div class="p-3 rounded-xl bg-blue-700/60 border border-white/20">
                <b>Customer</b><br>
                Email: <span class="font-mono">customer@user.com</span><br>
                Password: <span class="font-mono">user123</span>
            </div>

        </div>

        <button
            @click="open = false"
            class="mt-6 w-full py-2 rounded-xl
                   bg-white/20 hover:bg-white/30 transition font-semibold">
            Tutup & Lanjut Login
        </button>

    </div>
</div>

<h1 class="text-2xl font-bold text-center mb-6">
    Login
</h1>

<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
        class="w-full px-4 py-3 rounded-xl
               bg-white/20 border border-white/30
               placeholder-white/70 focus:outline-none
               focus:ring-2 focus:ring-primary">

    <input
        type="password"
        name="password"
        placeholder="Password"
        required
        class="w-full px-4 py-3 rounded-xl
               bg-white/20 border border-white/30
               placeholder-white/70 focus:outline-none
               focus:ring-2 focus:ring-primary">

    <button
        type="submit"
        class="w-full py-3 rounded-xl font-semibold
               bg-primary hover:bg-blue-700 transition">
        Login
    </button>
</form>

<p class="text-center text-sm mt-6">
    Belum punya akun?
    <a href="{{ route('register') }}"
       class="text-secondary font-semibold hover:underline">
        Register
    </a>
</p>

@endsection
