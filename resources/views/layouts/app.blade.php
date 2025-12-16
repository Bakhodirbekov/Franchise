<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DarkRock - Premium Franchise Marketplace')</title>
    <meta name="description" content="Build your empire on solid foundations with DarkRock">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-darkrock {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        }
        
        .gradient-accent {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(255, 107, 53, 0.2);
        }

        .nav-darkrock {
            backdrop-filter: blur(10px);
            background: rgba(26, 26, 26, 0.95);
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
        }
        
        .text-accent {
            color: #ff6b35;
        }
        
        .bg-accent {
            background-color: #ff6b35;
        }
        
        .border-accent {
            border-color: #ff6b35;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full font-sans antialiased bg-gray-900">
    <!-- Navigation -->
    <nav class="nav-darkrock fixed top-0 w-full z-50">
        <!-- Desktop Navigation (md and above) -->
        <div class="hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Desktop Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3">
                            <img src="{{ asset('images/logo.png') }}" alt="DarkRock Logo" class="w-10 h-10 rounded-lg object-contain transform hover:rotate-6 transition-transform">
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-white tracking-tight">DARK<span class="text-accent">ROCK</span></span>
                                <span class="text-xs text-gray-400 -mt-1 tracking-wider">FRANCHISE</span>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}"
                            class="text-gray-300 hover:text-accent font-semibold transition duration-200 {{ request()->routeIs('home') ? 'text-accent' : '' }}">
                            Главная
                        </a>
                        <a href="{{ route('franchises.index') }}"
                            class="text-gray-300 hover:text-accent font-semibold transition duration-200 {{ request()->routeIs('franchises.*') ? 'text-accent' : '' }}">
                            Каталог
                        </a>
                        @auth
                            <a href="{{ route('account.index') }}"
                                class="text-gray-300 hover:text-accent font-semibold transition duration-200 {{ request()->routeIs('account.*') ? 'text-accent' : '' }}">
                                Мой Кабинет
                            </a>
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-gray-300 hover:text-accent font-semibold transition duration-200 {{ request()->routeIs('admin.*') ? 'text-accent' : '' }}">
                                    Админ
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Desktop Auth Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-gray-300 hover:text-accent transition duration-200">
                                    <div class="w-8 h-8 gradient-accent rounded-full flex items-center justify-center text-gray-900 text-sm font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-white">{{ auth()->user()->name }}</span>
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </button>

                                <!-- Desktop Dropdown Menu -->
                                <div class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-accent transition duration-200">
                                        <i class="bi bi-person mr-2"></i>Профиль
                                    </a>
                                    <a href="{{ route('account.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-accent transition duration-200">
                                        <i class="bi bi-briefcase mr-2"></i>Мой Кабинет
                                    </a>
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-accent transition duration-200">
                                            <i class="bi bi-speedometer2 mr-2"></i>Панель Админа
                                        </a>
                                        <a href="{{ route('admin.call-requests.index') }}"
                                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-accent transition duration-200">
                                            <i class="bi bi-telephone mr-2"></i>Заявки
                                        </a>
                                    @endif
                                    <hr class="my-1 border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 transition duration-200">
                                            <i class="bi bi-box-arrow-right mr-2"></i>Выйти
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-300 hover:text-accent font-semibold transition duration-200">
                                Войти
                            </a>
                            <a href="{{ route('register') }}"
                                class="gradient-accent text-gray-900 px-6 py-2.5 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200">
                                Регистрация
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation (below md) -->
        <div class="md:hidden">
            <div class="flex justify-between items-center px-4 h-14">
                <!-- Mobile Logo -->
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="DarkRock Logo" class="w-8 h-8 rounded object-contain">
                    <span class="text-lg font-black text-white">DARK<span class="text-accent">ROCK</span></span>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center space-x-2">
                    @auth
                        <button onclick="toggleMobileUserMenu()" class="w-8 h-8 gradient-accent rounded-full flex items-center justify-center text-gray-900 text-xs font-bold hover:shadow-lg transition">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                    @endauth
                    <button id="mobile-menu-btn" type="button" class="text-gray-300 hover:text-accent focus:outline-none">
                        <i class="bi bi-list text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile User Menu (Dropdown) -->
            <div id="mobile-user-menu" class="hidden bg-gray-800 border-b border-gray-700 px-4 py-3">
                @auth
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 gradient-accent rounded-full flex items-center justify-center text-gray-900 font-bold text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 pt-3 space-y-2">
                        <a href="{{ route('profile.edit') }}" class="block text-sm text-gray-300 hover:text-accent py-2">
                            <i class="bi bi-person mr-2"></i>Профиль
                        </a>
                        <a href="{{ route('account.index') }}" class="block text-sm text-gray-300 hover:text-accent py-2">
                            <i class="bi bi-briefcase mr-2"></i>Мой Кабинет
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block text-sm text-gray-300 hover:text-accent py-2">
                                <i class="bi bi-speedometer2 mr-2"></i>Админ
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm text-red-400 hover:text-red-300 py-2">
                                <i class="bi bi-box-arrow-right mr-2"></i>Выйти
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

            <!-- Mobile Main Menu -->
            <div id="mobile-menu" class="hidden bg-gray-800 border-t border-gray-700 overflow-y-auto max-h-96">
                <div class="px-4 py-3 space-y-2">
                    <a href="{{ route('home') }}" class="block py-2.5 text-gray-300 hover:text-accent font-semibold text-sm {{ request()->routeIs('home') ? 'text-accent' : '' }}">
                        <i class="bi bi-house mr-2"></i>Главная
                    </a>
                    <a href="{{ route('franchises.index') }}" class="block py-2.5 text-gray-300 hover:text-accent font-semibold text-sm {{ request()->routeIs('franchises.*') ? 'text-accent' : '' }}">
                        <i class="bi bi-shop mr-2"></i>Каталог
                    </a>
                    @auth
                        <a href="{{ route('account.index') }}" class="block py-2.5 text-gray-300 hover:text-accent font-semibold text-sm {{ request()->routeIs('account.*') ? 'text-accent' : '' }}">
                            <i class="bi bi-briefcase mr-2"></i>Мой Кабинет
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block py-2.5 text-gray-300 hover:text-accent font-semibold text-sm {{ request()->routeIs('admin.*') ? 'text-accent' : '' }}">
                                <i class="bi bi-speedometer2 mr-2"></i>Админ
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="mt-3 pt-3 border-t border-gray-700">
                            @csrf
                            <button type="submit" class="block w-full text-left py-2.5 text-red-400 hover:text-red-300 font-semibold text-sm">
                                <i class="bi bi-box-arrow-right mr-2"></i>Выйти
                            </button>
                        </form>
                    @else
                        <div class="border-t border-gray-700 pt-2 mt-2 space-y-2">
                            <a href="{{ route('login') }}" class="block w-full text-center bg-gray-700 text-gray-300 py-2 px-3 rounded text-sm font-semibold hover:bg-gray-600 transition">
                                Войти
                            </a>
                            <a href="{{ route('register') }}" class="block w-full text-center gradient-accent text-gray-900 py-2 px-3 rounded text-sm font-bold hover:shadow-lg transition">
                                Регистрация
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Mobile user menu toggle
        function toggleMobileUserMenu() {
            const userMenu = document.getElementById('mobile-user-menu');
            const mainMenu = document.getElementById('mobile-menu');
            userMenu.classList.toggle('hidden');
            if (!mainMenu.classList.contains('hidden')) {
                mainMenu.classList.add('hidden');
            }
        }

        // Close mobile menus when clicking outside
        document.addEventListener('click', function(event) {
            const navBar = document.querySelector('nav');
            if (navBar && !navBar.contains(event.target)) {
                document.getElementById('mobile-menu')?.classList.add('hidden');
                document.getElementById('mobile-user-menu')?.classList.add('hidden');
            }
        });
    </script>

    <!-- Page Content -->
    <main class="pt-16 md:pt-16 min-h-screen">
        <!-- Flash Messages -->
        @include('components.flash')

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="gradient-darkrock text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="DarkRock Logo" class="w-10 h-10 rounded-lg object-contain">
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-white tracking-tight">DARK<span class="text-accent">ROCK</span></span>
                            <span class="text-xs text-gray-500 -mt-1 tracking-wider">FRANCHISE</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Создайте свой бизнес на надёжном фундаменте. DarkRock соединяет амбициозных предпринимателей с премиальными франшизами, подкреплёнными проверенным успехом.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-accent transition duration-200">
                            <i class="bi bi-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent transition duration-200">
                            <i class="bi bi-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent transition duration-200">
                            <i class="bi bi-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent transition duration-200">
                            <i class="bi bi-instagram text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold mb-4 text-white">Быстрые Ссылки</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-accent transition duration-200">Главная</a></li>
                        <li><a href="{{ route('franchises.index') }}"
                                class="text-gray-400 hover:text-accent transition duration-200">Каталог</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">О Нас</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">Контакты</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold mb-4 text-white">Поддержка</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">Помощь</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">Политика
                                Конфиденциальности</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">Условия
                                Использования</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent transition duration-200">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
                <p>&copy; 2024 <span class="text-accent font-bold">DarkRock</span>. All rights reserved. Built on solid foundations.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle (agar kerak bo'lsa)
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Dropdown menus
        document.addEventListener('DOMContentLoaded', function() {
            // Faqat dropdown menu logikasi qoldi
            const dropdownButtons = document.querySelectorAll('.relative.group');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            // Document click event - dropdownlarni yopish
            document.addEventListener('click', function() {
                document.querySelectorAll('.absolute.hidden[class*="group-hover:"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });
        });

        // Flash messages - faqat close function
        function closeFlashMessage(element) {
            element.parentElement.remove();
        }
    </script>

    @stack('scripts')
</body>

</html>
