@extends('layouts.app')

@section('title', 'UI Компоненты - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">UI Компоненты</h1>
            <p class="text-gray-400">Библиотека переиспользуемых компонентов интерфейса</p>
        </div>

        <!-- Buttons Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-cursor text-accent mr-2"></i>Кнопки
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Primary Buttons -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Основные</h3>
                    <div class="space-y-3">
                        <button class="w-full gradient-accent text-gray-900 py-3 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-500/50 transition">
                            Основная Кнопка
                        </button>
                        <button class="w-full bg-accent hover:bg-orange-600 text-gray-900 py-3 rounded-lg font-bold transition">
                            Акцентная Кнопка
                        </button>
                        <button class="w-full border-2 border-accent text-accent hover:bg-accent hover:text-gray-900 py-3 rounded-lg font-bold transition">
                            Контурная Кнопка
                        </button>
                    </div>
                </div>

                <!-- Secondary Buttons -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Второстепенные</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-gray-700 hover:bg-gray-600 text-white py-3 rounded-lg font-bold transition">
                            Серая Кнопка
                        </button>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold transition">
                            Синяя Кнопка
                        </button>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold transition">
                            Зелёная Кнопка
                        </button>
                    </div>
                </div>

                <!-- Icon Buttons -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">С Иконками</h3>
                    <div class="space-y-3">
                        <button class="w-full gradient-accent text-gray-900 py-3 rounded-lg font-bold hover:shadow-lg transition">
                            <i class="bi bi-search mr-2"></i>Поиск
                        </button>
                        <button class="w-full bg-gray-700 hover:bg-gray-600 text-white py-3 rounded-lg font-bold transition">
                            <i class="bi bi-download mr-2"></i>Скачать
                        </button>
                        <button class="w-full border-2 border-accent text-accent hover:bg-accent hover:text-gray-900 py-3 rounded-lg font-bold transition">
                            <i class="bi bi-heart-fill mr-2"></i>Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Forms Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-input-cursor text-accent mr-2"></i>Формы
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Input Fields -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Поля Ввода</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Текстовое Поле</label>
                            <input type="text" placeholder="Введите текст..." class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Email</label>
                            <input type="email" placeholder="email@example.com" class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Пароль</label>
                            <input type="password" placeholder="••••••••" class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Textarea</label>
                            <textarea rows="3" placeholder="Введите сообщение..." class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Select & Checkbox -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Выбор</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Выпадающий Список</label>
                            <select class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 focus:border-accent focus:ring-2 focus:ring-accent/50 transition">
                                <option>Выберите опцию...</option>
                                <option>Опция 1</option>
                                <option>Опция 2</option>
                                <option>Опция 3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-3">Чекбоксы</label>
                            <div class="space-y-2">
                                <label class="flex items-center text-gray-300 cursor-pointer hover:text-white transition">
                                    <input type="checkbox" class="w-5 h-5 text-accent bg-gray-700 border-gray-600 rounded focus:ring-accent focus:ring-2">
                                    <span class="ml-2">Опция 1</span>
                                </label>
                                <label class="flex items-center text-gray-300 cursor-pointer hover:text-white transition">
                                    <input type="checkbox" class="w-5 h-5 text-accent bg-gray-700 border-gray-600 rounded focus:ring-accent focus:ring-2" checked>
                                    <span class="ml-2">Опция 2 (выбрано)</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-3">Радио Кнопки</label>
                            <div class="space-y-2">
                                <label class="flex items-center text-gray-300 cursor-pointer hover:text-white transition">
                                    <input type="radio" name="radio" class="w-5 h-5 text-accent bg-gray-700 border-gray-600 focus:ring-accent focus:ring-2" checked>
                                    <span class="ml-2">Выбор 1</span>
                                </label>
                                <label class="flex items-center text-gray-300 cursor-pointer hover:text-white transition">
                                    <input type="radio" name="radio" class="w-5 h-5 text-accent bg-gray-700 border-gray-600 focus:ring-accent focus:ring-2">
                                    <span class="ml-2">Выбор 2</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alerts Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-exclamation-triangle text-accent mr-2"></i>Уведомления
            </h2>
            
            <div class="space-y-4">
                <div class="bg-green-900/20 border border-green-500 text-green-300 px-6 py-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle-fill text-green-400 text-2xl mr-3"></i>
                        <span class="font-bold">Успех! Операция выполнена успешно.</span>
                    </div>
                    <button class="text-green-400 hover:text-green-300 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="bg-blue-900/20 border border-blue-500 text-blue-300 px-6 py-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="bi bi-info-circle-fill text-blue-400 text-2xl mr-3"></i>
                        <span class="font-bold">Информация: Новое обновление доступно.</span>
                    </div>
                    <button class="text-blue-400 hover:text-blue-300 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="bg-yellow-900/20 border border-yellow-500 text-yellow-300 px-6 py-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="bi bi-exclamation-triangle-fill text-yellow-400 text-2xl mr-3"></i>
                        <span class="font-bold">Внимание: Проверьте введённые данные.</span>
                    </div>
                    <button class="text-yellow-400 hover:text-yellow-300 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="bg-red-900/20 border border-red-500 text-red-300 px-6 py-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="bi bi-x-circle-fill text-red-400 text-2xl mr-3"></i>
                        <span class="font-bold">Ошибка: Не удалось выполнить операцию.</span>
                    </div>
                    <button class="text-red-400 hover:text-red-300 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Cards Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-card-heading text-accent mr-2"></i>Карточки
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Basic Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition">
                    <h3 class="text-xl font-bold text-white mb-3">Простая Карточка</h3>
                    <p class="text-gray-400 mb-4">Базовая карточка с заголовком и описанием. Подходит для простого контента.</p>
                    <button class="gradient-accent text-gray-900 px-4 py-2 rounded-lg font-bold hover:shadow-lg transition">
                        Действие
                    </button>
                </div>

                <!-- Card with Icon -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="bi bi-star-fill text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">С Иконкой</h3>
                    <p class="text-gray-400 mb-4">Карточка с иконкой для визуального акцента.</p>
                    <a href="#" class="text-accent hover:text-orange-400 font-bold">Подробнее →</a>
                </div>

                <!-- Stats Card -->
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-accent hover:shadow-xl transition">
                    <div class="text-4xl font-black text-accent mb-2">1,234</div>
                    <h3 class="text-lg font-bold text-white mb-2">Статистика</h3>
                    <p class="text-sm text-gray-400">Показатель с числовыми данными</p>
                </div>
            </div>
        </section>

        <!-- Badges & Tags Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-tag text-accent mr-2"></i>Бейджи и Теги
            </h2>
            
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-3">Статусы</h3>
                        <div class="flex flex-wrap gap-3">
                            <span class="bg-green-900/50 border border-green-500 text-green-400 px-3 py-1 rounded-full text-sm font-bold">Активно</span>
                            <span class="bg-yellow-900/50 border border-yellow-500 text-yellow-400 px-3 py-1 rounded-full text-sm font-bold">В Ожидании</span>
                            <span class="bg-red-900/50 border border-red-500 text-red-400 px-3 py-1 rounded-full text-sm font-bold">Отклонено</span>
                            <span class="bg-blue-900/50 border border-blue-500 text-blue-400 px-3 py-1 rounded-full text-sm font-bold">В Процессе</span>
                            <span class="bg-gray-700 border border-gray-600 text-gray-300 px-3 py-1 rounded-full text-sm font-bold">Неактивно</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-white mb-3">Теги</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-accent/10 text-accent px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-accent/20 transition cursor-pointer">Новинка</span>
                            <span class="bg-accent/10 text-accent px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-accent/20 transition cursor-pointer">Популярное</span>
                            <span class="bg-accent/10 text-accent px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-accent/20 transition cursor-pointer">Рекомендуем</span>
                            <span class="bg-gray-700 text-gray-300 px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-gray-600 transition cursor-pointer">Архив</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pagination Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-distribute-horizontal text-accent mr-2"></i>Пагинация
            </h2>
            
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <div class="flex flex-wrap justify-center gap-2">
                    <button class="px-4 py-2 bg-gray-700 text-gray-400 rounded-lg font-bold hover:bg-gray-600 transition">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="px-4 py-2 gradient-accent text-gray-900 rounded-lg font-bold">1</button>
                    <button class="px-4 py-2 bg-gray-700 text-white rounded-lg font-bold hover:bg-gray-600 transition">2</button>
                    <button class="px-4 py-2 bg-gray-700 text-white rounded-lg font-bold hover:bg-gray-600 transition">3</button>
                    <button class="px-4 py-2 bg-gray-700 text-gray-400 rounded-lg font-bold">...</button>
                    <button class="px-4 py-2 bg-gray-700 text-white rounded-lg font-bold hover:bg-gray-600 transition">10</button>
                    <button class="px-4 py-2 bg-gray-700 text-white rounded-lg font-bold hover:bg-gray-600 transition">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Breadcrumbs Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-signpost text-accent mr-2"></i>Хлебные Крошки
            </h2>
            
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <nav class="flex flex-wrap items-center text-sm md:text-base">
                    <a href="#" class="text-accent hover:text-orange-400 font-bold transition">Главная</a>
                    <i class="bi bi-chevron-right text-gray-500 mx-2"></i>
                    <a href="#" class="text-accent hover:text-orange-400 font-bold transition">Категория</a>
                    <i class="bi bi-chevron-right text-gray-500 mx-2"></i>
                    <span class="text-gray-400">Текущая Страница</span>
                </nav>
            </div>
        </section>

        <!-- Modal Example -->
        <section class="mb-12">
            <h2 class="text-2xl font-black text-white mb-6 border-b border-gray-700 pb-3">
                <i class="bi bi-window text-accent mr-2"></i>Модальное Окно
            </h2>
            
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 text-center">
                <button onclick="document.getElementById('example-modal').classList.remove('hidden')" class="gradient-accent text-gray-900 px-6 py-3 rounded-lg font-bold hover:shadow-lg transition">
                    Открыть Модальное Окно
                </button>
            </div>
        </section>
    </div>
</div>

<!-- Example Modal -->
<div id="example-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
    <div class="bg-gray-800 border border-gray-700 rounded-xl max-w-md w-full p-6 md:p-8 relative">
        <button onclick="document.getElementById('example-modal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
            <i class="bi bi-x-lg text-2xl"></i>
        </button>
        
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle text-accent text-3xl"></i>
            </div>
            <h3 class="text-2xl font-black text-white mb-2">Модальное Окно</h3>
            <p class="text-gray-400">Пример модального окна с подтверждением действия.</p>
        </div>

        <div class="space-y-3">
            <button onclick="document.getElementById('example-modal').classList.add('hidden')" class="w-full gradient-accent text-gray-900 py-3 rounded-lg font-bold hover:shadow-lg transition">
                Подтвердить
            </button>
            <button onclick="document.getElementById('example-modal').classList.add('hidden')" class="w-full border-2 border-gray-600 text-gray-300 hover:border-gray-500 py-3 rounded-lg font-bold transition">
                Отмена
            </button>
        </div>
    </div>
</div>
@endsection
