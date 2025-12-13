@extends('layouts.app')

@section('title', 'DarkRock - Создайте Свой Бизнес на Надёжном Фундаменте')

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
                        <span class="text-accent text-sm md:text-base font-bold tracking-wider uppercase border border-accent/30 px-4 py-2 rounded-full">Премиальные Франшизы</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-6xl font-black mb-4 md:mb-6 tracking-tight">
                        Создайте Свой Бизнес на
                        <span class="text-accent block mt-2">Надёжном Фундаменте</span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 text-gray-300 max-w-3xl mx-auto px-4">
                        Откройте для себя премиальные франшизы с проверенным успехом. Начните своё предпринимательское путешествие с DarkRock уже сегодня.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-4">
                        <a href="{{ route('franchises.index') }}"
                            class="gradient-accent text-gray-900 px-6 md:px-8 py-3 md:py-4 rounded-xl font-black text-base md:text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                            <i class="bi bi-search mr-2"></i>Смотреть Каталог
                        </a>
                        <a href="{{ route('register') }}"
                            class="border-2 border-accent text-accent px-6 md:px-8 py-3 md:py-4 rounded-xl font-black text-base md:text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                            Начать Бесплатно
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-8 md:py-12 bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                    <div class="text-center p-4">
                        <div class="text-3xl md:text-4xl font-black text-accent mb-2">500+</div>
                        <div class="text-sm md:text-base text-gray-400">Франшиз</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl md:text-4xl font-black text-accent mb-2">1000+</div>
                        <div class="text-sm md:text-base text-gray-400">Партнёров</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl md:text-4xl font-black text-accent mb-2">50+</div>
                        <div class="text-sm md:text-base text-gray-400">Стран</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl md:text-4xl font-black text-accent mb-2">95%</div>
                        <div class="text-sm md:text-base text-gray-400">Успеха</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Franchises Section -->
        <section class="py-8 md:py-16 bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-3 md:mb-4">
                        Премиальные <span class="text-accent">Возможности</span>
                    </h2>
                    <p class="text-base md:text-xl text-gray-400 max-w-2xl mx-auto px-4">
                        Тщательно отобранные франшизы с доказанными результатами и надёжной поддержкой
                    </p>
                </div>

                <!-- Franchise Cards Grid - Адаптивная сетка: 1 колонка мобиль, 2×2 ноутбук -->
                <div class="grid grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4 md:gap-6 lg:gap-8 mb-8 md:mb-12">
                    @forelse($featuredFranchises as $franchise)
                        <div class="bg-gray-900 rounded-xl shadow-xl border border-gray-700 hover:border-accent hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-300 transform hover:-translate-y-2 card-hover flex flex-col h-full overflow-hidden">
                            <!-- Image -->
                            <div class="relative w-full aspect-video bg-gray-200 overflow-hidden flex-shrink-0">
                                @if ($franchise->images->count() > 0)
                                    <img src="{{ Storage::url($franchise->images->first()->path) }}"
                                        alt="{{ $franchise->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center">
                                        <i class="bi bi-building text-gray-400 text-3xl sm:text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
                                    <span class="bg-gray-900/90 backdrop-blur text-accent border border-accent/50 px-2 sm:px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $franchise->category->name }}
                                    </span>
                                </div>
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                            <span class="bg-accent text-gray-900 px-2 sm:px-2.5 py-1 rounded-full text-xs font-black">
                                                ${{ number_format($franchise->investment_min) }}
                                            </span>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Content -->
                            <div class="p-3 sm:p-4 flex flex-col flex-1">
                                <h3 class="text-xs sm:text-sm md:text-base font-black text-white mb-1.5 sm:mb-2 line-clamp-2">
                                    {{ $franchise->title }}
                                </h3>

                                <p class="text-xs text-gray-400 mb-2 sm:mb-3 line-clamp-2 flex-shrink-0">
                                    {{ $franchise->short_description }}
                                </p>

                                <!-- Investment Info -->
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="space-y-0.5 sm:space-y-1 mb-2 sm:mb-3 flex-shrink-0 text-xs">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-500">Инвестиции:</span>
                                                <span class="font-bold text-accent">
                                                    ${{ number_format($franchise->investment_min) }}
                                                </span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-500">Роялти:</span>
                                                <span class="font-bold text-white">
                                                    {{ $franchise->royalty_fee }}%
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endauth

                                <!-- View Details Button -->
                                <div class="mt-auto pt-2 sm:pt-3 border-t border-gray-800">
                                    <a href="{{ route('franchises.show', $franchise->slug) }}"
                                        class="block text-center gradient-accent text-gray-900 py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-bold hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-400 text-lg">Франшизы скоро появятся</p>
                        </div>
                    @endforelse
                </div>

                <!-- View All Button -->
                <div class="text-center">
                    <a href="{{ route('franchises.index') }}"
                        class="inline-block border-2 border-accent text-accent px-8 py-3 rounded-xl font-bold text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                        Смотреть Все Франшизы <i class="bi bi-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-8 md:py-16 bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-3 md:mb-4">
                        Категории <span class="text-accent">Франшиз</span>
                    </h2>
                    <p class="text-base md:text-xl text-gray-400">Найдите идеальную франшизу в вашей отрасли</p>
                </div>

                <!-- Categories Grid - Адаптивная сетка -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                    @forelse($categories as $category)
                        <a href="{{ route('franchises.index', ['category' => $category->id]) }}"
                            class="group bg-gray-800 border border-gray-700 rounded-xl p-4 md:p-6 hover:border-accent hover:shadow-xl hover:shadow-orange-500/20 transition-all duration-300 text-center">
                            <div class="w-12 h-12 md:w-16 md:h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4 group-hover:bg-accent/20 transition">
                                <i class="bi {{ $category->icon ?? 'bi-tag' }} text-accent text-xl md:text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-white text-sm md:text-base mb-1 md:mb-2 group-hover:text-accent transition">
                                {{ $category->name }}
                            </h3>
                            <p class="text-xs md:text-sm text-gray-400">
                                {{ $category->franchises_count ?? 0 }} франшиз
                            </p>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-400">Категории скоро появятся</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-8 md:py-16 bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-3 md:mb-4">
                        Почему <span class="text-accent">DarkRock</span>?
                    </h2>
                    <p class="text-base md:text-xl text-gray-400 max-w-2xl mx-auto">
                        Мы предлагаем всё необходимое для успешного старта вашего бизнеса
                    </p>
                </div>

                <!-- Features Grid - Адаптивная сетка -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-shield-check text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Проверенные Франшизы</h3>
                        <p class="text-gray-400">Каждая франшиза тщательно проверена и имеет доказанную историю успеха</p>
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-headset text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">24/7 Поддержка</h3>
                        <p class="text-gray-400">Наша команда всегда готова помочь вам на каждом этапе</p>
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-graph-up-arrow text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Высокая Доходность</h3>
                        <p class="text-gray-400">Франшизы с высоким потенциалом роста и прибыли</p>
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-book text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Обучение</h3>
                        <p class="text-gray-400">Полное обучение и инструкции для успешного старта</p>
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-people text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Сообщество</h3>
                        <p class="text-gray-400">Присоединяйтесь к сообществу успешных предпринимателей</p>
                    </div>

                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-globe text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Глобальная Сеть</h3>
                        <p class="text-gray-400">Возможности по всему миру с международной поддержкой</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-12 md:py-20 bg-gray-900">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white mb-4 md:mb-6">
                    Готовы Начать Своё <span class="text-accent">Путешествие</span>?
                </h2>
                <p class="text-base md:text-xl text-gray-400 mb-6 md:mb-8 max-w-2xl mx-auto">
                    Присоединяйтесь к тысячам успешных предпринимателей, которые уже построили свой бизнес с DarkRock
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('franchises.index') }}"
                        class="gradient-accent text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                        <i class="bi bi-search mr-2"></i>Посмотреть Франшизы
                    </a>
                    <a href="{{ route('register') }}"
                        class="border-2 border-accent text-accent px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                        Создать Аккаунт
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
