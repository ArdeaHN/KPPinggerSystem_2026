<section>
    <header class="border-b border-slate-100 pb-6 mb-6">
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            {{ __('Keamanan & Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Pastikan akun Anda menggunakan kombinasi password yang panjang dan unik agar sistem tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        @if (session('status') === 'password-updated')
            <div class="flex items-start gap-3 p-4 mb-6 rounded-xl bg-orange-50 border border-orange-100">
                <svg class="w-5 h-5 text-orange-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-bold text-orange-800">Keamanan Diperbarui</h3>
                    <p class="text-sm text-orange-700 mt-1">Password Anda telah sukses diganti dengan yang baru.</p>
                </div>
            </div>
        @endif

        @if ($errors->updatePassword->any())
            <div class="flex items-start gap-3 p-4 mb-6 rounded-xl bg-red-50 border border-red-100">
                <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Gagal Mengganti Password</h3>
                    <ul class="list-disc ml-5 mt-1 text-sm text-red-700">
                        @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="space-y-5">
            <div>
                <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Password Saat Ini') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" class="w-full md:w-2/3 rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/20 transition-all" autocomplete="current-password" />
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Password Baru') }}</label>
                <input id="update_password_password" name="password" type="password" class="w-full md:w-2/3 rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/20 transition-all" autocomplete="new-password" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Konfirmasi Password Baru') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full md:w-2/3 rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/20 transition-all" autocomplete="new-password" />
            </div>
        </div>

        <div class="flex items-center justify-end pt-6 mt-6 border-t border-slate-100">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-slate-900 text-white font-semibold rounded-xl hover:bg-orange-500 focus:ring-4 focus:ring-orange-500/30 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                {{ __('Ubah Password') }}
            </button>
        </div>
    </form>
</section>