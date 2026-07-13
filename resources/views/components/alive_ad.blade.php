{{-- resources/views/components/alive_ad.blade.php --}}
<div id="alive-ad-root"
     x-data="{
       open: false,
       init() {
         // modal selalu muncul setiap load halaman
         setTimeout(() => {
           this.open = true;
         }, 500); // jeda 0.5s sebelum muncul
       },
       close() { this.open = false; }
     }"
     x-init="init()"
     x-show="open"
     @click.self="close()"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
     aria-hidden="true"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-500"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
>
  <!-- Modal card -->
  <div
    @click.stop
    x-show="open"
    x-transition:enter="transition ease-out duration-500 transform"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-500 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="bg-[#FFFFF2] border-4 border-[#4F352F] rounded-2xl shadow-xl max-w-lg w-full p-6 text-center relative"
  >
    <!-- Logo -->
    <div class="flex justify-center mb-4">
      <img
        src="{{ asset('assets/logo/alive.webp') }}"
        alt="Alive Logo"
        class="h-24 object-contain animate-heartbeat"
      />
    </div>

    <!-- Title -->
    <h2 class="text-2xl font-bold text-[#4F352F] mb-3">ALIVE</h2>

    <!-- Description -->
    <p class="text-gray-700 text-sm leading-relaxed mb-6">
      Alive merupakan kegiatan tahunan yang mengangkat mengenai isu-isu kesehatan.
      Kegiatan ini sendiri berisi edukasi kesehatan yang dapat menjadi sarana
      menyebarkan dan meningkatkan kesadaran mengenai pentingnya menjaga
      kesehatan diri masing-masing.
    </p>

    <!-- Buttons -->
    <div class="flex justify-center space-x-4">
      <a
        href="{{ url('/alive') }}"
        class="bg-[#4F352F] text-white px-4 py-2 rounded-xl shadow hover:opacity-90 transition"
      >
        Kenali Alive
      </a>

      <button
        type="button"
        data-alive-close
        @click="close()"
        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-xl shadow hover:bg-gray-400 transition"
      >
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- fallback JS -->
<script>
  (function () {
    if (typeof Alpine !== 'undefined') return;

    const root = document.getElementById('alive-ad-root');
    if (!root) return;

    function openModal() {
      root.classList.remove('hidden');
      root.style.opacity = '1';
    }

    function closeModal() {
      root.style.transition = 'opacity 0.35s ease';
      root.style.opacity = '0';
      setTimeout(() => root.classList.add('hidden'), 350);
    }

    // modal selalu muncul tiap load halaman
    setTimeout(() => openModal(), 500);

    root.addEventListener('click', function (e) {
      if (e.target === root) closeModal();
    });

    root.querySelectorAll('[data-alive-close]').forEach(btn => {
      btn.addEventListener('click', () => closeModal());
    });
  })();
</script>

<style>
  /* fallback hidden */
  #alive-ad-root.hidden { display: none !important; }

  @keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    14% { transform: scale(1.18); }
    28% { transform: scale(1); }
    42% { transform: scale(1.18); }
    70% { transform: scale(1); }
  }
  .animate-heartbeat {
    animation: heartbeat 1.5s infinite;
    transform-origin: center;
  }
</style>
