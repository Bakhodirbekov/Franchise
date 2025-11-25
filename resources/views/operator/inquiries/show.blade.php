@extends('layouts.operator')

@section('title', 'Inquiry Details - Operator Panel')

@section('header', 'Inquiry Details')

@section('content')
<div class="py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Inquiry Details</h1>
        <a href="{{ route('operator.inquiries.index') }}" class="btn-secondary">
            <i class="bi bi-arrow-left mr-2"></i>Back to Inquiries
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Inquiry Details -->
        <div class="lg:col-span-2">
            <div class="stat-card bg-white p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $inquiry->subject }}</h2>
                        <p class="text-gray-600 mt-1">{{ $inquiry->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    <span class="badge 
                        {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                        {{ ucfirst($inquiry->status) }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Message</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $inquiry->message }}</p>
                    </div>

                    @if($inquiry->franchise)
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Franchise Interest</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="bi bi-shop text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $inquiry->franchise->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $inquiry->franchise->category->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="space-y-6">
            <div class="stat-card bg-white p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $inquiry->name }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center text-gray-600">
                            <i class="bi bi-envelope mr-3 text-gray-400"></i>
                            <span>{{ $inquiry->email }}</span>
                        </div>
                        @if($inquiry->phone)
                            <div class="flex items-center text-gray-600">
                                <i class="bi bi-telephone mr-3 text-gray-400"></i>
                                <span>{{ $inquiry->phone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="stat-card bg-white p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <form action="{{ route('operator.inquiries.update', $inquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="contacted">
                        <button type="submit" class="w-full btn-primary flex items-center justify-center">
                            <i class="bi bi-telephone mr-2"></i>Mark as Contacted
                        </button>
                    </form>

                    <form action="{{ route('operator.inquiries.update', $inquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="closed">
                        <button type="submit" class="w-full btn-secondary flex items-center justify-center">
                            <i class="bi bi-check-lg mr-2"></i>Mark as Closed
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection