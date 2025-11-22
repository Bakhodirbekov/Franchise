<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    <!-- Profile Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="bi bi-person text-blue-600 mr-2"></i>Full Name
            </label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            @error('name')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="bi bi-telephone text-blue-600 mr-2"></i>Phone Number
            </label>
            <input id="phone" 
                   name="phone" 
                   type="tel" 
                   value="{{ old('phone', $user->phone) }}" 
                   autocomplete="tel"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            @error('phone')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="bi bi-envelope text-blue-600 mr-2"></i>Email Address
        </label>
        <input id="email" 
               name="email" 
               type="email" 
               value="{{ old('email', $user->email) }}" 
               required 
               autocomplete="username"
               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        @error('email')
            <p class="mt-2 text-sm text-red-600 flex items-center">
                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
            </p>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                <p class="text-sm text-yellow-800 mb-2">
                    <i class="bi bi-exclamation-triangle mr-2"></i>Your email address is unverified.
                </p>
                <button form="send-verification" 
                        class="text-sm bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-200">
                    <i class="bi bi-send mr-1"></i>Resend Verification Email
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-green-600 flex items-center">
                        <i class="bi bi-check-circle mr-1"></i>A new verification link has been sent!
                    </p>
                @endif
            </div>
        @endif
    </div>

    <!-- Company & Address Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Company -->
        <div>
            <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="bi bi-building text-gray-400 mr-2"></i>Company <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <input id="company" 
                   name="company" 
                   type="text" 
                   value="{{ old('company', $user->company) }}" 
                   autocomplete="organization"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="bi bi-geo-alt text-gray-400 mr-2"></i>Address <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <input id="address" 
                   name="address" 
                   type="text" 
                   value="{{ old('address', $user->address) }}" 
                   autocomplete="street-address"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
        </div>
    </div>

    <!-- User Role Badge (Read-only) -->
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 mb-1">
                    <i class="bi bi-shield-check text-blue-600 mr-2"></i>Account Role
                </p>
                <p class="text-xs text-gray-600">Your current account privileges</p>
            </div>
            <span class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold text-sm">
                {{ ucfirst($user->role ?? 'user') }}
            </span>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center gap-4 pt-4">
        <button type="submit" 
                class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <i class="bi bi-check-circle mr-2"></i>Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }"
               x-show="show"
               x-transition
               x-init="setTimeout(() => show = false, 3000)"
               class="text-sm text-green-600 font-medium flex items-center">
                <i class="bi bi-check-circle-fill mr-2"></i>Profile updated successfully!
            </p>
        @endif
    </div>
</form>
