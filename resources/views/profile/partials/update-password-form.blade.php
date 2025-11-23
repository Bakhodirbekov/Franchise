<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-lock text-accent mr-2"></i>Current Password
            </label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   autocomplete="current-password"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200" />
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-shield-lock text-accent mr-2"></i>New Password
            </label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   autocomplete="new-password"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200" />
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-white mb-2">
                <i class="bi bi-shield-check text-accent mr-2"></i>Confirm Password
            </label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   autocomplete="new-password"
                   class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-accent focus:border-accent transition duration-200" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-400 flex items-center">
                    <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="gradient-accent text-gray-900 px-8 py-3 rounded-xl font-black hover:shadow-lg hover:shadow-orange-500/50 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-200 transform hover:-translate-y-0.5">
                <i class="bi bi-shield-check mr-2"></i>Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm text-green-400 font-bold flex items-center">
                    <i class="bi bi-check-circle-fill mr-2"></i>Password updated successfully!
                </p>
            @endif
        </div>
    </form>
</section>
