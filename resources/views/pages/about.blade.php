@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <div class="mt-16 relative bg-gradient-to-r from-[#53b490] to-[#3a8d6d] py-10 md:py-12">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h1 class="text-4xl md:text-4xl font-semibold text-white mb-4 fade-zoom">INTEGRITY IN ACTION</h1>
            <h2 class="text-4xl md:text-4xl font-semibold text-white fade-zoom">COMMITMENT TO CARE</h2>
        </div>
    </div>

    <!-- Tentang Kami Section -->
    <div class="container mx-auto px-0 md:px-0 py-16">
        <div class="bg-[#144034] rounded-xl shadow-2xl overflow-hidden fade-zoom">
            <!-- Card Header -->
            <div class="bg-[#1e5a44] px-6 py-4">
                <h2 class="text-2xl md:text-3xl font-bold text-white">TENTANG KAMI</h2>
            </div>
            
            <!-- Card Content -->
            <div class="flex flex-col lg:flex-row">
                <!-- Text Content (2/3 on desktop, full width on mobile) -->
                <div class="w-full lg:w-2/3 p-6 md:p-8">
                    <p class="text-[#effaf5] text-lg md:text-xl leading-relaxed text-justify">
                        UMN Medical Center merupakan Lembaga Semi Otonom di bawah pengawasan Badan Eksekutif Mahasiswa yang bergerak di bidang kesehatan. Mulai beroperasi sejak tahun 2014, dan telah resmi berdiri pada tahun 2015. UMN Medical Center kini sudah memasuki generasi kesepuluh, menunjukkan eksistensinya yang berkelanjutan dan dedikasinya dalam memberikan pelayanan kesehatan terbaik bagi civitas akademika Universitas Multimedia Nusantara.
                    </p>
                </div>
                
                <!-- Carousel Section -->
                <div class="w-full lg:w-1/3 p-4">
                    <div class="h-full w-full bg-black/10 rounded-lg overflow-hidden relative">
                        <div id="imageCarousel" class="h-full w-full relative">
                            <!-- Slide 1 -->
                            <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-100">
                                <img src="{{ asset('assets/foto/pelatihan7.webp') }}" alt="Pelatihan" 
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0">
                                <img src="{{ asset('assets/foto/pelatihan8.webp') }}" alt="Pelantikan" 
                                    class="w-full h-full object-cover">
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0">
                                <img src="{{ asset('assets/foto/pelatihan9.webp') }}" alt="Percobaan" 
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filosofi Logo Section -->
    <div class="container mt-2 mb-8 mx-auto px-6 md:px-12 py-16">
        <div class="text-center mb-16 fade-zoom">
            <h2 class="text-3xl md:text-4xl font-bold text-[#3a8d6d]">Filosofi Logo</h2>
            <div class="w-24 h-1 bg-[#53b490] mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Column 1 -->
            <div class="space-y-8">
                <!-- Item 1 -->
                <div class="flex items-start fade-zoom">
                    <div class="relative flex-shrink-0 mr-6">
                        <div class="absolute -inset-2 bg-[#3a8d6d] rounded-full shadow-lg"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <img src="{{ asset('assets/about/logo.webp') }}" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#3a8d6d] mb-2">Sisi Terbuka pada Pertemuan Tanda Plus</h3>
                        <p class="text-gray-700">Melambangkan keterbukaan UMN Medical Center kepada siapapun.</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="flex items-start fade-zoom">
                    <div class="relative flex-shrink-0 mr-6">
                        <div class="absolute -inset-2 bg-[#3a8d6d] rounded-full shadow-lg"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <img src="{{ asset('assets/about/logo3.webp') }}" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#3a8d6d] mb-2">Warna Hijau</h3>
                        <p class="text-gray-700">Melambangkan kesegaran dari keharmonisan.</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="flex items-start fade-zoom">
                    <div class="relative flex-shrink-0 mr-6">
                        <div class="absolute -inset-2 bg-[#3a8d6d] rounded-full shadow-lg"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <img src="{{ asset('assets/about/logo1.webp') }}" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#3a8d6d] mb-2">Bagian Melengkung pada Ujung Tanda Plus</h3>
                        <p class="text-gray-700">Melambangkan fleksibilitas.</p>
                    </div>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="space-y-8">
                <!-- Item 4 -->
                <div class="flex items-start fade-zoom">
                    <div class="relative flex-shrink-0 mr-6">
                        <div class="absolute -inset-2 bg-[#3a8d6d] rounded-full shadow-lg"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <img src="{{ asset('assets/about/logo4.webp') }}" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#3a8d6d] mb-2">Logo Universitas Multimedia Nusantara</h3>
                        <p class="text-gray-700">Melambangkan UMN Medical Center merupakan bagian dari Universitas Multimedia Nusantara.</p>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="flex items-start fade-zoom">
                    <div class="relative flex-shrink-0 mr-6">
                        <div class="absolute -inset-2 bg-[#3a8d6d] rounded-full shadow-lg"></div>
                        <div class="relative bg-white rounded-full p-4 shadow-lg">
                            <img src="{{ asset('assets/about/logo2.webp') }}" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-[#3a8d6d] mb-2">Tanda Plus Hijau</h3>
                        <p class="text-gray-700">Melambangkan 4 fakultas yang ada di Universitas Multimedia Nusantara yang berarti kerjasama dan solidaritas antar anggota.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-[#53b490] to-[#3a8d6d] py-16 mb-8">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-12 fade-zoom">Maskot</h2>
            
            <div class="flex flex-col md:flex-row justify-center items-center gap-12 max-w-5xl mx-auto">
                <!-- Medi -->
                <div class="bg-white rounded-xl p-6 shadow-xl transform transition-all hover:scale-105 fade-zoom w-full md:w-80">
                    <div class="relative h-64 mb-6">
                        <img src="{{ asset('assets/mascot/medi4.webp') }}" 
                             class="w-full h-full object-contain object-center"
                             alt="Maskot medi">
                    </div>
                    <div class="mt-4">
                        <div onclick="openMediModal()" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md inline-block font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer">
                             M E D I
                        </div>
                        <img src="{{ asset('assets/logo/MedicWhite_highres.webp') }}" 
                             class="w-20 mx-auto mt-4 opacity-90"
                             alt="Logo UMN Medical Center">
                    </div>
                </div>

                <!-- Ical -->
                <div class="bg-white rounded-xl p-6 shadow-xl transform transition-all hover:scale-105 fade-zoom w-full md:w-80">
                    <div class="relative h-64 mb-6">
                        <img src="{{ asset('assets/mascot/ical4.webp') }}" 
                             class="w-full h-full object-contain object-center"
                             alt="Maskot ical">
                    </div>
                    <div class="mt-4">
                        <div onclick="openIcalModal()" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md inline-block font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer">
                             I C A L 
                        </div>
                        <img src="{{ asset('assets/logo/MedicWhite_highres.webp') }}" 
                             class="w-20 mx-auto mt-4 opacity-90"
                             alt="Logo UMN Medical Center">
                    </div>
                </div>
            </div>
          </div>
    </div>

    <!-- Include modals -->
    <x-medi_nav />
    <x-ical_nav />

    <style>
        /* Carousel Styles */
        #imageCarousel {
            min-height: 300px;
        }
        
        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        
        .carousel-slide.active {
            opacity: 1;
        }

        /* Modal Responsive */
        @media (max-width: 640px) {
            #mediModal > div, #icalModal > div {
                width: 95%;
                padding: 1rem;
            }
            .flex-col.md\:flex-row {
                flex-direction: column;
            }
            .w-full.md\:w-1\/3 {
                width: 100%;
                margin-bottom: 1rem;
            }
            .w-full.md\:w-2\/3 {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const elements = document.querySelectorAll(".fade-zoom");

            const carousel = document.getElementById('imageCarousel');
            if (carousel) {
                const slides = carousel.querySelectorAll('.carousel-slide');
                let currentSlide = 0;

                slides[currentSlide].classList.add('active');
                
                function showNextSlide() {

                    slides[currentSlide].classList.remove('active');
                    
                    currentSlide = (currentSlide + 1) % slides.length;
                    
                    slides[currentSlide].classList.add('active');
                }
                
                setInterval(showNextSlide, 2000);
            }
        });
    </script>
@endsection