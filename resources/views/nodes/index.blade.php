<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-gradient-to-br from-teal-500 to-blue-600 rounded-xl shadow-lg shadow-teal-500/30 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-slate-900 leading-tight tracking-tight">
                        Manajemen Node & Topologi
                    </h2>
                    <p class="text-sm text-slate-500 font-medium mt-1">Kelola perangkat (node) dan konfigurasikan jalur koneksi jaringan Anda.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="flex items-center gap-3 p-4 bg-teal-50 border border-teal-100 rounded-2xl text-teal-800 shadow-sm animate-pulse-once">
                    <div class="p-1.5 bg-teal-100 rounded-full text-teal-600 shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error') || $errors->any())
                <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-800 shadow-sm">
                    <div class="p-1.5 bg-red-100 rounded-full text-red-600 shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Gagal memproses permintaan:</h3>
                        @if(session('error')) <p class="text-sm mt-1">{{ session('error') }}</p> @endif
                        @if($errors->any())
                            <ul class="list-disc ml-4 mt-1 text-sm">
                                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col overflow-hidden" 
                     x-data="{ showForm: {{ $errors->hasAny(['name', 'ip_address', 'latitude', 'longitude']) ? 'true' : 'false' }} }">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white z-10 relative">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 leading-none">Daftar Perangkat</h3>
                                <p class="text-xs text-slate-500 mt-1 font-medium">{{ Auth::user()->role !== 'Super Admin' ? 'Wilayah Anda' : 'Seluruh Wilayah' }}</p>
                            </div>
                        </div>
                        <button @click="showForm = !showForm" class="bg-slate-900 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-xl transition-all shadow-md shadow-slate-300 text-xs flex items-center gap-2">
                            <span x-text="showForm ? 'Tutup Form' : '+ Tambah Node'"></span>
                        </button>
                    </div>

                    <div x-show="showForm" x-transition class="bg-slate-50/80 border-b border-slate-100" style="display: none;">
                        <form action="{{ route('devices.store') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Perangkat</label>
                                    <input type="text" name="name" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all" required placeholder="Contoh: Router Wates">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">IP Address</label>
                                    <input type="text" name="ip_address" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all font-mono" required placeholder="192.168.1.1">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Latitude</label>
                                    <input type="text" name="latitude" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all" required placeholder="-7.8286">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Longitude</label>
                                    <input type="text" name="longitude" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all" required placeholder="110.1384">
                                </div>
                            </div>
                            <div class="pt-2">
                                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-2.5 rounded-xl transition shadow-lg shadow-teal-500/30">Simpan Perangkat</button>
                            </div>
                        </form>
                    </div>

                    <div class="flex-1 overflow-hidden flex flex-col bg-white">
                        <div class="overflow-y-auto max-h-[450px] custom-scrollbar p-1">
                            <table class="w-full text-left">
                                <thead class="bg-white sticky top-0 z-10 shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                                    <tr>
                                        <th class="py-3 px-6 text-xs font-extrabold text-slate-400 uppercase tracking-wider">Identitas Node</th>
                                        <th class="py-3 px-6 text-xs font-extrabold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($devices ?? [] as $device)
                                    <tr class="hover:bg-slate-50/60 transition-colors group">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-slate-900 text-sm mb-1.5">{{ $device->name }}</div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="inline-flex items-center font-mono text-[10px] text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100 font-bold">
                                                    {{ $device->ip_address }}
                                                </span>
                                                <span class="inline-flex items-center text-[10px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200 font-semibold truncate max-w-[120px]">
                                                    {{ $device->region ?? 'Pusat/Global' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('devices.edit', $device->id) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Perangkat">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Perangkat" onclick="return confirm('Apakah Anda yakin ingin menghapus perangkat ini?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="py-12 text-center">
                                            <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                                            <p class="text-sm font-medium text-slate-400">Belum ada data perangkat.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col overflow-hidden"
                     x-data="{ showForm: {{ $errors->hasAny(['source_device_id', 'target_device_id']) ? 'true' : 'false' }} }">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white z-10 relative">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 leading-none">Konfigurasi Link</h3>
                                <p class="text-xs text-slate-500 mt-1 font-medium">Jalur aktif: {{ count($links) }} link</p>
                            </div>
                        </div>
                        <button @click="showForm = !showForm" class="bg-slate-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl transition-all shadow-md shadow-slate-300 text-xs flex items-center gap-2">
                            <span x-text="showForm ? 'Tutup Form' : '+ Buat Koneksi'"></span>
                        </button>
                    </div>

                    <div x-show="showForm" x-transition class="bg-slate-50/80 border-b border-slate-100" style="display: none;">
                        <form action="{{ route('links.store') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">1. Sumber (Node Awal)</label>
                                    <select name="source_device_id" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all font-semibold text-slate-800" required>
                                        <option value="">-- Pilih Perangkat Anda --</option>
                                        @foreach($devices ?? [] as $device)
                                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-center -my-3 relative z-10">
                                    <div class="bg-blue-100 text-blue-600 p-1.5 rounded-full border-4 border-slate-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">2. Tujuan (Node Akhir)</label>
                                    <select name="target_device_id" class="w-full text-sm rounded-xl border-slate-200 bg-white px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all font-semibold text-slate-800" required>
                                        <option value="">-- Pilih Perangkat Tujuan --</option>
                                        @foreach($targetDevices ?? [] as $device)
                                            <option value="{{ $device->id }}">{{ $device->name }} ({{ $device->region ?? 'Pusat' }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 rounded-xl transition shadow-lg shadow-blue-500/30">Hubungkan Jalur</button>
                            </div>
                        </form>
                    </div>

                    <div class="flex-1 overflow-hidden flex flex-col bg-white">
                        <div class="overflow-y-auto max-h-[450px] custom-scrollbar p-1">
                            <table class="w-full text-left">
                                <thead class="bg-white sticky top-0 z-10 shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                                    <tr>
                                        <th class="py-3 px-6 text-xs font-extrabold text-slate-400 uppercase tracking-wider">Pemetaan Topologi</th>
                                        <th class="py-3 px-6 text-xs font-extrabold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($links ?? [] as $link)
                                    <tr class="hover:bg-slate-50/60 transition-colors group">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="flex flex-col max-w-[120px]">
                                                    <span class="px-2.5 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-800 font-bold text-xs truncate shadow-sm text-center" title="{{ $link->source->name ?? '?' }}">
                                                        {{ $link->source->name ?? '?' }}
                                                    </span>
                                                </div>
                                                <div class="text-blue-500 shrink-0">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                                </div>
                                                <div class="flex flex-col max-w-[120px]">
                                                    <span class="px-2.5 py-1.5 bg-blue-50 border border-blue-200 rounded-lg text-blue-800 font-bold text-xs truncate shadow-sm text-center" title="{{ $link->target->name ?? '?' }}">
                                                        {{ $link->target->name ?? '?' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('links.edit', $link->id) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Koneksi">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('links.destroy', $link->id) }}" method="POST" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Putus Koneksi" onclick="return confirm('Apakah Anda yakin ingin memutus koneksi ini?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.172 12l-2.828 2.828m0-5.656L13.172 12m-6.364 0a4 4 0 015.656-5.656l1.102 1.101m1.414 7.071a4 4 0 01-5.656 0l-1.102-1.101"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="py-12 text-center">
                                            <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            <p class="text-sm font-medium text-slate-400">Belum ada jalur koneksi yang dibuat.</p>
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
    </div>
</x-app-layout>