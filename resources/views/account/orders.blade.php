@extends('layouts.app')

@section('title', 'My Orders - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
            <p class="text-gray-600 mt-2">View your franchise purchase orders</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('account.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Orders List -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Order History</h3>
                    </div>

                    @if($orders->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach($orders as $order)
                            <div class="p-6 hover:bg-gray-50 transition duration-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4 mb-3">
                                            @if($order->franchise)
                                                @if($order->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($order->franchise->images->first()->path) }}" 
                                                         alt="{{ $order->franchise->title }}"
                                                         class="w-16 h-16 object-cover rounded-lg">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="bi bi-building text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900">{{ $order->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $order->franchise->category->name }}</p>
                                                    <p class="text-lg font-bold text-green-600">${{ number_format($order->amount) }}</p>
                                                </div>
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="bi bi-receipt text-gray-400"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">Order #{{ $order->id }}</h4>
                                                    <p class="text-sm text-gray-600">General Purchase</p>
                                                    <p class="text-lg font-bold text-green-600">${{ number_format($order->amount) }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div>
                                                <span class="text-gray-600">Order Date:</span>
                                                <p class="text-gray-900">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Currency:</span>
                                                <p class="text-gray-900">{{ $order->currency }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Order ID:</span>
                                                <p class="text-gray-900">#{{ $order->id }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-4 text-right">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $order->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $order->status === 'refunded' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-2">{{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($orders->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-8 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-receipt text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No orders yet</h3>
                            <p class="text-gray-600 mb-4">You haven't placed any orders yet.</p>
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