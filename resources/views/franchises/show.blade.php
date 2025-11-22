@extends('layouts.app')

@section('title', $franchise->title . ' - FranchiseShop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 inline-flex items-center">
                        <i class="bi bi-house-door mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('franchises.index') }}" class="text-gray-600 hover:text-blue-600">Franchises</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-900 font-medium">{{ $franchise->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image Gallery -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    @if($franchise->images->count() > 0)
                        <div class="relative h-96 bg-gray-200">
                            <img src="{{ Storage::url($franchise->images->first()->path) }}" 
                                 alt="{{ $franchise->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    {{ $franchise->category->name }}
                                </span>
                            </div>
                            @if($franchise->images->count() > 1)
                                <div class="absolute bottom-4 right-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-images mr-1"></i> {{ $franchise->images->count() }} Photos
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="bi bi-building text-gray-400 text-6xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Title & Description -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $franchise->title }}</h1>
                    
                    <p class="text-xl text-gray-600 mb-6">{{ $franchise->short_description }}</p>
                    
                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">About This Franchise</h2>
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $franchise->description }}</div>
                    </div>
                </div>

                <!-- Requirements -->
                @if($franchise->requirements && count($franchise->requirements) > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="bi bi-check-circle text-blue-500 mr-3"></i>
                        Requirements
                    </h2>
                    <ul class="space-y-3">
                        @foreach($franchise->requirements as $requirement)
                            <li class="flex items-start">
                                <i class="bi bi-check-lg text-green-500 mr-3 mt-1 flex-shrink-0"></i>
                                <span class="text-gray-700">{{ $requirement }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Related Franchises -->
                @if($relatedFranchises->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Similar Opportunities</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($relatedFranchises as $related)
                            <a href="{{ route('franchises.show', $related->slug) }}" 
                               class="group border border-gray-200 rounded-xl p-4 hover:shadow-lg hover:border-blue-300 transition duration-200">
                                <div class="flex gap-4">
                                    @if($related->images->count() > 0)
                                        <img src="{{ Storage::url($related->images->first()->path) }}" 
                                             alt="{{ $related->title }}"
                                             class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="bi bi-building text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition duration-200 line-clamp-1">
                                            {{ $related->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $related->short_description }}</p>
                                        <p class="text-sm font-semibold text-green-600">
                                            ${{ number_format($related->investment_min) }}+
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- Investment Details -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Investment Details</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start pb-4 border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Initial Investment</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($franchise->investment_min) }}
                                    </p>
                                    <p class="text-sm text-gray-600">to ${{ number_format($franchise->investment_max) }}</p>
                                </div>
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <i class="bi bi-cash-stack text-green-600 text-xl"></i>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Royalty Fee</p>
                                    <p class="text-xl font-bold text-gray-900">{{ $franchise->royalty }}%</p>
                                </div>
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i class="bi bi-percent text-blue-600 text-xl"></i>
                                </div>
                            </div>

                            @if($franchise->territory)
                            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Territory</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $franchise->territory }}</p>
                                </div>
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <i class="bi bi-geo-alt text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            @endif

                            <div class="pt-2">
                                <p class="text-xs text-gray-500 mb-1">Category</p>
                                <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $franchise->category->name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-sm p-6 text-white">
                        <h3 class="text-xl font-semibold mb-4">Interested in this franchise?</h3>
                        <p class="text-blue-100 text-sm mb-6">Send us an inquiry and we'll get back to you within 24 hours.</p>
                        
                        <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="franchise_id" value="{{ $franchise->id }}">
                            
                            <div>
                                <label class="block text-sm font-medium text-blue-100 mb-1">Full Name *</label>
                                <input type="text" name="name" value="{{ auth()->user()?->name }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 text-gray-900 focus:ring-2 focus:ring-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-blue-100 mb-1">Email Address *</label>
                                <input type="email" name="email" value="{{ auth()->user()?->email }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 text-gray-900 focus:ring-2 focus:ring-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-blue-100 mb-1">Phone Number *</label>
                                <input type="tel" name="phone" value="{{ auth()->user()?->phone }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 text-gray-900 focus:ring-2 focus:ring-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-blue-100 mb-1">Message</label>
                                <textarea name="message" rows="3" 
                                          class="w-full px-4 py-3 rounded-xl border-0 text-gray-900 focus:ring-2 focus:ring-white"
                                          placeholder="Tell us about your interest..."></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-white text-blue-600 py-3 rounded-xl font-semibold hover:bg-gray-100 transition duration-200 shadow-lg">
                                <i class="bi bi-send mr-2"></i>Send Inquiry
                            </button>
                        </form>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="bi bi-person text-gray-400 mr-2"></i>
                            Posted by <span class="font-medium text-gray-900 ml-1">{{ $franchise->creator->name }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="bi bi-calendar text-gray-400 mr-2"></i>
                            {{ $franchise->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
