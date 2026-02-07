@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Account Settings</h1>
                <p class="mt-2 text-sm text-gray-500 font-medium uppercase tracking-widest">Manage your personal information
                    and security</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <div class="relative">
                            <div
                                class="h-32 w-32 rounded-[2rem] bg-blue-600 flex items-center justify-center text-white text-4xl font-black shadow-2xl shadow-blue-200">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-emerald-500 border-4 border-white w-8 h-8 rounded-full shadow-sm"
                                title="Account Active"></div>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-xl font-black text-gray-900 leading-tight">{{ auth()->user()->name }}</h2>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <div class="mt-8 w-full pt-6 border-t border-gray-50">
                            <div class="flex items-center justify-between text-left">
                                <div>
                                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Member Since
                                    </p>
                                    <p class="text-sm font-bold text-gray-700">
                                        {{ auth()->user()->created_at?->format('M Y') ?? 'N/A' }}
                                    </p>
                                </div>
                                <span
                                    class="px-3 py-1 bg-gray-50 text-gray-400 text-[9px] font-black uppercase rounded-lg border border-gray-100">Verified</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900 rounded-[2rem] p-6 text-white overflow-hidden relative group cursor-pointer">
                        <div class="relative z-10">
                            <p class="text-xs font-black uppercase tracking-[0.2em] opacity-60">Need help?</p>
                            <p class="text-sm font-bold mt-1">Visit our support center for guide & tutorials.</p>
                        </div>
                        <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white/5 transform group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM5.884 6.68a1 1 0 10-1.404-1.427l-.707.69a1 1 0 101.404 1.428l.707-.691zM10 8a2 2 0 100 4 2 2 0 000-4zM3 10a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1zM17 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM14.116 13.32a1 1 0 101.404 1.427l.707-.69a1 1 0 10-1.404-1.428l-.707.691zM10 15a1 1 0 100 2v-1a1 1 0 100-1zM5.884 13.32a1 1 0 111.404 1.427l-.707.69a1 1 0 11-1.404-1.428l.707-.691z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-red-50 p-8 lg:p-10">
                        <div class="mb-10">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.2em] text-red-600 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Danger Zone
                            </h3>
                            <p class="text-sm text-gray-900 font-black tracking-tight">Delete Account</p>
                        </div>

                        {{-- Call the Delete Volt component --}}
                        <livewire:profile.delete-user-form />
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 lg:p-10">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.2em] text-blue-600 mb-8 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Full
                                        Name</label>
                                    <div
                                        class="px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100 text-gray-900 font-bold">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Email
                                        Address</label>
                                    <div
                                        class="px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100 text-gray-900 font-bold">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Account
                                        Role</label>
                                    <div class="px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                                        <span
                                            class="inline-flex items-center gap-2 text-sm font-black text-gray-900 uppercase italic">
                                            @can('admin') Admin Level @else Standard User @endcan
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Timezone</label>
                                    <div
                                        class="px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100 text-gray-400 font-bold italic">
                                        UTC (Default)
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-10">
                        <div class="mb-10">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.2em] text-red-600 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Security & Privacy
                            </h3>
                            <p class="text-sm text-gray-500 font-medium tracking-tight">Manage your password and
                                authentication methods.</p>
                        </div>
                        <livewire:profile.update-password-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection