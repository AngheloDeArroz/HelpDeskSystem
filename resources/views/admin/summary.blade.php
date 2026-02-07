@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">User Engagement Summary</h1>
            <p class="mt-2 text-sm text-gray-500 font-medium uppercase tracking-widest">Who has submitted the most ticket?</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                            <th class="px-8 py-6">Rank</th>
                            <th class="px-8 py-6">User Identity</th>
                            <th class="px-8 py-6">Submitted</th>
                            <th class="px-8 py-6">Closed</th>
                            <th class="px-8 py-6">Pending</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse($users as $index => $user)
                            @php
                                // Logic for special row styling based on rank
                                $rowStyle = match($index) {
                                    0 => 'bg-amber-50/40 hover:bg-amber-50/60',
                                    1 => 'bg-slate-50/50 hover:bg-slate-50/80',
                                    2 => 'bg-orange-50/30 hover:bg-orange-50/50',
                                    default => 'hover:bg-gray-50/80'
                                };
                            @endphp
                            <tr class="transition-all duration-200 {{ $rowStyle }}">
                                
                                <td class="px-8 py-6">
                                    @if($index === 0)
                                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-amber-100 text-amber-700 shadow-sm border border-amber-200">
                                            <span class="text-sm font-black italic">#1</span>
                                        </div>
                                    @elseif($index === 1)
                                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-700 shadow-sm border border-slate-200">
                                            <span class="text-sm font-black italic">#2</span>
                                        </div>
                                    @elseif($index === 2)
                                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-orange-100 text-orange-700 shadow-sm border border-orange-200">
                                            <span class="text-sm font-black italic">#3</span>
                                        </div>
                                    @else
                                        <span class="px-3 text-xs font-black text-gray-400">#{{ $index + 1 }}</span>
                                    @endif
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-8 h-8 rounded-full bg-gray-900 flex items-center justify-center text-[10px] font-black text-white">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-black text-gray-900 tracking-tight">{{ $user->name }}</span>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <span class="text-base font-black text-gray-900">{{ $user->tickets_count }}</span>
                                        <div class="hidden md:block w-16 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="bg-blue-500 h-full" style="width: {{ min(($user->tickets_count / 50) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-black bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-100/50">
                                        {{ $user->closed_tickets_count }}
                                    </span>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-black bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-100/50">
                                        {{ $user->pending_tickets_count }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Zero user data available</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active Engagement</p>
                    <p class="text-sm font-bold text-gray-700 leading-tight">Summary updates in real-time based on ticket resolution status.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection