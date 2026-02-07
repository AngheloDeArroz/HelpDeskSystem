@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <a href="javascript:history.back()" class="group inline-flex items-center text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-blue-600 transition-colors mb-2">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Queue
                </a>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                    <span class="text-blue-600">#{{ $ticket->id }}</span> {{ $ticket->subject }}
                </h1>
            </div>

            <div class="flex items-center gap-3">
                @php
                    $statusStyles = match(strtolower($ticket->status->name)) {
                        'open' => 'bg-blue-50 text-blue-700 ring-blue-100',
                        'in progress' => 'bg-amber-50 text-amber-700 ring-amber-100',
                        default => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
                    };
                @endphp
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest ring-1 ring-inset {{ $statusStyles }}">
                    {{ $ticket->status->name }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400">Issue Description</h3>
                            <span class="text-xs text-gray-400 font-medium">{{ $ticket->created_at->format('M d, Y • H:i') }}</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg font-medium italic">
                            "{{ $ticket->description }}"
                        </p>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-black text-gray-900 tracking-tight flex items-center">
                        Discussion
                        <span class="ml-3 px-2 py-0.5 bg-gray-100 text-gray-500 rounded-md text-xs">{{ $ticket->comments->count() }}</span>
                    </h3>

                    <div class="space-y-6">
                        @forelse($ticket->comments as $comment)
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center font-bold text-gray-500 shadow-sm border border-white">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-grow bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-sm font-black text-gray-900">{{ $comment->user->name }}</span>
                                        <span class="text-[10px] font-bold uppercase tracking-wide text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-white rounded-3xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">No activity yet</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <form action="{{ route('tickets.comments.store', $ticket) }}" method="POST">
                            @csrf
                            <div>
                                <label for="comment" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Add Response</label>
                                <textarea name="comment" id="comment" rows="4"
                                    class="w-full border-gray-100 bg-gray-50 rounded-2xl p-4 text-sm focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="Type your message here..." required></textarea>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button type="submit"
                                    class="bg-gray-900 hover:bg-black text-white font-black uppercase tracking-widest text-[11px] py-4 px-8 rounded-xl transition duration-150 shadow-xl shadow-gray-200">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Ticket Metadata</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Requester</p>
                            <p class="text-sm font-bold text-gray-900">{{ $ticket->user->name }}</p>
                        </div>

                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Priority Level</p>
                            @php
                                $priorityColor = match(strtolower($ticket->priority->name)) {
                                    'urgent' => 'text-red-500',
                                    'high' => 'text-orange-500',
                                    'medium' => 'text-yellow-600',
                                    default => 'text-emerald-500',
                                };
                            @endphp
                            <p class="text-sm font-black {{ $priorityColor }} uppercase tracking-tighter">
                                {{ $ticket->priority->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Timeline</p>
                            <p class="text-xs font-bold text-gray-600">Opened: <span class="text-gray-900">{{ $ticket->created_at->format('M d') }}</span></p>
                            <p class="text-xs font-bold text-gray-600">Last Activity: <span class="text-gray-900">{{ $ticket->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>

                    @if(strtolower($ticket->status->name) !== 'closed' && auth()->user()->can('support'))
                        <div class="mt-10 pt-6 border-t border-gray-50">
                            <form action="{{ route('tickets.solve', $ticket) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white font-black uppercase tracking-widest text-[10px] py-4 rounded-xl transition-all shadow-sm">
                                    Mark as Solved
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="p-6 bg-blue-600 rounded-3xl text-white shadow-xl shadow-blue-100">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-2">Support Note</p>
                    <p class="text-xs font-bold leading-relaxed">
                        Always be respectful and empathetic when communicating. Remember that they are likely frustrated or stressed about their issue, so a kind and understanding tone can go a long way.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection