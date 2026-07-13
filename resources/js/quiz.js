document.addEventListener('DOMContentLoaded', () => {
    const quizDataElement = document.getElementById('quiz-data');
    if (!quizDataElement) return;
    
    const questions = JSON.parse(quizDataElement.textContent || '[]');
    const quizId = quizDataElement.dataset.quizId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    if (questions.length === 0) {
        document.getElementById('question').innerText = 'Tidak ada pertanyaan saat ini.';
        return;
    }

    const questionEl = document.getElementById('question');
    const optionsEl = document.getElementById('options');
    const scoreEl = document.getElementById('score');
    const attemptsEl = document.getElementById('attempts');
    const timerEl = document.getElementById('timer');
    const resultEl = document.getElementById('result');
    const mascotEl = document.getElementById('mascot');

    let currentIndex = 0;
    let score = 0;
    let lives = 3;
    let time = 0;
    let timerInterval;
    let userAnswers = {};

    function showQuestion() {
        if (currentIndex >= questions.length) {
            endQuiz();
            return;
        }

        const q = questions[currentIndex];
        const answers = [
            q.correct_answer,
            q.wrong_answer1,
            q.wrong_answer2,
            q.wrong_answer3
        ].filter(Boolean);

        shuffleArray(answers);

        questionEl.innerText = `Pertanyaan ${currentIndex + 1}: ${q.question}`;
        optionsEl.innerHTML = '';
        
        answers.forEach(answer => {
            const btn = document.createElement('button');
            btn.innerText = answer;
            btn.className = 'answer-btn';
            btn.addEventListener('click', () => checkAnswer(answer, q.id, q.correct_answer));
            optionsEl.appendChild(btn);
        });
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function checkAnswer(selected, questionId, correct) {
        userAnswers[questionId] = selected;
        
        if (selected === correct) {
            score++;
            resultEl.innerText = 'Benar! 🎉';
            mascotEl.src = '/assets/ical2.png';
            resultEl.style.color = 'green';
        } else {
            lives--;
            resultEl.innerText = `Salah 😢. Jawaban benar: ${correct}`;
            mascotEl.src = '/assets/ical3.png';
            resultEl.style.color = 'red';
        }

        updateStatus();
        Array.from(optionsEl.children).forEach(btn => btn.disabled = true);

        setTimeout(() => {
            currentIndex++;
            if (lives > 0 && currentIndex < questions.length) {
                mascotEl.src = '/assets/ical1.png';
                resultEl.innerText = '';
                showQuestion();
            } else {
                endQuiz();
            }
        }, 1500);
    }

    function updateStatus() {
        scoreEl.innerText = score;
        attemptsEl.innerText = lives;
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            time++;
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;
            timerEl.innerText = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    }

    async function endQuiz() {
        clearInterval(timerInterval);
        
        questionEl.innerText = 'Quiz Selesai! 🎯';
        optionsEl.innerHTML = '';
        
        const totalQuestions = questions.length;
        const livesUsed = 3 - lives;
        
        resultEl.innerHTML = `
            <div style="text-align: center; padding: 20px;">
                <h3>Skor Akhir: ${score}/${totalQuestions}</h3>
                <p>Waktu: ${timerEl.innerText}</p>
                <p>Nyawa tersisa: ${lives}</p>
                <button id="save-score" class="btn btn-primary mt-3">Simpan Skor</button>
            </div>
        `;

        document.getElementById('save-score').addEventListener('click', async () => {
            try {
                const response = await fetch(`/quiz/${quizId}/save-attempt`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        score: score,
                        lives_used: livesUsed,
                        time_spent: time,
                        answers: userAnswers
                    })
                });

                const data = await response.json();
                
                if (data.status === 'success') {
                    // Redirect ke halaman score
                    window.location.href = `/quiz/${quizId}/score`;
                } else {
                    alert('Gagal menyimpan skor: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan skor.');
            }
        });
    }

    startTimer();
    showQuestion();
});