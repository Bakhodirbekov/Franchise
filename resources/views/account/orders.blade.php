@extends('layouts.app')

@section('title', 'Мои Заказы - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-6 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-2">Мои Заказы</h1>
                    <p class="text-base md:text-lg text-gray-400">Отслеживайте статус ваших заказов франшиз</p>
                </div>
                <a href="{{ route('franchises.index') }}" 
                   class="inline-flex items-center gap-2 gradient-accent text-gray-900 px-5 py-3 rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-orange-500/50 transition-all">
                    <i class="bi bi-search"></i>
                    <span>Искать Франшизы</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @include('account.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                    <div class="bg-gray-800 border border-gray-700 hover:border-green-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-box-seam-fill text-green-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $orders->total() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Заказов</p>
                    </div>

                    <div class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-check-circle-fill text-blue-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Успешно</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $orders->where('status', 'paid')->count() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Оплачено</p>
                    </div>

                    <div class="bg-gray-800 border border-gray-700 hover:border-yellow-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-hourglass-split text-yellow-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Ожидание</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $orders->where('status', 'pending')->count() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">В Обработке</p>
                    </div>

                    <div class="bg-gray-800 border border-gray-700 hover:border-accent rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-cash-stack text-accent text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Итого</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">${{ number_format($orders->where('status', 'paid')->sum('amount')) }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Оборот</p>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 md:px-8 py-5 border-b border-gray-700 bg-gray-800/50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl md:text-2xl font-black text-white flex items-center gap-2">
                                <i class="bi bi-receipt text-accent"></i>
                                История Заказов
                            </h3>
                            <span class="text-sm text-gray-400 font-semibold">{{ $orders->total() }} заказов</span>
                        </div>
                    </div>

                    @if($orders->count() > 0)
                        <div class="divide-y divide-gray-700">
                            @foreach($orders as $order)
                            <div class="p-6 md:p-8 hover:bg-gray-700/20 transition-all duration-300 group">
                                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4 mb-4">
                                            @if($order->franchise)
                                                @if($order->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($order->franchise->images->first()->path) }}" 
                                                         alt="{{ $order->franchise->title }}"
                                                         class="w-20 h-20 object-cover rounded-xl border-2 border-gray-700 group-hover:border-accent transition-colors flex-shrink-0">
                                                @else
                                                    <div class="w-20 h-20 bg-accent/10 border-2 border-gray-700 group-hover:border-accent rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                                                        <i class="bi bi-building text-accent text-2xl"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-black text-white text-lg group-hover:text-accent transition-colors mb-2">{{ $order->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-400 mb-2">
                                                        <i class="bi bi-tag-fill text-accent mr-1"></i>
                                                        {{ $order->franchise->category->name }}
                                                    </p>
                                                    <p class="text-xl font-black text-accent">
                                                        <i class="bi bi-cash-coin mr-1"></i>
                                                        ${{ number_format($order->amount) }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="w-20 h-20 bg-gray-700 border-2 border-gray-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                    <i class="bi bi-receipt text-gray-500 text-2xl"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-black text-white text-lg mb-2">Заказ #{{ $order->id }}</h4>
                                                    <p class="text-sm text-gray-400 mb-2">Общая Покупка</p>
                                                    <p class="text-xl font-black text-accent">${{ number_format($order->amount) }}</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="bg-gray-700/30 border border-gray-600 rounded-lg p-4 mt-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                                                <div>
                                                    <p class="text-gray-400 mb-1">
                                                        <i class="bi bi-calendar3 text-accent"></i> Дата Заказа:
                                                    </p>
                                                    <p class="text-white font-semibold">{{ $order->created_at->format('d.m.Y в H:i') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-400 mb-1">
                                                        <i class="bi bi-currency-exchange text-accent"></i> Валюта:
                                                    </p>
                                                    <p class="text-white font-semibold">{{ strtoupper($order->currency) }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-400 mb-1">
                                                        <i class="bi bi-hash text-accent"></i> ID Заказа:
                                                    </p>
                                                    <p class="text-white font-semibold">#{{ $order->id }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-start lg:items-end gap-3">
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-bold 
                                            {{ $order->status === 'pending' ? 'bg-yellow-900/30 border border-yellow-500/50 text-yellow-400' : '' }}
                                            {{ $order->status === 'paid' ? 'bg-green-900/30 border border-green-500/50 text-green-400' : '' }}
                                            {{ $order->status === 'failed' ? 'bg-red-900/30 border border-red-500/50 text-red-400' : '' }}
                                            {{ $order->status === 'refunded' ? 'bg-gray-700 border border-gray-600 text-gray-300' : '' }}">
                                            <i class="bi bi-circle-fill text-xs"></i>
                                            <span>{{ $order->status === 'pending' ? 'Ожидание' : ($order->status === 'paid' ? 'Оплачено' : ($order->status === 'failed' ? 'Ошибка' : 'Возврат')) }}</span>
                                        </span>
                                        <p class="text-xs text-gray-500">
                                            <i class="bi bi-clock-history"></i> {{ $order->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($orders->hasPages())
                        <div class="px-6 py-4 border-t border-gray-700">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-12 md:p-16 text-center">
                            <div class="w-24 h-24 bg-gray-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="bi bi-inbox text-gray-500 text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3">Пока Нет Заказов</h3>
                            <p class="text-gray-400 mb-6 max-w-md mx-auto">Вы еще не совершали покупки франшиз. Начните с изучения нашего каталога!</p>
                            <a href="{{ route('franchises.index') }}" 
                               class="inline-flex items-center gap-2 gradient-accent text-gray-900 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-orange-500/50 transition-all transform hover:scale-105">
                                <i class="bi bi-search"></i>
                                <span>Открыть Каталог</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection