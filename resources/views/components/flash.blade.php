@if ($message = Session::get('success'))
<div class="fixed top-4 right-4 z-50 animate-fade-in">
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 shadow-lg max-w-sm">
        <div class="flex items-start space-x-3">
            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                <i class="bi bi-check text-white text-xs"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-green-800">{{ $message }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600 transition duration-200">
                <i class="bi bi-x text-lg"></i>
            </button>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="fixed top-4 right-4 z-50 animate-fade-in">
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 shadow-lg max-w-sm">
        <div class="flex items-start space-x-3">
            <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                <i class="bi bi-exclamation text-white text-xs"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600 transition duration-200">
                <i class="bi bi-x text-lg"></i>
            </button>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="fixed top-4 right-4 z-50 animate-fade-in">
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 shadow-lg max-w-sm">
        <div class="flex items-start space-x-3">
            <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                <i class="bi bi-exclamation text-white text-xs"></i>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</h4>
                <ul class="text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center space-x-1">
                            <i class="bi bi-dot text-xs"></i>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600 transition duration-200">
                <i class="bi bi-x text-lg"></i>
            </button>
        </div>
    </div>
</div>
@endif

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- setTimeout OLIB TASHLANDI --}}
{{-- Foydalanuvchi o'zi yopadi yoki yangi requestda o'chadi --}}