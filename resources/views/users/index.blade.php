<x-app-layout>
    <x-slot name="header">
        <div class="flex min-w-0 items-center gap-3 overflow-hidden">
            <div class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-400 via-amber-500 to-orange-600 text-white shadow-lg shadow-orange-500/25 ring-1 ring-white/20 sm:flex">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                    />
                </svg>
            </div>

            <div class="min-w-0 flex-1 overflow-hidden">
                <h2 class="truncate text-sm font-black tracking-tight text-slate-900 sm:text-xl lg:text-2xl">
                    {{ __('Manajemen Pengguna') }}
                </h2>
                <p class="hidden truncate text-xs font-medium text-slate-500 md:block">
                    Kelola akun, role, dan akses wilayah pengguna sistem.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-dvh bg-slate-50">
        <div class="relative overflow-hidden">

            <!-- Background Accent -->
            <div class="pointer-events-none absolute -right-32 -top-40 h-80 w-80 rounded-full bg-orange-300/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-32 top-60 h-80 w-80 rounded-full bg-cyan-300/10 blur-3xl"></div>

            <div class="relative mx-auto w-full max-w-7xl px-4 py-5 sm:px-6 sm:py-7 lg:px-8 lg:py-8">

                @php
                    $userCollection = collect($users ?? []);
                    $totalUsers = $userCollection->count();
                    $superAdminCount = $userCollection->where('role', 'Super Admin')->count();
                    $adminCount = $userCollection->where('role', 'Admin')->count();
                    $viewerCount = $userCollection->where('role', 'Viewer')->count();
                @endphp

                <!-- Alert Section -->
                <div class="space-y-4">
                    @if (session('success'))
                        <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-black text-emerald-800">Berhasil</h3>
                                <p class="mt-1 text-sm font-medium leading-6 text-emerald-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-black text-red-800">Akses Ditolak</h3>
                                <p class="mt-1 text-sm font-medium leading-6 text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-black text-red-800">Gagal Memproses Data</h3>
                                <ul class="mt-1 list-disc space-y-1 pl-5 text-sm font-medium leading-6 text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Summary Cards -->
                <div class="mt-5 grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-5">
                    <div class="rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 ring-1 ring-slate-200">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m8-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-[10px] font-black uppercase tracking-[0.16em] text-slate-400 sm:text-xs">
                                    Total User
                                </p>
                                <p class="mt-1 text-2xl font-black leading-none text-slate-900">
                                    {{ $totalUsers }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-orange-50 text-orange-600 ring-1 ring-orange-100">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zm0 2c-3.314 0-6 1.79-6 4v1h12v-1c0-2.21-2.686-4-6-4z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-[10px] font-black uppercase tracking-[0.16em] text-slate-400 sm:text-xs">
                                    Super Admin
                                </p>
                                <p class="mt-1 text-2xl font-black leading-none text-orange-600">
                                    {{ $superAdminCount }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-[10px] font-black uppercase tracking-[0.16em] text-slate-400 sm:text-xs">
                                    Admin
                                </p>
                                <p class="mt-1 text-2xl font-black leading-none text-blue-600">
                                    {{ $adminCount }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-[10px] font-black uppercase tracking-[0.16em] text-slate-400 sm:text-xs">
                                    Viewer
                                </p>
                                <p class="mt-1 text-2xl font-black leading-none text-emerald-600">
                                    {{ $viewerCount }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role === 'Super Admin')
                    <div x-data="{ showForm: {{ $errors->any() ? 'true' : 'false' }} }" class="mt-5">

                        <!-- Action Bar -->
                        <div class="mb-5 rounded-3xl border border-white bg-white/85 p-4 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <h3 class="text-base font-black tracking-tight text-slate-900 sm:text-lg">
                                        Aksi Administrator
                                    </h3>
                                    <p class="mt-1 text-sm font-medium leading-6 text-slate-500">
                                        Tambahkan pengguna baru dan atur hak akses wilayah sesuai kebutuhan.
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    @click="showForm = !showForm"
                                    class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3 text-sm font-black text-white shadow-lg shadow-slate-900/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-orange-500 hover:shadow-orange-500/25 focus:outline-none focus:ring-4 focus:ring-orange-500/20 sm:w-auto"
                                >
                                    <svg x-show="!showForm" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4v16m8-8H4"/>
                                    </svg>

                                    <svg x-show="showForm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 12H4"/>
                                    </svg>

                                    <span x-text="showForm ? 'Tutup Form' : 'Tambah Pengguna Baru'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Create User Form -->
                        <div
                            x-show="showForm"
                            x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-3"
                            class="mb-5 overflow-hidden rounded-[1.75rem] border border-white bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-900/5"
                        >
                            <div class="h-1.5 bg-gradient-to-r from-orange-400 via-amber-500 to-orange-600"></div>

                            <div class="p-5 sm:p-7 lg:p-8">
                                <div class="mb-6 border-b border-slate-100 pb-5">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-orange-50 text-orange-600 ring-1 ring-orange-100">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-6 5a4 4 0 100-8 4 4 0 000 8zm0 2c-3.314 0-6 1.79-6 4v1h12v-1c0-2.21-2.686-4-6-4z"/>
                                            </svg>
                                        </div>

                                        <div class="min-w-0">
                                            <h3 class="text-lg font-black tracking-tight text-slate-900 sm:text-xl">
                                                Formulir Pendaftaran Pengguna
                                            </h3>
                                            <p class="mt-1 text-sm font-medium leading-6 text-slate-500">
                                                Buat akun akses baru untuk anggota tim atau administrator wilayah.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                                    @csrf

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        <!-- Name -->
                                        <div>
                                            <label for="name" class="mb-2 block text-sm font-bold text-slate-700">
                                                Nama Lengkap
                                            </label>
                                            <input
                                                id="name"
                                                type="text"
                                                name="name"
                                                value="{{ old('name') }}"
                                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10"
                                                required
                                                placeholder="Contoh: Admin Diskominfo"
                                            >
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                                                Email / Username
                                            </label>
                                            <input
                                                id="email"
                                                type="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10"
                                                required
                                                placeholder="Contoh: admin@kulonprogo.go.id"
                                            >
                                        </div>

                                        <!-- Password -->
                                        <div>
                                            <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
                                                Password Sistem
                                            </label>
                                            <input
                                                id="password"
                                                type="password"
                                                name="password"
                                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10"
                                                required
                                                placeholder="Minimal 8 karakter"
                                            >
                                        </div>

                                        <!-- Role -->
                                        <div>
                                            <label for="role" class="mb-2 block text-sm font-bold text-slate-700">
                                                Role Sistem
                                            </label>
                                            <select
                                                id="role"
                                                name="role"
                                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition-all focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10"
                                                required
                                            >
                                                <option value="Viewer" {{ old('role') === 'Viewer' ? 'selected' : '' }}>Viewer</option>
                                                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Super Admin" {{ old('role') === 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                            </select>
                                        </div>

                                        <!-- Region -->
                                        <div class="md:col-span-2">
                                            <label for="region_access" class="mb-2 block text-sm font-bold text-slate-700">
                                                Akses Wilayah / OPD
                                            </label>
                                            <select
                                                id="region_access"
                                                name="region_access"
                                                class="block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition-all focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10"
                                            >
                                                <option value="">Semua Wilayah / Bebas Akses</option>
                                                @foreach($regions as $region)
                                                    <option value="{{ $region->name }}" {{ old('region_access') === $region->name ? 'selected' : '' }}>
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-end">
                                        <button
                                            type="button"
                                            @click="showForm = false"
                                            class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-600 transition hover:bg-slate-50 hover:text-slate-900 sm:w-auto"
                                        >
                                            Batal
                                        </button>

                                        <button
                                            type="submit"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-3 text-sm font-black text-white shadow-lg shadow-orange-500/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-orange-500/35 focus:outline-none focus:ring-4 focus:ring-orange-500/20 sm:w-auto"
                                        >
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Daftarkan Akun
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- User List Card -->
                <div class="mt-5 overflow-hidden rounded-[1.75rem] border border-white bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-900/5">
                    <div class="h-1.5 bg-gradient-to-r from-cyan-400 via-teal-500 to-emerald-500"></div>

                    <!-- Card Header -->
                    <div class="border-b border-slate-100 bg-white px-5 py-5 sm:px-7">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <h3 class="text-lg font-black tracking-tight text-slate-900 sm:text-xl">
                                    Daftar Pengguna Aktif
                                </h3>
                                <p class="mt-1 text-sm font-medium leading-6 text-slate-500">
                                    Kelola seluruh akses pengguna ke dalam sistem.
                                </p>
                            </div>

                            <div class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                {{ $totalUsers }} Pengguna
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Card List -->
                    <div class="block space-y-4 p-4 md:hidden">
                        @forelse($users ?? [] as $user)
                            <div class="rounded-3xl border border-slate-100 bg-slate-50/70 p-4 shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-200 to-slate-300 text-sm font-black uppercase text-slate-700 shadow-inner">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-black text-slate-900">
                                            {{ $user->name }}
                                        </p>
                                        <p class="mt-0.5 truncate text-xs font-medium text-slate-500">
                                            {{ $user->email }}
                                        </p>

                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @if($user->role === 'Super Admin')
                                                <span class="inline-flex items-center rounded-full border border-orange-200 bg-orange-50 px-3 py-1 text-xs font-black text-orange-700">
                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                                    {{ $user->role }}
                                                </span>
                                            @elseif($user->role === 'Admin')
                                                <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-black text-blue-700">
                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    {{ $user->role }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">
                                                    {{ $user->role ?? 'Viewer' }}
                                                </span>
                                            @endif

                                            <span class="inline-flex max-w-full items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">
                                                <span class="truncate">
                                                    {{ $user->region_access ?? 'Semua Wilayah' }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 border-t border-slate-200/70 pt-4">
                                    @if(Auth::user()->role === 'Super Admin')
                                        <div class="grid grid-cols-2 gap-2">
                                            <a
                                                href="{{ route('users.edit', $user->id) }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-blue-200 bg-blue-50 px-4 py-2.5 text-xs font-black text-blue-700 transition hover:bg-blue-100"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-red-200 bg-red-50 px-4 py-2.5 text-xs font-black text-red-700 transition hover:bg-red-100"
                                                    onclick="return confirm('Peringatan: Yakin ingin menghapus akun {{ $user->name }} secara permanen?')"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold italic text-slate-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Restricted
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
                                <svg class="mx-auto mb-3 h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="text-sm font-bold text-slate-500">
                                    Belum ada data pengguna di dalam sistem.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop Table -->
                    <div class="hidden overflow-x-auto md:block">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="border-b border-slate-100 bg-slate-50/80 text-xs font-black uppercase tracking-[0.14em] text-slate-400">
                                <tr>
                                    <th class="px-6 py-4">Pengguna</th>
                                    <th class="px-6 py-4">Role / Jabatan</th>
                                    <th class="px-6 py-4">Akses Wilayah / OPD</th>
                                    <th class="px-6 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse($users ?? [] as $user)
                                    <tr class="transition-colors duration-150 hover:bg-slate-50/80">
                                        <td class="px-6 py-5">
                                            <div class="flex min-w-0 items-center">
                                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-200 to-slate-300 text-sm font-black uppercase text-slate-700 shadow-inner">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>

                                                <div class="ml-4 min-w-0">
                                                    <div class="truncate font-black text-slate-900">
                                                        {{ $user->name }}
                                                    </div>
                                                    <div class="mt-0.5 truncate text-xs font-medium text-slate-500">
                                                        {{ $user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-5">
                                            @if($user->role === 'Super Admin')
                                                <span class="inline-flex items-center rounded-full border border-orange-200 bg-orange-50 px-3 py-1 text-xs font-black text-orange-700">
                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                                    {{ $user->role }}
                                                </span>
                                            @elseif($user->role === 'Admin')
                                                <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-black text-blue-700">
                                                    <span class="mr-2 h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    {{ $user->role }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                                    {{ $user->role ?? 'Viewer' }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5 font-semibold text-slate-600">
                                            {{ $user->region_access ?? 'Semua Wilayah' }}
                                        </td>

                                        <td class="px-6 py-5 text-center">
                                            @if(Auth::user()->role === 'Super Admin')
                                                <div class="flex items-center justify-center gap-2">
                                                    <a
                                                        href="{{ route('users.edit', $user->id) }}"
                                                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700"
                                                        title="Edit Pengguna"
                                                    >
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-red-100 bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700"
                                                            title="Hapus Pengguna"
                                                            onclick="return confirm('Peringatan: Yakin ingin menghapus akun {{ $user->name }} secara permanen?')"
                                                        >
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="inline-flex items-center rounded-xl border border-slate-200 bg-slate-100 px-3 py-1.5 text-xs font-bold italic text-slate-400">
                                                    <svg class="mr-1.5 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                    </svg>
                                                    Restricted
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-16 text-center">
                                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-3xl bg-slate-100 text-slate-300">
                                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-bold text-slate-500">
                                                    Belum ada data pengguna di dalam sistem.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>