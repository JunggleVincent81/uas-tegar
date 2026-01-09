@extends('admin.layout')

@section('content')

<div
    x-data="{
        open:false,
        form:null,
        roleText:''
    }"
>

<h1 class="text-2xl font-bold mb-6">Manajemen User</h1>
@if (session('success'))
<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition
    class="mb-6 p-4 rounded-xl
           bg-green-500/20 border border-green-400
           text-green-200 flex justify-between items-center">

    <span>{{ session('success') }}</span>

    <button
        @click="show = false"
        class="text-sm opacity-70 hover:opacity-100">
        ✕
    </button>
</div>
@endif

<table class="w-full border border-white/20">
    <thead class="bg-white/10">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3 text-left">Role</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
<tr
    x-data="{ highlight: {{ session('updated_user_id') === $user->id ? 'true' : 'false' }} }"
    x-init="if (highlight) setTimeout(() => highlight = false, 3000)"
    :class="highlight
        ? 'bg-blue-500/20 ring-2 ring-blue-400'
        : 'border-t border-white/10'"
    class="transition-all duration-500"
>


            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3">{{ $user->role?->name ?? '-' }}</td>

            <td class="p-3">
                <form
                    x-ref="form{{ $user->id }}"
                    method="POST"
                    action="/admin/users/{{ $user->id }}/role"
                    class="flex items-center gap-2">
                    @csrf

                    <select
                        name="role_id"
                        class="bg-black/40 border p-2 rounded">
                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->id }}"
                                @selected($user->role_id === $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>

                    <button
                        type="button"
                        @click="
                            open=true;
                            form=$refs.form{{ $user->id }};
                            roleText=form.role_id.options[form.role_id.selectedIndex].text;
                        "
                        class="px-3 py-1 bg-blue-600 rounded">
                        Update
                    </button>
                </form>
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
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

    <div
        class="w-full max-w-sm p-6 rounded-2xl
               bg-white/20 backdrop-blur-xl
               border border-white/30 text-white">

        <h2 class="text-xl font-bold mb-4 text-center">
            Konfirmasi Update Role
        </h2>

        <div class="text-sm space-y-2 mb-6">
            <p>Role baru: <b x-text="roleText"></b></p>
            <p class="opacity-80">Apakah Anda yakin ingin mengubah role user ini?</p>
        </div>

        <div class="flex gap-3">
            <button
                type="button"
                @click="form.submit()"
                class="flex-1 py-2 rounded bg-blue-600">
                Konfirmasi
            </button>

            <button
                type="button"
                @click="open=false"
                class="flex-1 py-2 rounded bg-white/20 hover:bg-white/30">
                Batal
            </button>
        </div>
    </div>
</div>


</div>
@endsection
