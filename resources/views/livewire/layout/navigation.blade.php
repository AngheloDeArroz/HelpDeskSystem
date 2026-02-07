<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; 
?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100/80 sticky top-0 z-50 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate class="transition-transform hover:scale-105 active:scale-95">
                        <x-application-logo class="block h-8 w-auto fill-current text-blue-600" />
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate 
                        class="text-[11px] font-black uppercase tracking-[0.2em] px-4">
                        {{ __('Overview') }}
                    </x-nav-link>

                    @can('admin')
                        <x-nav-link :href="route('admin.summary')" :active="request()->routeIs('admin.summary')" wire:navigate
                            class="text-[11px] font-black uppercase tracking-[0.2em] px-4">
                            {{ __('Analytics') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.archive')" :active="request()->routeIs('admin.archive')" wire:navigate
                            class="text-[11px] font-black uppercase tracking-[0.2em] px-4">
                            {{ __('Archive') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-100 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-500 bg-gray-50 hover:bg-white hover:border-blue-500/20 hover:text-gray-900 transition-all focus:outline-none">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center text-[10px] text-white">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-50">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Signed in as</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile')" wire:navigate class="text-xs font-bold py-3 hover:bg-gray-50">
                            {{ __('Account Settings') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-50"></div>

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="text-xs font-bold text-red-600 py-3 hover:bg-red-50">
                                {{ __('Sign Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-xl text-gray-400 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-50 px-4 py-6 space-y-4">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                class="rounded-xl font-black uppercase tracking-widest text-[10px]">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('admin')
                <x-responsive-nav-link :href="route('admin.summary')" :active="request()->routeIs('admin.summary')" wire:navigate
                    class="rounded-xl font-black uppercase tracking-widest text-[10px]">
                    {{ __('Analytics') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.archive')" :active="request()->routeIs('admin.archive')" wire:navigate
                    class="rounded-xl font-black uppercase tracking-widest text-[10px]">
                    {{ __('Archive') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <div class="pt-6 border-t border-gray-100">
            <div class="flex items-center px-4 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black shadow-lg shadow-blue-100">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="ms-3">
                    <div class="font-black text-sm text-gray-900 leading-tight">{{ auth()->user()->name }}</div>
                    <div class="font-bold text-[10px] text-gray-400 uppercase tracking-widest">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="rounded-xl font-bold">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="rounded-xl font-bold text-red-600">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>