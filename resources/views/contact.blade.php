@extends('layouts.app')

@section('title', 'Контакты - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Hero Section -->
    <section class="gradient-darkrock text-white py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6">
                Свяжитесь <span class="text-accent">с Нами</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                Мы всегда готовы ответить на ваши вопросы и помочь вам начать своё предпринимательское путешествие
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-12 md:py-16 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Phone -->
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-telephone-fill text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Телефон</h3>
                        <p class="text-gray-400 mb-3">Звоните нам с понедельника по пятницу</p>
                        <a href="tel:+1234567890" class="text-accent hover:text-orange-400 font-bold">
                            +1 (234) 567-890
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-envelope-fill text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Email</h3>
                        <p class="text-gray-400 mb-3">Напишите нам — ответим в течение 24 часов</p>
                        <a href="mailto:info@darkrock.com" class="text-accent hover:text-orange-400 font-bold">
                            info@darkrock.com
                        </a>
                    </div>

                    <!-- Address -->
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-geo-alt-fill text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Адрес</h3>
                        <p class="text-gray-400 mb-3">Наш офис</p>
                        <p class="text-white font-semibold">
                            123 Franchise Street<br>
                            Business District<br>
                            New York, NY 10001
                        </p>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition-all">
                        <div class="w-14 h-14 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="bi bi-clock-fill text-accent text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Часы Работы</h3>
                        <div class="space-y-2 text-gray-400">
                            <div class="flex justify-between">
                                <span>Понедельник - Пятница:</span>
                                <span class="text-white font-semibold">9:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Суббота:</span>
                                <span class="text-white font-semibold">10:00 - 16:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Воскресенье:</span>
                                <span class="text-white font-semibold">Выходной</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 md:p-8">
                        <h2 class="text-2xl md:text-3xl font-black text-white mb-6">Отправить Сообщение</h2>
                        
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-300 mb-2">
                                        Ваше Имя <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition"
                                        placeholder="Иван Иванов">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition"
                                        placeholder="ivan@example.com">
                                </div>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-bold text-gray-300 mb-2">
                                    Телефон
                                </label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition"
                                    placeholder="+7 (999) 123-45-67">
                            </div>

                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-bold text-gray-300 mb-2">
                                    Тема <span class="text-red-500">*</span>
                                </label>
                                <select id="subject" name="subject" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition">
                                    <option value="">Выберите тему...</option>
                                    <option value="general">Общий вопрос</option>
                                    <option value="franchise">Вопрос о франшизе</option>
                                    <option value="partnership">Партнёрство</option>
                                    <option value="support">Техническая поддержка</option>
                                    <option value="other">Другое</option>
                                </select>
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-300 mb-2">
                                    Сообщение <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" name="message" rows="6" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition"
                                    placeholder="Расскажите нам о вашем запросе..."></textarea>
                            </div>

                            <!-- Privacy Policy -->
                            <div class="flex items-start">
                                <input type="checkbox" id="privacy" name="privacy" required
                                    class="w-5 h-5 text-accent bg-gray-800 border-gray-700 rounded focus:ring-accent focus:ring-2 mt-0.5">
                                <label for="privacy" class="ml-3 text-sm text-gray-400">
                                    Я согласен с <a href="#" class="text-accent hover:text-orange-400">политикой конфиденциальности</a> и обработкой персональных данных
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full gradient-accent text-gray-900 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="bi bi-send-fill mr-2"></i>Отправить Сообщение
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <section class="py-12 md:py-16 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden h-96">
                <!-- Placeholder for map - можно интегрировать Google Maps или другой сервис -->
                <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                    <div class="text-center">
                        <i class="bi bi-map text-gray-500 text-6xl mb-4"></i>
                        <p class="text-gray-400">Карта местоположения</p>
                        <p class="text-sm text-gray-500 mt-2">Интеграция с картами</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 md:py-16 bg-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                    Часто Задаваемые <span class="text-accent">Вопросы</span>
                </h2>
                <p class="text-lg text-gray-400">Возможно, ответ на ваш вопрос уже здесь</p>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent transition-all">
                    <h3 class="text-lg font-bold text-white mb-2">Как начать работу с DarkRock?</h3>
                    <p class="text-gray-400">Зарегистрируйтесь на платформе, изучите каталог франшиз и отправьте запрос на интересующую вас франшизу.</p>
                </div>

                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent transition-all">
                    <h3 class="text-lg font-bold text-white mb-2">Сколько стоят ваши услуги?</h3>
                    <p class="text-gray-400">Регистрация и просмотр каталога абсолютно бесплатны. Комиссия взимается только при успешном заключении сделки.</p>
                </div>

                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent transition-all">
                    <h3 class="text-lg font-bold text-white mb-2">Как быстро вы отвечаете на запросы?</h3>
                    <p class="text-gray-400">Мы стараемся отвечать на все запросы в течение 24 часов в рабочие дни.</p>
                </div>

                <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 hover:border-accent transition-all">
                    <h3 class="text-lg font-bold text-white mb-2">Предоставляете ли вы поддержку после покупки?</h3>
                    <p class="text-gray-400">Да, мы предоставляем постоянную поддержку нашим клиентам на всех этапах развития бизнеса.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
