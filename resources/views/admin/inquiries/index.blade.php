@extends('layouts.admin')

@section('title', 'Manage Inquiries - Admin Panel')

@section('header', 'Inquiries')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Inquiries</h1>
            <p class="text-gray-600 mt-1">View and manage customer inquiries</p>
        </div>
        <div class="flex items-center space-x-4">
            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                {{ $inquiries->where('status', 'new')->count() }} New
            </span>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-blue-600">{{ $inquiries->total() }}</div>
            <div class="text-sm text-gray-600">Total Inquiries</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-yellow-600">{{ $inquiries->where('status', 'new')->count() }}</div>
            <div class="text-sm text-gray-600">New</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-blue-600">{{ $inquiries->where('status', 'contacted')->count() }}</div>
            <div class="text-sm text-gray-600">Contacted</div>
        </div>
        <div class="stat-card bg-white p-4">
            <div class="text-2xl font-bold text-green-600">{{ $inquiries->where('status', 'closed')->count() }}</div>
            <div class="text-sm text-gray-600">Closed</div>
        </div>
    </div>

    <!-- Inquiries Table -->
    <div class="table-container bg-white">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">All Inquiries</h3>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search inquiries..." class="form-input">
                    <select class="form-input">
                        <option value="">All Status</option>
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Franchise</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $inquiry->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $inquiry->phone }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($inquiry->franchise)
                                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->franchise->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $inquiry->franchise->category->name }}</div>
                                @else
                                    <span class="text-sm text-gray-500">General Inquiry</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">{{ $inquiry->message }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge 
                                    {{ $inquiry->status === 'new' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $inquiry->status === 'closed' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $inquiry->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">{{ $inquiry->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-200" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="contacted">
                                        <button type="submit" class="text-green-600 hover:text-green-900 transition duration-200" title="Mark as Contacted">
                                            <i class="bi bi-telephone"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="closed">
                                        <button type="submit" class="text-gray-600 hover:text-gray-900 transition duration-200" title="Mark as Closed">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bi bi-chat-dots text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No inquiries yet</h3>
                                <p class="text-gray-600">Customer inquiries will appear here.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection