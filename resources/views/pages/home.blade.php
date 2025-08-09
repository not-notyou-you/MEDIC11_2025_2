@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 md:px-24 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL BESAR (Perbesar jarak di PC/Laptop, perlebar jarak atas di Mobile) -->
    <div class="w-full flex flex-col md:flex-row items-center justify-between fade-zoom md:py-20">
        <div class="text-center md:text-left md:w-3/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-7xl font-bold text-primary">UMN MEDICAL CENTER</h1>
            <h2 class="text-4xl md:text-5xl font-semibold text-primary mt-4">GEN XI</h2>
        </div>
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0 mt-8 md:mt-0">
            <div class="rounded-full bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/logo/logo1.png') }}" alt="Logo"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
    </div>

    <!-- CAROUSEL -->
    <div class="relative w-full max-w-3xl fade-zoom">
        <div class="rounded-lg bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
            <div class="overflow-hidden rounded-lg">
                <div class="carousel relative w-full h-[300px] md:h-[400px]">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="absolute w-full h-full transition-opacity duration-700 ease-in-out opacity-0">
                            <img src="{{ asset("assets/foto/c$i.jpg") }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- TEKS PENJELASAN -->
    <div class="max-w-3xl text-center space-y-6 fade-zoom"> 
        <p class="text-lg text-primary text-justify">
        UMN Medical Center berorientasi pada pelayanan kesehatan dengan kewajiban untuk memberikan pertolongan pertama, obat-obatan, serta edukasi kepada seluruh civitas akademika Universitas Multimedia Nusantara melalui kampanye-kampanye interaktif dan seminar mengenai kesehatan. Selain memiliki kegiatan yang interaktif, UMN Medical Center juga belajar mengenai solidaritas dan kekeluargaan yang disertai dengan pengimplementasian nilai 5C, baik di dalam maupun di luar kampus.
        </p>
    </div>

    <div class="h-[80px] md:h-[40px]"></div>

    <!-- VISI -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/foto/pelatihan3.jpg') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">VISI</h3>
            <p class="mt-4 text-lg text-primary text-justify">
                Menjadikan UMN Medical Center sebagai sarana pertolongan pertama yang responsif, tepat, dan berintegritas dengan berlandaskan pada tanggung jawab dan kepedulian.
            </p>
        </div>
    </div>

    <div class="h-[60px] md:h-[30px]"></div>

    <!-- MISI -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/foto/pelatihan6.jpg') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">MISI</h3>
            <p class="mt-4 text-lg text-primary text-justify">
                Menyediakan layanan pertolongan pertama yang responsif dan tepat bagi civitas akademika, mengembangkan tim yang kompeten melalui pelatihan rutin, serta menjalin hubungan kolaborasi baik internal dan eksternal untuk menciptakan lingkungan yang mendukung kesehatan seluruh komunitas kampus.
            </p>
        </div>
    </div>
</div>
<x-footer />

<!-- SCRIPT UNTUK CAROUSEL & ANIMASI SCROLL -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // CAROUSEL
        const slides = document.querySelectorAll(".carousel div");
        let index = 0;

        function showSlide() {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? "1" : "0";
            });
            index = (index + 1) % slides.length;
        }

        setInterval(showSlide, 2000);
        showSlide();

        // ANIMASI SCROLL (FADE OUT LEBIH SLOW, ZOOM OUT LEBIH KEREN)
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
    });
</script>
@endsection
