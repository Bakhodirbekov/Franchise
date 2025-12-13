@extends('layouts.app')

@section('title', 'Мобильный Интерфейс - DarkRock')

@section('content')
<!-- Mobile Full User Interface - Russian Text -->
<div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
    
    <!-- Navigation Header -->
    <div class="sticky top-0 z-50 bg-gray-900/95 backdrop-blur border-b border-gray-700">
        <div class="px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                    <span class="text-white font-black text-sm">DR</span>
                </div>
                <span class="font-black text-white text-sm">DarkRock</span>
            </div>
            <div class="flex items-center space-x-3">
                <button class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300 hover:text-accent transition">
                    <i class="bi bi-bell"></i>
                </button>
                <button class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300 hover:text-accent transition">
                    <i class="bi bi-gear"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Tab Navigation -->
    <div class="bg-gray-800/50 border-b border-gray-700 sticky top-12 z-40">
        <div class="flex overflow-x-auto scrollbar-hide">
            <button class="flex-1 px-4 py-3 text-center text-sm font-bold text-accent border-b-2 border-accent whitespace-nowrap" onclick="switchTab('dashboard')">
                <i class="bi bi-speedometer2 mr-1"></i>Панель
            </button>
            <button class="flex-1 px-4 py-3 text-center text-sm font-bold text-gray-400 border-b-2 border-transparent whitespace-nowrap hover:text-white transition" onclick="switchTab('inquiries')">
                <i class="bi bi-chat-dots mr-1"></i>Запросы
            </button>
            <button class="flex-1 px-4 py-3 text-center text-sm font-bold text-gray-400 border-b-2 border-transparent whitespace-nowrap hover:text-white transition" onclick="switchTab('orders')">
                <i class="bi bi-receipt mr-1"></i>Заказы
            </button>
            <button class="flex-1 px-4 py-3 text-center text-sm font-bold text-gray-400 border-b-2 border-transparent whitespace-nowrap hover:text-white transition" onclick="switchTab('profile')">
                <i class="bi bi-person mr-1"></i>Профиль
            </button>
        </div>
    </div>

    <!-- Content Container -->
    <div class="px-4 py-6">
        
        <!-- ============ DASHBOARD TAB ============ -->
        <div id="dashboard-tab" class="active-tab">
            
            <!-- User Profile Card -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-2xl p-6 mb-6">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-xl font-black flex-shrink-0">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-lg font-black text-white truncate">{{ $user->name ?? 'Пользователь' }}</h2>
                        <p class="text-xs text-gray-400 truncate">{{ $user->email ?? 'email@example.com' }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="bi bi-calendar2"></i> Участник с {{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}
                        </p>
                    </div>
                    <button class="w-10 h-10 rounded-xl bg-gray-700 flex items-center justify-center text-accent hover:bg-gray-600 transition flex-shrink-0">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <!-- Total Inquiries -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-400">Всего Запросов</span>
                        <div class="w-8 h-8 rounded-lg bg-orange-500/20 border border-orange-500/50 flex items-center justify-center">
                            <i class="bi bi-chat-dots text-orange-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-white">5</p>
                    <p class="text-xs text-gray-500 mt-1">+1 на этой неделе</p>
                </div>

                <!-- Active Orders -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-400">Активные Заказы</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-500/20 border border-blue-500/50 flex items-center justify-center">
                            <i class="bi bi-receipt text-blue-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-white">2</p>
                    <p class="text-xs text-gray-500 mt-1">Ожидание оплаты</p>
                </div>

                <!-- Contacted Status -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-400">Ответено</span>
                        <div class="w-8 h-8 rounded-lg bg-green-500/20 border border-green-500/50 flex items-center justify-center">
                            <i class="bi bi-check-circle text-green-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-white">3</p>
                    <p class="text-xs text-gray-500 mt-1">Администратор ответил</p>
                </div>

                <!-- Pending Status -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-gray-400">Ожидающие</span>
                        <div class="w-8 h-8 rounded-lg bg-yellow-500/20 border border-yellow-500/50 flex items-center justify-center">
                            <i class="bi bi-clock text-yellow-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-white">1</p>
                    <p class="text-xs text-gray-500 mt-1">Новые запросы</p>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-black text-white text-base">Недавняя Активность</h3>
                    <a href="#" class="text-xs text-orange-500 hover:text-orange-400 font-bold">Все →</a>
                </div>

                <!-- Activity Item 1 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 mb-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-500/20 border border-orange-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-building text-orange-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white">Запрос на Franch Inc.</p>
                            <p class="text-xs text-gray-400">2 часа назад</p>
                            <span class="inline-block text-xs font-bold bg-yellow-900/50 border border-yellow-500 text-yellow-400 px-2 py-1 rounded-full mt-2">
                                Новый
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Activity Item 2 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 mb-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 border border-blue-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-person-badge text-blue-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white">Ответ Администратора</p>
                            <p class="text-xs text-gray-400">5 часов назад</p>
                            <span class="inline-block text-xs font-bold bg-blue-900/50 border border-blue-500 text-blue-400 px-2 py-1 rounded-full mt-2">
                                Ответено
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Activity Item 3 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-green-500/20 border border-green-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-receipt text-green-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white">Заказ Успешно Создан</p>
                            <p class="text-xs text-gray-400">1 день назад</p>
                            <span class="inline-block text-xs font-bold bg-green-900/50 border border-green-500 text-green-400 px-2 py-1 rounded-full mt-2">
                                Оплачено
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3 sticky bottom-0 bg-gradient-to-t from-gray-900 via-gray-900 to-transparent pt-6 pb-4">
                <button class="w-full gradient-accent text-gray-900 py-3 rounded-xl font-black text-sm hover:shadow-lg hover:shadow-orange-500/50 transition">
                    <i class="bi bi-search mr-2"></i>Посмотреть Франшизы
                </button>
                <button class="w-full bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold text-sm hover:bg-gray-700 transition">
                    <i class="bi bi-chat-dots mr-2"></i>Новый Запрос
                </button>
            </div>
        </div>

        <!-- ============ INQUIRIES TAB ============ -->
        <div id="inquiries-tab" class="hidden-tab">
            
            <!-- Inquiries Stats -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">Всего</p>
                    <p class="text-2xl font-black text-white">5</p>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">Без Ответа</p>
                    <p class="text-2xl font-black text-yellow-400">1</p>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2 mb-4 overflow-x-auto pb-2 scrollbar-hide">
                <button class="px-4 py-2 rounded-full bg-orange-500 text-gray-900 font-bold text-xs whitespace-nowrap hover:bg-orange-400 transition">
                    Все
                </button>
                <button class="px-4 py-2 rounded-full bg-gray-800 border border-gray-700 text-gray-300 font-bold text-xs whitespace-nowrap hover:border-orange-500 transition">
                    Новые
                </button>
                <button class="px-4 py-2 rounded-full bg-gray-800 border border-gray-700 text-gray-300 font-bold text-xs whitespace-nowrap hover:border-orange-500 transition">
                    Ответено
                </button>
                <button class="px-4 py-2 rounded-full bg-gray-800 border border-gray-700 text-gray-300 font-bold text-xs whitespace-nowrap hover:border-orange-500 transition">
                    Закрыто
                </button>
            </div>

            <!-- Inquiry Items -->
            <div class="space-y-4 pb-6">
                <!-- Inquiry Item 1 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 cursor-pointer hover:border-orange-500 transition">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gray-700 border border-gray-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-building text-gray-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm truncate">Франшиза Успешных</h4>
                            <p class="text-xs text-gray-400">Инвестиция: $50K - $100K</p>
                            <p class="text-xs text-gray-500 mt-1">3 дня назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold bg-yellow-900/50 border border-yellow-500 text-yellow-400 px-2 py-1 rounded-full">
                            Новый
                        </span>
                        <i class="bi bi-chevron-right text-gray-400 text-sm"></i>
                    </div>
                </div>

                <!-- Inquiry Item 2 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 cursor-pointer hover:border-orange-500 transition">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gray-700 border border-gray-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-building text-gray-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm truncate">Бизнес Лидер Про</h4>
                            <p class="text-xs text-gray-400">Инвестиция: $75K - $150K</p>
                            <p class="text-xs text-gray-500 mt-1">1 неделя назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-2">
                            <span class="text-xs font-bold bg-blue-900/50 border border-blue-500 text-blue-400 px-2 py-1 rounded-full">
                                <i class="bi bi-envelope-check mr-1"></i>Ответено
                            </span>
                            <span class="text-xs font-bold bg-blue-900/50 border border-blue-500 text-blue-400 px-2 py-1 rounded-full">
                                Контакт
                            </span>
                        </div>
                        <i class="bi bi-chevron-right text-gray-400 text-sm"></i>
                    </div>
                </div>

                <!-- Inquiry Item 3 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 cursor-pointer hover:border-orange-500 transition">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-gray-700 border border-gray-600 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-building text-gray-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm truncate">Тех Инновации</h4>
                            <p class="text-xs text-gray-400">Инвестиция: $100K - $200K</p>
                            <p class="text-xs text-gray-500 mt-1">2 недели назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold bg-green-900/50 border border-green-500 text-green-400 px-2 py-1 rounded-full">
                            Закрыто
                        </span>
                        <i class="bi bi-chevron-right text-gray-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- New Inquiry Button -->
            <div class="sticky bottom-0 bg-gradient-to-t from-gray-900 via-gray-900 to-transparent pt-6 pb-4">
                <button class="w-full gradient-accent text-gray-900 py-3 rounded-xl font-black text-sm hover:shadow-lg hover:shadow-orange-500/50 transition">
                    <i class="bi bi-plus-circle mr-2"></i>Новый Запрос
                </button>
            </div>
        </div>

        <!-- ============ ORDERS TAB ============ -->
        <div id="orders-tab" class="hidden-tab">
            
            <!-- Orders Summary -->
            <div class="grid grid-cols-3 gap-3 mb-6">
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400 mb-1">Всего</p>
                    <p class="text-xl font-black text-white">5</p>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400 mb-1">Оплачено</p>
                    <p class="text-xl font-black text-green-400">3</p>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400 mb-1">Ожидание</p>
                    <p class="text-xl font-black text-yellow-400">2</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="space-y-4 pb-6">
                <!-- Order Item 1 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-green-500/20 border border-green-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-receipt text-green-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm">Франшиза Успешных</h4>
                            <p class="text-xs text-accent font-bold">$55,000</p>
                            <p class="text-xs text-gray-500">Заказ #1001 • 5 дней назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold bg-green-900/50 border border-green-500 text-green-400 px-2 py-1 rounded-full">
                            Оплачено
                        </span>
                        <button class="text-xs text-orange-500 hover:text-orange-400 font-bold">Детали →</button>
                    </div>
                </div>

                <!-- Order Item 2 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-yellow-500/20 border border-yellow-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-receipt text-yellow-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm">Бизнес Лидер Про</h4>
                            <p class="text-xs text-accent font-bold">$95,000</p>
                            <p class="text-xs text-gray-500">Заказ #1002 • 2 дня назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold bg-yellow-900/50 border border-yellow-500 text-yellow-400 px-2 py-1 rounded-full">
                            Ожидание
                        </span>
                        <button class="text-xs text-orange-500 hover:text-orange-400 font-bold">Детали →</button>
                    </div>
                </div>

                <!-- Order Item 3 -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4">
                    <div class="flex items-start space-x-3 mb-3">
                        <div class="w-12 h-12 rounded-lg bg-blue-500/20 border border-blue-500/50 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-receipt text-blue-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-white text-sm">Тех Инновации</h4>
                            <p class="text-xs text-accent font-bold">$125,000</p>
                            <p class="text-xs text-gray-500">Заказ #1003 • 1 неделя назад</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold bg-green-900/50 border border-green-500 text-green-400 px-2 py-1 rounded-full">
                            Оплачено
                        </span>
                        <button class="text-xs text-orange-500 hover:text-orange-400 font-bold">Детали →</button>
                    </div>
                </div>
            </div>

            <!-- Browse Button -->
            <div class="sticky bottom-0 bg-gradient-to-t from-gray-900 via-gray-900 to-transparent pt-6 pb-4">
                <button class="w-full bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold text-sm hover:bg-gray-700 transition">
                    <i class="bi bi-search mr-2"></i>Посмотреть Больше Франшиз
                </button>
            </div>
        </div>

        <!-- ============ PROFILE TAB ============ -->
        <div id="profile-tab" class="hidden-tab">
            
            <!-- Profile Header -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-2xl p-6 mb-6">
                <div class="text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-3xl font-black mx-auto mb-4">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <h2 class="text-xl font-black text-white">{{ $user->name ?? 'Пользователь' }}</h2>
                    <p class="text-sm text-gray-400">{{ $user->email ?? 'email@example.com' }}</p>
                    <div class="mt-4 flex gap-2 justify-center">
                        <span class="text-xs font-bold bg-gray-700 border border-gray-600 text-gray-300 px-3 py-1 rounded-full">
                            <i class="bi bi-phone mr-1"></i>{{ $user->phone ?? '+1 (555) 000-0000' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Profile Menu Items -->
            <div class="space-y-3 mb-6">
                <!-- Personal Information -->
                <button class="w-full bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center justify-between hover:border-orange-500 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-500/20 border border-orange-500/50 flex items-center justify-center">
                            <i class="bi bi-person text-orange-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-white">Личная Информация</p>
                            <p class="text-xs text-gray-400">Обновить профиль</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </button>

                <!-- Change Password -->
                <button class="w-full bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center justify-between hover:border-orange-500 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 border border-blue-500/50 flex items-center justify-center">
                            <i class="bi bi-shield-lock text-blue-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-white">Изменить Пароль</p>
                            <p class="text-xs text-gray-400">Обновить безопасность</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </button>

                <!-- Notifications -->
                <button class="w-full bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center justify-between hover:border-orange-500 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-500/20 border border-purple-500/50 flex items-center justify-center">
                            <i class="bi bi-bell text-purple-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-white">Уведомления</p>
                            <p class="text-xs text-gray-400">Управлять предпочтениями</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </button>

                <!-- Help & Support -->
                <button class="w-full bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center justify-between hover:border-orange-500 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-green-500/20 border border-green-500/50 flex items-center justify-center">
                            <i class="bi bi-question-circle text-green-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-white">Помощь & Поддержка</p>
                            <p class="text-xs text-gray-400">Получить помощь</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </button>

                <!-- Settings -->
                <button class="w-full bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center justify-between hover:border-orange-500 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-700 border border-gray-600 flex items-center justify-center">
                            <i class="bi bi-gear text-gray-300"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-white">Параметры</p>
                            <p class="text-xs text-gray-400">Приватность и данные</p>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400"></i>
                </button>
            </div>

            <!-- Danger Zone -->
            <div class="border-t border-gray-700 pt-6 pb-6">
                <p class="text-xs font-bold text-gray-400 uppercase mb-3">Опасная Зона</p>
                <button class="w-full bg-red-900/20 border border-red-500/50 text-red-400 rounded-xl p-4 font-bold text-sm hover:bg-red-900/30 transition">
                    <i class="bi bi-trash mr-2"></i>Удалить Аккаунт
                </button>
            </div>

            <!-- Logout Button -->
            <div class="sticky bottom-0 bg-gradient-to-t from-gray-900 via-gray-900 to-transparent pt-6 pb-4">
                <button class="w-full bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold text-sm hover:bg-gray-700 transition">
                    <i class="bi bi-box-arrow-right mr-2"></i>Выход
                </button>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
    function switchTab(tabName) {
        // Hide all tabs
        const tabs = document.querySelectorAll('[id$="-tab"]');
        tabs.forEach(tab => {
            tab.classList.remove('active-tab');
            tab.classList.add('hidden-tab');
        });

        // Show selected tab
        const selectedTab = document.getElementById(tabName + '-tab');
        if (selectedTab) {
            selectedTab.classList.remove('hidden-tab');
            selectedTab.classList.add('active-tab');
        }

        // Update button styles
        const buttons = document.querySelectorAll('[onclick^="switchTab"]');
        buttons.forEach(btn => {
            btn.classList.remove('text-accent', 'border-accent');
            btn.classList.add('text-gray-400', 'border-transparent', 'hover:text-white');
        });

        // Highlight active button
        event.target.closest('button').classList.remove('text-gray-400', 'border-transparent', 'hover:text-white');
        event.target.closest('button').classList.add('text-accent', 'border-accent');
    }
</script>
<style>
    .active-tab {
        display: block;
    }

    .hidden-tab {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .gradient-accent {
        @apply bg-gradient-to-r from-orange-500 to-red-600;
    }
</style>
@endpush

@endsection
