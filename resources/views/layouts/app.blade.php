<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'KulonProgo Pinger System') }}</title>

        <link class="favicon" rel="icon" href="{{ asset('favicon.ico') }}?v=1" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <body class="font-sans antialiased bg-slate-50 text-slate-900">

        <div class="flex h-dvh overflow-hidden bg-slate-50" x-data="{ sidebarOpen: false }">

            @include('layouts.navigation')

            <div class="relative flex min-w-0 flex-1 flex-col overflow-y-auto overflow-x-hidden">

                <!-- Top Navbar -->
                <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/90 shadow-sm backdrop-blur-xl">
                    <div class="flex min-h-16 items-center gap-3 px-3 py-2 sm:px-6 lg:px-8">

                        <!-- Mobile Sidebar Button -->
                        <button
                            type="button"
                            @click="sidebarOpen = true"
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 lg:hidden"
                            aria-label="Buka sidebar"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>

                        <!-- Header Slot Area -->
                        <div class="min-w-0 flex-1 overflow-hidden">
                            @isset($header)
                                <div class="min-w-0 max-w-full overflow-hidden">
                                    {{ $header }}
                                </div>
                            @else
                                <div class="min-w-0 overflow-hidden">
                                    <h1 class="truncate text-sm font-black tracking-tight text-slate-900 sm:text-xl">
                                        Dashboard
                                    </h1>
                                    <p class="hidden truncate text-xs font-medium text-slate-500 sm:block">
                                        Kulon Progo Pinger System
                                    </p>
                                </div>
                            @endisset
                        </div>

                        <!-- Right User Area -->
                        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
                            <div class="hidden min-w-0 sm:block">
                                <p class="max-w-[140px] truncate text-sm font-bold text-slate-700 lg:max-w-[180px]">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="hidden max-w-[180px] truncate text-xs font-medium text-slate-400 lg:block">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <a
                                href="{{ route('profile.edit') }}"
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-green-600 text-sm font-black uppercase text-white shadow-lg shadow-emerald-500/20 ring-2 ring-white transition hover:scale-105"
                                title="{{ Auth::user()->name }}"
                            >
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </a>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="w-full min-w-0 flex-1">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>