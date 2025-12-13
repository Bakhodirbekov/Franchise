{{-- 
    Универсальный компонент адаптивной карточки товара/франшизы
    
    Props:
    - $title: Заголовок
    - $description: Описание
    - $image: URL изображения
    - $price: Цена
    - $badge: Бейдж (категория)
    - $link: Ссылка
    - $info: Дополнительная информация (массив)
--}}

<div class="bg-gray-900 rounded-xl shadow-xl border border-gray-700 hover:border-accent hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-300 transform hover:-translate-y-2 card-hover flex flex-col h-full">
    <!-- Image -->
    <div class="relative h-48 md:h-56 lg:h-64 bg-gray-200 rounded-t-xl overflow-hidden flex-shrink-0">
        @if($image)
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center">
                <i class="bi bi-image text-gray-400 text-4xl md:text-5xl"></i>
            </div>
        @endif
        
        @if(isset($badge))
            <div class="absolute top-3 left-3">
                <span class="bg-gray-900/90 backdrop-blur text-accent border border-accent/50 px-3 py-1.5 rounded-full text-xs md:text-sm font-bold">
                    {{ $badge }}
                </span>
            </div>
        @endif
        
        @if(isset($price))
            <div class="absolute top-3 right-3">
                <span class="bg-accent text-gray-900 px-2.5 py-1 rounded-full text-xs md:text-sm font-black">
                    {{ $price }}
                </span>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-4 md:p-5 lg:p-6 flex flex-col flex-1">
        <h3 class="text-base md:text-lg lg:text-xl font-black text-white mb-2 md:mb-3 line-clamp-2">
            {{ $title }}
        </h3>

        <p class="text-sm md:text-base text-gray-400 mb-3 md:mb-4 line-clamp-2">
            {{ $description }}
        </p>

        <!-- Additional Info -->
        @if(isset($info) && is_array($info))
            <div class="space-y-2 mb-4 bg-gray-800/50 p-3 rounded-lg border border-gray-700 flex-1">
                @foreach($info as $label => $value)
                    <div class="flex justify-between items-center">
                        <span class="text-xs md:text-sm text-gray-400">{{ $label }}:</span>
                        <span class="text-sm md:text-base font-bold text-white">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Action Button -->
        @if(isset($link))
            <a href="{{ $link }}" class="block w-full text-center gradient-accent text-gray-900 py-2.5 md:py-3 rounded-lg font-bold text-sm md:text-base hover:shadow-lg hover:shadow-orange-500/50 transition-all duration-200 mt-auto">
                {{ $buttonText ?? 'Подробнее' }}
            </a>
        @endif
    </div>
</div>
