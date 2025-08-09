<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Tombol untuk membuka form password -->
    <div class="flex items-center gap-4 mt-6">
        <x-primary-button
            type="button"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            id="open-password-modal"
        >
            {{ __('Update Password') }}
        </x-primary-button>
    </div>

    <!-- Form Update Password (meniru modal style) -->
    <div id="update-password-modal" class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-md w-full max-w-md p-6">
            <header class="mb-4">
                <h3 class="text-xl font-medium text-gray-900">{{ __('Update Password') }}</h3>
            </header>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Current Password') }}</label>
                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        autocomplete="current-password"
                        required
                    />
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('New Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        autocomplete="new-password"
                        required
                    />
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        autocomplete="new-password"
                        required
                    />
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Modal Footer with buttons -->
                <div class="flex items-center justify-between">
                    <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                    <button type="button" id="close-password-modal" class="text-gray-600 hover:text-gray-900">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation message -->
    @if (session('status') === 'password-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 mt-4"
        >
            {{ __('Password updated successfully.') }}
        </p>
    @endif
</section>

<script>
    // Script untuk membuka dan menutup modal tanpa komponen modal.blade.php
    const openModalButton = document.getElementById('open-password-modal');
    const closeModalButton = document.getElementById('close-password-modal');
    const modal = document.getElementById('update-password-modal');

    // Menampilkan modal saat tombol ditekan
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Menutup modal saat tombol cancel ditekan
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Menutup modal jika area di luar modal diklik
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
