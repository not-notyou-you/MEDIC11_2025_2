@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 md:px-24 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL BESAR -->
    <div class="w-full flex flex-col md:flex-row items-center justify-between fade-zoom md:py-20">
        <div class="text-center md:text-left md:w-3/5 px-6 pt-8 md:pt-0 pb-8 md:pb-0">
            <h1 class="text-6xl md:text-7xl font-bold text-primary">UMN MEDICAL CENTER</h1>
            <h2 class="text-4xl md:text-5xl font-semibold text-primary mt-4">GEN XII</h2>
        </div>
        <div class="relative fade-zoom order-first md:order-none sm:my-6 md:my-0 mt-8 md:mt-0">
            <div class="rounded-full bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
                <img src="{{ asset('assets/logo/logo1.webp') }}" alt="Logo"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
            </div>
        </div>
    </div>

    <!-- CAROUSEL -->
    <div class="relative w-full max-w-3xl fade-zoom">
        <div class="rounded-lg bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)]">
            <div class="overflow-hidden rounded-lg">
                <div class="carousel relative w-full h-[300px] md:h-[400px]">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="absolute w-full h-full transition-opacity duration-700 ease-in-out opacity-0">
                            <img src="{{ asset("assets/foto/c$i.webp") }}" 
                                 alt="Carousel Image {{ $i }}"
                                 class="w-full h-full object-cover rounded-lg"
                                 loading="lazy">
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
                <img src="{{ asset('assets/foto/pelatihan3.webp') }}" alt="Visi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                    loading="lazy">
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
                <img src="{{ asset('assets/foto/pelatihan6.webp') }}" alt="Misi"
                    class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]"
                    loading="lazy">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    // ==============================================
    // OPTIMIZED CAROUSEL
    // ==============================================
    class OptimizedCarousel {
        constructor(containerSelector = '.carousel') {
            this.container = document.querySelector(containerSelector);
            if (!this.container) return;
            
            this.slides = this.container.querySelectorAll('div');
            this.currentIndex = 0;
            this.interval = null;
            this.intervalTime = 2000;
            this.isPaused = false;
            
            this.init();
        }
        
        init() {
            if (this.slides.length === 0) return;
            
            this.showSlide(this.currentIndex);
            this.startAutoSlide();
            
            this.container.addEventListener('mouseenter', () => this.pause());
            this.container.addEventListener('mouseleave', () => this.resume());
            
            document.addEventListener('visibilitychange', () => {
                document.hidden ? this.pause() : this.resume();
            });
        }
        
        showSlide(index) {
            this.slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? "1" : "0";
                slide.style.zIndex = i === index ? "1" : "0";
            });
        }
        
        nextSlide() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
            this.showSlide(this.currentIndex);
        }
        
        startAutoSlide() {
            if (this.interval) clearInterval(this.interval);
            this.interval = setInterval(() => this.nextSlide(), this.intervalTime);
        }
        
        pause() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
                this.isPaused = true;
            }
        }
        
        resume() {
            if (this.isPaused) {
                this.startAutoSlide();
                this.isPaused = false;
            }
        }
    }
    
    // ==============================================
    // OPTIMIZED SCROLL ANIMATION (FADE + ZOOM)
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
                
                // REMOVED BLUR EFFECT
                // el.style.filter = 'blur(0px)'; // Tidak ada blur
                
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
    // INITIALIZE COMPONENTS
    // ==============================================
    const carousel = new OptimizedCarousel();
    const scrollAnimator = new ScrollAnimator();
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
    
    .carousel div {
        will-change: opacity;
        transition: opacity 0.7s ease-in-out;
    }
    
    /* Performance optimizations */
    .carousel,
    .fade-zoom {
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }
    
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection