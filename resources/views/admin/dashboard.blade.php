@extends('layouts.app')

@section('title', 'Admin Dashboard - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    <i class="bi bi-circle-fill text-xs mr-1"></i>
                    Admin
                </span>
                <span class="text-sm text-gray-500">{{ now()->format('M d, Y - h:i A') }}</span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Franchises -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Franchises</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_franchises'] }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                {{ $stats['published_franchises'] }} Published
                            </span>
                            <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                {{ $stats['total_franchises'] - $stats['published_franchises'] }} Draft
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="bi bi-shop text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Inquiries -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Inquiries</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_inquiries'] }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">
                                {{ $stats['pending_inquiries'] }} New
                            </span>
                            <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-full">
                                {{ $stats['total_inquiries'] - $stats['pending_inquiries'] }} Processed
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="bi bi-chat-dots text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded-full">
                                {{ $stats['admin_users'] }} Admin
                            </span>
                            <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                {{ $stats['total_users'] - $stats['admin_users'] }} Users
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="bi bi-people text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                {{ $stats['completed_orders'] }} Completed
                            </span>
                            <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full">
                                {{ $stats['pending_orders'] }} Pending
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="bi bi-receipt text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recent Inquiries -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Inquiries</h3>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center space-x-1">
                        <span>View All</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                
                @if($recentInquiries->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentInquiries as $inquiry)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition duration-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-chat-dots text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $inquiry->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $inquiry->email }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $inquiry->franchise->title ?? 'General Inquiry' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $inquiry->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-chat-dots text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">No inquiries yet</p>
                    </div>
                @endif
            </div>

            <!-- Recent Franchises -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Franchises</h3>
                    <a href="{{ route('admin.franchises.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center space-x-1">
                        <span>View All</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                
                @if($recentFranchises->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentFranchises as $franchise)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition duration-200">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-shop text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $franchise->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $franchise->category->name }}</p>
                                        <p class="text-xs text-gray-500">${{ number_format($franchise->investment_min) }} - ${{ number_format($franchise->investment_max) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $franchise->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($franchise->status) }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $franchise->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-shop text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">No franchises yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.franchises.create') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition duration-200 group">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition duration-200">
                    <i class="bi bi-plus-lg text-blue-600 text-2xl"></i>
                </div>
                <p class="font-semibold text-gray-900 mb-2">Add Franchise</p>
                <p class="text-sm text-gray-600">Create new franchise opportunity</p>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition duration-200 group">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition duration-200">
                    <i class="bi bi-tags text-green-600 text-2xl"></i>
                </div>
                <p class="font-semibold text-gray-900 mb-2">Categories</p>
                <p class="text-sm text-gray-600">Manage franchise categories</p>
            </a>
            
            <a href="{{ route('admin.inquiries.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition duration-200 group">
                <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-200 transition duration-200">
                    <i class="bi bi-chat-dots text-yellow-600 text-2xl"></i>
                </div>
                <p class="font-semibold text-gray-900 mb-2">Inquiries</p>
                <p class="text-sm text-gray-600">View customer inquiries</p>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 text-center hover:shadow-md transition duration-200 group">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition duration-200">
                    <i class="bi bi-people text-purple-600 text-2xl"></i>
                </div>
                <p class="font-semibold text-gray-900 mb-2">Users</p>
                <p class="text-sm text-gray-600">Manage system users</p>
            </a>
        </div>
    </div>
</div>
@endsection