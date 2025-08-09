@extends('layouts.dashboard_template')

@section('content')

<div class="min-h-[500px] bg-white rounded-md p-6 flex items-center">
    <form class="max-w-md w-full mx-auto" action="{{ route('profile.update_admin', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="relative z-0 w-full mb-5 group">
            <input type="email" name="email" id="floating_email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ $user->email }}" />
            <label for="floating_email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                address</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="first_name" id="floating_first_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ $user->first_name }}" />
            <label for="floating_first_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                name</label>
        </div>
        <div class="relative z-0 mb-5 w-full group">
            <input type="text" name="last_name" id="floating_last_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ $user->last_name }}" />
            <label for="floating_last_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                name</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <select id="status" name="status"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1.5 px-2.5">
                <option value="0" @if ($user->is_admin == '0') selected @endif>User</option>
                <option value="1" @if ($user->is_admin == '1') selected @endif>Admin</option>
            </select>
        </div>

        <div class="flex justify-center">
            <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
        </div>
    </form>
</div>

@endsection