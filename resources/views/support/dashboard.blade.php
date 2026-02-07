@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Ticket Queue</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Total Tickets</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $totalTickets }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group text-green-600">
                <div class="absolute right-0 top-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <p class="text-sm font-bold uppercase tracking-wide">Solved</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $solvedTickets }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group text-yellow-600">
                <div class="absolute right-0 top-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                </div>
                <p class="text-sm font-bold uppercase tracking-wide">Pending</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $remainingTickets }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30">
                <form action="{{ route('support.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by user, subject, or ID..."
                            class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-900 hover:bg-black text-white font-bold py-3 px-8 rounded-xl transition-all active:scale-95">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('support.dashboard') }}" class="bg-white border border-gray-200 text-gray-600 font-bold py-3 px-8 rounded-xl hover:bg-gray-50 transition-all">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="mx-8 mt-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl text-sm font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black uppercase tracking-[0.15em] text-gray-400 bg-white">
                            <th class="px-8 py-5">ID</th>
                            <th class="px-6 py-5">User & Subject</th>
                            <th class="px-6 py-5">Status</th>
                            <th class="px-6 py-5">Priority</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($tickets as $ticket)
                            <tr class="group hover:bg-gray-50/80 transition-all cursor-pointer" onclick="window.location='{{ route('tickets.show', $ticket) }}'">
                                
                                <td class="px-8 py-6 text-sm font-mono text-gray-400">
                                    #{{ $ticket->id }}
                                </td>

                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $ticket->subject }}
                                        </span>
                                        <span class="text-xs font-semibold text-gray-500 mt-0.5 flex items-center">
                                            <div class="w-4 h-4 rounded-full bg-gray-200 mr-1.5 flex items-center justify-center text-[8px] text-gray-500 uppercase">
                                                {{ substr($ticket->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            {{ $ticket->user->name ?? 'Unknown User' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    @php
                                        $statusStyles = match(strtolower($ticket->status->name)) {
                                            'open' => 'bg-blue-50 text-blue-700 ring-blue-100',
                                            'in progress' => 'bg-amber-50 text-amber-700 ring-amber-100',
                                            'closed' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
                                            default => 'bg-gray-50 text-gray-600 ring-gray-100',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-tight ring-1 ring-inset {{ $statusStyles }}">
                                        {{ $ticket->status->name }}
                                    </span>
                                </td>

                                    <td class="px-6 py-6 text-sm font-bold">
                                        @php
                                            $priorityColor = match(strtolower($ticket->priority->name)) {
                                                'urgent' => 'text-red-500',
                                                'high' => 'text-orange-500',
                                                'medium' => 'text-blue-500',
                                                default => 'text-gray-400',
                                            };
                                        @endphp
                                        <div class="flex items-center {{ $priorityColor }}">
                                            <span class="mr-2 italic text-lg">!</span>
                                            {{ strtoupper($ticket->priority->name) }}
                                        </div>
                                    </td>

                                <td class="px-8 py-6 text-right" onclick="event.stopPropagation()">
                                    @if(strtolower($ticket->status->name) !== 'closed' && auth()->user()->can('support'))
                                        <form action="{{ route('tickets.solve', $ticket) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                                                Mark as solved
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] font-black uppercase text-gray-300 tracking-widest leading-none">Complete</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                        </div>
                                        <p class="text-gray-500 font-bold">No tickets found in the queue</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50/50 px-8 py-4 border-t border-gray-100 flex justify-between items-center">
                <p class="text-[10px] text-gray-400 uppercase font-black tracking-[0.2em]">
                    System Status: Operational
                </p>
                <div class="flex gap-1">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400 opacity-50"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400 opacity-25"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection