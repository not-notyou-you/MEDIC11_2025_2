@extends('layouts.app')
@section('title', $quiz->title)
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mx-auto px-4 py-12">

    {{-- Ready Screen --}}
    <div id="ready-screen" class="text-center">
        <div class="bg-gradient-to-r from-[#53b490] to-[#3a8d6d] text-white p-10 rounded-2xl shadow-2xl flex flex-col items-center">
            
            {{-- Maskot --}}
            @php
                $mascots = [
                    'assets/mascot/medi1.webp',
                    'assets/mascot/medi2.webp',
                    'assets/mascot/medi3.webp',
                    'assets/mascot/medi4.webp',
                    'assets/mascot/medi1.webp',
                    'assets/mascot/medi2.webp',
                    'assets/mascot/medi3.webp',
                    'assets/mascot/ical4.webp'
                ];
                $randomMascot = $mascots[array_rand($mascots)];
            @endphp

            <div class="mb-6">
                <img src="{{ asset($randomMascot) }}" alt="Maskot" class="w-40 mx-auto">
            </div>

            <h2 class="text-3xl font-bold mb-4">Quiz: {{ $quiz->title }} </h2>

            <p class="text-lg mb-6">
                Persiapkan diri kamu.<br>
                Setiap soal memiliki waktu terbatas.<br>
                Klik tombol di bawah untuk memulai.
            </p>
            
            <div class="flex gap-4 justify-center">
                <button id="start-quiz" 
                    class="bg-[#048C6A] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#144034] transition shadow-[0_4px_15px_rgba(255,255,255,0.6)]">
                    Mulai Quiz
                </button>

                <button id="back-button"
                    class="bg-white text-[#048C6A] font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition shadow-[0_4px_15px_rgba(255,255,255,0.6)]">
                    Kembali
                </button>
            </div>

        </div>
    </div>

    {{-- Quiz Screen --}}
    <div id="quiz-screen" class="hidden mt-6">

        {{-- Info Skor & Lives --}}
        <div class="flex justify-between items-center mb-6">
            <div class="text-lg font-semibold">Skor: <span id="score">0</span></div>
            <div class="text-lg font-semibold">
                Kesempatan: <span id="lives-container">❤️ ❤️ ❤️</span>
            </div>
            <div class="text-lg font-semibold">Waktu: <span id="timer">10</span>s</div>
        </div>

        {{-- Maskot --}}
        <div class="text-center mb-6 relative">
            <!-- Tambahkan ID untuk gambar maskot -->
            <img id="quiz-mascot" src="{{ asset($randomMascot) }}" alt="Maskot" class="w-40 mx-auto">
            <div id="bubble-feedback" class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-10 bg-white text-[#048C6A] px-4 py-2 rounded-2xl shadow-lg text-lg font-semibold opacity-0 transition-opacity">
                <!-- Feedback per soal muncul disini -->
            </div>
        </div>

        {{-- Card Pertanyaan --}}
        <div class="bg-white shadow-lg rounded-2xl p-6 mb-6">
            <h3 id="question-text" class="text-xl font-semibold text-[#144034] mb-4"></h3>
            <div id="answer-buttons" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>
        </div>

        <div id="final-feedback" class="text-center text-2xl font-bold"></div>
    </div>

    {{-- Simpan data quiz dalam hidden div untuk diakses JavaScript --}}
    <div id="quiz-data" 
         data-questions='{!! json_encode($quiz->questions) !!}'
         data-quiz-id="{{ $quiz->id }}"
         data-back-url="{{ route('public.quiz.index') }}"
         data-save-attempt-url="{{ route('public.quiz.saveAttempt', $quiz->id) }}"
         style="display: none;">
    </div>
</div>

<div id="quiz-data" data-quiz-id="{{ $quiz->id }}" style="display: none;">
    @json($quiz->questions)
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data dari hidden div
    const quizData = document.getElementById('quiz-data');
    const questions = JSON.parse(quizData.getAttribute('data-questions') || '[]');
    const quizId = quizData.getAttribute('data-quiz-id');
    
    let currentIndex = 0;
    let score = 0;
    let lives = 3;
    let timeLeft = 10;
    let timerInterval;
    let gameEnded = false;

    const readyScreen = document.getElementById('ready-screen');
    const quizScreen = document.getElementById('quiz-screen');
    const startBtn = document.getElementById('start-quiz');
    const backBtn = document.getElementById('back-button');
    const questionText = document.getElementById('question-text');
    const answerButtons = document.getElementById('answer-buttons');
    const timerEl = document.getElementById('timer');
    const scoreEl = document.getElementById('score');
    const livesContainer = document.getElementById('lives-container');
    const feedbackEl = document.getElementById('bubble-feedback');
    const finalFeedbackEl = document.getElementById('final-feedback');
    const mascot = document.getElementById('quiz-mascot');

    // Setup back button
    backBtn.addEventListener('click', function() {
        window.location.href = "{{ route('public.quiz.index') }}";
    });

    function updateLivesDisplay() {
        let hearts = '';
        for (let i = 0; i < lives; i++) hearts += '❤️ ';
        livesContainer.textContent = hearts.trim();
    }

    function loseLife() {
        lives--;
        if(lives < 0) lives = 0;
        updateLivesDisplay();
    }

    startBtn.addEventListener('click', function() {
        readyScreen.style.display = 'none';
        quizScreen.classList.remove('hidden');
        currentIndex = 0;
        score = 0;
        lives = 3;
        gameEnded = false;
        scoreEl.textContent = '0';
        updateLivesDisplay();
        showQuestion();
        startTimer();
    });

    function showQuestion() {
        if(gameEnded) return;
        
        if(currentIndex >= questions.length){
            endGame(true);
            return;
        }

        let q = questions[currentIndex];
        questionText.textContent = `Pertanyaan ${currentIndex + 1}: ${q.question}`;

        let answers = [q.correct_answer, q.wrong_answer1, q.wrong_answer2, q.wrong_answer3].filter(function(a) { return a; });
        shuffleArray(answers);
        answerButtons.innerHTML = '';

        answers.forEach(function(a) {
            let btn = document.createElement('button');
            btn.textContent = a;
            btn.className = "bg-[#048C6A] hover:bg-[#144034] text-[#f0f9f5] font-semibold py-2 px-4 rounded-xl transition";
            btn.addEventListener('click', function() { checkAnswer(a, q.correct_answer); });
            answerButtons.appendChild(btn);
        });

        timeLeft = 10;
        timerEl.textContent = timeLeft;
    }

    function checkAnswer(selected, correct){
        if(gameEnded) return;
        
        stopTimer();
        if(selected === correct){
            score++;
            scoreEl.textContent = score;
            showBubble("Kamu benar! 🎉", true);
            mascot.style.filter = "brightness(1.2)";
        } else {
            loseLife();
            showBubble("Sayang sekali salah! 😢", false);
            mascot.style.filter = "brightness(0.8)";
            
            if(lives <= 0){
                endGame(false);
                return;
            }
        }
        
        currentIndex++;
        setTimeout(function() {
            if(gameEnded) return;
            feedbackEl.style.opacity = 0;
            mascot.style.filter = "";
            showQuestion();
            startTimer();
        }, 1500);
    }

    function showBubble(text, correct){
        feedbackEl.textContent = text;
        feedbackEl.style.opacity = 1;
        if(correct){
            feedbackEl.style.background = '#D1F7DD';
            feedbackEl.style.color = '#048C6A';
        } else {
            feedbackEl.style.background = '#FDDDD8';
            feedbackEl.style.color = '#C53030';
        }
    }

    function startTimer() {
        if(gameEnded) return;
        
        stopTimer();
        timerInterval = setInterval(function() {
            if(gameEnded || currentIndex >= questions.length || lives <= 0){
                stopTimer();
                return;
            }
            timeLeft--;
            timerEl.textContent = timeLeft;

            if(timeLeft <= 0){
                stopTimer();
                loseLife();
                showBubble("Waktu habis! 😢", false);
                mascot.style.filter = "brightness(0.8)";
                
                if(lives <= 0){
                    endGame(false);
                    return;
                }
                
                currentIndex++;
                setTimeout(function() {
                    if(gameEnded) return;
                    feedbackEl.style.opacity = 0;
                    mascot.style.filter = "";
                    showQuestion();
                    startTimer();
                }, 1500);
            }
        }, 1000);
    }

    function stopTimer(){ 
        if(timerInterval) {
            clearInterval(timerInterval);
        }
    }

    function endGame(win){
        gameEnded = true;
        stopTimer();
        
        // Sembunyikan elemen pertanyaan
        if(document.getElementById('answer-buttons')) {
            document.getElementById('answer-buttons').style.display = 'none';
        }
        if(document.getElementById('question-text')) {
            document.getElementById('question-text').style.display = 'none';
        }
        
        const questionCard = document.querySelector('.bg-white.shadow-lg.rounded-2xl.p-6.mb-6');
        if(questionCard) {
            questionCard.style.display = 'none';
        }
        
        if(feedbackEl) {
            feedbackEl.style.opacity = 0;
        }

        // Tampilkan form input nama dan skor dengan desain minimalis
        let finalMessage = '<div class="bg-white rounded-2xl shadow-lg p-6 max-w-2xl mx-auto">';
        
        // Header sederhana
        finalMessage += '<div class="text-center mb-6">';
        if(win) {
            finalMessage += '<h3 class="text-xl font-semibold text-[#048C6A] mb-2">🎉 Quiz Selesai!</h3>';
            mascot.style.filter = "brightness(1.2)";
        } else {
            finalMessage += '<h3 class="text-xl font-semibold text-[#048C6A] mb-2">Quiz Selesai!</h3>';
            mascot.style.filter = "brightness(0.9)";
        }
        finalMessage += '</div>';
        
        // Info skor dalam grid horizontal yang compact
        finalMessage += `
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-[#f0f9f5] rounded-lg p-4 text-center">
                    <div class="text-sm text-gray-600 mb-1">Skor Akhir</div>
                    <div class="text-2xl font-bold text-[#048C6A]">${score}/${questions.length}</div>
                </div>
                <div class="bg-[#f0f9f5] rounded-lg p-4 text-center">
                    <div class="text-sm text-gray-600 mb-1">Nyawa Tersisa</div>
                    <div class="text-2xl font-bold text-[#048C6A]">${lives}</div>
                </div>
            </div>
        `;
        
        // Form input nama yang compact
        finalMessage += `
            <div class="mb-6">
                <label for="player-name" class="block text-sm text-gray-700 mb-2">
                    Nama Anda (opsional):
                </label>
                <div class="flex gap-2">
                    <input type="text" 
                        id="player-name" 
                        class="bg-[#f0f9f5] flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#048C6A] focus:border-[#048C6A] text-sm"
                        placeholder="Kosongkan untuk Anonim"
                        value="">
                    <button id="save-score-btn" 
                            class="bg-[#048C6A] hover:bg-[#144034] text-[#f0f9f5] font-medium px-4 py-2 rounded-lg transition text-sm whitespace-nowrap">
                        💾 Simpan
                    </button>
                </div>
            </div>
        `;
        
        // Tombol aksi dalam grid horizontal yang proporsional
        finalMessage += `
            <div class="grid grid-cols-2 gap-3">
                <button id="view-score-btn" 
                        class="bg-[#f0f9f5] hover:bg-[#048C6A] text-gray-600 font-medium px-4 py-2 rounded-lg transition text-sm border border-blue-200 flex items-center justify-center gap-1">
                    <span>📊</span>
                    <span>Scoreboard</span>
                </button>
                <button id="back-to-list-btn" 
                        class="bg-[#f0f9f5] hover:bg-[#048C6A] text-gray-600 font-medium px-4 py-2 rounded-lg transition text-sm border border-gray-200 flex items-center justify-center gap-1">
                    <span>↩️</span>
                    <span>Kembali</span>
                </button>
            </div>
        `;
        
        // Status message area (untuk loading/success/error)
        finalMessage += '<div id="status-message" class="mt-4 text-sm"></div>';
        
        finalMessage += '</div>';

        if(finalFeedbackEl) {
            finalFeedbackEl.innerHTML = finalMessage;
            finalFeedbackEl.classList.remove('hidden');
        }

        // Setup event listeners
        setTimeout(function() {
            const saveScoreBtn = document.getElementById('save-score-btn');
            const viewScoreBtn = document.getElementById('view-score-btn');
            const backToListBtn = document.getElementById('back-to-list-btn');
            const playerNameInput = document.getElementById('player-name');
            
            // Fokus ke input nama
            if(playerNameInput) {
                playerNameInput.focus();
            }
            
            if(saveScoreBtn) {
                saveScoreBtn.addEventListener('click', function() {
                    saveAttemptToServer();
                });
                
                // Juga bisa save dengan Enter
                if(playerNameInput) {
                    playerNameInput.addEventListener('keypress', function(e) {
                        if(e.key === 'Enter') {
                            saveAttemptToServer();
                        }
                    });
                }
            }
            
            if(viewScoreBtn) {
                viewScoreBtn.addEventListener('click', function() {
                    window.location.href = `/quiz/${quizId}/score`;
                });
            }
            
            if(backToListBtn) {
                backToListBtn.addEventListener('click', function() {
                    window.location.href = "/quiz";
                });
            }
        }, 100);
    }

    // Fungsi saveAttemptToServer yang diperbaiki untuk desain baru
    async function saveAttemptToServer() {
        try {
            const playerNameInput = document.getElementById('player-name');
            const saveBtn = document.getElementById('save-score-btn');
            const statusMessage = document.getElementById('status-message');
            let playerName = '';
            
            if (playerNameInput) {
                playerName = playerNameInput.value.trim();
            }
            
            // Update UI: tampilkan loading state
            if(saveBtn) {
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<span class="animate-spin mr-1">⟳</span> Menyimpan';
                saveBtn.classList.add('opacity-70');
            }
            
            if(statusMessage) {
                statusMessage.innerHTML = '<div class="text-blue-600 flex items-center gap-1"><span class="animate-spin">⟳</span> Menyimpan skor...</div>';
            }

            // Kirim data ke server
            const response = await fetch(`/quiz/${quizId}/save-attempt`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    score: score,
                    lives_used: 3 - lives,
                    player_name: playerName
                })
            });

            const data = await response.json();
            
            if (data.status === 'success') {
                // Tampilkan pesan sukses
                if(statusMessage) {
                    statusMessage.innerHTML = '<div class="text-green-600 flex items-center gap-1"><span>✓</span> Skor berhasil disimpan! Mengarahkan...</div>';
                }
                
                // Redirect setelah 1.5 detik
                setTimeout(() => {
                    window.location.href = data.redirect_url || `/quiz/${quizId}/score`;
                }, 1500);
                
            } else {
                throw new Error(data.message || 'Gagal menyimpan skor');
            }
            
        } catch (error) {
            console.error('Error:', error);
            
            // Reset button state
            const saveBtn = document.getElementById('save-score-btn');
            if(saveBtn) {
                saveBtn.disabled = false;
                saveBtn.innerHTML = '💾 Simpan';
                saveBtn.classList.remove('opacity-70');
            }
            
            // Tampilkan error message di status area
            const statusMessage = document.getElementById('status-message');
            if(statusMessage) {
                let errorText = 'Gagal menyimpan skor. Coba lagi.';
                if(error.message.includes('Network')) {
                    errorText = 'Koneksi bermasalah. Coba lagi.';
                }
                statusMessage.innerHTML = `<div class="text-red-600 flex items-center gap-1"><span>✗</span> ${errorText}</div>`;
            }
        }
    }

    function shuffleArray(array){
        for(let i = array.length - 1; i > 0; i--){
            const j = Math.floor(Math.random() * (i + 1));
            const temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
    }

    updateLivesDisplay();
});
</script>

@endsection