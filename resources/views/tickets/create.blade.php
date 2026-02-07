@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50/50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                    <li>User</li>
                    <li><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-blue-600">New Ticket</li>
                </ol>
            </nav>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Create Support Ticket</h1>
            <p class="mt-2 text-sm text-gray-500 font-medium">Describe your issue and we'll get back to you as soon as possible.</p>
        </div>

        @if ($errors->any())
            <div class="mb-8 bg-red-50 border border-red-100 rounded-2xl p-6 shadow-sm animate-pulse">
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-black text-red-800 uppercase tracking-widest">Entry Errors</span>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600 font-medium space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-10 space-y-8">
                @csrf

                <div>
                    <label for="subject" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Subject</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        placeholder="e.g. Cannot access billing dashboard"
                        class="block w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 text-gray-900 font-medium placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all">
                </div>

                <div>
                    <label for="priority_id" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Priority Level</label>
                    <div class="relative">
                        <select name="priority_id" id="priority_id" required
                            class="appearance-none block w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 text-gray-900 font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all cursor-pointer">
                            <option value="" disabled {{ old('priority_id') ? '' : 'selected' }}>Select priority level...</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Detailed Description</label>
                    <textarea name="description" id="description" rows="6" required
                        placeholder="Please provide as much detail as possible..."
                        class="block w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50 text-gray-900 font-medium placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all">{{ old('description') }}</textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-gray-50">
                    <a href="{{ url()->previous() }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancel
                    </a>

                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-4 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-100 active:scale-95 transition-all">
                        Create Ticket
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 flex items-start gap-4 p-6 bg-blue-50/50 rounded-2xl border border-blue-100/50">
            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-blue-900 uppercase tracking-wide mb-1">Response Time</p>
                <p class="text-sm text-blue-800 opacity-80 leading-relaxed font-medium">Standard support tickets are typically reviewed within 24 hours. For urgent matters, please ensure you select the appropriate priority level.</p>
            </div>
        </div>
    </div>
</div>
@endsection