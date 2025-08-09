<nav class="bg-[#06D6A0] text-[#222222] p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold">My Website</a>

        <div class="space-x-4">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('program') }}">Program</a>
            <a href="{{ route('organigram') }}">Organigram</a>
            <a href="{{ route('service') }}">Service</a>
            <a href="{{ route('galeri') }}">Galeri</a>

            @auth
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                    <a href="{{ route('admin.profile') }}">Admin Profile</a>
                    <a href="{{ route('admin.manage.service') }}">Manage Service</a>
                    <a href="{{ route('admin.manage.galeri') }}">Manage Galeri</a>
                @endif

                @if (Auth::user()->role == 'superadmin')
                    <a href="{{ route('admin.manage.organigram') }}">Manage Organigram</a>
                    <a href="{{ route('admin.manage.user') }}">Manage User</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</nav>
