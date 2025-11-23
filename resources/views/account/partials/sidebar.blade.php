<div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6">
    <!-- User Info -->
    <div class="text-center mb-6">
        <div
            class="w-20 h-20 gradient-accent rounded-full flex items-center justify-center text-gray-900 text-2xl font-black mx-auto mb-4">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h3 class="text-lg font-black text-white">{{ auth()->user()->name }}</h3>
        <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>
        <p class="text-gray-500 text-sm">{{ auth()->user()->phone }}</p>

        @if (auth()->user()->company)
            <p class="text-gray-500 text-sm mt-1">{{ auth()->user()->company }}</p>
        @endif
    </div>

    <!-- Navigation -->
    <nav class="space-y-2">
        <a href="{{ route('account.index') }}"
            class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200 {{ request()->routeIs('account.index') ? 'bg-accent/10 border border-accent text-accent' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('account.inquiries') }}"
            class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200 {{ request()->routeIs('account.inquiries') ? 'bg-accent/10 border border-accent text-accent' : '' }}">
            <i class="bi bi-chat-dots"></i>
            <span>My Inquiries</span>
            <span
                class="ml-auto bg-accent/10 border border-accent text-accent px-2 py-1 rounded-full text-xs font-bold">
                {{ auth()->user()->inquiries()->count() }}
            </span>
        </a>
        <a href="{{ route('account.orders') }}"
            class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200 {{ request()->routeIs('account.orders') ? 'bg-accent/10 border border-accent text-accent' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>My Orders</span>
            <span
                class="ml-auto bg-accent/10 border border-accent text-accent px-2 py-1 rounded-full text-xs font-bold">
                {{ auth()->user()->orders()->count() }}
            </span>
        </a>
        <a href="{{ route('profile.edit') }}"
            class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-semibold transition duration-200 {{ request()->routeIs('profile.edit') ? 'bg-accent/10 border border-accent text-accent' : '' }}">
            <i class="bi bi-person"></i>
            <span>Profile Settings</span>
        </a>

        @if (auth()->user()->isAdmin())
            <div class="border-t border-gray-600 pt-2 mt-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 text-purple-400 hover:bg-purple-900/20 border border-purple-500/30 rounded-xl font-semibold transition duration-200">
                    <i class="bi bi-speedometer2"></i>
                    <span>Admin Panel</span>
                </a>
            </div>
        @endif
    </nav>
</div>
