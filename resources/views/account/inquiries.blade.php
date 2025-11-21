@extends('layouts.app')

@section('title', 'My Inquiries - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Inquiries</h1>
            <p class="text-gray-600 mt-2">View your franchise inquiries and their status</p>
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
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Inquiries</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $inquiries->total() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-chat-dots text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Pending</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $inquiries->where('status', 'new')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-clock text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Contacted</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $inquiries->where('status', 'contacted')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inquiries List -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">All Inquiries</h3>
                    </div>

                    @if($inquiries->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach($inquiries as $inquiry)
                            <div class="p-6 hover:bg-gray-50 transition duration-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4 mb-3">
                                            @if($inquiry->franchise)
                                                @if($inquiry->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($inquiry->franchise->images->first()->path) }}" 
                                                         alt="{{ $inquiry->franchise->title }}"
                                                         class="w-16 h-16 object-cover rounded-lg">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="bi bi-building text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900">{{ $inquiry->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $inquiry->franchise->category->name }}</p>
                                                    <p class="text-sm text-gray-500">${{ number_format($inquiry->franchise->investment_min) }} - ${{ number_format($inquiry->franchise->investment_max) }}</p>
                                                </div>
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="bi bi-question-circle text-gray-400"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">General Inquiry</h4>
                                                    <p class="text-sm text-gray-600">No specific franchise</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-3">
                                            <div>
                                                <span class="text-gray-600">Message:</span>
                                                <p class="text-gray-900 line-clamp-2">{{ $inquiry->message }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Submitted:</span>
                                                <p class="text-gray-900">{{ $inquiry->created_at->format('M d, Y - h:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-4 text-right">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-2">{{ $inquiry->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($inquiries->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $inquiries->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-8 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-chat-dots text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No inquiries yet</h3>
                            <p class="text-gray-600 mb-4">You haven't made any franchise inquiries yet.</p>
                            <a href="{{ route('franchises.index') }}" 
                               class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200">
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