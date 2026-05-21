<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('nodes.index') }}" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-lg transition-colors text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                Edit Perangkat: {{ $device->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-teal-400 to-teal-600"></div>
                <div class="p-8 sm:p-10">
                    
                    @if ($errors->any())
                        <div class="p-4 mb-6 rounded-xl bg-red-50 border border-red-100 text-red-700 text-sm">
                            <strong class="font-bold block mb-1">Gagal memperbarui data:</strong>
                            <ul class="list-disc ml-5">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('devices.update', $device->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Perangkat</label>
                                <input type="text" name="name" value="{{ old('name', $device->name) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">IP Address</label>
                                <input type="text" name="ip_address" value="{{ old('ip_address', $device->ip_address) }}" class="w-full font-mono rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Latitude</label>
                                <input type="text" name="latitude" value="{{ old('latitude', $device->latitude) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Longitude</label>
                                <input type="text" name="longitude" value="{{ old('longitude', $device->longitude) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">
                            <a href="{{ route('nodes.index') }}" class="text-slate-500 hover:text-slate-800 font-medium">Batal</a>
                            <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-teal-500/30">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>