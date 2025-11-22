@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h1>
            <p class="text-gray-600">Manage your account information and preferences</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sticky top-24">
                    <nav class="space-y-1">
                        <a href="#profile-info" 
                           class="profile-nav-link active flex items-center px-4 py-3 text-sm font-medium rounded-xl transition duration-200"
                           onclick="showSection('profile-info', this)">
                            <i class="bi bi-person mr-3"></i>
                            Profile Information
                        </a>
                        <a href="#password" 
                           class="profile-nav-link flex items-center px-4 py-3 text-sm font-medium rounded-xl transition duration-200"
                           onclick="showSection('password', this)">
                            <i class="bi bi-shield-lock mr-3"></i>
                            Change Password
                        </a>
                        <a href="#delete-account" 
                           class="profile-nav-link flex items-center px-4 py-3 text-sm font-medium rounded-xl transition duration-200"
                           onclick="showSection('delete-account', this)">
                            <i class="bi bi-trash mr-3"></i>
                            Delete Account
                        </a>
                        <div class="border-t border-gray-200 my-2"></div>
                        <a href="{{ route('account.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-xl transition duration-200">
                            <i class="bi bi-arrow-left mr-3"></i>
                            Back to Dashboard
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Profile Information Section -->
                <div id="section-profile-info" class="profile-section bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Profile Information</h2>
                        <p class="text-gray-600">Update your account's profile information and email address.</p>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Password Section -->
                <div id="section-password" class="profile-section hidden bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Change Password</h2>
                        <p class="text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account Section -->
                <div id="section-delete-account" class="profile-section hidden bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Delete Account</h2>
                        <p class="text-gray-600">Permanently delete your account and all associated data.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showSection(sectionId, linkElement) {
    event.preventDefault();
    
    // Hide all sections
    document.querySelectorAll('.profile-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Remove active class from all links
    document.querySelectorAll('.profile-nav-link').forEach(link => {
        link.classList.remove('active', 'bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white');
        link.classList.add('text-gray-700', 'hover:bg-gray-100');
    });
    
    // Show selected section
    document.getElementById('section-' + sectionId).classList.remove('hidden');
    
    // Add active class to clicked link
    linkElement.classList.add('active', 'bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white');
    linkElement.classList.remove('text-gray-700', 'hover:bg-gray-100');
}

// Initialize active state
document.addEventListener('DOMContentLoaded', function() {
    const activeLink = document.querySelector('.profile-nav-link.active');
    if (activeLink) {
        activeLink.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white');
        activeLink.classList.remove('text-gray-700', 'hover:bg-gray-100');
    }
});
</script>
@endpush
@endsection
