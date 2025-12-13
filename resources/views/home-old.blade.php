@extends('layouts.app')

@section('title', 'DarkRock - Build Your Empire on Solid Foundations')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="gradient-darkrock text-white py-12 md:py-20 relative overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,107,53,0.1) 35px, rgba(255,107,53,0.1) 70px);"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center">
                    <div class="inline-block mb-4">
                        <span class="text-accent text-sm md:text-base font-bold tracking-wider uppercase border border-accent/30 px-4 py-2 rounded-full">Premium Franchise Marketplace</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-6xl font-black mb-4 md:mb-6 tracking-tight">
                        Build Your Empire on
                        <span class="text-accent block mt-2">Solid Foundations</span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 text-gray-300 max-w-3xl mx-auto px-4">
                        Discover premium franchise opportunities backed by proven success. Start your entrepreneurial journey with DarkRock today.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-4">
                        <a href="{{ route('franchises.index') }}"
                            class="gradient-accent text-gray-900 px-6 md:px-8 py-3 md:py-4 rounded-xl font-black text-base md:text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                            <i class="bi bi-search mr-2"></i>Explore Franchises
                        </a>
                        <a href="{{ route('register') }}"
                            class="border-2 border-accent text-accent px-6 md:px-8 py-3 md:py-4 rounded-xl font-black text-base md:text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                            Get Started Free
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Franchises Section -->
        <section class="py-8 md:py-16 bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-3 md:mb-4">
                        Premium Franchise <span class="text-accent">Opportunities</span>
                    </h2>
                    <p class="text-base md:text-xl text-gray-400 max-w-2xl mx-auto px-4">
                        Handpicked franchises with proven success records and rock-solid support
                    </p>
                </div>

                <!-- Franchise Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8 mb-8 md:mb-12">
                    @forelse($featuredFranchises as $franchise)
                        <div
                            class="bg-gray-900 rounded-xl md:rounded-2xl shadow-xl border border-gray-700 hover:border-accent hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-300 transform hover:-translate-y-2 card-hover">
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
                                    <span class="bg-gray-900/90 backdrop-blur text-accent border border-accent/50 px-3 py-1 rounded-full text-sm font-bold">
                                        {{ $franchise->category->name }}
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="bg-accent text-gray-900 px-2 py-1 rounded-full text-xs font-black">
                                        ${{ number_format($franchise->investment_min) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4 md:p-6">
                                <h3 class="text-lg md:text-xl font-black text-white mb-2 md:mb-3 line-clamp-2">
                                    {{ $franchise->title }}
                                </h3>

                                <p class="text-sm md:text-base text-gray-400 mb-3 md:mb-4 line-clamp-2 md:line-clamp-3">
                                    {{ $franchise->short_description }}
                                </p>

                                <!-- Investment Info -->
                                <div class="space-y-1.5 md:space-y-2 mb-3 md:mb-4 bg-gray-800/50 p-3 rounded-lg border border-gray-700">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs md:text-sm text-gray-400">Investment:</span>
                                        <span class="text-sm md:text-base font-bold text-accent">
                                            ${{ number_format($franchise->investment_min) }} -
                                            ${{ number_format($franchise->investment_max) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs md:text-sm text-gray-400">Royalty:</span>
                                        <span class="text-sm md:text-base font-bold text-white">{{ $franchise->royalty }}%</span>
                                    </div>
                                </div>

                                <!-- CTA Buttons -->
                                <div class="flex space-x-2 md:space-x-3">
                                    <a href="{{ route('franchises.show', $franchise->slug) }}"
                                        class="flex-1 gradient-accent text-gray-900 text-center py-2.5 md:py-3 px-3 md:px-4 rounded-lg md:rounded-xl text-sm md:text-base font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                                        View Details
                                    </a>
                                    <button
                                        class="w-10 h-10 md:w-12 md:h-12 bg-gray-800 border border-gray-700 text-accent rounded-lg md:rounded-xl hover:bg-gray-700 hover:border-accent transition duration-200 flex items-center justify-center"
                                        onclick="showInquiryModal({{ $franchise->id }})" title="Quick Inquiry">
                                        <i class="bi bi-chat-dots text-sm md:text-base"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="w-24 h-24 bg-gray-800 border border-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="bi bi-shop text-gray-600 text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-2">No franchises available</h3>
                            <p class="text-gray-400 mb-6">Check back later for new opportunities</p>
                        </div>
                    @endforelse
                </div>

                <!-- View All Button -->
                @if ($featuredFranchises->count() > 0)
                    <div class="text-center">
                        <a href="{{ route('franchises.index') }}"
                            class="inline-flex items-center space-x-2 gradient-accent text-gray-900 px-8 py-4 rounded-xl font-black text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                            <span>View All Franchises</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                        Why Choose <span class="text-accent">DarkRock</span>?
                    </h2>
                    <p class="text-xl text-gray-400">Everything you need to build your empire on solid foundations</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6 bg-gray-800 border border-gray-700 rounded-2xl hover:border-accent transition duration-200">
                        <div class="w-16 h-16 bg-accent/10 border border-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-shield-check text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">Verified Opportunities</h3>
                        <p class="text-gray-400">All franchises are thoroughly vetted for success and reliability</p>
                    </div>

                    <div class="text-center p-6 bg-gray-800 border border-gray-700 rounded-2xl hover:border-accent transition duration-200">
                        <div class="w-16 h-16 bg-accent/10 border border-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-headset text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">Expert Support</h3>
                        <p class="text-gray-400">Get guidance from franchise experts every step of the way</p>
                    </div>

                    <div class="text-center p-6 bg-gray-800 border border-gray-700 rounded-2xl hover:border-accent transition duration-200">
                        <div class="w-16 h-16 bg-accent/10 border border-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-graph-up text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">Growth Potential</h3>
                        <p class="text-gray-400">Discover franchises with proven growth and profitability</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 gradient-darkrock text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(255,107,53,0.1) 35px, rgba(255,107,53,0.1) 70px);"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-black mb-6">
                    Ready to Build Your <span class="text-accent">Empire</span>?
                </h2>
                <p class="text-xl mb-8 text-gray-300 max-w-2xl mx-auto">
                    Join thousands of successful franchise owners and take the first step towards business ownership on solid foundations.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="gradient-accent text-gray-900 px-8 py-4 rounded-xl font-black text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                        Get Started Free
                    </a>
                    <a href="{{ route('franchises.index') }}"
                        class="border-2 border-accent text-accent px-8 py-4 rounded-xl font-black text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                        Explore Franchises
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Inquiry Modal -->
    <div id="inquiryModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-black text-white">Send Inquiry</h3>
                    <button onclick="closeInquiryModal()" class="text-gray-400 hover:text-accent transition duration-200">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <form id="inquiryForm" method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="franchise_id" id="modalFranchiseId">

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Full Name *</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                            value="{{ auth()->user()?->name ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Email Address *</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                            value="{{ auth()->user()?->email ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Phone Number *</label>
                        <input type="tel" name="phone" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                            value="{{ auth()->user()?->phone ?? '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-1">Message *</label>
                        <textarea name="message" required rows="4"
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                            placeholder="Tell us about your interest in this franchise opportunity..."></textarea>
                    </div>

                    <div class="flex space-x-3 pt-2">
                        <button type="button" onclick="closeInquiryModal()"
                            class="flex-1 bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold hover:bg-gray-700 transition duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
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
