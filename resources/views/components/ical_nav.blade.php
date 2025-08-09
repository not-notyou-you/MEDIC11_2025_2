<div>
    <!-- Modal Ical -->
    <div id="icalModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 backdrop-blur-md hidden">
        <div onclick="event.stopPropagation()" class="bg-gradient-to-br from-[#e0f2ec] to-[#f5fffc] text-[#144034] rounded-3xl border-8 border-double border-[#319875] shadow-glow w-11/12 max-w-md px-6 py-8 animate-fade-in ring-4 ring-[#a4dbc8]">
            <button id="closeIcalModal" class="absolute top-4 right-4 text-[#144034] hover:text-[#048C6A] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="flex flex-col items-center gap-6">
                <!-- Image -->
                <div class="w-full flex justify-center">
                    <img id="icalImage" src="" alt="Ical" class="w-40 h-40 object-contain">
                </div>
                
                <!-- Question -->
                <div class="w-full">
                    <p id="icalQuestion" class="text-center text-lg font-medium mb-6"></p>
                    
                    <!-- Buttons -->
                    <div class="flex flex-wrap justify-center gap-4">
                        <a id="icalYesLink" href="#" 
                           class="border-2 border-[#048C6A] text-[#048C6A] text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] cursor-pointer">
                        </a>
                        
                        <button id="icalNoButton" 
                                class="border-2 border-gray-400 text-gray-600 text-lg shadow-md font-bold px-4 py-2 rounded-lg hover:bg-gray-400 hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-gray-400 cursor-pointer">
                            Tidak, terima kasih
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data for Ical
        const icalData = [
            {
                image: "{{ asset('assets/mascot/ical1.png') }}",
                question: "Hallo, perkenalkan, namaku Ical, selamat datang di website resmi UMN Medical Center. Apakah teman-teman ingin melihat galeri kegiatan kami?",
                yesLink: "{{ route('gallery.user_index') }}",
                yesText: "Iya, saya ingin melihatnya"
            },
            {
                image: "{{ asset('assets/mascot/ical2.png') }}",
                question: "Hallo, perkenalkan, namaku Ical, selamat datang di website resmi UMN Medical Center. Dengan website ini kamu dapat melakukan pengajuan jasa, apakah kamu ingin melakukan pengajuan jasa?",
                yesLink: "{{ route('service.index') }}",
                yesText: "Iya, saya ingin melakukannya"
            },
            {
                image: "{{ asset('assets/mascot/ical2.png') }}",
                question: "Hallo, perkenalkan, namaku Ical, selamat datang di website resmi UMN Medical Center. UMN Medical Center memiliki beberapa program kerja, apakah teman-teman tertarik untuk mengetahuinya?",
                yesLink: "{{ route('program') }}",
                yesText: "Iya, saya tertarik"
            }
        ];

        // Function to open the modal with random content
        function openIcalModal() {
            const modal = document.getElementById('icalModal');
            const randomIndex = Math.floor(Math.random() * icalData.length);
            const data = icalData[randomIndex];

            // Set the content
            document.getElementById('icalImage').src = data.image;
            document.getElementById('icalQuestion').textContent = data.question;
            const yesLink = document.getElementById('icalYesLink');
            yesLink.href = data.yesLink;
            yesLink.textContent = data.yesText;

            // Show the modal
            modal.classList.remove('hidden');
        }

        // Function to close the modal
        function closeIcalModal() {
            document.getElementById('icalModal').classList.add('hidden');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal when clicking on close button
            document.getElementById('closeIcalModal').addEventListener('click', closeIcalModal);
            document.getElementById('icalNoButton').addEventListener('click', closeIcalModal);

            // Close modal when clicking outside the modal content
            document.getElementById('icalModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    closeIcalModal();
                }
            });
        });
    </script>

    <style>
        .shadow-glow {
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3), 0 0 30px rgba(16, 185, 129, 0.2);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</div>