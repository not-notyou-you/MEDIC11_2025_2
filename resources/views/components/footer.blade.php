<footer class="bg-gradient-to-tr from-[#1A1F2B] to-[#048C6A] text-white font-roboto mt-12 rounded-t-[20px] shadow-[0_-6px_20px_rgba(0,0,0,0.3)] w-full text-sm" id="specialFooter">
    <!-- Overlay dan Modal tetap sama (tidak ditampilkan ulang) -->

    <!-- Konten Utama -->
    <div class="px-6 md:px-12 py-6 flex flex-col md:flex-row justify-between items-center md:items-start gap-6">
        <!-- Kiri: Logo, Sosial Media, dan Kontak -->
        <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-3">
            <img src="{{ asset('/assets/logo/MedicWhite_highres.png') }}" alt="Logo Medic" class="h-20 mb-2 drop-shadow-[0_2px_4px_rgba(0,0,0,0.4)]">
            
            <div class="flex gap-4">
                <a href="https://www.instagram.com/umnmedicalcenter/" target="_blank" class="hover:scale-110 transition">
                    <img src="{{ asset('/assets/logo/instagram.png') }}" alt="Instagram" class="w-6 h-6">
                </a>
                <a href="https://line.me/R/ti/p/@617rpkkn" target="_blank" class="hover:scale-110 transition">
                    <img src="{{ asset('/assets/logo/line.png') }}" alt="Line" class="w-6 h-6">
                </a>
                <a href="https://www.tiktok.com/@medical.center.umn" target="_blank" class="hover:scale-110 transition">
                    <img src="{{ asset('/assets/logo/tiktok.png') }}" alt="TikTok" class="w-6 h-6">
                </a>
            </div>

            <div class="flex items-center gap-2 text-white font-medium">
                <i class="fa-solid fa-phone text-sm"></i>
                <span>Ext. 7000</span>
            </div>
        </div>

        <!-- Kanan: Alamat dan Jam Operasional -->
        <div class="text-center md:text-right space-y-1">
            <h3 class="font-poppins font-semibold text-lg text-white tracking-wide">UMN MEDICAL CENTER</h3>
            <p>Universitas Multimedia Nusantara</p>
            <p>Jl. Scientia Boulevard, Curug Sangereng</p>
            <p>Kec. Klp. Dua, Kab. Tangerang, Banten 15810</p>
            <div class="mt-2">
                <p class="font-semibold">Operational Hours</p>
                <p>Weekdays: 08.00 - 17.00</p>
                <p>Saturday: 08.00 - 11.00</p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-[#111827] py-3 text-center text-xs tracking-wide text-[#A0F0D5]">
        &copy; 2025 <strong>UMN Medical Center</strong> — All Rights Reserved.
    </div>
</footer>
