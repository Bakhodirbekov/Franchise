@extends('layouts.app')

@section('title', 'FranchiseShop - Find Your Perfect Franchise Opportunity')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-blue-500 to-purple-600 text-white py-12 md:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-4 md:mb-6">
                        Find Your Perfect
                        <span class="text-yellow-300">Franchise</span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-2xl mb-6 md:mb-8 text-blue-100 max-w-3xl mx-auto px-4">
                        Discover thousands of franchise opportunities and start your entrepreneurial journey today
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-4">
                        <a href="{{ route('franchises.index') }}"
                            class="bg-white text-blue-600 px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-blue-50 transition duration-200 shadow-lg">
                            Browse Franchises
                        </a>
                        <a href="{{ route('register') }}"
                            class="border-2 border-white text-white px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-white hover:text-blue-600 transition duration-200">
                            Get Started Free
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Franchises Section -->
        <section class="py-8 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        Featured Franchise Opportunities
                    </h2>
                    <p class="text-base md:text-xl text-gray-600 max-w-2xl mx-auto px-4">
                        Handpicked franchises with proven success records and comprehensive support
                    </p>
                </div>

                <!-- Franchise Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8 mb-8 md:mb-12">
                    @forelse($featuredFranchises as $franchise)
                        <div
                            class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Image -->
                            <div class="relative h-40 md:h-48 bg-gray-200 rounded-t-xl md:rounded-t-2xl overflow-hidden">
                                @if ($franchise->images->count() > 0)
                                    <img src="{{ Storage::url($franchise->images->first()->path) }}"
                                        alt="{{ $franchise->title }}" class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center">
                                        <i class="bi bi-building text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $franchise->category->name }}
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                        ${{ number_format($franchise->investment_min) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4 md:p-6">
                                <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 line-clamp-2">
                                    {{ $franchise->title }}
                                </h3>

                                <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 line-clamp-2 md:line-clamp-3">
                                    {{ $franchise->short_description }}
                                </p>

                                <!-- Investment Info -->
                                <div class="space-y-1.5 md:space-y-2 mb-3 md:mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs md:text-sm text-gray-500">Investment Range:</span>
                                        <span class="text-sm md:text-base font-bold text-green-600">
                                            ${{ number_format($franchise->investment_min) }} -
                                            ${{ number_format($franchise->investment_max) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs md:text-sm text-gray-500">Royalty Fee:</span>
                                        <span class="text-sm md:text-base font-semibold text-gray-900">{{ $franchise->royalty }}%</span>
                                    </div>
                                </div>

                                <!-- CTA Buttons -->
                                <div class="flex space-x-2 md:space-x-3">
                                    <a href="{{ route('franchises.show', $franchise->slug) }}"
                                        class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-2.5 md:py-3 px-3 md:px-4 rounded-lg md:rounded-xl text-sm md:text-base font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                                        View Details
                                    </a>
                                    <button
                                        class="w-10 h-10 md:w-12 md:h-12 bg-gray-100 text-gray-700 rounded-lg md:rounded-xl hover:bg-gray-200 transition duration-200 flex items-center justify-center"
                                        onclick="showInquiryModal({{ $franchise->id }})" title="Quick Inquiry">
                                        <i class="bi bi-chat-dots text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="bi bi-shop text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">No franchises available</h3>
                            <p class="text-gray-600 mb-6">Check back later for new opportunities</p>
                        </div>
                    @endforelse
                </div>

                <!-- View All Button -->
                @if ($featuredFranchises->count() > 0)
                    <div class="text-center">
                        <a href="{{ route('franchises.index') }}"
                            class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-blue-600 hover:to-purple-700 transition duration-200 shadow-lg">
                            <span>View All Franchises</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Why Choose FranchiseShop?
                    </h2>
                    <p class="text-xl text-gray-600">Everything you need to start your franchise journey</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-shield-check text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Verified Opportunities</h3>
                        <p class="text-gray-600">All franchises are thoroughly vetted for success and reliability</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-headset text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Expert Support</h3>
                        <p class="text-gray-600">Get guidance from franchise experts every step of the way</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-graph-up text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Growth Potential</h3>
                        <p class="text-gray-600">Discover franchises with proven growth and profitability</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Ready to Start Your Franchise Journey?
                </h2>
                <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                    Join thousands of successful franchise owners and take the first step towards business ownership today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition duration-200">
                        Get Started Free
                    </a>
                    <a href="{{ route('franchises.index') }}"
                        class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-blue-600 transition duration-200">
                        Browse Franchises
                    </a>
                </div>
            </div>
        </section>
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
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            value="{{ auth()->user()?->name ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            value="{{ auth()->user()?->email ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                        <input type="tel" name="phone" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            value="{{ auth()->user()?->phone ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea name="message" required rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
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
            function showInquiryModal(franchiseId) {
                document.getElementById('modalFranchiseId').value = franchiseId;
                document.getElementById('inquiryModal').classList.remove('hidden');
            }

            function closeInquiryModal() {
                document.getElementById('inquiryModal').classList.add('hidden');
            }

            // Close modal when clicking outside - setTimeout OLIB TASHLANDI
            document.getElementById('inquiryModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeInquiryModal();
                }
            });
        </script>
    @endpush
@endsection
