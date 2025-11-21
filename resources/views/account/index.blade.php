@extends('layouts.app')

@section('title', 'My Account - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Account</h1>
            <p class="text-gray-600 mt-2">Welcome back, {{ $user->name }}!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <!-- User Info -->
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                        <p class="text-gray-500 text-sm">{{ $user->phone }}</p>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="{{ route('account.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-medium transition duration-200">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('account.inquiries') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200">
                            <i class="bi bi-chat-dots"></i>
                            <span>My Inquiries</span>
                        </a>
                        <a href="{{ route('account.orders') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200">
                            <i class="bi bi-receipt"></i>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200">
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
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Inquiries</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $user->inquiries()->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-chat-dots text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Active Orders</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $user->orders()->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-receipt text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Member Since</p>
                                <p class="text-lg font-bold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-calendar-check text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Inquiries -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Inquiries</h3>
                        <a href="{{ route('account.inquiries') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                            View All
                        </a>
                    </div>
                    
                    @if($recentInquiries->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentInquiries as $inquiry)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition duration-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-building text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $inquiry->franchise->title ?? 'General Inquiry' }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $inquiry->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-chat-dots text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-600 mb-4">You haven't made any inquiries yet</p>
                            <a href="{{ route('franchises.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200">
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