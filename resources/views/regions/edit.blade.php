<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('regions.index') }}" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-lg text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg></a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">Edit Wilayah</h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-blue-600"></div>
                <div class="p-8 sm:p-10">
                    <header class="border-b border-slate-100 pb-6 mb-8">
                        <h3 class="text-xl font-extrabold text-slate-900">Perbarui Nama OPD: {{ $region->name }}</h3>
                    </header>
                    
                    @if ($errors->any())
                        <div class="p-4 mb-6 rounded-xl bg-red-50 text-red-700 text-sm"><ul class="list-disc ml-5">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul></div>
                    @endif

                    <form action="{{ route('regions.update', $region->id) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Organisasi / Kapanewon</label>
                            <input type="text" name="name" value="{{ old('name', $region->name) }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20" required>
                        </div>
                        <div class="flex justify-end pt-4"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md">Simpan Perubahan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>