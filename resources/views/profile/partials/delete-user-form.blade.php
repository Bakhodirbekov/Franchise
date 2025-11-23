<section class="space-y-6">
    <div class="bg-red-900/20 border border-red-500 rounded-xl p-6">
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 bg-red-900/50 border border-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="bi bi-exclamation-triangle text-red-400 text-xl"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-black text-white mb-2">
                    Delete Account Permanently
                </h3>
                <p class="text-sm text-gray-400 mb-4">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
                <button type="button"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl font-black transition duration-200 hover:shadow-lg hover:shadow-red-500/50">
                    <i class="bi bi-trash mr-2"></i>Delete Account
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ show: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }"
         x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null"
         x-on:close.stop="show = false"
         x-on:keydown.escape.window="show = false"
         x-show="show"
         class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
         style="display: none;">
        <div x-show="show" 
             class="fixed inset-0 transform transition-all"
             x-on:click="show = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-900/75"></div>
        </div>

        <div x-show="show" 
             class="mb-6 bg-gray-800 border border-gray-700 rounded-2xl shadow-xl transform transition-all sm:w-full sm:max-w-md mx-auto"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-xl font-black text-white mb-4">
                    <i class="bi bi-exclamation-triangle text-red-400 mr-2"></i>Are you sure?
                </h2>

                <p class="text-sm text-gray-400 mb-6">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-bold text-white mb-2">
                        <i class="bi bi-lock text-accent mr-2"></i>Password
                    </label>
                    <input id="password"
                           name="password"
                           type="password"
                           placeholder="Enter your password"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200" />
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-400 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" 
                            x-on:click="show = false"
                            class="px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-xl font-bold transition duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-black transition duration-200 hover:shadow-lg hover:shadow-red-500/50">
                        <i class="bi bi-trash mr-2"></i>Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
