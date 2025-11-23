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
            <label for="name" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-person text-accent mr-2"></i>Full Name
            </label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
            @error('name')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-telephone text-accent mr-2"></i>Phone Number
            </label>
            <input id="phone" 
                   name="phone" 
                   type="tel" 
                   value="{{ old('phone', $user->phone) }}" 
                   autocomplete="tel"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
            @error('phone')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-bold text-white mb-2">
            <i class="bi bi-envelope text-accent mr-2"></i>Email Address
        </label>
        <input id="email" 
               name="email" 
               type="email" 
               value="{{ old('email', $user->email) }}" 
               required 
               autocomplete="username"
               class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
        @error('email')
            <p class="mt-2 text-sm text-red-400 flex items-center">
                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
            </p>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 p-4 bg-yellow-900/20 border border-yellow-500 rounded-xl">
                <p class="text-sm text-yellow-400 mb-2">
                    <i class="bi bi-exclamation-triangle mr-2"></i>Your email address is unverified.
                </p>
                <button form="send-verification" 
                        class="text-sm gradient-accent text-gray-900 px-4 py-2 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-500/50 transition duration-200">
                    <i class="bi bi-send mr-1"></i>Resend Verification Email
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-green-400 flex items-center">
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
            <label for="company" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-building text-gray-500 mr-2"></i>Company <span class="text-gray-500 text-xs">(Optional)</span>
            </label>
            <input id="company" 
                   name="company" 
                   type="text" 
                   value="{{ old('company', $user->company) }}" 
                   autocomplete="organization"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-geo-alt text-gray-500 mr-2"></i>Address <span class="text-gray-500 text-xs">(Optional)</span>
            </label>
            <input id="address" 
                   name="address" 
                   type="text" 
                   value="{{ old('address', $user->address) }}" 
                   autocomplete="street-address"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200">
        </div>
    </div>

    <!-- User Role Badge (Read-only) -->
    <div class="gradient-darkrock border border-gray-600 rounded-xl p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-white mb-1">
                    <i class="bi bi-shield-check text-accent mr-2"></i>Account Role
                </p>
                <p class="text-xs text-gray-400">Your current account privileges</p>
            </div>
            <span class="px-4 py-2 gradient-accent text-gray-900 rounded-lg font-black text-sm">
                {{ ucfirst($user->role ?? 'user') }}
            </span>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center gap-4 pt-4">
        <button type="submit" 
                class="gradient-accent text-gray-900 px-8 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-200 transform hover:-translate-y-0.5">
            <i class="bi bi-check-circle mr-2"></i>Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }"
               x-show="show"
               x-transition
               x-init="setTimeout(() => show = false, 3000)"
               class="text-sm text-green-400 font-bold flex items-center">
                <i class="bi bi-check-circle-fill mr-2"></i>Profile updated successfully!
            </p>
        @endif
    </div>
</form>
