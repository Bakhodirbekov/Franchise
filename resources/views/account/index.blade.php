@extends('layouts.app')

@section('title', 'My Account - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black text-white">My Account</h1>
            <p class="text-gray-400 mt-2">Welcome back, {{ $user->name }}!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                    <!-- User Info -->
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 gradient-accent rounded-full flex items-center justify-center text-gray-900 text-2xl font-black mx-auto mb-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-lg font-black text-white">{{ $user->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                        <p class="text-gray-500 text-sm">{{ $user->phone }}</p>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="{{ route('account.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 bg-accent/10 border border-accent text-accent rounded-xl font-bold transition duration-200">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('account.inquiries') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200">
                            <i class="bi bi-chat-dots"></i>
                            <span>My Inquiries</span>
                        </a>
                        <a href="{{ route('account.orders') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200">
                            <i class="bi bi-receipt"></i>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200">
                            <i class="bi bi-person"></i>
                            <span>Profile Settings</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Inquiries</p>
                                <p class="text-2xl font-black text-white">{{ $user->inquiries()->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-accent/10 border border-accent rounded-xl flex items-center justify-center">
                                <i class="bi bi-chat-dots text-accent text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Active Orders</p>
                                <p class="text-2xl font-black text-white">{{ $user->orders()->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-accent/10 border border-accent rounded-xl flex items-center justify-center">
                                <i class="bi bi-receipt text-accent text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Member Since</p>
                                <p class="text-lg font-black text-white">{{ $user->created_at->format('M Y') }}</p>
                            </div>
                            <div class="w-12 h-12 bg-accent/10 border border-accent rounded-xl flex items-center justify-center">
                                <i class="bi bi-calendar-check text-accent text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Inquiries -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-black text-white">Recent Inquiries</h3>
                        <a href="{{ route('account.inquiries') }}" class="text-accent hover:text-orange-400 font-bold text-sm">
                            View All
                        </a>
                    </div>
                    
                    @if($recentInquiries->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentInquiries as $inquiry)
                                <div class="border border-gray-700 rounded-xl hover:border-accent hover:bg-gray-900/50 transition duration-200">
                                    <div class="flex items-center justify-between p-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 gradient-accent rounded-lg flex items-center justify-center">
                                                <i class="bi bi-building text-gray-900 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-white">
                                                    {{ $inquiry->franchise->title ?? 'General Inquiry' }}
                                                </p>
                                                <p class="text-sm text-gray-400">
                                                    {{ $inquiry->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($inquiry->admin_response)
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-900/50 border border-blue-500 text-blue-400">
                                                    <i class="bi bi-envelope-check"></i> Admin Replied
                                                </span>
                                            @endif
                                            <span class="px-3 py-1 rounded-full text-xs font-bold 
                                                {{ $inquiry->status === 'new' ? 'bg-yellow-900/50 border border-yellow-500 text-yellow-400' : '' }}
                                                {{ $inquiry->status === 'contacted' ? 'bg-blue-900/50 border border-blue-500 text-blue-400' : '' }}
                                                {{ $inquiry->status === 'closed' ? 'bg-green-900/50 border border-green-500 text-green-400' : '' }}">
                                                {{ ucfirst($inquiry->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($inquiry->admin_response)
                                        <div class="px-4 pb-4">
                                            <div class="bg-blue-900/20 border border-blue-500/50 rounded-lg p-4">
                                                <div class="flex items-start space-x-3">
                                                    <div class="w-8 h-8 gradient-accent rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="bi bi-person-badge text-gray-900 text-sm"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="text-xs font-bold text-blue-400 mb-1">Admin Response:</p>
                                                        <p class="text-sm text-gray-300 whitespace-pre-line">{{ $inquiry->admin_response }}</p>
                                                        @if($inquiry->admin_response_at)
                                                            <p class="text-xs text-gray-500 mt-2">
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
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-700 border border-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-chat-dots text-gray-500 text-2xl"></i>
                            </div>
                            <p class="text-gray-400 mb-4">You haven't made any inquiries yet</p>
                            <a href="{{ route('franchises.index') }}" class="gradient-accent text-gray-900 px-6 py-2 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200 inline-block">
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