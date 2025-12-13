@extends('layouts.app')

@section('title', 'Тест Адаптивности - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-6 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-white mb-4">
                🎨 Тест <span class="text-accent">Адаптивности</span>
            </h1>
            <p class="text-gray-400 text-base md:text-lg">
                Проверка отображения на всех устройствах
            </p>
        </div>

        <!-- Device Info -->
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-black text-white mb-4">Текущее Устройство</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-700/50 p-4 rounded-xl">
                    <p class="text-sm text-gray-400 mb-2">Ширина экрана</p>
                    <p class="text-2xl font-black text-accent" id="screen-width">-</p>
                </div>
                <div class="bg-gray-700/50 p-4 rounded-xl">
                    <p class="text-sm text-gray-400 mb-2">Тип устройства</p>
                    <p class="text-2xl font-black text-white" id="device-type">-</p>
                </div>
                <div class="bg-gray-700/50 p-4 rounded-xl">
                    <p class="text-sm text-gray-400 mb-2">Breakpoint</p>
                    <p class="text-2xl font-black text-green-400" id="breakpoint">-</p>
                </div>
            </div>
        </div>

        <!-- Responsive Grid Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Тест Сетки (1-4 колонки)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                @for($i = 1; $i <= 8; $i++)
                <div class="bg-gray-800 border border-gray-700 hover:border-accent rounded-xl p-6 transition-all">
                    <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl font-black text-accent">{{ $i }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Карточка {{ $i }}</h3>
                    <p class="text-sm text-gray-400">Адаптивная карточка для проверки сетки</p>
                </div>
                @endfor
            </div>
        </div>

        <!-- Stats Cards Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Статистические Карточки</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-5 md:p-6 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="bi bi-chat-dots-fill text-blue-400 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                    </div>
                    <p class="text-4xl font-black text-white mb-1">125</p>
                    <p class="text-sm text-gray-400 font-semibold">Запросов</p>
                </div>

                <div class="bg-gray-800 border border-gray-700 hover:border-green-500 rounded-xl p-5 md:p-6 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="bi bi-box-seam-fill text-green-400 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                    </div>
                    <p class="text-4xl font-black text-white mb-1">45</p>
                    <p class="text-sm text-gray-400 font-semibold">Заказов</p>
                </div>

                <div class="bg-gray-800 border border-gray-700 hover:border-yellow-500 rounded-xl p-5 md:p-6 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="bi bi-hourglass-split text-yellow-400 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-500 uppercase font-bold">Активные</span>
                    </div>
                    <p class="text-4xl font-black text-white mb-1">12</p>
                    <p class="text-sm text-gray-400 font-semibold">В Процессе</p>
                </div>

                <div class="bg-gray-800 border border-gray-700 hover:border-accent rounded-xl p-5 md:p-6 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <i class="bi bi-building text-accent text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-500 uppercase font-bold">Доступно</span>
                    </div>
                    <p class="text-4xl font-black text-white mb-1">500+</p>
                    <p class="text-sm text-gray-400 font-semibold">Франшиз</p>
                </div>
            </div>
        </div>

        <!-- Typography Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Тест Типографики</h2>
            <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 md:p-8">
                <h1 class="text-3xl md:text-4xl font-black text-white mb-3">H1 Заголовок</h1>
                <h2 class="text-2xl md:text-3xl font-black text-white mb-3">H2 Заголовок</h2>
                <h3 class="text-xl md:text-2xl font-bold text-white mb-3">H3 Заголовок</h3>
                <p class="text-base md:text-lg text-gray-400 mb-3">Обычный текст параграфа с адаптивным размером</p>
                <p class="text-sm md:text-base text-gray-500">Маленький текст для описаний</p>
            </div>
        </div>

        <!-- Buttons Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Тест Кнопок</h2>
            <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 md:p-8">
                <div class="flex flex-wrap gap-4">
                    <button class="gradient-accent text-gray-900 px-6 py-3 rounded-xl font-bold hover:shadow-lg transition">
                        Основная Кнопка
                    </button>
                    <button class="border-2 border-accent text-accent px-6 py-3 rounded-xl font-bold hover:bg-accent hover:text-gray-900 transition">
                        Контурная Кнопка
                    </button>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-bold transition">
                        Серая Кнопка
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Layout Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Тест Sidebar Layout</h2>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 sticky top-20">
                        <h3 class="text-lg font-bold text-white mb-4">Меню</h3>
                        <nav class="space-y-2">
                            <a href="#" class="flex items-center gap-3 bg-accent/10 border border-accent text-accent px-4 py-3 rounded-xl font-bold text-sm">
                                <i class="bi bi-house"></i>
                                <span>Главная</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 text-gray-300 px-4 py-3 rounded-xl font-bold text-sm hover:bg-gray-700">
                                <i class="bi bi-search"></i>
                                <span>Поиск</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 text-gray-300 px-4 py-3 rounded-xl font-bold text-sm hover:bg-gray-700">
                                <i class="bi bi-gear"></i>
                                <span>Настройки</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:col-span-3">
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 md:p-8">
                        <h3 class="text-xl font-bold text-white mb-4">Контент</h3>
                        <p class="text-gray-400">Этот блок занимает 3/4 ширины на больших экранах и полную ширину на мобильных.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive Visibility Test -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-white mb-6">Тест Видимости</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-red-900/20 border border-red-500 rounded-xl p-6 block md:hidden">
                    <p class="text-red-400 font-bold">✅ Видно только на MOBILE (< 768px)</p>
                </div>
                <div class="bg-blue-900/20 border border-blue-500 rounded-xl p-6 hidden md:block lg:hidden">
                    <p class="text-blue-400 font-bold">✅ Видно только на TABLET (768px - 1024px)</p>
                </div>
                <div class="bg-green-900/20 border border-green-500 rounded-xl p-6 hidden lg:block">
                    <p class="text-green-400 font-bold">✅ Видно только на DESKTOP (> 1024px)</p>
                </div>
            </div>
        </div>

        <!-- Result Summary -->
        <div class="bg-gradient-to-r from-accent/10 to-orange-600/10 border border-accent rounded-2xl p-8 text-center">
            <div class="w-20 h-20 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle-fill text-accent text-4xl"></i>
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-white mb-3">
                Адаптивность Работает!
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto mb-6">
                Все элементы правильно адаптируются под разные размеры экранов: мобильные телефоны, планшеты, ноутбуки и большие мониторы.
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <span class="bg-gray-800 border border-gray-700 px-4 py-2 rounded-lg text-sm font-bold text-gray-300">
                    📱 Mobile: < 640px
                </span>
                <span class="bg-gray-800 border border-gray-700 px-4 py-2 rounded-lg text-sm font-bold text-gray-300">
                    📱 Tablet: 640px - 1024px
                </span>
                <span class="bg-gray-800 border border-gray-700 px-4 py-2 rounded-lg text-sm font-bold text-gray-300">
                    💻 Desktop: 1024px - 1280px
                </span>
                <span class="bg-gray-800 border border-gray-700 px-4 py-2 rounded-lg text-sm font-bold text-gray-300">
                    🖥️ Large: > 1280px
                </span>
            </div>
        </div>
    </div>
</div>

<script>
    function updateDeviceInfo() {
        const width = window.innerWidth;
        document.getElementById('screen-width').textContent = width + 'px';
        
        let deviceType = '';
        let breakpoint = '';
        
        if (width < 640) {
            deviceType = '📱 Mobile';
            breakpoint = 'XS';
        } else if (width < 768) {
            deviceType = '📱 Mobile L';
            breakpoint = 'SM';
        } else if (width < 1024) {
            deviceType = '📱 Tablet';
            breakpoint = 'MD';
        } else if (width < 1280) {
            deviceType = '💻 Desktop';
            breakpoint = 'LG';
        } else {
            deviceType = '🖥️ Large';
            breakpoint = 'XL';
        }
        
        document.getElementById('device-type').textContent = deviceType;
        document.getElementById('breakpoint').textContent = breakpoint;
    }
    
    updateDeviceInfo();
    window.addEventListener('resize', updateDeviceInfo);
</script>
@endsection
