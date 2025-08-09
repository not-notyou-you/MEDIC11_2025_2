@extends('layouts.dashboard_template')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Add New Account</h2>
    <form method="POST" action="{{ route('profile.store_admin') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required class="w-full mt-1 p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" name="first_name" required class="w-full mt-1 p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" name="last_name" required class="w-full mt-1 p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required class="w-full mt-1 p-2 border rounded" />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="is_admin" class="w-full mt-1 p-2 border rounded">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Account</button>
    </form>
</div>
@endsection
