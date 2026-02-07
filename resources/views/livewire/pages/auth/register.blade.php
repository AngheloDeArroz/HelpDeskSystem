<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = 3; 

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="relative w-full max-w-md mx-auto">
    <div class="text-center mb-10">
        <h2 class="text-4xl font-[900] tracking-tight text-slate-900 mb-3">Join Us</h2>
        <p class="text-sm text-slate-500 font-medium leading-relaxed">Create your account now.</p>
    </div>

    <div class="bg-white/70 backdrop-blur-xl border border-white p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200/60 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-100/50 rounded-full blur-3xl"></div>

        <form wire:submit="register" class="relative z-10 space-y-5">
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Full Name')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ms-1" />
                <x-text-input wire:model="name" id="name" class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder:text-slate-300" type="text" name="name" required autofocus placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs font-bold text-red-500" />
            </div>

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email Address')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ms-1" />
                <x-text-input wire:model="email" id="email" class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder:text-slate-300" type="email" name="email" required placeholder="name@company.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs font-bold text-red-500" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ms-1" />
                <x-text-input wire:model="password" id="password" class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder:text-slate-300" type="password" name="password" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs font-bold text-red-500" />
            </div>

            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ms-1" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full bg-slate-50/50 border-slate-200 rounded-2xl px-5 py-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder:text-slate-300" type="password" name="password_confirmation" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs font-bold text-red-500" />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-slate-900 text-white rounded-2xl py-4 text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-slate-200 hover:bg-blue-600 hover:-translate-y-0.5 active:scale-[0.98] transition-all">
                    {{ __('Create Account') }}
                </button>
            </div>
        </form>
    </div>

    <div class="mt-10 space-y-6 text-center">
        <p class="text-sm font-bold text-slate-400">
            {{ __('Already registered?') }}
            <a href="{{ route('login') }}" wire:navigate class="text-blue-600 hover:text-blue-700 transition-colors">
                Sign in instead
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