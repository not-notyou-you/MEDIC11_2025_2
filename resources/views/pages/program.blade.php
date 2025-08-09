@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center px-4 md:px-24 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL BESAR -->
    <div class="w-full flex flex-col md:flex-row items-center justify-center fade-zoom md:py-20">
        <div class="text-center md:w-4/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-10xl font-semibold text-primary">PRORAM KERJA RUTIN</h1>
            <h2 class="text-4xl md:text-3xl font-bold text-primary mt-2">UMN Medical Center Gen XI</h2>
        </div>
    </div>

    <!-- PIKET -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/piket.png') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Piket</h3>
            <p class="mt-4 text-lg text-primary">
                Piket dilaksanakan setiap hari kerja dengan tujuan agar memastikan pelayanan kesehatan dapat tetap berjalan. Jadwal yang disediakan ialah Senin hingga Jumat pukul 08.00 – 17.00, dan Sabtu pukul 08.00 – 11.00. Setiap anggota bertugas secara bergiliran untuk menjaga UKK dan kebutuhan kampus.
            </p>
        </div>
    </div>

    <div class="h-[30px] md:h-[10px]"></div>

    <!-- PELATIHAN -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pelatihan.png') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pelatihan</h3>
            <p class="mt-4 text-lg text-primary">
                Pelatihan merupakan kegiatan yang ditujukan untuk seluruh anggota UMN Medical Center untuk meningkatkan pengetahuan dan keterampilan dasar medis. Materi dari pelatihan ini sendiri mencakup pertolongan pertama, penggunaan alat-alat kesehatan, dan penggunaan obat-obat yang tersedia dalam UKK. Kegiatan ini dilakukan agar setiap anggota UMN Medical Center dapat sigap dan tetap siap dalam bertugas.
            </p>
        </div>
    </div>


    <div class="h-[30px] md:h-[10px]"></div>

    <!-- RAPAT -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/rapat.png') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Rapat</h3>
            <p class="mt-4 text-lg text-primary">
                Rapat dilakukan secara rutin untuk memonitor dan mengevaluasi kinerja dan perkembangan setiap anggota. Agenda dari rapat sendiri meliputi update dari kegiatan setiap divisi, pembahasan kendala, dan penyusunan strategi untuk meningkatkan pelayanan. Hal ini bertujuan agar dapat menyelesaikan suatu masalah dan memperkuat koordinasi dari tiap divisi maupun anggota.
            </p>
        </div>
    </div>

    <div class="h-[30px] md:h-[10px]"></div>

    <!-- PENGAJUAN JASA -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pengajuan_jasa.png') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pengajuan Jasa</h3>
            <p class="mt-4 text-lg text-primary">
                UMN Medical Center menerima pengajuan jasa dari berbagai pihak dalam lingkup kampus. Pengajuan ini mencakup dari permintaan pertolongan medis dalam kegiatan kampus, kerja sama, hingga konsultasi kesehatan. Prosedur dari pengajuan sendiri dapat dilakukan melalui pengisian form dan menghubungi Line OA UMN Medical Center agar pelayanan dapat disiapkan secara optimal.
            </p>
        </div>
    </div>

    <div class="w-full flex flex-col md:flex-row items-center justify-center fade-zoom md:py-20">
        <div class="text-center md:w-5/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-10xl font-semibold text-primary">PRORAM KERJA UNGGULAN</h1>
            <h2 class="text-4xl md:text-3xl font-bold text-primary mt-2">UMN Medical Center Gen XI</h2>
        </div>
    </div>

    <!-- apresiasi -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/apresiasi.png') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Apresiasi</h3>
            <p class="mt-4 text-lg text-primary">
            Program yang bertujuan untuk memberikan penghargaan bagi anggota-anggota yang telah berperan aktif dan berdedikasi tinggi. Hal ini bertujuan agar menjaga api semangat tiap anggota dan menjadi suatu motivasi agar dapat terus bekerja dengan maksimal.
            </p>
        </div>
    </div>

    <div class="h-[30px] md:h-[10px]"></div>

    <!-- identity -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/identity.png') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Identity</h3>
            <p class="mt-4 text-lg text-primary">
            Pembuatan kartu tanda pengenal khusus tiap anggota UMN Medical Center. Kartu itu berfungsi sebagai identitas resmi serta bukti nyata anggota telah bekerja dan menjalankan tugas medis di lingkungan kampus. Selain menjadi identitas resmi, hal ini juga bertujuan untuk mempermudahkan pengenalan saat bertugas di berbagai kegiatan.
            </p>
        </div>
    </div>

    <div class="h-[80px] md:h-[40px]"></div>

    <!-- ALIVE -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/alive.png') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">ALIVE</h3>
            <p class="mt-4 text-lg text-primary">
                Alive sendiri merupakan kegiatan tahunan yang mengangkat mengenai isu-isu kesehatan. Kegiatan ini sendiri berisi edukasi kesehatan yang dapat menjadi sarana menyebarkan dan meningkatkan kesadaran mengenai pentingnya menjaga kesehatan diri masing-masing.
            </p>
        </div>
    </div>

    <div class="h-[60px] md:h-[30px]"></div>

    <!-- Cek Kesehatan -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/cek_kesehatan.png') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Cek Kesehatan</h3>
            <p class="mt-4 text-lg text-primary">
            Program ini berkolaborasi dengan pihak eksternal untuk memberikan layanan cek kesehatan dalam lingkup kampus. Pemeriksaan sendiri dapat meliputi cek tensi ataupun saturasi oksigen. Tujuannya adalah meningkatkan kesadaran lingkup kampus mengenai kondisi masing-masing dan pengingat untuk selalu menjaga kesehatan.
            </p>
        </div>
    </div>

    <div class="h-[80px] md:h-[40px]"></div>

    <!-- Pelatihan Civitas UMN -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pelatihan_civitas.png') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pelatihan Civitas UMN</h3>
            <p class="mt-4 text-lg text-primary">
            Pelatihan ini ditujukan kepada civitas UMN mengenai pertolongan pertama dan penggunaan alat medis dasar. Materi disusun secara simple agar mudah dipahami dan dapat diaplikasikan ketika ada situasi darurat.
            </p>
        </div>
    </div>

    <div class="h-[60px] md:h-[30px]"></div>

    <!-- BONDING -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/bonding.png') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Bonding</h3>
            <p class="mt-4 text-lg text-primary">
                Bonding adalah kegiatan internal dengan tujuan utama mempererat hubungan antaranggota UMN Medical Center. Bentuk dari ekgiatan ini sendiri beragam. Dimulai dari outing, games, dan diskusi sehingga menciptakan kekeluargaan dan suasana yang solid.
            </p>
        </div>
    </div>
</div>

<x-footer />


<script>
        const elements = document.querySelectorAll(".fade-zoom");

        function animateOnScroll() {
            const viewportHeight = window.innerHeight;

            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                const distanceFromCenter = Math.abs(viewportHeight / 2 - (rect.top + rect.height / 2));

                const fadeStart = viewportHeight * 0.10;
                const fadeEnd = viewportHeight * 0.7;
                const fadeAmount = Math.min(1, Math.max(0, (distanceFromCenter - fadeStart) / (fadeEnd - fadeStart)));

                const scaleAmount = 1 - fadeAmount * 0.25;

                el.style.opacity = 1 - fadeAmount;
                el.style.transform = `scale(${scaleAmount})`;
            });
        }

        window.addEventListener("scroll", animateOnScroll);
        animateOnScroll();
</script>
@endsection
