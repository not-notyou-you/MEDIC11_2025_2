@extends('layouts.dashboard_template')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Add New Account</h2>
    
    <!-- Display validation errors -->
    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
        <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
        <ul class="list-disc list-inside text-red-600 text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('profile.store_admin') }}">
        @csrf
        
        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required 
                   class="w-full mt-1 p-2 border rounded @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}"
                   placeholder="example@student.umn.ac.id" />
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-xs mt-1">Must end with @student.umn.ac.id</p>
        </div>
        
        <!-- First Name -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
            <input type="text" name="first_name" required 
                   class="w-full mt-1 p-2 border rounded @error('first_name') border-red-500 @enderror"
                   value="{{ old('first_name') }}"
                   placeholder="Enter first name" />
            @error('first_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Last Name -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
            <input type="text" name="last_name" required 
                   class="w-full mt-1 p-2 border rounded @error('last_name') border-red-500 @enderror"
                   value="{{ old('last_name') }}"
                   placeholder="Enter last name" />
            @error('last_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required 
                   class="w-full mt-1 p-2 border rounded @error('password') border-red-500 @enderror"
                   placeholder="Minimum 8 characters" />
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-xs mt-1">Password must be at least 8 characters long</p>
        </div>
        
        <!-- Password Confirmation -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full mt-1 p-2 border rounded"
                   placeholder="Re-enter password" />
        </div>
        
        <!-- Role -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="is_admin" id="is_admin" 
                    class="w-full mt-1 p-2 border rounded @error('is_admin') border-red-500 @enderror">
                <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>User</option>
                <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('is_admin') == '2' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @error('is_admin')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-500 text-xs mt-1">Only superadmin can create superadmin accounts</p>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-blue-600 text-white px-5 py-2.5 rounded hover:bg-blue-700 transition duration-300 font-medium">
                Add Account
            </button>
            <a href="{{ route('profile.index') }}" 
               class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded hover:bg-gray-300 transition duration-300 font-medium">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection