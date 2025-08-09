@extends('layouts.dashboard_template')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">
            Accounts Management
        </h1>
        <p class="text-center text-lg text-[#144034]">Manage and organize user accounts</p>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        @if (session()->has('status'))
        <div class="mb-6">
            <div class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-[#ebf5ff]"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 lg:w-5 lg:h-5 me-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <p class="text-sm font-medium">
                    {{ session()->get('status') }}
                </p>
            </div>
        </div>
        @endif

        <div class="flex flex-col space-y-4 justify-center sm:space-y-0 sm:flex-row sm:justify-between mb-5">
            <h2 class="text-xl font-semibold text-[#144034]">User Accounts</h2>
            <a href="{{ route('profile.create_admin') }}"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                Add New Account
            </a>
        </div>

        @if ($accounts->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-[#048C6A]/10">
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tl-md rounded-bl-md border-r border-[#048C6A]/20">
                            ID</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Email</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            First Name</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Last Name</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Role</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Created At</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Updated At</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tr-md rounded-br-md">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                    <tr class="hover:bg-[#e0f2e9]">
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $account->id }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20 hover:underline">
                            <a href="{{ route('profile.edit_admin', $account->id) }}" class="text-[#144034] text-sm font-semibold">
                                {{ $account->email }}
                            </a>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $account->first_name }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $account->last_name }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            @if ($account->is_admin == 1)
                            <span class="w-20 text-center p-1 rounded bg-emerald-500/10 text-emerald-500 font-semibold text-[12px] leading-none">
                                Admin
                            </span>
                            @else
                            <span class="w-20 text-center p-1 rounded bg-blue-500/10 text-blue-500 font-semibold text-[12px] leading-none">
                                User
                            </span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $account->formatted_created_at }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $account->formatted_updated_at }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <form action="{{ route('profile.destroy_admin', $account->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm font-semibold hover:text-red-800 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $accounts->links('vendor.pagination.tailwind') }}</div>
        @else
        <div class="min-h-96 flex flex-col items-center justify-center p-10 border border-dashed border-[#048C6A] rounded-lg">
            <i class="ri-user-line text-6xl text-[#048C6A] mb-4"></i>
            <p class="text-xl font-semibold text-center text-[#144034]">No accounts found</p>
            <p class="text-center text-gray-500 mt-2">Start by creating your first account</p>
        </div>
        @endif
    </div>
</div>
@endsection