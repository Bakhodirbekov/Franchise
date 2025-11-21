<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FranchiseShop')</title>
    <meta name="description" content="Discover the best franchise opportunities">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .nav-blur {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>

    @stack('styles')
</head>

<body class="h-full font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="nav-blur fixed top-0 w-full z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="bi bi-shop text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">FranchiseShop</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-200 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('franchises.index') }}"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-200 {{ request()->routeIs('franchises.*') ? 'text-blue-600' : '' }}">
                        Franchises
                    </a>
                    @auth
                        <a href="{{ route('account.index') }}"
                            class="text-gray-700 hover:text-blue-600 font-medium transition duration-200 {{ request()->routeIs('account.*') ? 'text-blue-600' : '' }}">
                            My Account
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-gray-700 hover:text-blue-600 font-medium transition duration-200 {{ request()->routeIs('admin.*') ? 'text-blue-600' : '' }}">
                                Admin
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition duration-200">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden md:block font-medium">{{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200">
                                    <i class="bi bi-person mr-2"></i>Profile
                                </a>
                                <a href="{{ route('account.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200">
                                    <i class="bi bi-briefcase mr-2"></i>My Account
                                </a>
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200">
                                        <i class="bi bi-speedometer2 mr-2"></i>Admin Dashboard
                                    </a>
                                @endif
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition duration-200">
                                        <i class="bi bi-box-arrow-right mr-2"></i>Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 transition duration-200 shadow-lg">
                            Sign up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-16 min-h-screen">
        <!-- Flash Messages -->
        @include('components.flash')

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="bi bi-shop text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">FranchiseShop</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Your gateway to the best franchise opportunities. Discover, compare, and start your
                        entrepreneurial journey with confidence.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="bi bi-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="bi bi-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="bi bi-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-200">
                            <i class="bi bi-instagram text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-400 hover:text-white transition duration-200">Home</a></li>
                        <li><a href="{{ route('franchises.index') }}"
                                class="text-gray-400 hover:text-white transition duration-200">Franchises</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">About
                                Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Help
                                Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Privacy
                                Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Terms of
                                Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 FranchiseShop. All rights reserved.</p>
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
