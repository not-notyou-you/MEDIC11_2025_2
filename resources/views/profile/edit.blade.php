@extends('layouts.dashboard_template')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-4 sm:p-6">
    <!-- Header -->
    <div class="bg-white border border-[#048C6A] rounded-lg shadow shadow-black/5 px-4 py-5 text-center mb-6">
        <h1 class="text-xl sm:text-2xl font-semibold text-[#144034]">
            <span id="greeting"></span>
            <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name ?? '' }}</span>!
        </h1>
        <p class="text-sm sm:text-base text-[#144034]">Manage your profile information and security</p>
    </div>

    <!-- Profile Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
        <!-- Update Password -->
        <section class="bg-white border border-[#048C6A] rounded-lg shadow shadow-black/5 px-4 py-5">
            @include('profile.partials.update-password-form')
        </section>

        <!-- Delete Account -->
        <section class="bg-white border border-[#048C6A] rounded-lg shadow shadow-black/5 px-4 py-5">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
</div>

<script>
    // Greeting berdasarkan waktu
    const hour = new Date().getHours();
    const greeting = document.getElementById('greeting');
    greeting.textContent =
        hour < 12 ? 'Selamat Pagi,' :
        hour < 18 ? 'Selamat Siang,' :
        'Selamat Malam,';
</script>
@endsection
