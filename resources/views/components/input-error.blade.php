<div class="bg-[#ffe5e5] border-l-4 border-[#e53935] text-[#a01010] px-4 py-3 rounded-lg shadow-inner mb-4">
    <p class="font-semibold">{{ $title ?? 'Error!' }}</p>

    <!-- Periksa apakah $messages terdefinisi dan apakah array atau string -->
    <p class="text-sm">
        @if(isset($messages) && is_array($messages))
            {{-- Jika $messages adalah array, gabungkan menjadi string dan tampilkan --}}
            @foreach($messages as $msg)
                <span>{{ $msg }}</span><br>
            @endforeach
        @elseif(isset($messages))
            {{-- Jika $messages adalah string, tampilkan langsung --}}
            {{ $messages }}
        @endif
    </p>
</div>
