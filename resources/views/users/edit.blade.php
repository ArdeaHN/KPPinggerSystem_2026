<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-lg transition-colors text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Penyesuaian Akses Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-blue-600"></div>

                <div class="p-8 sm:p-10">
                    <header class="border-b border-slate-100 pb-6 mb-8 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Edit Akun: {{ $user->name }}</h3>
                            <p class="mt-1 text-sm text-slate-500">Ubah peran, wilayah, atau perbarui password akun ini.</p>
                        </div>
                        <div class="hidden sm:flex h-14 w-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white items-center justify-center font-bold text-xl shadow-lg ring-4 ring-blue-50">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </header>
                    
                    @if ($errors->any())
                        <div class="flex items-start gap-3 p-4 mb-8 rounded-xl bg-red-50 border border-red-100 shadow-sm">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Gagal Memperbarui Data</h3>
                                <ul class="list-disc ml-5 mt-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/20 transition-all" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Email / Username</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/20 transition-all" required>
                            </div>
                        </div>

                        <div class="p-5 bg-slate-50 border border-slate-100 rounded-xl mt-6">
                            <label class="block text-sm font-semibold text-slate-800 mb-1 flex items-center gap-2">
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Reset Password Sistem (Opsional)
                            </label>
                            <input type="password" name="password" class="w-full mt-2 rounded-xl border-slate-200 bg-white px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all" placeholder="Ketik password baru untuk me-reset sandi user">
                            <p class="text-xs text-slate-500 mt-2 font-medium">
                                *Kosongkan kolom ini jika tidak ingin mengubah password milik user.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-6 border-t border-slate-100">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Role Sistem / Jabatan</label>
                                <div class="relative">
                                    <select name="role" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/20 transition-all appearance-none" required>
                                        <option value="Viewer" {{ $user->role === 'Viewer' ? 'selected' : '' }}>Viewer (Hanya Melihat)</option>
                                        <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin (Pengelola Wilayah)</option>
                                        <option value="Super Admin" {{ $user->role === 'Super Admin' ? 'selected' : '' }}>Super Admin (Sistem Penuh)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Akses Wilayah (OPD)</label>
                                <div class="relative">
                                    <select name="region_access" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/20 transition-all appearance-none">
                                        <option value="">-- Semua Wilayah / Bebas Akses --</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->name }}" {{ old('region_access', $user->region_access) === $region->name ? 'selected' : '' }}>
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-8 mt-4">
                            <a href="{{ route('users.index') }}" class="px-5 py-2.5 text-slate-600 hover:text-slate-900 font-semibold text-sm transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-500/30 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>