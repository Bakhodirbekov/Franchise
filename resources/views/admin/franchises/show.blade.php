@extends('layouts.app')

@section('title', 'Franchise Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(!isset($franchise))
            <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                <i class="bi bi-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                <h1 class="text-2xl font-bold text-red-800 mb-2">Franchise Not Found</h1>
                <p class="text-red-600 mb-4">The franchise you are looking for does not exist.</p>
                <a href="{{ route('franchises.index') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Browse All Franchises
                </a>
            </div>
        @else
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition duration-200">Home</a>
                <span class="text-gray-400">›</span>
                <a href="{{ route('franchises.index') }}" class="hover:text-blue-600 transition duration-200">Franchises</a>
                <span class="text-gray-400">›</span>
                <span class="text-gray-900 font-medium">{{ $franchise->title }}</span>
            </nav>

            <!-- Simple Franchise Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $franchise->title }}</h1>
                
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

            <!-- Simple Action Buttons -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Get More Information</h3>
                <button onclick="showInquiryModal({{ $franchise->id }})" 
                        class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-200">
                    <i class="bi bi-chat-dots mr-2"></i>
                    Request Information
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Simple Inquiry Modal -->
<div id="inquiryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Request Information</h3>
        
        <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="franchise_id" id="modalFranchiseId">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                <input type="tel" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div class="flex space-x-3">
                <button type="button" onclick="closeInquiryModal()" 
                        class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-medium">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showInquiryModal(franchiseId) {
    document.getElementById('modalFranchiseId').value = franchiseId;
    document.getElementById('inquiryModal').classList.remove('hidden');
}

function closeInquiryModal() {
    document.getElementById('inquiryModal').classList.add('hidden');
}

document.getElementById('inquiryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeInquiryModal();
    }
});
</script>
@endsection