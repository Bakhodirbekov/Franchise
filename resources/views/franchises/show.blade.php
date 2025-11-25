@extends('layouts.app')

@section('title', $franchise->title . ' - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-accent inline-flex items-center">
                        <i class="bi bi-house-door mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-600 mx-2"></i>
                        <a href="{{ route('franchises.index') }}" class="text-gray-400 hover:text-accent">Franchises</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-600 mx-2"></i>
                        <span class="text-white font-bold">{{ $franchise->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image Gallery -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm overflow-hidden">
                    @if($franchise->images->count() > 0)
                        <div class="relative h-96 bg-gray-700">
                            <img src="{{ Storage::url($franchise->images->first()->path) }}" 
                                 alt="{{ $franchise->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="bg-gray-900/90 backdrop-blur text-accent border border-accent/50 px-4 py-2 rounded-full text-sm font-bold">
                                    {{ $franchise->category->name }}
                                </span>
                            </div>
                            @if($franchise->images->count() > 1)
                                <div class="absolute bottom-4 right-4 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-images mr-1"></i> {{ $franchise->images->count() }} Photos
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="h-96 bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <i class="bi bi-building text-gray-600 text-6xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Title & Description -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-8">
                    <h1 class="text-4xl font-black text-white mb-4">{{ $franchise->title }}</h1>
                    
                    <p class="text-xl text-gray-300 mb-6">{{ $franchise->short_description }}</p>
                    
                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-black text-white mb-4">About This Franchise</h2>
                        <div class="text-gray-400 leading-relaxed whitespace-pre-line">{{ $franchise->description }}</div>
                    </div>
                </div>

                <!-- Requirements -->
                @if($franchise->requirements && count($franchise->requirements) > 0)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-8">
                    <h2 class="text-2xl font-black text-white mb-6 flex items-center">
                        <i class="bi bi-check-circle text-accent mr-3"></i>
                        Requirements
                    </h2>
                    <ul class="space-y-3">
                        @foreach($franchise->requirements as $requirement)
                            <li class="flex items-start">
                                <i class="bi bi-check-lg text-accent mr-3 mt-1 flex-shrink-0"></i>
                                <span class="text-gray-300">{{ $requirement }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Related Franchises -->
                @if($relatedFranchises->count() > 0)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-8">
                    <h2 class="text-2xl font-black text-white mb-6">Similar Opportunities</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($relatedFranchises as $related)
                            <a href="{{ route('franchises.show', $related->slug) }}" 
                               class="group border border-gray-700 rounded-xl p-4 hover:shadow-lg hover:border-accent transition duration-200 bg-gray-900/50">
                                <div class="flex gap-4">
                                    @if($related->images->count() > 0)
                                        <img src="{{ Storage::url($related->images->first()->path) }}" 
                                             alt="{{ $related->title }}"
                                             class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="w-20 h-20 bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="bi bi-building text-gray-600"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-black text-white group-hover:text-accent transition duration-200 line-clamp-1">
                                            {{ $related->title }}
                                        </h3>
                                        <p class="text-sm text-gray-400 line-clamp-2 mb-2">{{ $related->short_description }}</p>
                                        <p class="text-sm font-bold text-accent">
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
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <h3 class="text-xl font-black text-white mb-6">Investment Details</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-start pb-4 border-b border-gray-700">
                                <div>
                                    <p class="text-sm text-gray-400 mb-1">Initial Investment</p>
                                    <p class="text-2xl font-black text-white">
                                        ${{ number_format($franchise->investment_min) }}
                                    </p>
                                    <p class="text-sm text-gray-300">to ${{ number_format($franchise->investment_max) }}</p>
                                </div>
                                <div class="bg-accent/10 border border-accent p-2 rounded-lg">
                                    <i class="bi bi-cash-stack text-accent text-xl"></i>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <div>
                                    <p class="text-sm text-gray-400 mb-1">Royalty Fee</p>
                                    <p class="text-xl font-black text-white">{{ $franchise->royalty }}%</p>
                                </div>
                                <div class="bg-accent/10 border border-accent p-2 rounded-lg">
                                    <i class="bi bi-percent text-accent text-xl"></i>
                                </div>
                            </div>

                            @if($franchise->territory)
                            <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                                <div>
                                    <p class="text-sm text-gray-400 mb-1">Territory</p>
                                    <p class="text-base font-bold text-white">{{ $franchise->territory }}</p>
                                </div>
                                <div class="bg-accent/10 border border-accent p-2 rounded-lg">
                                    <i class="bi bi-geo-alt text-accent text-xl"></i>
                                </div>
                            </div>
                            @endif

                            <div class="pt-2">
                                <p class="text-xs text-gray-500 mb-1">Category</p>
                                <span class="inline-block bg-gray-900 border border-gray-700 text-accent px-3 py-1 rounded-full text-sm font-bold">
                                    {{ $franchise->category->name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="gradient-darkrock border border-gray-700 rounded-2xl shadow-sm p-6 text-white">
                        <h3 class="text-xl font-black mb-4">Interested in this franchise?</h3>
                        <p class="text-gray-300 text-sm mb-6">Send us an inquiry and we'll get back to you within 24 hours.</p>
                        
                        <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="franchise_id" value="{{ $franchise->id }}">
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-1">Full Name *</label>
                                <input type="text" name="name" value="{{ auth()->user()?->name }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 bg-gray-800 border border-gray-700 text-white focus:ring-2 focus:ring-accent" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-1">Email Address *</label>
                                <input type="email" name="email" value="{{ auth()->user()?->email }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 bg-gray-800 border border-gray-700 text-white focus:ring-2 focus:ring-accent" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-1">Phone Number *</label>
                                <input type="tel" name="phone" value="{{ auth()->user()?->phone }}" 
                                       class="w-full px-4 py-3 rounded-xl border-0 bg-gray-800 border border-gray-700 text-white focus:ring-2 focus:ring-accent" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-1">Message</label>
                                <textarea name="message" rows="3" 
                                          class="w-full px-4 py-3 rounded-xl border-0 bg-gray-800 border border-gray-700 text-white focus:ring-2 focus:ring-accent"
                                          placeholder="Tell us about your interest..."></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                                <i class="bi bi-send mr-2"></i>Send Inquiry
                            </button>
                            
                            <button type="button" 
                                    onclick="showCallRequestModal({{ $franchise->id }}, '{{ addslashes($franchise->title) }}')"
                                    class="w-full bg-gray-800 border border-gray-700 text-white py-3 rounded-xl font-bold hover:bg-gray-700 transition duration-200 flex items-center justify-center">
                                <i class="bi bi-telephone mr-2"></i>Request a Call
                            </button>
                        </form>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <div class="flex items-center text-sm text-gray-400 mb-3">
                            <i class="bi bi-person text-gray-500 mr-2"></i>
                            Posted by <span class="font-bold text-white ml-1">{{ $franchise->creator->name }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-400">
                            <i class="bi bi-calendar text-gray-500 mr-2"></i>
                            {{ $franchise->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <!-- Company Contact Info -->
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-black text-white mb-3">Company Contact</h3>
                        <p class="text-gray-400 text-sm mb-4">For immediate assistance, call our direct line:</p>
                        <div class="flex items-center justify-between bg-gray-900 p-4 rounded-xl">
                            <span class="font-bold text-accent">+998 87 811 14 44</span>
                            <a href="tel:+998878111444" class="gradient-accent text-gray-900 px-4 py-2 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                                <i class="bi bi-telephone mr-2"></i>Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call Request Modal -->
<div id="callRequestModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-black text-white">Request a Call</h3>
                <button onclick="closeCallRequestModal()" class="text-gray-400 hover:text-accent transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="callRequestForm" method="POST" action="{{ route('call-requests.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="franchise_id" id="callRequestFranchiseId">
                <input type="hidden" name="franchise_name" id="callRequestFranchiseName">
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Full Name *</label>
                    <input type="text" name="name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->name }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Phone Number *</label>
                    <input type="tel" name="phone" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->phone }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Preferred Call Time</label>
                    <select name="call_time" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
                        <option value="">Any time</option>
                        <option value="Morning (9AM - 12PM)">Morning (9AM - 12PM)</option>
                        <option value="Afternoon (12PM - 5PM)">Afternoon (12PM - 5PM)</option>
                        <option value="Evening (5PM - 8PM)">Evening (5PM - 8PM)</option>
                    </select>
                </div>
                
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeCallRequestModal()" 
                            class="flex-1 bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold hover:bg-gray-700 transition duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                        Request Call
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showCallRequestModal(franchiseId, franchiseName) {
        document.getElementById('callRequestFranchiseId').value = franchiseId;
        document.getElementById('callRequestFranchiseName').value = franchiseName;
        document.getElementById('callRequestModal').classList.remove('hidden');
    }
    
    function closeCallRequestModal() {
        document.getElementById('callRequestModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('callRequestModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCallRequestModal();
        }
    });
    
    // Handle form submission with AJAX
    document.getElementById('callRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeCallRequestModal();
                alert(data.message);
            } else {
                alert('Error submitting call request. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting call request. Please try again.');
        });
    });
</script>
@endpush
@endsection
