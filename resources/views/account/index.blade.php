@extends('layouts.app')

@section('title', 'Мой Кабинет - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-6 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-2">Личный Кабинет</h1>
                    <p class="text-base md:text-lg text-gray-400">
                        <span class="text-accent font-bold">{{ $user->name }}</span>, добро пожаловать в DarkRock! 👋
                    </p>
                </div>
                <a href="{{ route('profile.edit') }}" 
                   class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-accent text-white px-5 py-3 rounded-xl font-bold text-sm transition-all duration-200">
                    <i class="bi bi-gear"></i>
                    <span>Настройки</span>
                </a>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-800 border border-gray-700 rounded-2xl p-6 md:p-8 mb-8 shadow-xl">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="w-20 h-20 md:w-24 md:h-24 gradient-accent rounded-2xl flex items-center justify-center text-gray-900 text-3xl md:text-4xl font-black flex-shrink-0 shadow-lg">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-black text-white mb-2">{{ $user->name }}</h2>
                    <p class="text-base text-gray-400 mb-4">
                        <i class="bi bi-envelope mr-2"></i>{{ $user->email }}
                    </p>
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="inline-flex items-center gap-2 bg-gray-700 text-gray-300 px-4 py-2 rounded-lg text-sm font-semibold">
                            <i class="bi bi-calendar-check text-accent"></i>
                            Зарегистрирован: {{ $user->created_at->format('d.m.Y') }}
                        </span>
                        <span class="inline-flex items-center gap-2 bg-gray-700 text-gray-300 px-4 py-2 rounded-lg text-sm font-semibold">
                            <i class="bi bi-shield-check text-green-400"></i>
                            Активный аккаунт
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
            <!-- Inquiries -->
            <div class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                        <i class="bi bi-chat-dots-fill text-blue-400 text-2xl"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                </div>
                <p class="text-4xl font-black text-white mb-1">{{ $user->inquiries()->count() }}</p>
                <p class="text-sm text-gray-400 font-semibold">Запросов</p>
            </div>

            <!-- Orders -->
            <div class="bg-gray-800 border border-gray-700 hover:border-green-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                        <i class="bi bi-box-seam-fill text-green-400 text-2xl"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                </div>
                <p class="text-4xl font-black text-white mb-1">{{ $user->orders()->count() }}</p>
                <p class="text-sm text-gray-400 font-semibold">Заказов</p>
            </div>

            <!-- Active Inquiries -->
            <div class="bg-gray-800 border border-gray-700 hover:border-yellow-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                        <i class="bi bi-hourglass-split text-yellow-400 text-2xl"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase font-bold">Активные</span>
                </div>
                <p class="text-4xl font-black text-white mb-1">{{ $user->inquiries()->whereIn('status', ['new', 'contacted'])->count() }}</p>
                <p class="text-sm text-gray-400 font-semibold">В процессе</p>
            </div>

            <!-- Franchises -->
            <div class="bg-gray-800 border border-gray-700 hover:border-accent rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/10">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                        <i class="bi bi-building text-accent text-2xl"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase font-bold">Доступно</span>
                </div>
                <p class="text-4xl font-black text-white mb-1">{{ App\Models\Franchise::where('status', 'active')->count() }}</p>
                <p class="text-sm text-gray-400 font-semibold">Франшиз</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
            <!-- Sidebar: Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 sticky top-20">
                    <h3 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
                        <i class="bi bi-grid-3x3-gap text-accent"></i>
                        Быстрые Действия
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('account.index') }}" 
                           class="flex items-center gap-3 bg-accent/10 border border-accent text-accent px-4 py-3.5 rounded-xl font-bold text-sm hover:bg-accent/20 transition-all duration-200 group">
                            <i class="bi bi-speedometer2 text-lg"></i>
                            <span>Панель управления</span>
                        </a>
                        <a href="{{ route('account.inquiries') }}" 
                           class="flex items-center gap-3 bg-gray-700/50 border border-gray-600 text-gray-300 px-4 py-3.5 rounded-xl font-bold text-sm hover:border-accent hover:text-accent transition-all duration-200 group">
                            <i class="bi bi-chat-dots text-lg"></i>
                            <span>Мои Запросы</span>
                        </a>
                        <a href="{{ route('account.orders') }}" 
                           class="flex items-center gap-3 bg-gray-700/50 border border-gray-600 text-gray-300 px-4 py-3.5 rounded-xl font-bold text-sm hover:border-accent hover:text-accent transition-all duration-200 group">
                            <i class="bi bi-box-seam text-lg"></i>
                            <span>Мои Заказы</span>
                        </a>
                        <a href="{{ route('franchises.index') }}" 
                           class="flex items-center gap-3 bg-gray-700/50 border border-gray-600 text-gray-300 px-4 py-3.5 rounded-xl font-bold text-sm hover:border-accent hover:text-accent transition-all duration-200 group">
                            <i class="bi bi-search text-lg"></i>
                            <span>Каталог Франшиз</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-3 bg-gray-700/50 border border-gray-600 text-gray-300 px-4 py-3.5 rounded-xl font-bold text-sm hover:border-accent hover:text-accent transition-all duration-200 group">
                            <i class="bi bi-person-gear text-lg"></i>
                            <span>Профиль</span>
                        </a>
                    </div>

                    <!-- Quick Info -->
                    <div class="mt-6 pt-6 border-t border-gray-700">
                        <h4 class="text-sm font-bold text-gray-400 mb-3">Информация</h4>
                        <div class="space-y-2 text-xs">
                            <p class="text-gray-500">
                                <i class="bi bi-info-circle mr-1"></i>
                                Нужна помощь? <a href="#" class="text-accent hover:underline">Поддержка</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content: Recent Activity -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Recent Inquiries Section -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 md:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-xl md:text-2xl font-black text-white flex items-center gap-2">
                                <i class="bi bi-clock-history text-accent"></i>
                                Последние Запросы
                            </h3>
                            <p class="text-sm text-gray-400 mt-1">Ваша активность по франшизам</p>
                        </div>
                        <a href="{{ route('account.inquiries') }}" 
                           class="inline-flex items-center gap-2 text-accent hover:text-orange-400 font-bold text-sm transition-all group">
                            <span>Смотреть все</span>
                            <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                    
                    @if($recentInquiries->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentInquiries as $inquiry)
                                <div class="bg-gray-700/30 border border-gray-600 hover:border-accent rounded-xl p-5 transition-all duration-300 hover:shadow-lg group">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                                        <div class="flex-1">
                                            <div class="flex items-start gap-3 mb-2">
                                                <div class="w-10 h-10 bg-accent/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                                    <i class="bi bi-building text-accent"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-white text-base group-hover:text-accent transition-colors">
                                                        {{ $inquiry->franchise->title ?? 'Общий запрос' }}
                                                    </h4>
                                                    <p class="text-sm text-gray-400 mt-1 flex items-center gap-2">
                                                        <i class="bi bi-calendar3 text-xs"></i>
                                                        {{ $inquiry->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2
                                                {{ $inquiry->status === 'new' ? 'bg-yellow-900/30 text-yellow-400 border border-yellow-500/50' : '' }}
                                                {{ $inquiry->status === 'contacted' ? 'bg-blue-900/30 text-blue-400 border border-blue-500/50' : '' }}
                                                {{ $inquiry->status === 'closed' ? 'bg-green-900/30 text-green-400 border border-green-500/50' : '' }}">
                                                <i class="bi bi-circle-fill text-xs"></i>
                                                {{ $inquiry->status === 'new' ? 'Новый' : ($inquiry->status === 'contacted' ? 'В обработке' : 'Завершён') }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($inquiry->admin_response)
                                        <div class="mt-4 p-4 bg-blue-900/20 border border-blue-500/30 rounded-lg">
                                            <p class="text-sm font-bold text-blue-400 mb-2 flex items-center gap-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Ответ администратора:
                                            </p>
                                            <p class="text-sm text-gray-300">{{ Str::limit($inquiry->admin_response, 100) }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-inbox text-gray-500 text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">Пока нет запросов</h4>
                            <p class="text-gray-400 mb-6 max-w-md mx-auto">Начните изучать наш каталог франшиз и отправьте свой первый запрос</p>
                            <a href="{{ route('franchises.index') }}" 
                               class="inline-flex items-center gap-2 gradient-accent text-gray-900 px-6 py-3 rounded-xl font-bold hover:shadow-lg hover:shadow-orange-500/50 transition-all">
                                <i class="bi bi-search"></i>
                                <span>Открыть Каталог</span>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Quick Access Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Browse Franchises -->
                    <a href="{{ route('franchises.index') }}" 
                       class="bg-gradient-to-br from-gray-800 to-gray-800 border border-gray-700 hover:border-accent rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-accent/10 group">
                        <div class="w-14 h-14 bg-accent/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="bi bi-search text-accent text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2 group-hover:text-accent transition-colors">Каталог Франшиз</h4>
                        <p class="text-sm text-gray-400">Изучите доступные франшизы и найдите идеальный вариант для вашего бизнеса</p>
                    </a>

                    <!-- My Orders -->
                    <a href="{{ route('account.orders') }}" 
                       class="bg-gradient-to-br from-gray-800 to-gray-800 border border-gray-700 hover:border-green-500 rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 group">
                        <div class="w-14 h-14 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="bi bi-box-seam text-green-400 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2 group-hover:text-green-400 transition-colors">Мои Заказы</h4>
                        <p class="text-sm text-gray-400">Отслеживайте статус ваших заказов и управляйте покупками</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection