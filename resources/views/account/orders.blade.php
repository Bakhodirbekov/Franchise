@extends('layouts.app')

@section('title', 'My Orders - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-black text-white">My Orders</h1>
            <p class="text-gray-400 mt-2">View your franchise purchase orders</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('account.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Orders List -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-700">
                        <h3 class="text-lg font-black text-white">Order History</h3>
                    </div>

                    @if($orders->count() > 0)
                        <div class="divide-y divide-gray-700">
                            @foreach($orders as $order)
                            <div class="p-6 hover:bg-gray-900/50 transition duration-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4 mb-3">
                                            @if($order->franchise)
                                                @if($order->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($order->franchise->images->first()->path) }}" 
                                                         alt="{{ $order->franchise->title }}"
                                                         class="w-16 h-16 object-cover rounded-lg border border-gray-700">
                                                @else
                                                    <div class="w-16 h-16 bg-gray-700 border border-gray-600 rounded-lg flex items-center justify-center">
                                                        <i class="bi bi-building text-gray-500"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-black text-white">{{ $order->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-400">{{ $order->franchise->category->name }}</p>
                                                    <p class="text-lg font-black text-accent">${{ number_format($order->amount) }}</p>
                                                </div>
                                            @else
                                                <div class="w-16 h-16 bg-gray-700 border border-gray-600 rounded-lg flex items-center justify-center">
                                                    <i class="bi bi-receipt text-gray-500"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-black text-white">Order #{{ $order->id }}</h4>
                                                    <p class="text-sm text-gray-400">General Purchase</p>
                                                    <p class="text-lg font-black text-accent">${{ number_format($order->amount) }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div>
                                                <span class="text-gray-400">Order Date:</span>
                                                <p class="text-gray-300">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-400">Currency:</span>
                                                <p class="text-gray-300">{{ $order->currency }}</p>
                                            </div>
                                            <div>
                                                <span class="text-gray-400">Order ID:</span>
                                                <p class="text-gray-300">#{{ $order->id }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-4 text-right">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $order->status === 'pending' ? 'bg-yellow-900/50 border border-yellow-500 text-yellow-400' : '' }}
                                            {{ $order->status === 'paid' ? 'bg-green-900/50 border border-green-500 text-green-400' : '' }}
                                            {{ $order->status === 'failed' ? 'bg-red-900/50 border border-red-500 text-red-400' : '' }}
                                            {{ $order->status === 'refunded' ? 'bg-gray-900/50 border border-gray-500 text-gray-400' : '' }}">
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
                        <div class="px-6 py-4 border-t border-gray-700">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-8 text-center">
                            <div class="w-24 h-24 bg-gray-700 border border-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-receipt text-gray-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-black text-white mb-2">No orders yet</h3>
                            <p class="text-gray-400 mb-4">You haven't placed any orders yet.</p>
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