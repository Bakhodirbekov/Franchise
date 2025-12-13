@extends('layouts.app')

@section('title', '404 - Страница Не Найдена')

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
    <div class="max-w-2xl w-full text-center">
        <!-- 404 Illustration -->
        <div class="mb-8">
            <div class="text-9xl md:text-[12rem] font-black text-accent/20 leading-none">404</div>
        </div>

        <!-- Error Icon -->
        <div class="w-20 h-20 md:w-24 md:h-24 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="bi bi-exclamation-triangle text-accent text-4xl md:text-5xl"></i>
        </div>

        <!-- Error Message -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">
            Страница Не Найдена
        </h1>
        <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-xl mx-auto">
            К сожалению, страница, которую вы ищете, не существует или была перемещена.
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" 
                class="gradient-accent text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 transform hover:scale-105">
                <i class="bi bi-house mr-2"></i>На Главную
            </a>
            <a href="{{ route('franchises.index') }}" 
                class="border-2 border-accent text-accent px-8 py-4 rounded-xl font-bold text-lg hover:bg-accent hover:text-gray-900 transition duration-200">
                <i class="bi bi-search mr-2"></i>Каталог Франшиз
            </a>
        </div>

        <!-- Additional Help -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <p class="text-gray-500 mb-4">Нужна помощь?</p>
            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <a href="#" class="text-gray-400 hover:text-accent transition font-semibold">
                    <i class="bi bi-envelope mr-1"></i>Написать в Поддержку
                </a>
                <a href="#" class="text-gray-400 hover:text-accent transition font-semibold">
                    <i class="bi bi-telephone mr-1"></i>Позвонить
                </a>
                <a href="#" class="text-gray-400 hover:text-accent transition font-semibold">
                    <i class="bi bi-question-circle mr-1"></i>FAQ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
