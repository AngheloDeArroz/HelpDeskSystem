@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight flex items-center gap-3">
                    <span class="p-2 bg-gray-200 rounded-xl">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </span>
                    Archived Tickets
                </h1>
                <p class="mt-2 text-sm text-gray-500 font-medium uppercase tracking-widest">Deleted records available for restoration</p>
            </div>
            <a href="javascript:history.back()" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-blue-600 transition-colors">
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                            <th class="px-8 py-6">Reference</th>
                            <th class="px-8 py-6">Subject</th>
                            <th class="px-8 py-6 text-center">Management</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse($tickets as $ticket)
                            <tr class="group hover:bg-gray-50/50 transition-all italic">
                                
                                <td class="px-8 py-6">
                                    <span class="text-xs font-mono font-bold text-gray-300">#{{ $ticket->id }}</span>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-400 group-hover:text-gray-600 transition-colors tracking-tight">
                                        {{ $ticket->subject }}
                                    </div>
                                    <div class="text-[9px] text-gray-300 uppercase font-black mt-1 tracking-widest not-italic">
                                        Deleted {{ $ticket->deleted_at?->diffForHumans() ?? 'Recently' }}
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-100 transition-all not-italic">
                                            Preview
                                        </a>

                                        <form action="{{ route('tickets.restore', $ticket->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm shadow-emerald-100/50 not-italic">
                                                Restore
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-300 uppercase tracking-[0.2em]">Archive is currently empty</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.3em]">
                Permanently deleted items cannot be recovered
            </p>
        </div>
    </div>
</div>
@endsection