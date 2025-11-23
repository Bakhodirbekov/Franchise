@extends('layouts.app')

@section('title', 'My Inquiries - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black text-white">My Inquiries</h1>
            <p class="text-gray-400 mt-2">View your franchise inquiries and their status</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('account.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Inquiries</p>
                                <p class="text-2xl font-black text-white">{{ $inquiries->total() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-accent/10 border border-accent rounded-xl flex items-center justify-center">
                                <i class="bi bi-chat-dots text-accent text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Pending</p>
                                <p class="text-2xl font-black text-white">{{ $inquiries->where('status', 'new')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-900/50 border border-yellow-500 rounded-xl flex items-center justify-center">
                                <i class="bi bi-clock text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Contacted</p>
                                <p class="text-2xl font-black text-white">{{ $inquiries->where('status', 'contacted')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-900/50 border border-green-500 rounded-xl flex items-center justify-center">
                                <i class="bi bi-check-circle text-green-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inquiries List -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-700">
                        <h3 class="text-lg font-black text-white">All Inquiries</h3>
                    </div>

                    @if($inquiries->count() > 0)
                        <div class="divide-y divide-gray-700">
                            @foreach($inquiries as $inquiry)
                            <div class="p-6 hover:bg-gray-900/50 transition duration-200">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4 mb-3">
                                            @if($inquiry->franchise)
                                                @if($inquiry->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($inquiry->franchise->images->first()->path) }}" 
                                                         alt="{{ $inquiry->franchise->title }}"
                                                         class="w-16 h-16 object-cover rounded-lg border border-gray-700">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-700 border border-gray-600 rounded-lg flex items-center justify-center">
                                                        <i class="bi bi-building text-gray-500"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-black text-white">{{ $inquiry->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-400">{{ $inquiry->franchise->category->name }}</p>
                                                    <p class="text-sm text-accent">${{ number_format($inquiry->franchise->investment_min) }} - ${{ number_format($inquiry->franchise->investment_max) }}</p>
                                                </div>
                                            @else
                                                <div class="w-16 h-16 bg-gray-700 border border-gray-600 rounded-lg flex items-center justify-center">
                                                    <i class="bi bi-question-circle text-gray-500"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-black text-white">General Inquiry</h4>
                                                    <p class="text-sm text-gray-400">No specific franchise</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-3">
                                            <div>
                                                <span class="text-gray-400">Message:</span>
                                                <p class="text-gray-300 line-clamp-2">{{ $inquiry->message }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-400">Submitted:</span>
                                                <p class="text-gray-300">{{ $inquiry->created_at->format('M d, Y - h:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-4 text-right">
                                        @if($inquiry->admin_response)
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-900/50 border border-blue-500 text-blue-400 block mb-2">
                                                <i class="bi bi-envelope-check"></i> Admin Replied
                                            </span>
                                        @endif
                                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $inquiry->status === 'new' ? 'bg-yellow-900/50 border border-yellow-500 text-yellow-400' : '' }}
                                            {{ $inquiry->status === 'contacted' ? 'bg-blue-900/50 border border-blue-500 text-blue-400' : '' }}
                                            {{ $inquiry->status === 'closed' ? 'bg-green-900/50 border border-green-500 text-green-400' : '' }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-2">{{ $inquiry->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                @if($inquiry->admin_response)
                                    <div class="mt-4">
                                        <div class="bg-blue-900/20 border border-blue-500/50 rounded-lg p-4">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-10 h-10 gradient-accent rounded-full flex items-center justify-center flex-shrink-0">
                                                    <i class="bi bi-person-badge text-gray-900"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-bold text-blue-400 mb-2">Admin Response:</p>
                                                    <p class="text-sm text-gray-300 whitespace-pre-line">{{ $inquiry->admin_response }}</p>
                                                    @if($inquiry->admin_response_at)
                                                        <p class="text-xs text-gray-500 mt-3">
                                                            <i class="bi bi-clock"></i> {{ $inquiry->admin_response_at->format('M d, Y - h:i A') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($inquiries->hasPages())
                        <div class="px-6 py-4 border-t border-gray-700">
                            {{ $inquiries->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-8 text-center">
                            <div class="w-24 h-24 bg-gray-700 border border-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-chat-dots text-gray-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-black text-white mb-2">No inquiries yet</h3>
                            <p class="text-gray-400 mb-4">You haven't made any franchise inquiries yet.</p>
                            <a href="{{ route('franchises.index') }}" 
                               class="gradient-accent text-gray-900 px-6 py-2 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200 inline-block">
                                Browse Franchises
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection