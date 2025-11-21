@extends('layouts.app')

@section('title', 'Edit Franchise - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.franchises.index') }}" class="text-blue-600 hover:text-blue-700 transition duration-200 flex items-center space-x-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Franchises</span>
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Franchise</h1>
            <p class="text-gray-600 mt-2">Update franchise information</p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.franchises.update', $franchise->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Basic Information</h3>
                    </div>

                    <!-- Title -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Franchise Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               required 
                               value="{{ old('title', $franchise->title) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="Enter franchise title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category *
                        </label>
                        <select name="category_id" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $franchise->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status *
                        </label>
                        <select name="status" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="draft" {{ old('status', $franchise->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $franchise->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Short Description *
                        </label>
                        <textarea name="short_description" 
                                  required 
                                  rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Brief description (max 255 characters)">{{ old('short_description', $franchise->short_description) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">{{ Str::length(old('short_description', $franchise->short_description)) }}/255 characters</p>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Description -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Full Description *
                        </label>
                        <textarea name="description" 
                                  required 
                                  rows="6" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Detailed description of the franchise opportunity">{{ old('description', $franchise->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Investment Information -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Investment Information</h3>
                    </div>

                    <!-- Min Investment -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Minimum Investment ($) *
                        </label>
                        <input type="number" 
                               name="investment_min" 
                               required 
                               value="{{ old('investment_min', $franchise->investment_min) }}" 
                               step="1000" 
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., 50000">
                        @error('investment_min')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Investment -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Maximum Investment ($) *
                        </label>
                        <input type="number" 
                               name="investment_max" 
                               required 
                               value="{{ old('investment_max', $franchise->investment_max) }}" 
                               step="1000" 
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., 200000">
                        @error('investment_max')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Royalty -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Royalty Fee (%) *
                        </label>
                        <input type="number" 
                               name="royalty" 
                               required 
                               value="{{ old('royalty', $franchise->royalty) }}" 
                               step="0.1" 
                               min="0" 
                               max="100"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., 5.0">
                        @error('royalty')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Territory -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Territory
                        </label>
                        <input type="text" 
                               name="territory" 
                               value="{{ old('territory', $franchise->territory) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="e.g., National, Regional, City">
                        @error('territory')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Requirements -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Requirements
                        </label>
                        <textarea name="requirements" 
                                  rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Enter requirements separated by commas&#10;Example: Business experience, Liquid capital, Management skills">{{ old('requirements', $franchise->requirements ? implode(', ', $franchise->requirements) : '') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter requirements separated by commas</p>
                        @error('requirements')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Images -->
                    @if($franchise->images->count() > 0)
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Current Images
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($franchise->images as $image)
                            <div class="relative">
                                <img src="{{ Storage::url($image->path) }}" 
                                     alt="{{ $image->alt }}" 
                                     class="w-full h-32 object-cover rounded-lg">
                                <div class="absolute top-2 right-2">
                                    <button type="button" 
                                            onclick="deleteImage({{ $image->id }})"
                                            class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600 transition duration-200">
                                        <i class="bi bi-trash text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- New Images -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Add New Images
                        </label>
                        <input type="file" 
                               name="images[]" 
                               multiple 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <p class="mt-1 text-sm text-gray-500">Upload multiple images (JPEG, PNG, WebP, max 5MB each)</p>
                        @error('images')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.franchises.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-200 transition duration-200 text-center">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                        Update Franchise
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Image Form -->
<form id="deleteImageForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Character counter for short description - setTimeout OLIB TASHLANDI
document.addEventListener('DOMContentLoaded', function() {
    const shortDesc = document.querySelector('textarea[name="short_description"]');
    const counter = document.querySelector('.text-gray-500');
    
    if (shortDesc && counter) {
        shortDesc.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + '/255 characters';
            
            if (length > 255) {
                counter.classList.add('text-red-600');
            } else {
                counter.classList.remove('text-red-600');
            }
        });
        
        // Trigger on load - setTimeout OLIB TASHLANDI
        if (shortDesc.value) {
            shortDesc.dispatchEvent(new Event('input'));
        }
    }
});

// Delete image function - setTimeout OLIB TASHLANDI
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        const form = document.getElementById('deleteImageForm');
        form.action = `/admin/franchise-images/${imageId}`;
        form.submit();
    }
}
</script>
@endsection