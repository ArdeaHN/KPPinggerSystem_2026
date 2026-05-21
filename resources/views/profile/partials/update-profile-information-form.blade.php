<section>
    <header class="border-b border-slate-100 pb-6 mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                {{ __('Informasi Profil') }}
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                {{ __("Perbarui nama lengkap dan alamat email Anda di sini.") }}
            </p>
        </div>
        
        <div class="hidden md:flex h-16 w-16 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 text-white items-center justify-center font-bold text-2xl shadow-lg ring-4 ring-teal-50">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        @if (session('status') === 'profile-updated')
            <div class="flex items-start gap-3 p-4 mb-6 rounded-xl bg-teal-50 border border-teal-100">
                <svg class="w-5 h-5 text-teal-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-bold text-teal-800">Berhasil Disimpan</h3>
                    <p class="text-sm text-teal-700 mt-1">Informasi profil Anda telah berhasil diperbarui ke dalam sistem.</p>
                </div>
            </div>
        @endif

        @if ($errors->default->any())
            <div class="flex items-start gap-3 p-4 mb-6 rounded-xl bg-red-50 border border-red-100">
                <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Gagal Memperbarui Profil</h3>
                    <ul class="list-disc ml-5 mt-1 text-sm text-red-700">
                        @foreach ($errors->default->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Nama Lengkap') }}</label>
                <input id="name" name="name" type="text" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/20 transition-all" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Alamat Email') }}</label>
                <input id="email" name="email" type="email" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/20 transition-all" value="{{ old('email', $user->email) }}" required autocomplete="username" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-100">
                        <p class="text-xs text-amber-800 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Email belum diverifikasi.
                            <button form="send-verification" class="font-bold underline hover:text-amber-600 transition">Kirim ulang tautan</button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-end pt-6">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-teal-600 focus:ring-4 focus:ring-teal-500/30 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                {{ __('Simpan Profil') }}
            </button>
        </div>
    </form>
</section>