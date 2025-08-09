@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col items-center px-2 md:px-12 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL BESAR -->
    <div class="w-full flex flex-col items-center text-center fade-zoom md:py-5">
        <h1 class="text-5xl md:text-6xl font-bold text-primary pb--10">ORGANIGRAM</h1>
    </div>

    <div class="relative w-full max-w-5xl fade-zoom">
        <!-- Navigation - Desktop -->
        <div class="hidden md:flex justify-between items-center mb-6">
            <button id="prevButton" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span id="prevLabel">Gen 10</span>
            </button>
            
            <h2 id="currentGen" class="text-2xl font-bold text-[#048C6A]">Gen 11</h2>
            
            <button id="nextButton" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer flex items-center">
                <span id="nextLabel">Gen 12</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Organigram Container -->
        <div class="rounded-lg bg-[#048C6A] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5)] transition-all duration-500 ease-in-out">
            <div class="overflow-hidden rounded-lg">
                <a href="{{ asset('assets/organigram/gen11.png') }}" data-fancybox="organigram">
                    <img id="organigramImage" src="{{ asset('assets/organigram/gen11.png') }}" 
                         class="w-full h-auto max-h-[70vh] object-contain transition-all duration-500 ease-in-out" 
                         alt="Organigram Gen 11" />
                </a>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden flex flex-col items-center mt-6">
            <h2 id="mobileCurrentGen" class="text-2xl font-bold text-[#048C6A] mb-4">Gen 11</h2>
            
            <div class="flex justify-between w-full max-w-xs">
                <button id="mobilePrevButton" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span id="mobilePrevLabel">Gen 10</span>
                </button>
                
                <button id="mobileNextButton" class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer flex items-center">
                    <span id="mobileNextLabel">Gen 12</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</div>

<x-footer />

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // List of all organigram generations
        const organigrams = [
            { gen: 1, src: "{{ asset('assets/organigram/gen1.png') }}" },
            { gen: 2, src: "{{ asset('assets/organigram/gen2.png') }}" },
            { gen: 3, src: "{{ asset('assets/organigram/gen3.png') }}" },
            { gen: 4, src: "{{ asset('assets/organigram/gen4.png') }}" },
            { gen: 5, src: "{{ asset('assets/organigram/gen5.png') }}" },
            { gen: 6, src: "{{ asset('assets/organigram/gen6.png') }}" },
            { gen: 7, src: "{{ asset('assets/organigram/gen7.png') }}" },
            { gen: 8, src: "{{ asset('assets/organigram/gen8.png') }}" },
            { gen: 9, src: "{{ asset('assets/organigram/gen9.png') }}" },
            { gen: 10, src: "{{ asset('assets/organigram/gen10.png') }}" },
            { gen: 11, src: "{{ asset('assets/organigram/gen11.png') }}" }
        ];

        let currentIndex = 10; // Start with Gen 11

        // DOM Elements
        const organigramImage = document.getElementById('organigramImage');
        const organigramLink = document.querySelector('[data-fancybox="organigram"]');
        const currentGen = document.getElementById('currentGen');
        const mobileCurrentGen = document.getElementById('mobileCurrentGen');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const prevLabel = document.getElementById('prevLabel');
        const nextLabel = document.getElementById('nextLabel');
        const mobilePrevButton = document.getElementById('mobilePrevButton');
        const mobileNextButton = document.getElementById('mobileNextButton');
        const mobilePrevLabel = document.getElementById('mobilePrevLabel');
        const mobileNextLabel = document.getElementById('mobileNextLabel');

        // Update organigram display
        function updateOrganigram() {
            const current = organigrams[currentIndex];
            
            // Fade out animation
            organigramImage.style.opacity = 0;
            
            setTimeout(() => {
                // Update image and link
                organigramImage.src = current.src;
                organigramImage.alt = `Organigram Gen ${current.gen}`;
                organigramLink.href = current.src;
                
                // Update labels
                currentGen.textContent = `Gen ${current.gen}`;
                mobileCurrentGen.textContent = `Gen ${current.gen}`;
                prevLabel.textContent = currentIndex > 0 ? `Gen ${organigrams[currentIndex - 1].gen}` : '';
                nextLabel.textContent = currentIndex < organigrams.length - 1 ? `Gen ${organigrams[currentIndex + 1].gen}` : '';
                mobilePrevLabel.textContent = currentIndex > 0 ? `Gen ${organigrams[currentIndex - 1].gen}` : '';
                mobileNextLabel.textContent = currentIndex < organigrams.length - 1 ? `Gen ${organigrams[currentIndex + 1].gen}` : '';
                
                // Fade in animation
                setTimeout(() => {
                    organigramImage.style.opacity = 1;
                }, 50);
            }, 300);
            
            // Update button states
            updateButtonState(prevButton, currentIndex === 0);
            updateButtonState(nextButton, currentIndex === organigrams.length - 1);
            updateButtonState(mobilePrevButton, currentIndex === 0);
            updateButtonState(mobileNextButton, currentIndex === organigrams.length - 1);
        }

        // Update button state
        function updateButtonState(button, isDisabled) {
            button.disabled = isDisabled;
            
            if (isDisabled) {
                button.classList.add('opacity-50', 'cursor-not-allowed');
                button.classList.remove('hover:bg-[#048C6A]', 'hover:text-white', 'active:transform', 'active:scale-95', 'active:shadow-lg', 'active:shadow-[#048C6A]');
            } else {
                button.classList.remove('opacity-50', 'cursor-not-allowed');
                button.classList.add('hover:bg-[#048C6A]', 'hover:text-white', 'active:transform', 'active:scale-95', 'active:shadow-lg', 'active:shadow-[#048C6A]');
            }
        }

        // Navigation function
        function navigate(direction) {
            if (direction === 'prev' && currentIndex > 0) {
                currentIndex--;
                updateOrganigram();
            } else if (direction === 'next' && currentIndex < organigrams.length - 1) {
                currentIndex++;
                updateOrganigram();
            }
        }

        // Navigation event listeners
        prevButton.addEventListener('click', () => navigate('prev'));
        nextButton.addEventListener('click', () => navigate('next'));
        mobilePrevButton.addEventListener('click', () => navigate('prev'));
        mobileNextButton.addEventListener('click', () => navigate('next'));

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') navigate('prev');
            else if (e.key === 'ArrowRight') navigate('next');
        });

        // Initialize button states
        updateOrganigram();
    });
</script>

<style>
    /* Animation for smoother transitions */
    #organigramImage {
        transition: opacity 0.3s ease-in-out;
        max-height: 70vh;
    }
    
    /* Disabled button styling */
    .opacity-50 {
        opacity: 0.5;
    }
    
    .cursor-not-allowed {
        cursor: not-allowed;
    }
    
    /* Responsive adjustments */
    @media (max-width: 320px) {
        #mobilePrevButton, #mobileNextButton {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        
        #mobilePrevButton span, 
        #mobileNextButton span {
            display: block;
            text-align: center;
        }
    }
</style>
@endsection