<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="relative">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-[900] tracking-tight text-slate-900 mb-2">Welcome Back</h2>
        <p class="text-sm text-slate-500 font-medium">Please enter your details to sign in.</p>
    </div>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="bg-white/70 backdrop-blur-xl border border-white p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/60 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-100/50 rounded-full blur-3xl"></div>

        <form wire:submit="login" class="relative z-10 space-y-6">
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email Address')" class="text-xs font-black uppercase tracking-widest text-slate-500 ms-1" />
                <div class="relative group">
                    <x-text-input 
                        wire:model="form.email" 
                        id="email" 
                        class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all group-hover:bg-white" 
                        type="email" 
                        name="email" 
                        required 
                        autofocus 
                        placeholder="name@company.com"
                    />
                </div>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-xs font-bold" />
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between ms-1">
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-black uppercase tracking-widest text-slate-500" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-bold text-blue-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot?') }}
                        </a>
                    @endif
                </div>
                <div class="relative group">
                    <x-text-input 
                        wire:model="form.password" 
                        id="password" 
                        class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all group-hover:bg-white"
                        type="password"
                        name="password"
                        required 
                        placeholder="••••••••"
                    />
                </div>
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-xs font-bold" />
            </div>

            <div class="flex items-center ps-1">
                <label for="remember" class="inline-flex items-center cursor-pointer group">
                    <div class="relative flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500/20 transition-all cursor-pointer group-hover:border-blue-400" name="remember">
                    </div>
                    <span class="ms-3 text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Keep me signed in') }}</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-600 text-white rounded-2xl py-4 text-sm font-black uppercase tracking-widest shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 active:scale-[0.98] transition-all">
                    {{ __('Sign In to Account') }}
                </button>
            </div>
        </form>
    </div>

<div class="mt-10 space-y-6 text-center">
        <p class="text-sm font-bold text-slate-400">
            New to the platform? 
            <a href="{{ route('register') }}" wire:navigate class="text-blue-600 hover:text-blue-700 transition-colors">
                Create an account
            </a>
        </p>

        <div class="flex items-center justify-center gap-4 max-w-[200px] mx-auto opacity-20">
            <div class="h-[1px] flex-1 bg-slate-400"></div>
            <div class="w-1 h-1 rounded-full bg-slate-400"></div>
            <div class="h-[1px] flex-1 bg-slate-400"></div>
        </div>

        <a href="/" wire:navigate 
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-slate-200 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 hover:bg-white hover:text-blue-600 hover:border-white hover:shadow-lg transition-all">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Home
        </a>
    </div>
</div>
</div>