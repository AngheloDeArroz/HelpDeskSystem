@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">User Tickets</h1>
                <p class="mt-2 text-sm text-gray-500 font-medium uppercase tracking-widest">Centralized request management system</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Total Volume</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">{{ $tickets->count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Resolved</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">{{ $tickets->where('status.name', 'closed')->count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Awaiting</p>
                    <p class="text-2xl font-black text-gray-900 tracking-tight">{{ $tickets->where('status.name', '!=', 'closed')->count() }}</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center animate-fade-in shadow-sm">
                <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Search by subject, user, status or priority..."
                            class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all text-sm font-medium">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-900 hover:bg-black text-white font-bold py-3 px-8 rounded-xl transition-all active:scale-95 text-xs uppercase tracking-widest">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.dashboard') }}" class="bg-white border border-gray-200 text-gray-600 font-bold py-3 px-8 rounded-xl hover:bg-gray-50 transition-all text-xs uppercase tracking-widest flex items-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                            <th class="px-8 py-6">Reference</th>
                            <th class="px-8 py-6">Subject</th>
                            <th class="px-8 py-6 text-center">Status</th>
                            <th class="px-8 py-6 text-center">Priority</th>
                            <th class="px-8 py-6 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse($tickets as $ticket)
                            <tr class="hover:bg-gray-50/80 transition-all cursor-pointer group" 
                                onclick="window.location='{{ route('tickets.show', $ticket->id) }}'">
                                
                                <td class="px-8 py-6">
                                    <span class="text-xs font-mono font-bold text-gray-300 group-hover:text-gray-900 transition-colors">#{{ $ticket->id }}</span>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors tracking-tight">
                                        {{ $ticket->subject }}
                                    </div>
                                    <div class="text-[9px] text-gray-400 uppercase font-black mt-1 tracking-widest">
                                        Updated {{ $ticket->updated_at->diffForHumans() }}
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    @php
                                        $statusName = strtolower($ticket->status->name);
                                        $statusStyles = match($statusName) {
                                            'open' => 'bg-blue-50 text-blue-700 ring-blue-100',
                                            'in progress' => 'bg-amber-50 text-amber-700 ring-amber-100',
                                            default => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase tracking-widest ring-1 ring-inset {{ $statusStyles }}">
                                        {{ $ticket->status->name }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    @php
                                        $priorityName = strtolower($ticket->priority->name);
                                        $priorityStyles = match($priorityName) {
                                            'urgent' => 'text-red-600 bg-red-50',
                                            'high' => 'text-orange-600 bg-orange-50',
                                            'medium' => 'text-blue-600 bg-blue-50',
                                            default => 'text-gray-400 bg-gray-50',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg {{ $priorityStyles }} text-[9px] font-black uppercase tracking-widest">
                                        {{ $ticket->priority->name }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block" 
                                          onclick="event.stopPropagation();" onsubmit="return confirm('Are you sure you want to archive this ticket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-600 rounded-xl transition-all border border-transparent hover:border-red-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-300 uppercase tracking-[0.2em]">No active tickets found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-10 text-center">
            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">
                System automatically archives resolved tickets after 30 days
            </p>
        </div>
    </div>
</div>
@endsection