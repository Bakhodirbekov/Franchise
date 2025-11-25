@extends('layouts.admin')

@section('title', 'Inquiry Details - Admin Panel')

@section('header', 'Inquiry Details')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('admin.inquiries.index') }}" class="text-blue-600 hover:text-blue-700 transition duration-200 flex items-center space-x-2">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Inquiries</span>
            </a>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Inquiry #{{ $inquiry->id }}</span>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Inquiry Details</h1>
        <p class="text-gray-600 mt-1">View and manage customer inquiry</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Inquiry Information -->
            <div class="stat-card bg-white p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                        <p class="text-gray-900 font-medium">{{ $inquiry->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-gray-900">{{ $inquiry->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                        <p class="text-gray-900">{{ $inquiry->phone }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Inquiry Date</label>
                        <p class="text-gray-900">{{ $inquiry->created_at->format('M d, Y - h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="stat-card bg-white p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Message</h3>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-700 whitespace-pre-line">{{ $inquiry->message }}</p>
                </div>
            </div>

            <!-- Franchise Information -->
            @if($inquiry->franchise)
            <div class="stat-card bg-white p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Franchise Information</h3>
                
                <div class="flex items-center space-x-4 mb-4">
                    @if($inquiry->franchise->images->count() > 0)
                        <img src="{{ Storage::url($inquiry->franchise->images->first()->path) }}" 
                             alt="{{ $inquiry->franchise->title }}"
                             class="w-16 h-16 object-cover rounded-lg">
                    @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="bi bi-building text-gray-400"></i>
                        </div>
                    @endif
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ $inquiry->franchise->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $inquiry->franchise->category->name }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Investment:</span>
                        <span class="font-medium text-gray-900">
                            ${{ number_format($inquiry->franchise->investment_min) }} - ${{ number_format($inquiry->franchise->investment_max) }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Royalty:</span>
                        <span class="font-medium text-gray-900">{{ $inquiry->franchise->royalty }}%</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Status Management -->
            <div class="stat-card bg-white p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Management</h3>
                
                <div class="space-y-4">
                    <!-- Current Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Current Status</label>
                        <span class="px-3 py-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                            {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ ucfirst($inquiry->status) }}
                        </span>
                    </div>

                    <!-- Update Status -->
                    <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Update Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Admin Notes (Internal Only)</label>
                            <textarea name="admin_note" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Add internal notes (not visible to user)...">{{ old('admin_note', $inquiry->admin_note) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Response to User (Visible to User)</label>
                            <textarea name="admin_response" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Write a response that the user will see...">{{ old('admin_response', $inquiry->admin_response) }}</textarea>
                            @if($inquiry->admin_response_at)
                                <p class="text-xs text-gray-500 mt-1">Last updated: {{ $inquiry->admin_response_at->format('M d, Y - h:i A') }}</p>
                            @endif
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                            Update Inquiry
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="stat-card bg-white p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="mailto:{{ $inquiry->email }}" 
                       class="w-full flex items-center justify-center space-x-2 bg-blue-50 text-blue-700 py-2 rounded-lg font-medium hover:bg-blue-100 transition duration-200">
                        <i class="bi bi-envelope"></i>
                        <span>Send Email</span>
                    </a>
                    
                    <a href="tel:{{ $inquiry->phone }}" 
                       class="w-full flex items-center justify-center space-x-2 bg-green-50 text-green-700 py-2 rounded-lg font-medium hover:bg-green-100 transition duration-200">
                        <i class="bi bi-telephone"></i>
                        <span>Call Customer</span>
                    </a>
                    
                    @if($inquiry->franchise)
                    <a href="{{ route('franchises.show', $inquiry->franchise->slug) }}" 
                       target="_blank"
                       class="w-full flex items-center justify-center space-x-2 bg-gray-50 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-100 transition duration-200">
                        <i class="bi bi-eye"></i>
                        <span>View Franchise</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection