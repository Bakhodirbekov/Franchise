@extends('layouts.admin')

@section('title', 'Admin Dashboard - DarkRock')

@section('header', 'Dashboard')

@section('content')
<div class="py-6">
    <!-- Welcome Message -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600 mt-2">Here's what's happening with your franchise business today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Franchises -->
        <div class="stat-card bg-white p-6">
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
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-arrow-up text-green-500 mr-1"></i>
                    <span>{{ round(($stats['published_franchises'] / max($stats['total_franchises'], 1)) * 100, 1) }}% published</span>
                </div>
            </div>
        </div>

        <!-- Total Inquiries -->
        <div class="stat-card bg-white p-6">
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
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-arrow-down text-yellow-500 mr-1"></i>
                    <span>{{ round(($stats['pending_inquiries'] / max($stats['total_inquiries'], 1)) * 100, 1) }}% pending</span>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="stat-card bg-white p-6">
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
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-person-badge text-purple-500 mr-1"></i>
                    <span>{{ round(($stats['admin_users'] / max($stats['total_users'], 1)) * 100, 1) }}% admins</span>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="stat-card bg-white p-6">
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
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-check-circle text-green-500 mr-1"></i>
                    <span>{{ round(($stats['completed_orders'] / max($stats['total_orders'], 1)) * 100, 1) }}% completed</span>
                </div>
            </div>
        </div>
        
        <!-- Total Call Requests -->
        <div class="stat-card bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Call Requests</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_call_requests'] }}</p>
                    <div class="flex items-center space-x-2 mt-1">
                        <span class="text-xs text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">
                            {{ $stats['pending_call_requests'] }} Pending
                        </span>
                        <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-full">
                            {{ $stats['total_call_requests'] - $stats['pending_call_requests'] }} Processed
                        </span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="bi bi-telephone text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-clock-history text-yellow-500 mr-1"></i>
                    <span>{{ round(($stats['pending_call_requests'] / max($stats['total_call_requests'], 1)) * 100, 1) }}% pending</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Franchises Chart -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Franchises Overview</h3>
                <span class="text-sm text-gray-500">Current Status</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-blue-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_franchises'] > 0) ? (80 + ($stats['published_franchises'] / $stats['total_franchises']) * 20) : 80 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-blue-600">
                                {{ $stats['published_franchises'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Published</p>
                </div>
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-gray-400 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_franchises'] > 0) ? (80 + (($stats['total_franchises'] - $stats['published_franchises']) / $stats['total_franchises']) * 20) : 80 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-gray-600">
                                {{ $stats['total_franchises'] - $stats['published_franchises'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Draft</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total:</span>
                    <span class="font-semibold text-gray-900">{{ $stats['total_franchises'] }} franchises</span>
                </div>
            </div>
        </div>

        <!-- Inquiries & Orders Chart -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Inquiries & Orders</h3>
                <span class="text-sm text-gray-500">Current Status</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-yellow-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_inquiries'] > 0) ? (60 + ($stats['pending_inquiries'] / $stats['total_inquiries']) * 40) : 60 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-yellow-600">
                                {{ $stats['pending_inquiries'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Pending Inquiries</p>
                </div>
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-green-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_orders'] > 0) ? (60 + ($stats['completed_orders'] / $stats['total_orders']) * 40) : 60 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-green-600">
                                {{ $stats['completed_orders'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Completed Orders</p>
                </div>
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-red-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_orders'] > 0) ? (60 + ($stats['pending_orders'] / $stats['total_orders']) * 40) : 60 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-red-600">
                                {{ $stats['pending_orders'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Pending Orders</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Inquiries:</span>
                        <span class="font-semibold text-gray-900">{{ $stats['total_inquiries'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Orders:</span>
                        <span class="font-semibold text-gray-900">{{ $stats['total_orders'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Chart -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Users Overview</h3>
                <span class="text-sm text-gray-500">User Distribution</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-purple-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_users'] > 0) ? (70 + ($stats['admin_users'] / $stats['total_users']) * 30) : 70 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-purple-600">
                                {{ $stats['admin_users'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Admin Users</p>
                </div>
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-green-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ ($stats['total_users'] > 0) ? (70 + (($stats['total_users'] - $stats['admin_users']) / $stats['total_users']) * 30) : 70 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-sm font-bold text-green-600">
                                {{ $stats['total_users'] - $stats['admin_users'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Regular Users</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total Users:</span>
                    <span class="font-semibold text-gray-900">{{ $stats['total_users'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Franchises Trend -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Franchises Growth</h3>
                <span class="text-sm text-gray-500">Last 6 Months</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-1">
                @foreach($franchiseData as $data)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-blue-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ $data['count'] > 0 ? (20 + ($data['count'] / max(array_column($franchiseData, 'count')) * 80)) : 20 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-blue-600">
                                {{ $data['count'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">{{ $data['month'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total Franchises:</span>
                    <span class="font-semibold text-gray-900">{{ array_sum(array_column($franchiseData, 'count')) }}</span>
                </div>
            </div>
        </div>

        <!-- Users Trend -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Users Growth</h3>
                <span class="text-sm text-gray-500">Last 6 Months</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-1">
                @foreach($userData as $data)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-gray-200 rounded-t-lg relative" style="height: 200px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-green-500 rounded-t-lg transition-all duration-500" 
                             style="height: {{ $data['count'] > 0 ? (20 + ($data['count'] / max(array_column($userData, 'count')) * 80)) : 20 }}%;">
                            <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-green-600">
                                {{ $data['count'] }}
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">{{ $data['month'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total Users:</span>
                    <span class="font-semibold text-gray-900">{{ array_sum(array_column($userData, 'count')) }}</span>
                </div>
            </div>
        </div>

        <!-- Inquiries & Orders Trend -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Inquiries & Orders</h3>
                <span class="text-sm text-gray-500">Last 6 Months</span>
            </div>
            <div class="h-64 flex items-end justify-between space-x-1">
                @foreach($inquiryData as $index => $data)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full flex justify-center space-x-1" style="height: 200px;">
                        <!-- Inquiries -->
                        <div class="w-1/2 bg-gray-200 rounded-t-lg relative">
                            <div class="absolute bottom-0 left-0 right-0 bg-yellow-500 rounded-t-lg transition-all duration-500" 
                                 style="height: {{ $data['count'] > 0 ? (10 + ($data['count'] / (max(array_column($inquiryData, 'count')) + 1) * 90)) : 10 }}%;">
                                <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-yellow-600">
                                    {{ $data['count'] }}
                                </div>
                            </div>
                        </div>
                        <!-- Orders -->
                        <div class="w-1/2 bg-gray-200 rounded-t-lg relative">
                            <div class="absolute bottom-0 left-0 right-0 bg-purple-500 rounded-t-lg transition-all duration-500" 
                                 style="height: {{ $orderData[$index]['count'] > 0 ? (10 + ($orderData[$index]['count'] / (max(array_column($orderData, 'count')) + 1) * 90)) : 10 }}%;">
                                <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-purple-600">
                                    {{ $orderData[$index]['count'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">{{ $data['month'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                    <span class="text-xs text-gray-600">Inquiries</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                    <span class="text-xs text-gray-600">Orders</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total Activity:</span>
                    <span class="font-semibold text-gray-900">{{ array_sum(array_column($inquiryData, 'count')) + array_sum(array_column($orderData, 'count')) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Traffic Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Column Chart - Website Traffic -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Website Traffic (Last 7 Days)</h3>
                <div class="flex space-x-2">
                    <span class="flex items-center text-xs text-gray-600">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-1"></div>
                        Visitors
                    </span>
                    <span class="flex items-center text-xs text-gray-600">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-1"></div>
                        Page Views
                    </span>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-1">
                @foreach($trafficData as $data)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full flex justify-center space-x-1" style="height: 200px;">
                        <!-- Visitors Column -->
                        <div class="w-1/2 bg-gray-200 rounded-t-lg relative">
                            <div class="absolute bottom-0 left-0 right-0 bg-blue-500 rounded-t-lg transition-all duration-500" 
                                 style="height: {{ $data['visitors'] > 0 ? (10 + ($data['visitors'] / (max(array_column($trafficData, 'visitors')) + 1) * 90)) : 10 }}%;">
                                <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-blue-600">
                                    {{ $data['visitors'] }}
                                </div>
                            </div>
                        </div>
                        <!-- Page Views Column -->
                        <div class="w-1/2 bg-gray-200 rounded-t-lg relative">
                            <div class="absolute bottom-0 left-0 right-0 bg-green-500 rounded-t-lg transition-all duration-500" 
                                 style="height: {{ $data['pageViews'] > 0 ? (10 + ($data['pageViews'] / (max(array_column($trafficData, 'pageViews')) + 1) * 90)) : 10 }}%;">
                                <div class="absolute -top-6 left-0 right-0 text-center text-xs font-bold text-green-600">
                                    {{ $data['pageViews'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">{{ $data['date'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Visitors:</span>
                        <span class="font-semibold text-gray-900">{{ array_sum(array_column($trafficData, 'visitors')) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Page Views:</span>
                        <span class="font-semibold text-gray-900">{{ array_sum(array_column($trafficData, 'pageViews')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart - Website Traffic -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Traffic Trend Analysis</h3>
                <div class="flex space-x-2">
                    <span class="flex items-center text-xs text-gray-600">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-1"></div>
                        Visitors
                    </span>
                </div>
            </div>
            <div class="h-64 relative">
                <!-- Area Chart Background -->
                <div class="absolute inset-0">
                    <!-- Grid lines -->
                    <div class="absolute bottom-0 left-0 right-0 h-px bg-gray-200"></div>
                    <div class="absolute bottom-1/4 left-0 right-0 h-px bg-gray-100"></div>
                    <div class="absolute bottom-2/4 left-0 right-0 h-px bg-gray-100"></div>
                    <div class="absolute bottom-3/4 left-0 right-0 h-px bg-gray-100"></div>
                    <div class="absolute top-0 left-0 right-0 h-px bg-gray-200"></div>
                </div>
                
                <!-- Area Chart -->
                <div class="absolute inset-0">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <!-- Area path -->
                        <path 
                            d="M0,100 
                            @foreach($trafficData as $index => $data)
                                L{{ ($index / (count($trafficData) - 1)) * 100 }},{{ 100 - ($data['visitors'] / max(array_column($trafficData, 'visitors')) * 80) }}
                            @endforeach
                            L100,100 Z" 
                            fill="rgba(59, 130, 246, 0.2)" 
                            stroke="rgba(59, 130, 246, 1)" 
                            stroke-width="0.5">
                        </path>
                        
                        <!-- Line path -->
                        <path 
                            d="M0,100 
                            @foreach($trafficData as $index => $data)
                                L{{ ($index / (count($trafficData) - 1)) * 100 }},{{ 100 - ($data['visitors'] / max(array_column($trafficData, 'visitors')) * 80) }}
                            @endforeach" 
                            fill="none" 
                            stroke="rgba(59, 130, 246, 1)" 
                            stroke-width="1">
                        </path>
                    </svg>
                    
                    <!-- Data points -->
                    @foreach($trafficData as $index => $data)
                        <div class="absolute w-3 h-3 bg-blue-500 rounded-full border-2 border-white shadow"
                             style="left: calc({{ ($index / (count($trafficData) - 1)) * 100 }}% - 6px); 
                                    top: calc({{ 100 - ($data['visitors'] / max(array_column($trafficData, 'visitors')) * 80) }}% - 6px);">
                        </div>
                    @endforeach
                </div>
                
                <!-- X-axis labels -->
                <div class="absolute bottom-0 left-0 right-0 flex justify-between px-2">
                    @foreach($trafficData as $data)
                        <span class="text-xs text-gray-500">{{ $data['date'] }}</span>
                    @endforeach
                </div>
            </div>
            
            <!-- Stats summary -->
            <div class="grid grid-cols-3 gap-4 mt-6 pt-4 border-t border-gray-200 text-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ array_sum(array_column($trafficData, 'visitors')) }}
                    </p>
                    <p class="text-xs text-gray-500">Total Visitors</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ array_sum(array_column($trafficData, 'pageViews')) }}
                    </p>
                    <p class="text-xs text-gray-500">Page Views</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ round(array_sum(array_column($trafficData, 'pageViews')) / array_sum(array_column($trafficData, 'visitors')), 1) }}
                    </p>
                    <p class="text-xs text-gray-500">Pages/Visit</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Franchises -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Franchises</h3>
                <a href="{{ route('admin.franchises.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    View All
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentFranchises as $franchise)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-shop text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ Str::limit($franchise->name, 20) }}</h4>
                            <p class="text-xs text-gray-500">
                                {{ $franchise->created_at->diffForHumans() }}
                                @if($franchise->is_published)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Published
                                </span>
                                @else
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Draft
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.franchises.show', $franchise->id) }}" 
                           class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.franchises.edit', $franchise->id) }}" 
                           class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="bi bi-shop text-gray-300 text-2xl mb-2"></i>
                    <p class="text-gray-500">No franchises found</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Inquiries -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Inquiries</h3>
                <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    View All
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentInquiries as $inquiry)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-chat-dots text-yellow-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ Str::limit($inquiry->subject, 20) }}</h4>
                            <p class="text-xs text-gray-500">
                                From: {{ Str::limit($inquiry->name, 15) }}
                                <span class="mx-1">•</span>
                                {{ $inquiry->created_at->diffForHumans() }}
                                @if($inquiry->status === 'pending')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                                @elseif($inquiry->status === 'processing')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Processing
                                </span>
                                @else
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Resolved
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" 
                       class="text-gray-400 hover:text-blue-600 transition-colors">
                        <i class="bi bi-eye"></i>
                    </a>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="bi bi-chat-dots text-gray-300 text-2xl mb-2"></i>
                    <p class="text-gray-500">No inquiries found</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mt-8">
        <a href="{{ route('admin.franchises.create') }}" class="stat-card bg-white p-6 text-center hover:shadow-md transition duration-200">
            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-plus-lg text-blue-600 text-2xl"></i>
            </div>
            <p class="font-semibold text-gray-900 mb-2">Add Franchise</p>
            <p class="text-sm text-gray-600">Create new franchise opportunity</p>
        </a>
        
        <a href="{{ route('admin.categories.index') }}" class="stat-card bg-white p-6 text-center hover:shadow-md transition duration-200">
            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-tags text-green-600 text-2xl"></i>
            </div>
            <p class="font-semibold text-gray-900 mb-2">Categories</p>
            <p class="text-sm text-gray-600">Manage franchise categories</p>
        </a>
        
        <a href="{{ route('admin.inquiries.index') }}" class="stat-card bg-white p-6 text-center hover:shadow-md transition duration-200">
            <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-chat-dots text-yellow-600 text-2xl"></i>
            </div>
            <p class="font-semibold text-gray-900 mb-2">Inquiries</p>
            <p class="text-sm text-gray-600">View customer inquiries</p>
        </a>
        
        <a href="{{ route('admin.call-requests.index') }}" class="stat-card bg-white p-6 text-center hover:shadow-md transition duration-200">
            <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-telephone text-orange-600 text-2xl"></i>
            </div>
            <p class="font-semibold text-gray-900 mb-2">Call Requests</p>
            <p class="text-sm text-gray-600">Manage call requests</p>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="stat-card bg-white p-6 text-center hover:shadow-md transition duration-200">
            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-people text-purple-600 text-2xl"></i>
            </div>
            <p class="font-semibold text-gray-900 mb-2">Users</p>
            <p class="text-sm text-gray-600">Manage system users</p>
        </a>
    </div>
</div>
@endsection