@extends('layouts.app')

@section('title', 'Manage Franchises - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Franchises</h1>
                <p class="text-gray-600 mt-2">Create and manage franchise opportunities</p>
            </div>
            <a href="{{ route('admin.franchises.create') }}"
                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200 flex items-center space-x-2">
                <i class="bi bi-plus-lg"></i>
                <span>Add New Franchise</span>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-blue-600">{{ $franchises->total() }}</div>
                <div class="text-sm text-gray-600">Total Franchises</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-green-600">{{ $franchises->where('status', 'published')->count() }}</div>
                <div class="text-sm text-gray-600">Published</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-yellow-600">{{ $franchises->where('status', 'draft')->count() }}</div>
                <div class="text-sm text-gray-600">Draft</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-2xl font-bold text-purple-600">{{ $categories->count() }}</div>
                <div class="text-sm text-gray-600">Categories</div>
            </div>
        </div>

        <!-- Franchises Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">All Franchises</h3>
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search franchises..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Franchise
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Investment
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($franchises as $franchise)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if ($franchise->images->count() > 0)
                                                <img class="h-10 w-10 rounded-lg object-cover"
                                                    src="{{ Storage::url($franchise->images->first()->path) }}"
                                                    alt="{{ $franchise->title }}">
                                            @else
                                                <div
                                                    class="h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <i class="bi bi-building text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $franchise->title }}</div>
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($franchise->short_description, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        {{ $franchise->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">${{ number_format($franchise->investment_min) }}</div>
                                    <div class="text-sm text-gray-500">to ${{ number_format($franchise->investment_max) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $franchise->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($franchise->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $franchise->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('franchises.show', $franchise->slug) }}" 
                                           target="_blank"
                                           class="text-blue-600 hover:text-blue-900 transition duration-200"
                                           title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.franchises.edit', $franchise->id) }}"
                                           class="text-green-600 hover:text-green-900 transition duration-200"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.franchises.destroy', $franchise->id) }}"
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this franchise?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition duration-200"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="bi bi-shop text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No franchises found</h3>
                                    <p class="text-gray-600 mb-4">Get started by creating your first franchise opportunity.</p>
                                    <a href="{{ route('admin.franchises.create') }}"
                                       class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                                        Create Franchise
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($franchises->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $franchises->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection