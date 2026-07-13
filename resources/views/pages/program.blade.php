@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 md:px-24 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL BESAR UNGGULAN -->
    <div class="w-full flex flex-col md:flex-row items-center justify-center fade-zoom md:py-20">
        <div class="text-center md:w-5/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-10xl font-semibold text-primary">PRORAM KERJA UNGGULAN</h1>
            <h2 class="text-4xl md:text-3xl font-bold text-primary mt-2">UMN Medical Center Gen XI</h2>
        </div>
    </div>

    <!-- ALIVE -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom group">
        <!-- Gambar -->
        <a href="{{ url('/alive') }}" class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)] group-hover:bg-[#4F352F] group-hover:shadow-[0px_0px_20px_rgba(255,215,0,0.8)] transition duration-300">
                <img src="{{ asset('assets/program/alive.webp') }}" 
                     alt="Alive Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)] group-hover:opacity-0 transition duration-300">
                <img src="{{ asset('assets/program/alive2.webp') }}" 
                     alt="Alive Program Hover"
                     class="absolute top-4 left-4 w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)] opacity-0 group-hover:opacity-100 transition duration-300">
            </div>
        </a>

        <!-- Teks -->
        <a href="{{ url('/alive') }}" class="text-center md:text-left md:w-3/5 mt-6 md:mt-0 block">
            <h3 class="text-4xl font-bold text-primary group-hover:text-[#4F352F] group-hover:font-extrabold transition duration-300">
                ALIVE
            </h3>
            <p class="mt-4 text-lg text-primary group-hover:text-[#4F352F] transition duration-300">
                Alive sendiri merupakan kegiatan tahunan yang mengangkat mengenai isu-isu kesehatan. 
                Kegiatan ini sendiri berisi edukasi kesehatan yang dapat menjadi sarana menyebarkan 
                dan meningkatkan kesadaran mengenai pentingnya menjaga kesehatan diri masing-masing.
            </p>
        </a>
    </div>

    <!-- CEK KESEHATAN -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/cek_kesehatan.webp') }}" 
                     alt="Cek Kesehatan Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Cek Kesehatan</h3>
            <p class="mt-4 text-lg text-primary">
                Program ini berkolaborasi dengan pihak eksternal untuk memberikan layanan cek kesehatan dalam lingkup kampus. Pemeriksaan sendiri dapat meliputi cek tensi ataupun saturasi oksigen. Tujuannya adalah meningkatkan kesadaran lingkup kampus mengenai kondisi masing-masing dan pengingat untuk selalu menjaga kesehatan.
            </p>
        </div>
    </div>

    <!-- APRESIASI -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/apresiasi.webp') }}" 
                     alt="Apresiasi Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Apresiasi</h3>
            <p class="mt-4 text-lg text-primary">
                Program yang bertujuan untuk memberikan penghargaan bagi anggota-anggota yang telah berperan aktif dan berdedikasi tinggi. Hal ini bertujuan agar menjaga api semangat tiap anggota dan menjadi suatu motivasi agar dapat terus bekerja dengan maksimal.
            </p>
        </div>
    </div>

    <!-- IDENTITY -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/identity.webp') }}" 
                     alt="Identity Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Identity</h3>
            <p class="mt-4 text-lg text-primary">
                Pembuatan kartu tanda pengenal khusus tiap anggota UMN Medical Center. Kartu itu berfungsi sebagai identitas resmi serta bukti nyata anggota telah bekerja dan menjalankan tugas medis di lingkungan kampus. Selain menjadi identitas resmi, hal ini juga bertujuan untuk mempermudahkan pengenalan saat bertugas di berbagai kegiatan.
            </p>
        </div>
    </div>

    <!-- PELATIHAN CIVITAS UMN -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pelatihan_civitas.webp') }}" 
                     alt="Pelatihan Civitas Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pelatihan Civitas UMN</h3>
            <p class="mt-4 text-lg text-primary">
                Pelatihan ini ditujukan kepada civitas UMN mengenai pertolongan pertama dan penggunaan alat medis dasar. Materi disusun secara simple agar mudah dipahami dan dapat diaplikasikan ketika ada situasi darurat.
            </p>
        </div>
    </div>

    <!-- BONDING -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/bonding.webp') }}" 
                     alt="Bonding Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Bonding</h3>
            <p class="mt-4 text-lg text-primary">
                Bonding adalah kegiatan internal dengan tujuan utama mempererat hubungan antaranggota UMN Medical Center. Bentuk dari kegiatan ini sendiri beragam. Dimulai dari outing, games, dan diskusi sehingga menciptakan kekeluargaan dan suasana yang solid.
            </p>
        </div>
    </div>

    <!-- JUDUL BESAR RUTIN -->
    <div class="w-full flex flex-col md:flex-row items-center justify-center fade-zoom md:py-20">
        <div class="text-center md:w-5/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-10xl font-semibold text-primary">PRORAM KERJA RUTIN</h1>
            <h2 class="text-4xl md:text-3xl font-bold text-primary mt-2">UMN Medical Center Gen XI</h2>
        </div>
    </div>

    <!-- PIKET -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/piket.webp') }}" 
                     alt="Piket Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Piket</h3>
            <p class="mt-4 text-lg text-primary">
                Piket dilaksanakan setiap hari kerja dengan tujuan agar memastikan pelayanan kesehatan dapat tetap berjalan. Jadwal yang disediakan ialah Senin hingga Jumat pukul 08.00 – 17.00, dan Sabtu pukul 08.00 – 11.00. Setiap anggota bertugas secara bergiliran untuk menjaga UKK dan kebutuhan kampus.
            </p>
        </div>
    </div>

    <!-- PELATIHAN -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pelatihan.webp') }}" 
                     alt="Pelatihan Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pelatihan</h3>
            <p class="mt-4 text-lg text-primary">
                Pelatihan merupakan kegiatan yang ditujukan untuk seluruh anggota UMN Medical Center untuk meningkatkan pengetahuan dan keterampilan dasar medis. Materi dari pelatihan ini sendiri mencakup pertolongan pertama, penggunaan alat-alat kesehatan, dan penggunaan obat-obat yang tersedia dalam UKK. Kegiatan ini dilakukan agar setiap anggota UMN Medical Center dapat sigap dan tetap siap dalam bertugas.
            </p>
        </div>
    </div>

    <!-- RAPAT -->
    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/rapat.webp') }}" 
                     alt="Rapat Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-left md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Rapat</h3>
            <p class="mt-4 text-lg text-primary">
                Rapat dilakukan secara rutin untuk memonitor dan mengevaluasi kinerja dan perkembangan setiap anggota. Agenda dari rapat sendiri meliputi update dari kegiatan setiap divisi, pembahasan kendala, dan penyusunan strategi untuk meningkatkan pelayanan. Hal ini bertujuan agar dapat menyelesaikan suatu masalah dan memperkuat koordinasi dari tiap divisi maupun anggota.
            </p>
        </div>
    </div>

    <!-- PENGAJUAN JASA -->
    <div class="flex flex-col md:flex-row-reverse md:gap-12 items-center md:items-start md:space-x-10 fade-zoom">
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0">
            <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/program/pengajuan_jasa.webp') }}" 
                     alt="Pengajuan Jasa Program"
                     class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                     loading="lazy">
            </div>
        </div>
        <div class="text-center md:text-right md:w-3/5 mt-6 md:mt-0">
            <h3 class="text-4xl font-bold text-primary">Pengajuan Jasa</h3>
            <p class="mt-4 text-lg text-primary">
                UMN Medical Center menerima pengajuan jasa dari berbagai pihak dalam lingkup kampus. Pengajuan ini mencakup dari permintaan pertolongan medis dalam kegiatan kampus, kerja sama, hingga konsultasi kesehatan. Prosedur dari pengajuan sendiri dapat dilakukan melalui pengisian form dan menghubungi Line OA UMN Medical Center agar pelayanan dapat disiapkan secara optimal.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // ==============================================
    // OPTIMIZED SCROLL ANIMATION (FADE + ZOOM) - SAME AS HOME
    // ==============================================
    class ScrollAnimator {
        constructor() {
            this.elements = document.querySelectorAll('.fade-zoom');
            this.viewportHeight = window.innerHeight;
            this.lastScrollY = window.scrollY;
            this.ticking = false;
            this.animationFrame = null;
            
            this.init();
        }
        
        init() {
            if (this.elements.length === 0) return;
            
            this.animateElements();
            
            window.addEventListener('scroll', () => this.handleScroll(), { passive: true });
            window.addEventListener('resize', () => {
                this.viewportHeight = window.innerHeight;
                this.animateElements();
            });
        }
        
        handleScroll() {
            this.lastScrollY = window.scrollY;
            
            if (!this.ticking) {
                this.animationFrame = requestAnimationFrame(() => {
                    this.animateElements();
                    this.ticking = false;
                });
                this.ticking = true;
            }
        }
        
        calculateVisibility(element) {
            const rect = element.getBoundingClientRect();
            const elementCenter = rect.top + (rect.height / 2);
            const viewportCenter = this.viewportHeight / 2;
            const distanceFromCenter = Math.abs(viewportCenter - elementCenter);
            
            const fadeStart = this.viewportHeight * 0.10;
            const fadeEnd = this.viewportHeight * 0.70;
            
            let fadeAmount = 0;
            if (distanceFromCenter > fadeStart) {
                fadeAmount = Math.min(1, (distanceFromCenter - fadeStart) / (fadeEnd - fadeStart));
            }
            
            const minScale = 0.75;
            const scaleAmount = 1 - (fadeAmount * (1 - minScale));
            
            return { fadeAmount, scaleAmount };
        }
        
        animateElements() {
            this.elements.forEach(el => {
                const { fadeAmount, scaleAmount } = this.calculateVisibility(el);
                
                el.style.opacity = 1 - fadeAmount;
                el.style.transform = `scale(${scaleAmount})`;
                el.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                
                // NO BLUR EFFECT
                // el.style.filter = 'blur(0px)';
                
                if (fadeAmount < 0.1) {
                    el.classList.add('is-fully-visible');
                    el.classList.remove('is-partially-visible');
                } else if (fadeAmount < 0.5) {
                    el.classList.add('is-partially-visible');
                    el.classList.remove('is-fully-visible');
                } else {
                    el.classList.remove('is-fully-visible', 'is-partially-visible');
                }
            });
        }
    }
    
    // ==============================================
    // FIX FOR ALIVE IMAGE HOVER (Mengganti group-hover:content-[url()] yang tidak work)
    // ==============================================
    class AliveImageHover {
        constructor() {
            this.aliveLinks = document.querySelectorAll('a[href*="alive"]');
            this.init();
        }
        
        init() {
            this.aliveLinks.forEach(link => {
                const imgContainer = link.querySelector('.rounded-full.bg-\\[#53b490\\]');
                if (imgContainer) {
                    const defaultImg = imgContainer.querySelector('img:first-child');
                    const hoverImg = imgContainer.querySelector('img:last-child');
                    
                    if (defaultImg && hoverImg) {
                        // Remove problematic CSS and use JavaScript instead
                        defaultImg.classList.remove('group-hover:content-[url()]');
                        hoverImg.classList.remove('group-hover:opacity-100');
                        
                        // Add mouse events
                        link.addEventListener('mouseenter', () => {
                            defaultImg.style.opacity = '0';
                            hoverImg.style.opacity = '1';
                        });
                        
                        link.addEventListener('mouseleave', () => {
                            defaultImg.style.opacity = '1';
                            hoverImg.style.opacity = '0';
                        });
                    }
                }
            });
        }
    }
    
    // ==============================================
    // LAZY LOADING FOR PROGRAM IMAGES
    // ==============================================
    class ProgramImageLoader {
        constructor() {
            this.images = document.querySelectorAll('img[loading="lazy"]');
            this.init();
        }
        
        init() {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '100px 0px',
                    threshold: 0.01
                });
                
                this.images.forEach(img => observer.observe(img));
            } else {
                // Fallback for older browsers
                this.images.forEach(img => img.classList.add('loaded'));
            }
        }
    }
    
    // ==============================================
    // INITIALIZE COMPONENTS
    // ==============================================
    const scrollAnimator = new ScrollAnimator();
    const aliveHover = new AliveImageHover();
    const imageLoader = new ProgramImageLoader();
});
</script>

<style>
    .fade-zoom {
        will-change: opacity, transform;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
    
    .fade-zoom.is-fully-visible {
        opacity: 1 !important;
        transform: scale(1) !important;
    }
    
    .fade-zoom.is-partially-visible {
        opacity: 0.8 !important;
        transform: scale(0.95) !important;
    }
    
    /* Performance optimizations */
    .fade-zoom {
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }
    
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
    
    /* Alive image hover fix */
    .group:hover .rounded-full.bg-\[#53b490\] img:first-child {
        opacity: 0;
    }
    
    .group:hover .rounded-full.bg-\[#53b490\] img:last-child {
        opacity: 1;
    }
    
    /* Image transition */
    .rounded-full.bg-\[#53b490\] img {
        transition: opacity 0.3s ease;
    }
    
    .rounded-full.bg-\[#53b490\] img:last-child {
        opacity: 0;
    }
    
    /* Optimize spacing */
    .h-\[60px\] {
        height: 60px;
    }
    
    .h-\[30px\] {
        height: 30px;
    }
    
    .h-\[80px\] {
        height: 80px;
    }
    
    .h-\[40px\] {
        height: 40px;
    }
    
    /* Responsive text sizes */
    @media (max-width: 768px) {
        .text-6xl {
            font-size: 3rem;
        }
        
        .text-8xl {
            font-size: 4rem;
        }
        
        .text-10xl {
            font-size: 5rem;
        }
    }
</style>
@endsection