@extends('layouts.dashboard_template')

@section('content')
<div class="min-h-screen bg-white p-4 md:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-6 md:mb-8 lg:mb-10 text-center">
        <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">
            Edit Account: {{ $user->first_name }} {{ $user->last_name }}
        </h2>
        <p class="text-gray-600 text-sm md:text-base">Edit user information and permissions</p>
    </div>

    <!-- Display validation errors -->
    @if ($errors->any())
    <div class="mb-6 mx-auto max-w-4xl p-4 bg-red-50 border border-red-200 rounded">
        <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
        <ul class="list-disc list-inside text-red-600 text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Form -->
    <form class="mx-auto max-w-4xl" action="{{ route('profile.update_admin', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Row 1 - Grid for Name Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
            <!-- First Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" name="first_name" 
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                       value="{{ old('first_name', $user->first_name) }}" 
                       required />
                @error('first_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" name="last_name" 
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                       value="{{ old('last_name', $user->last_name) }}" 
                       required />
                @error('last_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="md:col-span-2 lg:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" 
                       class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                       value="{{ old('email', $user->email) }}" 
                       required />
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Must be valid UMN email</p>
            </div>
        </div>

        <!-- Row 2 - Grid for Role -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="status" 
                        class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                    <option value="0" {{ old('status', $user->is_admin) == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ old('status', $user->is_admin) == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('status', $user->is_admin) == 2 ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Role Display -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Role</label>
                <div class="w-full p-3 border border-gray-200 rounded bg-gray-50">
                    @if($user->is_admin == 2)
                        <span class="text-green-600 font-medium">Super Admin</span>
                    @elseif($user->is_admin == 1)
                        <span class="text-blue-600 font-medium">Admin</span>
                    @else
                        <span class="text-gray-600 font-medium">User</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Row 3 - Grid for Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
            <!-- New Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-sm font-medium text-gray-700">New Password</label>
                    <button type="button" 
                            class="text-xs text-green-600 hover:text-green-800 toggle-password" 
                            data-target="password">
                        Show
                    </button>
                </div>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="w-full p-3 pr-10 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                           placeholder="Leave empty to keep current password" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Minimum 8 characters</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <button type="button" 
                            class="text-xs text-green-600 hover:text-green-800 toggle-password" 
                            data-target="password_confirmation">
                        Show
                    </button>
                </div>
                <div class="relative">
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="w-full p-3 pr-10 border border-gray-300 rounded focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500"
                           placeholder="Re-enter new password" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('profile.index') }}" 
               class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition duration-300 font-medium text-center">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 bg-green-600 text-white rounded hover:bg-green-700 transition duration-300 font-medium">
                Save Changes
            </button>
        </div>

        <!-- Current Info Section -->
        <div class="mt-8 p-4 border border-gray-200 rounded bg-gray-50">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Account Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                <div>
                    <span class="text-gray-500">Created:</span>
                    <span class="ml-2 text-gray-700">{{ $user->formatted_created_at }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Last Updated:</span>
                    <span class="ml-2 text-gray-700">{{ $user->formatted_updated_at }}</span>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    });

    // Real-time password strength (optional)
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const hint = this.nextElementSibling?.nextElementSibling;
            
            if (password.length > 0 && password.length < 8) {
                if (hint && hint.classList.contains('text-gray-500')) {
                    hint.classList.remove('text-gray-500');
                    hint.classList.add('text-red-500');
                    hint.textContent = 'Password must be at least 8 characters';
                }
            } else if (password.length >= 8) {
                if (hint && hint.classList.contains('text-red-500')) {
                    hint.classList.remove('text-red-500');
                    hint.classList.add('text-green-500');
                    hint.textContent = '✓ Password meets minimum length';
                }
            } else {
                if (hint && (hint.classList.contains('text-red-500') || hint.classList.contains('text-green-500'))) {
                    hint.classList.remove('text-red-500', 'text-green-500');
                    hint.classList.add('text-gray-500');
                    hint.textContent = 'Minimum 8 characters';
                }
            }
        });
    }
});
</script>
@endpush
@endsection