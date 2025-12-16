@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block mb-6">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                    <i class="bi bi-shop text-white text-3xl"></i>
                </div>
            </a>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Создайте аккаунт</h2>
            <p class="text-gray-600">Присоединяйтесь к нам и открыте возможности франшиз</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- CAPTCHA -->
                    <div id="captcha-container" class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="bi bi-shield mr-2 text-blue-600"></i>Проверка безопасности
                            </label>
                            <button type="button" id="refresh-captcha" class="text-sm text-blue-600 hover:text-blue-800">
                                <i class="bi bi-arrow-repeat"></i> Обновить
                            </button>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div id="captcha-question" class="font-medium text-gray-800">Loading...</div>
                            <div class="flex-1">
                                <input type="text" 
                                       name="captcha" 
                                       id="captcha" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('captcha') border-red-500 @enderror" 
                                       placeholder="Введите ответ">
                            </div>
                        </div>
                        @error('captcha')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                        <input type="hidden" name="captcha_hash" id="captcha_hash">
                    </div>

                    <!-- Two Column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-person mr-2 text-blue-600"></i>Полное имя
                            </label>
                            <input id="name" 
                                   type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-500 @enderror"
                                   placeholder="Иван Петров">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-telephone mr-2 text-blue-600"></i>Номер телефона
                            </label>
                            <input id="phone" 
                                   type="tel" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   required 
                                   autocomplete="tel"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('phone') border-red-500 @enderror"
                                   placeholder="+7 (999) 123-45-67">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="bi bi-envelope mr-2 text-blue-600"></i>Адрес электронной почты
                        </label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror"
                               placeholder="example@email.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Two Column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company (Optional) -->
                        <div>
                            <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-building mr-2 text-gray-400"></i>Компания <span class="text-gray-400 text-xs">(Необязательно)</span>
                            </label>
                            <input id="company" 
                                   type="text" 
                                   name="company" 
                                   value="{{ old('company') }}" 
                                   autocomplete="organization"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Ваша компания">
                        </div>

                        <!-- Address (Optional) -->
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-geo-alt mr-2 text-gray-400"></i>Адрес <span class="text-gray-400 text-xs">(Необязательно)</span>
                            </label>
                            <input id="address" 
                                   type="text" 
                                   name="address" 
                                   value="{{ old('address') }}" 
                                   autocomplete="street-address"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Город, страна">
                        </div>
                    </div>

                    <!-- Two Column Grid for Passwords -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-lock mr-2 text-blue-600"></i>Пароль
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password', 'toggleIcon1')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i id="toggleIcon1" class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="bi bi-lock-fill mr-2 text-blue-600"></i>Подтвердите пароль
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" 
                                       type="password" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i id="toggleIcon2" class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <p class="text-sm text-blue-800 font-medium mb-2">
                            <i class="bi bi-info-circle mr-2"></i>Требования к паролю:
                        </p>
                        <ul class="text-xs text-blue-700 space-y-1 ml-6">
                            <li>• Не менее 8 символов</li>
                            <li>• Полные и средние буквы</li>
                            <li>• Не менее одного числа</li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="bi bi-person-plus mr-2"></i>Создать аккаунт
                    </button>
                </form>
            </div>

            <!-- Login Link -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                <p class="text-center text-sm text-gray-600">
                    Уже есть аккаунт?
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition duration-200">
                        Войти <i class="bi bi-arrow-right ml-1"></i>
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900 transition duration-200">
                <i class="bi bi-arrow-left mr-2"></i>На главную
            </a>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

// CAPTCHA functionality
function loadCaptcha() {
    fetch('/captcha/generate')
        .then(response => response.json())
        .then(data => {
            document.getElementById('captcha-question').textContent = data.question;
            document.getElementById('captcha_hash').value = data.hash;
        })
        .catch(error => {
            console.error('Error loading CAPTCHA:', error);
            document.getElementById('captcha-question').textContent = 'Error loading CAPTCHA';
        });
}

// Load CAPTCHA on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCaptcha();
    
    // Refresh CAPTCHA on button click
    document.getElementById('refresh-captcha').addEventListener('click', loadCaptcha);
});
</script>
@endsection