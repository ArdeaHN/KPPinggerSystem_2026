<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">Master OPD & Wilayah</h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div class="flex items-start gap-3 p-4 rounded-xl bg-teal-50 border border-teal-100 shadow-sm">
                    <svg class="w-5 h-5 text-teal-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div><h3 class="text-sm font-bold text-teal-800">Berhasil!</h3><p class="text-sm text-teal-700 mt-1">{{ session('success') }}</p></div>
                </div>
            @endif
            @if ($errors->any())
                <div class="flex items-start gap-3 p-4 rounded-xl bg-red-50 border border-red-100 shadow-sm">
                    <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div><h3 class="text-sm font-bold text-red-800">Gagal Memproses</h3>
                    <ul class="list-disc ml-5 mt-1 text-sm text-red-700">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
                </div>
            @endif

            <div x-data="{ showForm: {{ $errors->any() ? 'true' : 'false' }} }">
                <div class="flex justify-end mb-6">
                    <button @click="showForm = !showForm" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-purple-600 text-white font-semibold py-2.5 px-5 rounded-xl transition-all shadow-md">
                        <span x-text="showForm ? 'Tutup Form' : 'Tambah OPD Baru'"></span>
                    </button>
                </div>

                <div x-show="showForm" x-transition class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative mb-8" style="display: none;">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-purple-400 to-purple-600"></div>
                    <div class="p-8">
                        <header class="border-b border-slate-100 pb-4 mb-6">
                            <h3 class="text-xl font-extrabold text-slate-900">Pendaftaran Wilayah Baru</h3>
                        </header>
                        <form action="{{ route('regions.store') }}" method="POST">
                            @csrf
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Organisasi / Kapanewon</label>
                            <div class="flex gap-4">
                                <input type="text" name="name" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20" required placeholder="Contoh: Dinas Kominfo Kulon Progo">
                                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-md shrink-0">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-teal-400 to-teal-600"></div>
                <div class="p-6 sm:p-8 border-b border-slate-100"><h3 class="text-xl font-extrabold text-slate-900">Daftar Wilayah Operasional</h3></div>
                
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="bg-slate-50/80 text-slate-500 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama OPD / Wilayah</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($regions as $region)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-purple-500"></div>{{ $region->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('regions.edit', $region->id) }}" class="text-blue-500 hover:text-blue-700 hover:bg-blue-50 p-2 rounded-lg transition-all"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                                    <form action="{{ route('regions.destroy', $region->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg" onclick="return confirm('Hapus wilayah ini?')"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-10 text-center text-slate-400">Belum ada data wilayah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>