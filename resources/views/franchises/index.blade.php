@extends('layouts.app')

@section('title', 'Возможности Франшиз - DarkRock')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4">
                Возможности <span class="text-accent">Франшиз</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Открыте вашу идеальную бизнес-овность из нашего подборанных процессов франшиз
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-white">Фильтры</h3>
                        <button onclick="resetFilters()" class="text-sm text-accent hover:text-orange-400 font-bold">
                            Очистить Все
                        </button>
                    </div>
                    
                    <form id="filterForm" method="GET" action="{{ route('franchises.index') }}" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Поиск</label>
                            <div class="relative">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Найдите франшизы..."
                                       class="w-full pl-10 pr-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200 placeholder-gray-500">
                                <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Категория</label>
                            <select name="category" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
                                <option value="">Все Категории</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Investment Range -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">
                                Диапазон Инвестиций
                            </label>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs text-gray-500">Min: $<span id="minValue">{{ request('investment_min', 0) }}</span></label>
                                    <input type="range" 
                                           name="investment_min" 
                                           min="0" 
                                           max="1000000" 
                                           step="10000"
                                           value="{{ request('investment_min', 0) }}"
                                           class="w-full range-slider accent-accent"
                                           oninput="updateRangeValues()">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500">Max: $<span id="maxValue">{{ request('investment_max', 1000000) }}</span></label>
                                    <input type="range" 
                                           name="investment_max" 
                                           min="0" 
                                           max="1000000" 
                                           step="10000"
                                           value="{{ request('investment_max', 1000000) }}"
                                           class="w-full range-slider accent-accent"
                                           oninput="updateRangeValues()">
                                </div>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Сортировка</label>
                            <select name="sort" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Сначала новые</option>
                                <option value="investment_low_high" {{ request('sort') == 'investment_low_high' ? 'selected' : '' }}>Инвестиции: от низких к высоким</option>
                                <option value="investment_high_low" {{ request('sort') == 'investment_high_low' ? 'selected' : '' }}>Инвестиции: от высоких к низким</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                            Применить фильтры
                        </button>
                    </form>
                </div>
            </div>

            <!-- Franchise Grid -->
            <div class="lg:w-3/4">
                <!-- Results Header -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl font-black text-white">
                                {{ $franchises->total() }} франшиз{{ $franchises->total() !== 1 ? 'ы' : 'а' }} найдено
                            </h2>
                            @if(request()->anyFilled(['search', 'category', 'investment_min', 'investment_max']))
                                <p class="text-gray-400 text-sm mt-1">
                                    Фильтрованные результаты
                                    @if(request('search')) • "{{ request('search') }}" @endif
                                    @if(request('category')) • {{ $categories->find(request('category'))->name ?? '' }} @endif
                                </p>
                            @endif
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                Страница {{ $franchises->currentPage() }} из {{ $franchises->lastPage() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Franchise Cards -->
                @if($franchises->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4 md:gap-6 lg:gap-8">
                        @foreach($franchises as $franchise)
                            <div class="bg-gray-800 border border-gray-700 rounded-2xl card-hover overflow-hidden hover:border-accent hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-300 flex flex-col h-full">
                                <!-- Image -->
                                <div class="relative w-full aspect-video bg-gray-700 overflow-hidden flex-shrink-0">
                                    @if($franchise->images->count() > 0)
                                        <img src="{{ Storage::url($franchise->images->first()->path) }}" 
                                             alt="{{ $franchise->title }}"
                                             class="w-full h-full object-cover transition duration-300 hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                            <i class="bi bi-building text-gray-600 text-3xl sm:text-4xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 sm:top-3 left-2 sm:left-4">
                                        <span class="bg-gray-900/90 backdrop-blur text-accent border border-accent/50 px-2 sm:px-3 py-1 rounded-full text-xs font-bold">
                                            {{ $franchise->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-3 sm:p-4 flex flex-col flex-1">
                                    <h3 class="text-xs sm:text-sm md:text-base font-black text-white mb-1.5 sm:mb-2 line-clamp-2">
                                        {{ $franchise->title }}
                                    </h3>
                                    
                                    <p class="text-gray-400 text-xs mb-2 sm:mb-3 line-clamp-2 flex-shrink-0">
                                        {{ $franchise->short_description }}
                                    </p>

                                    <!-- Investment Info -->
                                    <div class="space-y-0.5 sm:space-y-1 mb-2 sm:mb-3 flex-shrink-0 text-xs">
                                        @auth
                                            @if(auth()->user()->role === 'admin')
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-500">Инвестиции:</span>
                                                    <span class="font-bold text-accent">
                                                        ${{ number_format($franchise->investment_min) }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-500">Роялти:</span>
                                                    <span class="font-bold text-white">{{ $franchise->royalty }}%</span>
                                                </div>
                                            @endif
                                        @endauth
                                        @if($franchise->territory)
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Территория:</span>
                                            <span class="font-semibold text-white">{{ $franchise->territory }}</span>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- CTA Buttons -->
                                    <div class="mt-auto pt-2 sm:pt-3 border-t border-gray-700">
                                        <div class="flex gap-1.5 sm:gap-2">
                                            <a href="{{ route('franchises.show', $franchise->slug) }}" 
                                               class="flex-1 gradient-accent text-gray-900 text-center py-1.5 sm:py-2 px-2 rounded-lg text-xs sm:text-sm font-bold hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                                                Подробнее
                                            </a>
                                            <button class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-700 border border-gray-600 text-accent rounded-lg hover:bg-gray-600 hover:border-accent transition duration-200 flex items-center justify-center flex-shrink-0"
                                                    onclick="showInquiryModal({{ $franchise->id }})"
                                                    title="Быстрый запрос">
                                                <i class="bi bi-chat-dots text-xs sm:text-sm"></i>
                                            </button>
                                            <button class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-700 border border-gray-600 text-accent rounded-lg hover:bg-gray-600 hover:border-accent transition duration-200 flex items-center justify-center flex-shrink-0"
                                                    onclick="showCallRequestModal({{ $franchise->id }}, '{{ addslashes($franchise->title) }}')"
                                                    title="Заказать звонок">
                                                <i class="bi bi-telephone text-sm sm:text-base"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $franchises->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-sm p-12 text-center">
                        <div class="w-24 h-24 bg-gray-700 border border-gray-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="bi bi-search text-gray-500 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">Франшизы не найдены</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">
                            Мы не смогли найти франшизы, соответствующие вашим критериям. Попробуйте изменить фильтры или просмотреть все доступные предложения.
                        </p>
                        <a href="{{ route('franchises.index') }}" 
                           class="gradient-accent text-gray-900 px-8 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200 inline-flex items-center space-x-2">
                            <span>Смотреть все франшизы</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Inquiry Modal -->
<div id="inquiryModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-black text-white">Отправить запрос</h3>
                <button onclick="closeInquiryModal()" class="text-gray-400 hover:text-accent transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="inquiryForm" method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="franchise_id" id="modalFranchiseId">
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Полное имя *</label>
                    <input type="text" name="name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->name }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Email *</label>
                    <input type="email" name="email" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->email }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Телефон *</label>
                    <input type="tel" name="phone" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->phone }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Сообщение</label>
                    <textarea name="message" rows="4" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                              placeholder="Расскажите нам о вашем интересе к этой франшизе..."></textarea>
                </div>
                
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeInquiryModal()" 
                            class="flex-1 bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold hover:bg-gray-700 transition duration-200">
                        Отмена
                    </button>
                    <button type="submit" 
                            class="flex-1 gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Call Request Modal -->
<div id="callRequestModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-black text-white">Заказать звонок</h3>
                <button onclick="closeCallRequestModal()" class="text-gray-400 hover:text-accent transition duration-200">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
            
            <form id="callRequestForm" method="POST" action="{{ route('call-requests.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="franchise_id" id="callRequestFranchiseId">
                <input type="hidden" name="franchise_name" id="callRequestFranchiseName">
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Полное имя *</label>
                    <input type="text" name="name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->name }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Телефон *</label>
                    <input type="tel" name="phone" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200"
                           value="{{ auth()->user()?->phone }}" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-1">Предпочтительное время звонка</label>
                    <select name="call_time" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
                        <option value="">Любое время</option>
                        <option value="Morning (9AM - 12PM)">Утро (9:00 - 12:00)</option>
                        <option value="Afternoon (12PM - 5PM)">День (12:00 - 17:00)</option>
                        <option value="Evening (5PM - 8PM)">Вечер (17:00 - 20:00)</option>
                    </select>
                </div>
                
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeCallRequestModal()" 
                            class="flex-1 bg-gray-800 border border-gray-700 text-gray-300 py-3 rounded-xl font-bold hover:bg-gray-700 transition duration-200">
                        Отмена
                    </button>
                    <button type="submit" 
                            class="flex-1 gradient-accent text-gray-900 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                        Заказать
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateRangeValues() {
        document.getElementById('minValue').textContent = 
            parseInt(document.querySelector('input[name="investment_min"]').value).toLocaleString();
        document.getElementById('maxValue').textContent = 
            parseInt(document.querySelector('input[name="investment_max"]').value).toLocaleString();
    }
    
    function resetFilters() {
        document.getElementById('filterForm').reset();
        updateRangeValues();
        document.getElementById('filterForm').submit();
    }
    
    function showInquiryModal(franchiseId) {
        document.getElementById('modalFranchiseId').value = franchiseId;
        document.getElementById('inquiryModal').classList.remove('hidden');
    }
    
    function closeInquiryModal() {
        document.getElementById('inquiryModal').classList.add('hidden');
    }
    
    function showCallRequestModal(franchiseId, franchiseName) {
        document.getElementById('callRequestFranchiseId').value = franchiseId;
        document.getElementById('callRequestFranchiseName').value = franchiseName;
        document.getElementById('callRequestModal').classList.remove('hidden');
    }
    
    function closeCallRequestModal() {
        document.getElementById('callRequestModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('inquiryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeInquiryModal();
        }
    });
    
    document.getElementById('callRequestModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCallRequestModal();
        }
    });
    
    // Handle form submission with AJAX
    document.getElementById('callRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeCallRequestModal();
                alert(data.message);
            } else {
                alert('Error submitting call request. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting call request. Please try again.');
        });
    });
    
    // Initialize range values
    updateRangeValues();
</script>
@endpush
@endsection