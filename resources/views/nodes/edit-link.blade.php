<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('nodes.index') }}" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-lg transition-colors text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Ubah Jalur Koneksi
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-blue-600"></div>
                <div class="p-8 sm:p-10">
                    
                    @if ($errors->any())
                        <div class="p-4 mb-6 rounded-xl bg-red-50 border border-red-100 text-red-700 text-sm">
                            <strong class="font-bold block mb-1">Gagal memperbarui data:</strong>
                            <ul class="list-disc ml-5">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('links.update', $link->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">1. Perangkat Sumber (Source)</label>
                                <select name="source_device_id" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20" required>
                                    @foreach($devices as $device)
                                        <option value="{{ $device->id }}" {{ $link->source_device_id == $device->id ? 'selected' : '' }}>{{ $device->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-center -my-2 relative z-10">
                                <div class="bg-blue-100 text-blue-600 p-1.5 rounded-full border-4 border-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">2. Perangkat Tujuan (Target)</label>
                                <select name="target_device_id" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20" required>
                                    @foreach($targetDevices as $device)
                                        <option value="{{ $device->id }}" {{ $link->target_device_id == $device->id ? 'selected' : '' }}>{{ $device->name }} ({{ $device->region ?? 'Pusat' }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100 mt-6">
                            <a href="{{ route('nodes.index') }}" class="text-slate-500 hover:text-slate-800 font-medium">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-blue-500/30">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>