<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HelpDesk') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-[#fafafa] text-slate-900 selection:bg-blue-500/10 selection:text-blue-600">

    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-blue-100/40 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[5%] w-[30%] h-[30%] rounded-full bg-indigo-100/40 blur-[120px]"></div>
    </div>

    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-200">
                    <x-application-logo class="h-6 w-6 text-white" />
                </div>
                <span class="text-xl font-[900] tracking-tight text-slate-800">{{ config('app.name') }}</span>
            </div>

            <div class="hidden md:flex items-center gap-8">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-bold uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 hover:-translate-y-0.5 transition-all shadow-xl shadow-slate-200 active:scale-95">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

<section class="relative pt-20 pb-32 overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="text-center lg:text-left">
                <h1 class="text-5xl md:text-7xl font-[900] tracking-tighter text-slate-900 leading-[1.1] mb-8">
                    <span class="block">Dedicated Support,</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500 italic">
                        Simpler Resolution.
                    </span>
                </h1>

                <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                    Experience a streamlined helpdesk system designed to handle your requests with surgical precision.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-xs shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all active:scale-95">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-xs shadow-2xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all active:scale-95">
                            Create Account
                        </a>
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto px-10 py-5 bg-white text-slate-900 border border-slate-200 rounded-[2rem] font-black uppercase tracking-widest text-xs hover:bg-slate-50 transition-all">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>

            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-tr from-blue-100 to-indigo-100 rounded-[3rem] blur-2xl opacity-50 group-hover:opacity-80 transition-opacity duration-500"></div>
                <div class="relative bg-white border border-white p-8 rounded-[3rem] shadow-2xl overflow-hidden">
                    <div class="aspect-square lg:aspect-video bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
                        <div class="relative w-2/3 h-2/3 transform group-hover:scale-105 transition-transform duration-500 ease-out">
                            <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-xl">
                                <path d="M50 80C50 68.9543 58.9543 60 70 60H246C257.046 60 266 68.9543 266 80V105C254.954 105 246 113.954 246 125C246 136.046 254.954 145 266 145V236C266 247.046 257.046 256 246 256H70C58.9543 256 50 247.046 50 236V145C61.0457 145 70 136.046 70 125C70 113.954 61.0457 105 50 105V80Z" fill="#3b82f6" />
                                <path d="M110 110H160C165.523 110 170 114.477 170 120V150C170 155.523 165.523 160 160 160H135L115 175V160H110C104.477 160 100 155.523 100 150V120C100 114.477 104.477 110 110 110Z" fill="white" fill-opacity="0.9" />
                                <path d="M185 170L200 185L230 155" stroke="white" stroke-width="12" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <line x1="90" y1="210" x2="226" y2="210" stroke="white" stroke-width="4" stroke-dasharray="8 8" stroke-opacity="0.5" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-blue-600 mb-4">Infrastructure</p>
                <h2 class="text-4xl font-[900] tracking-tight text-slate-900">Engineered for Reliability</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 hover:border-blue-200 transition-all hover:shadow-2xl hover:shadow-blue-100/50">
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black mb-3">Instant Alerts</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">No more waiting. Our system dispatches
                        notifications to agents the millisecond a ticket arrives.</p>
                </div>

                <div
                    class="group p-10 bg-slate-900 rounded-[2.5rem] text-white shadow-2xl shadow-slate-200 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-white/10 text-white rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black mb-3 text-white">Direct Messaging</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Real-time threading allows you to collaborate
                        directly on issues without refreshing the page.</p>
                </div>

                <div
                    class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 hover:border-blue-200 transition-all hover:shadow-2xl hover:shadow-blue-100/50">
                    <div
                        class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black mb-3">Enterprise Grade</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Encrypted at rest and in transit. Your
                        internal data security is our top priority.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-16 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div
                class="flex items-center justify-center gap-2 mb-8 opacity-50 grayscale hover:grayscale-0 transition-all">
                <x-application-logo class="h-5 w-auto" />
                <span class="text-sm font-black uppercase tracking-widest">{{ config('app.name') }}</span>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} Crafted for high-performance teams.
            </p>
        </div>
    </footer>
</body>

</html>