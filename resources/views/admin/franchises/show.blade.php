@extends('layouts.admin')

@section('title', 'Franchise Details - Admin Panel')

@section('header', 'Franchise Details')

@section('content')
<div class="py-6">
    @if(!isset($franchise))
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
            <i class="bi bi-exclamation-triangle text-red-500 text-4xl mb-4"></i>
            <h1 class="text-2xl font-bold text-red-800 mb-2">Franchise Not Found</h1>
            <p class="text-red-600 mb-4">The franchise you are looking for does not exist.</p>
            <a href="{{ route('admin.franchises.index') }}" 
               class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Back to Franchises
            </a>
        </div>
    @else
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition duration-200">Dashboard</a>
            <span class="text-gray-400">›</span>
            <a href="{{ route('admin.franchises.index') }}" class="hover:text-blue-600 transition duration-200">Franchises</a>
            <span class="text-gray-400">›</span>
            <span class="text-gray-900 font-medium">{{ $franchise->title }}</span>
        </nav>

        <!-- Franchise Info -->
        <div class="stat-card bg-white p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $franchise->title }}</h1>
            
            <div class="flex items-center space-x-4 mb-4">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $franchise->category->name ?? 'No Category' }}
                </span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    ${{ number_format($franchise->investment_min) }} - ${{ number_format($franchise->investment_max) }}
                </span>
            </div>

            <p class="text-gray-700 text-lg mb-4">{{ $franchise->short_description }}</p>
            
            <div class="bg-gray-50 rounded-xl p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Description:</h3>
                <p class="text-gray-700">{{ $franchise->description }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="stat-card bg-white p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Actions</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.franchises.edit', $franchise->id) }}"
                   class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 px-4 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                    <i class="bi bi-pencil mr-2"></i>
                    Edit Franchise
                </a>
                
                <form action="{{ route('admin.franchises.destroy', $franchise->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this franchise?')"
                            class="bg-red-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-700 transition duration-200">
                        <i class="bi bi-trash mr-2"></i>
                        Delete Franchise
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection