<div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-xl p-5 md:p-6 sticky top-20">
    <!-- User Info -->
    <div class="text-center mb-6">
        <div class="w-16 h-16 md:w-20 md:h-20 gradient-accent rounded-2xl flex items-center justify-center text-gray-900 text-xl md:text-2xl font-black mx-auto mb-4 shadow-lg">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h3 class="text-base md:text-lg font-black text-white">{{ auth()->user()->name }}</h3>
        <p class="text-gray-400 text-xs md:text-sm mt-1">{{ auth()->user()->email }}</p>
        @if(auth()->user()->phone)
            <p class="text-gray-500 text-xs md:text-sm">{{ auth()->user()->phone }}</p>
        @endif

        @if (auth()->user()->company)
            <p class="text-gray-500 text-xs md:text-sm mt-1">{{ auth()->user()->company }}</p>
        @endif
    </div>

    <!-- Navigation -->
    <nav class="space-y-2">
        <a href="{{ route('account.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('account.index') ? 'bg-accent/10 border border-accent text-accent' : 'hover:border-gray-600 border border-transparent' }}">
            <i class="bi bi-speedometer2 text-lg"></i>
            <span>Панель</span>
        </a>
        <a href="{{ route('account.inquiries') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('account.inquiries') ? 'bg-accent/10 border border-accent text-accent' : 'hover:border-gray-600 border border-transparent' }}">
            <i class="bi bi-chat-dots text-lg"></i>
            <span>Запросы</span>
            <span class="ml-auto bg-accent/10 border border-accent text-accent px-2 py-0.5 rounded-full text-xs font-bold">
                {{ auth()->user()->inquiries()->count() }}
            </span>
        </a>
        <a href="{{ route('account.orders') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('account.orders') ? 'bg-accent/10 border border-accent text-accent' : 'hover:border-gray-600 border border-transparent' }}">
            <i class="bi bi-box-seam text-lg"></i>
            <span>Заказы</span>
            <span class="ml-auto bg-accent/10 border border-accent text-accent px-2 py-0.5 rounded-full text-xs font-bold">
                {{ auth()->user()->orders()->count() }}
            </span>
        </a>
        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 rounded-xl font-bold text-sm transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-accent/10 border border-accent text-accent' : 'hover:border-gray-600 border border-transparent' }}">
            <i class="bi bi-person-gear text-lg"></i>
            <span>Настройки</span>
        </a>

        @if (auth()->user()->isAdmin())
            <div class="border-t border-gray-700 pt-3 mt-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 bg-purple-900/20 border border-purple-500/30 text-purple-400 hover:bg-purple-900/30 rounded-xl font-bold text-sm transition-all duration-200">
                    <i class="bi bi-shield-lock text-lg"></i>
                    <span>Админ Панель</span>
                </a>
            </div>
        @endif
    </nav>

    <!-- Quick Info -->
    <div class="mt-6 pt-6 border-t border-gray-700">
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <i class="bi bi-shield-check text-green-400"></i>
            <span>Активный аккаунт</span>
        </div>
    </div>
</div>
