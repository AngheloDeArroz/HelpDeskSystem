@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">My Tickets</h1>
            </div>
            <a href="{{ route('tickets.create') }}"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Create New Ticket
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                </div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-wide">Total Tickets</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $tickets->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 text-blue-500 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                </div>
                <p class="text-sm font-bold text-blue-600 uppercase tracking-wide">Active Requests</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $tickets->whereIn('status.name', ['open', 'in progress'])->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 text-green-500 opacity-30 group-hover:opacity-100 transition-opacity">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <p class="text-sm font-bold text-green-600 uppercase tracking-wide">Resolved</p>
                <p class="text-3xl font-black text-gray-900 mt-1">{{ $tickets->where('status.name', 'closed')->count() }}</p>
            </div>
        </div>

        @if($tickets->isEmpty())
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-20 text-center">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 00-2-2m0 0V5a2 2 0 012-2h6.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V9" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">All quiet here</h3>
                <p class="text-gray-500 mt-2 max-w-xs mx-auto">You haven't opened any support tickets yet. Need help with something?</p>
                <a href="{{ route('tickets.create') }}" class="mt-8 inline-flex font-bold text-blue-600 hover:text-blue-700 items-center">
                    Create your first ticket <span class="ml-2">→</span>
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] font-black uppercase tracking-[0.15em] text-gray-400 bg-white">
                                <th class="px-8 py-4">Ticket Description</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Priority</th>
                                <th class="px-6 py-4">Timeline</th>
                                <th class="px-8 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($tickets as $ticket)
                                <tr class="group hover:bg-gray-50/80 transition-all cursor-pointer" onclick="window.location.href='{{ route('tickets.show', $ticket) }}'">
                                    
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                                {{ $ticket->subject }}
                                            </span>
                                            <span class="text-sm text-gray-500 mt-1 line-clamp-1 font-medium">
                                                {{ $ticket->description }}
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

                                    <td class="px-6 py-6">
                                        <div class="text-xs">
                                            <p class="font-bold text-gray-900">Added {{ $ticket->created_at->format('M d') }}</p>
                                            <p class="text-gray-400 font-medium mt-0.5">{{ $ticket->updated_at->diffForHumans() }}</p>
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 text-right">
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-gray-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection