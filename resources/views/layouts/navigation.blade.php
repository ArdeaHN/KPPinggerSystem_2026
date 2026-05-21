<!-- Sidebar Overlay Mobile -->
<div
    x-show="sidebarOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-slate-950/70 backdrop-blur-md lg:hidden"
    @click="sidebarOpen = false"
></div>

<!-- Sidebar -->
<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex h-dvh w-[min(19rem,calc(100vw-1.5rem))] flex-col overflow-hidden border-r border-white/10 bg-slate-950/95 shadow-2xl shadow-slate-950/40 backdrop-blur-2xl transition-transform duration-300 ease-out lg:static lg:z-auto lg:h-dvh lg:w-72 lg:translate-x-0"
>

    <!-- Decorative Background -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-28 -left-20 h-56 w-56 rounded-full bg-cyan-500/10 blur-3xl"></div>
        <div class="absolute top-1/3 -right-28 h-56 w-56 rounded-full bg-blue-500/10 blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.035]"
             style="background-image: linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px); background-size: 32px 32px;">
        </div>
    </div>

    <!-- Header -->
    <div class="relative flex h-20 shrink-0 items-center justify-between border-b border-white/10 px-4">
        <a href="{{ route('dashboard') }}" class="group flex min-w-0 items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 via-teal-500 to-blue-600 shadow-lg shadow-cyan-500/20 ring-1 ring-white/20 transition duration-300 group-hover:scale-105">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                </svg>
            </div>

            <div class="min-w-0">
                <p class="truncate text-lg font-black tracking-tight text-white">
                    KP <span class="text-cyan-300">PINGER</span>
                </p>
                <p class="truncate text-[10px] font-bold uppercase tracking-[0.22em] text-slate-500">
                    Topology System
                </p>
            </div>
        </a>

        <!-- Close Button Mobile -->
        <button
            type="button"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden"
            @click="sidebarOpen = false"
            aria-label="Tutup sidebar"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="relative flex-1 space-y-1 overflow-y-auto px-3 py-5 custom-scrollbar sm:px-4">

        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.22em] text-slate-600">
            Main Menu
        </p>

        <!-- Dashboard -->
        <a
            href="{{ route('dashboard') }}"
            @click="sidebarOpen = false"
            class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-300
            {{ request()->routeIs('dashboard')
                ? 'bg-cyan-500/10 text-cyan-300 shadow-inner ring-1 ring-cyan-400/10'
                : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-100' }}"
        >
            @if(request()->routeIs('dashboard'))
                <span class="absolute left-0 top-1/2 h-8 w-1 -translate-y-1/2 rounded-r-full bg-cyan-400 shadow-[0_0_14px_rgba(34,211,238,.65)]"></span>
            @endif

            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-cyan-400/15 text-cyan-300'
                    : 'bg-white/[0.04] text-slate-500 group-hover:bg-cyan-400/10 group-hover:text-cyan-300' }}">
                <svg class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 20l-5.447-2.724A2 2 0 013 15.382V6.618a2 2 0 011.106-1.789L9 2m0 18l9.944-4.972A2 2 0 0020 13.236V4.464a2 2 0 00-1.106-1.789L9 2m0 18v-8m0-8v8m9-4H9"/>
                </svg>
            </span>

            <span class="min-w-0 flex-1 truncate transition-transform duration-300 group-hover:translate-x-0.5">
                Monitoring Peta
            </span>
        </a>

        <!-- Nodes -->
        <a
            href="{{ route('nodes.index') }}"
            @click="sidebarOpen = false"
            class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-300
            {{ request()->routeIs('nodes.*')
                ? 'bg-blue-500/10 text-blue-300 shadow-inner ring-1 ring-blue-400/10'
                : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-100' }}"
        >
            @if(request()->routeIs('nodes.*'))
                <span class="absolute left-0 top-1/2 h-8 w-1 -translate-y-1/2 rounded-r-full bg-blue-400 shadow-[0_0_14px_rgba(96,165,250,.65)]"></span>
            @endif

            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl transition
                {{ request()->routeIs('nodes.*')
                    ? 'bg-blue-400/15 text-blue-300'
                    : 'bg-white/[0.04] text-slate-500 group-hover:bg-blue-400/10 group-hover:text-blue-300' }}">
                <svg class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </span>

            <span class="min-w-0 flex-1 truncate transition-transform duration-300 group-hover:translate-x-0.5">
                Manajemen Node
            </span>
        </a>

        <!-- Users -->
        <a
            href="{{ route('users.index') }}"
            @click="sidebarOpen = false"
            class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-300
            {{ request()->routeIs('users.*')
                ? 'bg-amber-500/10 text-amber-300 shadow-inner ring-1 ring-amber-400/10'
                : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-100' }}"
        >
            @if(request()->routeIs('users.*'))
                <span class="absolute left-0 top-1/2 h-8 w-1 -translate-y-1/2 rounded-r-full bg-amber-400 shadow-[0_0_14px_rgba(251,191,36,.65)]"></span>
            @endif

            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl transition
                {{ request()->routeIs('users.*')
                    ? 'bg-amber-400/15 text-amber-300'
                    : 'bg-white/[0.04] text-slate-500 group-hover:bg-amber-400/10 group-hover:text-amber-300' }}">
                <svg class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </span>

            <span class="min-w-0 flex-1 truncate transition-transform duration-300 group-hover:translate-x-0.5">
                Manajemen Pengguna
            </span>
        </a>

        @if(Auth::user()->role === 'Super Admin')
            <div class="my-4 border-t border-white/10"></div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.22em] text-slate-600">
                Administration
            </p>

            <!-- Regions -->
            <a
                href="{{ route('regions.index') }}"
                @click="sidebarOpen = false"
                class="group relative flex items-center gap-3 rounded-2xl px-3.5 py-3 text-sm font-semibold transition-all duration-300
                {{ request()->routeIs('regions.*')
                    ? 'bg-violet-500/10 text-violet-300 shadow-inner ring-1 ring-violet-400/10'
                    : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-100' }}"
            >
                @if(request()->routeIs('regions.*'))
                    <span class="absolute left-0 top-1/2 h-8 w-1 -translate-y-1/2 rounded-r-full bg-violet-400 shadow-[0_0_14px_rgba(167,139,250,.65)]"></span>
                @endif

                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl transition
                    {{ request()->routeIs('regions.*')
                        ? 'bg-violet-400/15 text-violet-300'
                        : 'bg-white/[0.04] text-slate-500 group-hover:bg-violet-400/10 group-hover:text-violet-300' }}">
                    <svg class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>

                <span class="min-w-0 flex-1 truncate transition-transform duration-300 group-hover:translate-x-0.5">
                    Master OPD & Wilayah
                </span>
            </a>
        @endif
    </nav>

    <!-- User Footer -->
    <div class="relative shrink-0 border-t border-white/10 bg-slate-950/70 p-3 sm:p-4">

        <div class="mb-3 rounded-2xl border border-white/10 bg-white/[0.04] p-3">
            <div class="flex min-w-0 items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 text-sm font-black uppercase text-white shadow-lg shadow-cyan-500/20 ring-1 ring-white/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-slate-100">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="truncate text-xs text-slate-500">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <a
                href="{{ route('profile.edit') }}"
                @click="sidebarOpen = false"
                class="flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/[0.05] px-3 py-2.5 text-xs font-bold text-slate-300 transition hover:bg-white/[0.08] hover:text-white"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-400/20 bg-red-500/10 px-3 py-2.5 text-xs font-bold text-red-300 transition hover:bg-red-500/20 hover:text-red-200"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</aside>

<style>
    [x-cloak] {
        display: none !important;
    }

    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #334155 transparent;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 999px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>