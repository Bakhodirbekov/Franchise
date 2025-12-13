@extends('layouts.app')

@section('title', 'О Нас - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Hero Section -->
    <section class="gradient-darkrock text-white py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6">
                О <span class="text-accent">DarkRock</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto">
                Мы создаём надёжный фундамент для вашего предпринимательского успеха
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 md:py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-block mb-4">
                        <span class="text-accent text-sm font-bold uppercase tracking-wider border border-accent/30 px-4 py-2 rounded-full">Наша Миссия</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-6">
                        Строим Будущее Вместе
                    </h2>
                    <p class="text-gray-400 text-lg mb-4">
                        DarkRock — это премиальная платформа, соединяющая амбициозных предпринимателей с проверенными франшизами мирового класса.
                    </p>
                    <p class="text-gray-400 text-lg mb-4">
                        Мы верим, что каждый бизнес должен строиться на прочном фундаменте. Поэтому тщательно отбираем только те франшизы, которые доказали свою эффективность и стабильность.
                    </p>
                    <p class="text-gray-400 text-lg">
                        Наша цель — сделать процесс выбора и запуска франшизы максимально простым, прозрачным и успешным.
                    </p>
                </div>
                <div class="bg-gray-900 border border-gray-700 rounded-2xl p-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-black text-accent mb-2">500+</div>
                            <div class="text-sm text-gray-400">Франшиз</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black text-accent mb-2">1000+</div>
                            <div class="text-sm text-gray-400">Партнёров</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black text-accent mb-2">50+</div>
                            <div class="text-sm text-gray-400">Стран</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black text-accent mb-2">95%</div>
                            <div class="text-sm text-gray-400">Успеха</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 md:py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                    Наши <span class="text-accent">Ценности</span>
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Принципы, которыми мы руководствуемся в работе
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-shield-check text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Надёжность</h3>
                    <p class="text-gray-400">
                        Мы проверяем каждую франшизу и гарантируем качество представленных возможностей.
                    </p>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-lightbulb text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Инновации</h3>
                    <p class="text-gray-400">
                        Используем передовые технологии для упрощения процесса выбора и запуска бизнеса.
                    </p>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-people text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Партнёрство</h3>
                    <p class="text-gray-400">
                        Мы не просто посредники — мы ваши партнёры на пути к успеху.
                    </p>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-star text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Качество</h3>
                    <p class="text-gray-400">
                        Только премиальные франшизы с доказанными результатами попадают на нашу платформу.
                    </p>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-graph-up-arrow text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Рост</h3>
                    <p class="text-gray-400">
                        Мы помогаем вам масштабировать бизнес и достигать новых высот.
                    </p>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-accent/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="bi bi-headset text-accent text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Поддержка</h3>
                    <p class="text-gray-400">
                        Наша команда всегда на связи, готовая помочь на каждом этапе вашего пути.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section (Optional) -->
    <section class="py-16 md:py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                    Наша <span class="text-accent">Команда</span>
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Профессионалы, которые делают DarkRock возможным
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @for($i = 1; $i <= 4; $i++)
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 text-center hover:border-accent hover:shadow-xl transition-all">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl font-black text-gray-900">{{ chr(64 + $i) }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Член Команды {{ $i }}</h3>
                    <p class="text-sm text-accent mb-3">Должность</p>
                    <p class="text-sm text-gray-400">Краткое описание опыта и роли в команде</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-20 bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-black text-white mb-6">
                Готовы Начать <span class="text-accent">Вместе</span>?
            </h2>
            <p class="text-lg text-gray-400 mb-8 max-w-2xl mx-auto">
                Присоединяйтесь к DarkRock и постройте свой бизнес на надёжном фундаменте
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('franchises.index') }}" class="gradient-accent text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all transform hover:scale-105">
                    <i class="bi bi-search mr-2"></i>Посмотреть Франшизы
                </a>
                <a href="{{ route('register') }}" class="border-2 border-accent text-accent px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent hover:text-gray-900 transition">
                    Создать Аккаунт
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
