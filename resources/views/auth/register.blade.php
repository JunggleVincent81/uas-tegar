@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-center mb-6">
    Register
</h1>

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <input
        type="text"
        name="name"
        placeholder="Nama Lengkap"
        required
        class="w-full px-4 py-3 rounded-xl
               bg-white/20 border border-white/30
               placeholder-white/70 focus:outline-none
               focus:ring-2 focus:ring-primary">

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

    <input
        type="password"
        name="password_confirmation"
        placeholder="Konfirmasi Password"
        required
        class="w-full px-4 py-3 rounded-xl
               bg-white/20 border border-white/30
               placeholder-white/70 focus:outline-none
               focus:ring-2 focus:ring-primary">

    <button
        type="submit"
        class="w-full py-3 rounded-xl font-semibold
               bg-primary hover:bg-blue-700 transition">
        Register
    </button>
</form>

<p class="text-center text-sm mt-6">
    Sudah punya akun?
    <a href="{{ route('login') }}"
       class="text-secondary font-semibold hover:underline">
        Login
    </a>
</p>
@endsection
