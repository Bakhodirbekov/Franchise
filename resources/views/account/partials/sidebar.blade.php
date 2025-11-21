<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
    <!-- User Info -->
    <div class="text-center mb-6">
        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
        <p class="text-gray-600 text-sm">{{ auth()->user()->email }}</p>
        <p class="text-gray-500 text-sm">{{ auth()->user()->phone }}</p>
        
        @if(auth()->user()->company)
            <p class="text-gray-500 text-sm mt-1">{{ auth()->user()->company }}</p>
        @endif
    </div>

    <!-- Navigation -->
    <nav class="space-y-2">
        <a href="{{ route('account.index') }}" 
           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200 {{ request()->routeIs('account.index') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('account.inquiries') }}" 
           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200 {{ request()->routeIs('account.inquiries') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="bi bi-chat-dots"></i>
            <span>My Inquiries</span>
            <span class="ml-auto bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                {{ auth()->user()->inquiries()->count() }}
            </span>
        </a>
        <a href="{{ route('account.orders') }}" 
           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200 {{ request()->routeIs('account.orders') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>My Orders</span>
            <span class="ml-auto bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                {{ auth()->user()->orders()->count() }}
            </span>
        </a>
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition duration-200 {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="bi bi-person"></i>
            <span>Profile Settings</span>
        </a>
        
        @if(auth()->user()->isAdmin())
            <div class="border-t border-gray-200 pt-2 mt-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 text-purple-700 hover:bg-purple-50 rounded-xl font-medium transition duration-200">
                    <i class="bi bi-speedometer2"></i>
                    <span>Admin Panel</span>
                </a>
            </div>
        @endif
    </nav>
</div>