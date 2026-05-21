<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-teal-100 rounded-lg">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Pengaturan Akun') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-teal-400 to-teal-600"></div>
                <div class="p-8 sm:p-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-400 to-orange-600"></div>
                <div class="p-8 sm:p-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>