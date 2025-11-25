@extends('layouts.operator')

@section('title', 'Operator Dashboard - DarkRock')

@section('header', 'Dashboard')

@section('content')
<div class="py-6">
    <!-- Welcome Message -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600 mt-2">Here's what you need to work on today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Call Requests -->
        <div class="stat-card bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Call Requests</p>
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

        <!-- Contacted Call Requests -->
        <div class="stat-card bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Contacted Calls</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['contacted_call_requests'] }}</p>
                    <div class="flex items-center space-x-2 mt-1">
                        <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                            {{ $stats['completed_call_requests'] }} Completed
                        </span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="bi bi-telephone-outbound text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-check-circle text-green-500 mr-1"></i>
                    <span>{{ round(($stats['contacted_call_requests'] / max($stats['total_call_requests'], 1)) * 100, 1) }}% contacted</span>
                </div>
            </div>
        </div>

        <!-- Closed Inquiries -->
        <div class="stat-card bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Closed Inquiries</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['closed_inquiries'] }}</p>
                    <div class="flex items-center space-x-2 mt-1">
                        <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                            {{ $stats['contacted_inquiries'] }} Contacted
                        </span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="bi bi-check-all text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center text-xs text-gray-500">
                    <i class="bi bi-check-circle text-green-500 mr-1"></i>
                    <span>{{ round(($stats['closed_inquiries'] / max($stats['total_inquiries'], 1)) * 100, 1) }}% closed</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Call Requests -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Call Requests</h3>
                <a href="{{ route('operator.call-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    View All
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentCallRequests as $request)
                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-telephone text-orange-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ Str::limit($request->name, 20) }}</h4>
                            <p class="text-xs text-gray-500">
                                {{ $request->created_at->diffForHumans() }}
                                @if($request->status === 'pending')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                                @elseif($request->status === 'contacted')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Contacted
                                </span>
                                @else
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Completed
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $request->franchise_name ?? 'General' }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="bi bi-telephone-x text-gray-300 text-2xl mb-2"></i>
                    <p class="text-gray-500">No call requests found</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Inquiries -->
        <div class="stat-card bg-white p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Inquiries</h3>
                <a href="{{ route('operator.inquiries.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
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
                                @if($inquiry->status === 'new')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    New
                                </span>
                                @elseif($inquiry->status === 'contacted')
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Contacted
                                </span>
                                @else
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Closed
                                </span>
                                @endif
                            </p>
                        </div>
                    </div>
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
</div>
@endsection