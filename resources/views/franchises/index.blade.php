@extends('layouts.app')

@section('title', 'Franchise Opportunities - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Franchise <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Opportunities</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover your perfect business opportunity from our curated selection of successful franchise models
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                        <button onclick="resetFilters()" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Reset All
                        </button>
                    </div>
                    
                    <form id="filterForm" method="GET" action="{{ route('franchises.index') }}" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Find franchises..."
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Investment Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Investment Range
                            </label>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs text-gray-500">Min: $<span id="minValue">{{ request('investment_min', 0) }}</span></label>
                                    <input type="range" 
                                           name="investment_min" 
                                           min="0" 
                                           max="1000000" 
                                           step="10000"
                                           value="{{ request('investment_min', 0) }}"
                                           class="w-full range-slider"
                                           oninput="updateRangeValues()">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500">Max: $<span id="maxValue">{{ request('investment_max', 1000000) }}</span></label>
                                    <input type="range" 
                                           name="investment_max" 
                                           min="0" 
                                           max="1000000" 
                                           step="10000"
                                           value="{{ request('investment_max', 1000000) }}"
                                           class="w-full range-slider"
                                           oninput="updateRangeValues()">
                                </div>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                            <select name="sort" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="investment_low_high" {{ request('sort') == 'investment_low_high' ? 'selected' : '' }}>Investment: Low to High</option>
                                <option value="investment_high_low" {{ request('sort') == 'investment_high_low' ? 'selected' : '' }}>Investment: High to Low</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200 shadow-lg">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </div>

            <!-- Franchise Grid -->
            <div class="lg:w-3/4">
                <!-- Results Header -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">
                                {{ $franchises->total() }} Franchise{{ $franchises->total() !== 1 ? 's' : '' }} Found
                            </h2>
                            @if(request()->anyFilled(['search', 'category', 'investment_min', 'investment_max']))
                                <p class="text-gray-600 text-sm mt-1">
                                    Filtered results
                                    @if(request('search')) • "{{ request('search') }}" @endif
                                    @if(request('category')) • {{ $categories->find(request('category'))->name ?? '' }} @endif
                                </p>
                            @endif
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                Page {{ $franchises->currentPage() }} of {{ $franchises->lastPage() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Franchise Cards -->
                @if($franchises->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($franchises as $franchise)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 card-hover overflow-hidden">
                                <!-- Image -->
                                <div class="relative h-48 bg-gray-200 overflow-hidden">
                                    @if($franchise->images->count() > 0)
                                        <img src="{{ Storage::url($franchise->images->first()->path) }}" 
                                             alt="{{ $franchise->title }}"
                                             class="w-full h-full object-cover transition duration-300 hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <i class="bi bi-building text-gray-400 text-4xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            {{ $franchise->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                        {{ $franchise->title }}
                                    </h3>
                                    
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $franchise->short_description }}
                                    </p>

                                    <!-- Investment Info -->
                                    <div class="space-y-2 mb-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">Investment:</span>
                                            <span class="font-semibold text-green-600">
                                                ${{ number_format($franchise->investment_min) }} - ${{ number_format($franchise->investment_max) }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">Royalty Fee:</span>
                                            <span class="font-semibold text-gray-900">{{ $franchise->royalty }}%</span>
                                        </div>
                                        @if($franchise->territory)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">Territory:</span>
                                            <span class="font-medium text-gray-900 text-sm">{{ $franchise->territory }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- CTA Buttons -->
                                    <div class="flex space-x-3">
                                        <a href="{{ route('franchises.show', $franchise->slug) }}" 
                                           class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-2.5 px-4 rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200">
                                            View Details
                                        </a>
                                        <button class="w-12 h-12 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition duration-200 flex items-center justify-center"
                                                onclick="showInquiryModal({{ $franchise->id }})"
                                                title="Quick Inquiry">
                                            <i class="bi bi-chat-dots"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $franchises->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="bi bi-search text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">No franchises found</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            We couldn't find any franchises matching your criteria. Try adjusting your filters or browse all available opportunities.
                        </p>
                        <a href="{{ route('franchises.index') }}" 
                           class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200 inline-flex items-center space-x-2">
                            <span>Browse All Franchises</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Inquiry Modal -->
<div id="inquiryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Send Inquiry</h3>
                <button onclick="closeInquiryModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="inquiryForm" method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="franchise_id" id="modalFranchiseId">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           value="{{ auth()->user()?->name }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                    <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           value="{{ auth()->user()?->email }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                    <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           value="{{ auth()->user()?->phone }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                              placeholder="Tell us about your interest in this franchise opportunity..."></textarea>
                </div>
                
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeInquiryModal()" 
                            class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-xl font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200">
                        Send Inquiry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateRangeValues() {
        document.getElementById('minValue').textContent = 
            parseInt(document.querySelector('input[name="investment_min"]').value).toLocaleString();
        document.getElementById('maxValue').textContent = 
            parseInt(document.querySelector('input[name="investment_max"]').value).toLocaleString();
    }
    
    function resetFilters() {
        document.getElementById('filterForm').reset();
        updateRangeValues();
        document.getElementById('filterForm').submit();
    }
    
    function showInquiryModal(franchiseId) {
        document.getElementById('modalFranchiseId').value = franchiseId;
        document.getElementById('inquiryModal').classList.remove('hidden');
    }
    
    function closeInquiryModal() {
        document.getElementById('inquiryModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('inquiryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeInquiryModal();
        }
    });
    
    // Initialize range values
    updateRangeValues();
</script>
@endpush
@endsection