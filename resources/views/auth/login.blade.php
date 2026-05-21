<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kulon Progo Pinger System</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px);
            background-size: 42px 42px;
        }
    </style>
</head>

<body class="min-h-dvh bg-slate-950 text-slate-900 antialiased">

    <main class="relative min-h-dvh w-full overflow-y-auto grid-pattern">

        <!-- Background Glow -->
        <div class="pointer-events-none fixed -top-40 -left-40 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
        <div class="pointer-events-none fixed top-1/3 -right-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
        <div class="pointer-events-none fixed -bottom-40 left-1/3 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl"></div>

        <!-- Center Wrapper -->
        <div class="relative z-10 min-h-dvh flex items-center justify-center px-4 py-6 sm:px-6 sm:py-8">

            <!-- Main Card -->
            <div class="w-full max-w-md lg:max-w-5xl rounded-3xl bg-white/10 backdrop-blur-2xl border border-white/15 shadow-2xl overflow-hidden">

                <div class="grid grid-cols-1 lg:grid-cols-2">

                    <!-- Left Branding Section -->
                    <div class="relative hidden lg:flex flex-col justify-between p-10 bg-gradient-to-br from-slate-900 via-slate-900 to-cyan-950 text-white overflow-hidden">

                        <div class="absolute inset-0 opacity-30 grid-pattern"></div>
                        <div class="absolute -right-20 top-20 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>

                        <div class="relative z-10">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center shadow-lg mb-8">
                                <svg width="38" height="38" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="24" cy="24" r="18" stroke="#22d3ee" stroke-width="3" opacity="0.9"/>
                                    <path d="M14 30L22 22L30 28L36 18" stroke="#60a5fa" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="14" cy="30" r="3" fill="#38bdf8"/>
                                    <circle cx="22" cy="22" r="3" fill="#22d3ee"/>
                                    <circle cx="30" cy="28" r="3" fill="#38bdf8"/>
                                    <path d="M31 13C34 14 36 16 37 19" stroke="#5eead4" stroke-width="3" stroke-linecap="round"/>
                                    <path d="M28 8C34 9 39 14 40 20" stroke="#5eead4" stroke-width="3" stroke-linecap="round" opacity="0.7"/>
                                </svg>
                            </div>

                            <h1 class="text-4xl font-extrabold tracking-tight leading-tight">
                                Kulon Progo<br>
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-400">
                                    Pinger System
                                </span>
                            </h1>

                            <p class="mt-5 text-sm leading-7 text-slate-300 max-w-md">
                                Sistem monitoring untuk pengecekan status device, node, dan link jaringan
                                di lingkungan Pemerintah Kabupaten Kulon Progo.
                            </p>
                        </div>

                        <div class="relative z-10 grid grid-cols-3 gap-4 mt-10">
                            <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                                <p class="text-2xl font-bold text-cyan-300">24/7</p>
                                <p class="text-xs text-slate-300 mt-1">Monitoring</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                                <p class="text-2xl font-bold text-blue-300">Node</p>
                                <p class="text-xs text-slate-300 mt-1">Checking</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 border border-white/10 p-4">
                                <p class="text-2xl font-bold text-teal-300">Link</p>
                                <p class="text-xs text-slate-300 mt-1">Status</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Login Section -->
                    <div class="bg-white px-6 py-8 sm:px-8 sm:py-10 lg:p-12">

                        <!-- Mobile Logo -->
                        <div class="lg:hidden mb-7 text-center">
                            <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-900 flex items-center justify-center mb-4 shadow-lg">
                                <svg width="34" height="34" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="24" cy="24" r="18" stroke="#22d3ee" stroke-width="3"/>
                                    <path d="M14 30L22 22L30 28L36 18" stroke="#60a5fa" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="14" cy="30" r="3" fill="#38bdf8"/>
                                    <circle cx="22" cy="22" r="3" fill="#22d3ee"/>
                                    <circle cx="30" cy="28" r="3" fill="#38bdf8"/>
                                </svg>
                            </div>

                            <h1 class="text-2xl font-extrabold text-slate-900">
                                Kulon Progo
                            </h1>
                            <p class="text-sm font-semibold text-cyan-600 tracking-wide">
                                Pinger System
                            </p>
                        </div>

                        <div class="mb-7">
                            <p class="text-xs sm:text-sm font-semibold text-cyan-600 uppercase tracking-[0.2em]">
                                Secure Access
                            </p>
                            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                                Masuk ke Sistem
                            </h2>
                            <p class="mt-2 text-sm text-slate-500 leading-6">
                                Gunakan akun yang telah terdaftar untuk mengakses dashboard monitoring.
                            </p>
                        </div>

                        @if (session('status'))
                            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Username / Email
                                </label>

                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 10-8 0m8 0v1a2 2 0 104 0v-1a8 8 0 10-3.3 6.5"/>
                                        </svg>
                                    </div>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="admin@kulonprogo.go.id"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm text-slate-900 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10"
                                    />
                                </div>

                                @error('email')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Password
                                </label>

                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"/>
                                        </svg>
                                    </div>

                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-12 text-sm text-slate-900 shadow-sm outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10"
                                    />

                                    <button
                                        type="button"
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-cyan-600 transition"
                                        aria-label="Tampilkan password"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>

                                @error('password')
                                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        name="remember"
                                        class="h-4 w-4 rounded border-slate-300 text-cyan-600 shadow-sm focus:ring-cyan-500"
                                    >
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition">
                                        Ingat saya
                                    </span>
                                </label>
                            </div>

                            <!-- Submit -->
                            <button
                                type="submit"
                                class="group relative w-full overflow-hidden rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 px-4 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-cyan-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-cyan-600/30 focus:outline-none focus:ring-4 focus:ring-cyan-500/20"
                            >
                                <span class="relative z-10">Login</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-teal-500 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            </button>
                        </form>

                        <p class="mt-8 text-center text-xs text-slate-400">
                            © {{ date('Y') }} Kulon Progo Pinger System. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>