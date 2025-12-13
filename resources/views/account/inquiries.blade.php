@extends('layouts.app')

@section('title', 'Мои Запросы - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-6 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-2">Мои Запросы</h1>
                    <p class="text-base md:text-lg text-gray-400">Отслеживайте статус ваших запросов по франшизам</p>
                </div>
                <a href="{{ route('franchises.index') }}" 
                   class="inline-flex items-center gap-2 gradient-accent text-gray-900 px-5 py-3 rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-orange-500/50 transition-all">
                    <i class="bi bi-plus-lg"></i>
                    <span>Новый Запрос</span>
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                    <div class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-chat-dots-fill text-blue-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Всего</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $inquiries->total() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Запросов</p>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 hover:border-yellow-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-hourglass-split text-yellow-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Новые</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $inquiries->where('status', 'new')->count() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Ожидают</p>
                    </div>
                    
                    <div class="bg-gray-800 border border-gray-700 hover:border-green-500 rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-check-circle-fill text-green-400 text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Ответы</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $inquiries->where('status', 'contacted')->count() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Обработано</p>
                    </div>

                    <div class="bg-gray-800 border border-gray-700 hover:border-accent rounded-xl p-5 md:p-6 transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                                <i class="bi bi-check2-all text-accent text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-500 uppercase font-bold">Закрыто</span>
                        </div>
                        <p class="text-4xl font-black text-white mb-1">{{ $inquiries->where('status', 'closed')->count() }}</p>
                        <p class="text-sm text-gray-400 font-semibold">Завершено</p>
                    </div>
                </div>

                <!-- Inquiries List -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 md:px-8 py-5 border-b border-gray-700 bg-gray-800/50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl md:text-2xl font-black text-white flex items-center gap-2">
                                <i class="bi bi-list-ul text-accent"></i>
                                Все Запросы
                            </h3>
                            <span class="text-sm text-gray-400 font-semibold">{{ $inquiries->total() }} запросов</span>
                        </div>
                    </div>

                    @if($inquiries->count() > 0)
                        <div class="divide-y divide-gray-700">
                            @foreach($inquiries as $inquiry)
                            <div class="p-6 md:p-8 hover:bg-gray-700/20 transition-all duration-300 group">
                                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4 mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4 mb-4">
                                            @if($inquiry->franchise)
                                                @if($inquiry->franchise->images->count() > 0)
                                                    <img src="{{ Storage::url($inquiry->franchise->images->first()->path) }}" 
                                                         alt="{{ $inquiry->franchise->title }}"
                                                         class="w-20 h-20 object-cover rounded-xl border-2 border-gray-700 group-hover:border-accent transition-colors flex-shrink-0">
                                                @else
                                                    <div class="w-20 h-20 bg-accent/10 border-2 border-gray-700 group-hover:border-accent rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                                                        <i class="bi bi-building text-accent text-2xl"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-black text-white text-lg group-hover:text-accent transition-colors mb-2">{{ $inquiry->franchise->title }}</h4>
                                                    <p class="text-sm text-gray-400 mb-1">
                                                        <i class="bi bi-tag-fill text-accent mr-1"></i>
                                                        {{ $inquiry->franchise->category->name }}
                                                    </p>
                                                    <p class="text-base font-bold text-accent">
                                                        <i class="bi bi-cash-stack mr-1"></i>
                                                        ${{ number_format($inquiry->franchise->investment_min) }} - ${{ number_format($inquiry->franchise->investment_max) }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="w-20 h-20 bg-gray-700 border-2 border-gray-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                    <i class="bi bi-question-circle text-gray-500 text-2xl"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-black text-white text-lg mb-2">Общий Запрос</h4>
                                                    <p class="text-sm text-gray-400">Без привязки к франшизе</p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="bg-gray-700/30 border border-gray-600 rounded-lg p-4 mt-4">
                                            <p class="text-sm font-bold text-gray-400 mb-2">
                                                <i class="bi bi-chat-quote text-accent"></i> Сообщение:
                                            </p>
                                            <p class="text-sm text-gray-300 line-clamp-3">{{ $inquiry->message }}</p>
                                            <p class="text-xs text-gray-500 mt-3">
                                                <i class="bi bi-calendar3"></i> Отправлено: {{ $inquiry->created_at->format('d.m.Y в H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-start lg:items-end gap-3">
                                        @if($inquiry->admin_response)
                                            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-bold bg-blue-900/30 border border-blue-500/50 text-blue-400">
                                                <i class="bi bi-envelope-check-fill"></i>
                                                <span>Есть Ответ</span>
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-bold 
                                            {{ $inquiry->status === 'new' ? 'bg-yellow-900/30 border border-yellow-500/50 text-yellow-400' : '' }}
                                            {{ $inquiry->status === 'contacted' ? 'bg-blue-900/30 border border-blue-500/50 text-blue-400' : '' }}
                                            {{ $inquiry->status === 'closed' ? 'bg-green-900/30 border border-green-500/50 text-green-400' : '' }}">
                                            <i class="bi bi-circle-fill text-xs"></i>
                                            <span>{{ $inquiry->status === 'new' ? 'Новый' : ($inquiry->status === 'contacted' ? 'В Обработке' : 'Завершён') }}</span>
                                        </span>
                                        <p class="text-xs text-gray-500">
                                            <i class="bi bi-clock-history"></i> {{ $inquiry->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                
                                @if($inquiry->admin_response)
                                    <div class="mt-5">
                                        <div class="bg-gradient-to-r from-blue-900/20 to-blue-800/20 border border-blue-500/50 rounded-xl p-5 md:p-6">
                                            <div class="flex items-start gap-4">
                                                <div class="w-12 h-12 gradient-accent rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                                    <i class="bi bi-person-badge-fill text-gray-900 text-xl"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-base font-black text-blue-400 mb-3 flex items-center gap-2">
                                                        <i class="bi bi-chat-left-quote-fill"></i>
                                                        Ответ Администратора
                                                    </p>
                                                    <p class="text-sm md:text-base text-gray-200 whitespace-pre-line leading-relaxed">{{ $inquiry->admin_response }}</p>
                                                    @if($inquiry->admin_response_at)
                                                        <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                                                            <i class="bi bi-calendar-check"></i>
                                                            {{ $inquiry->admin_response_at->format('d.m.Y в H:i') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($inquiries->hasPages())
                        <div class="px-6 py-4 border-t border-gray-700">
                            {{ $inquiries->links() }}
                        </div>
                        @endif
                    @else
                        <div class="p-12 md:p-16 text-center">
                            <div class="w-24 h-24 bg-gray-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="bi bi-inbox text-gray-500 text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3">Пока Нет Запросов</h3>
                            <p class="text-gray-400 mb-6 max-w-md mx-auto">Вы еще не отправляли запросы по франшизам. Начните с изучения нашего каталога!</p>
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