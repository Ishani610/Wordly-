<?php
// include database connection
include('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordly - Practice</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Wordly</div>
        <div class="nav-links">
            <a href="#" class="nav-link active" onclick="showPage('dashboard')">Dashboard</a>
            <a href="#" class="nav-link" onclick="showPage('practice')">Practice</a>
            <a href="#" class="nav-link" onclick="showPage('library')">Library</a>
            <a href="#" class="nav-link" onclick="showPage('progress')">Progress</a>
        </div>
    <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
        <div class="progress-badge">Level 5</div>
        <span>
            <?php
                // Show logged-in user's name
                echo isset($_SESSION['username']) ? "Welcome, ".$_SESSION['username']."!" : "Welcome, User!";
            ?>
            

        </span>
        <form action="logout.php" method="post">
            <button type="submit" class="btn" style="background: #ff6b6b; padding: 5px 10px; font-size: 0.85rem;">Logout</button>
        </form>
    </div>

    </nav>

    <div class="container">
        <?php
        // You can load parts dynamically from DB here in future if needed
        ?>

        <!-- your full HTML structure remains same -->
        <!-- (Paste your entire <div class="container"> ... </div> part here from your HTML) -->
        <div class="container">
        <!-- Dashboard Page -->
        <div id="dashboard" class="page active">
            <div class="dashboard-grid">
                <div class="card">
                    <h3>🌍 Select Learning Language</h3>
                    <p>Choose the language you want to learn</p>
                    <div class="language-selector">
                        <div class="language-btn" onclick="selectLanguage('spanish')">
                            <span class="flag">🇪🇸</span>
                            Spanish
                        </div>
                        <div class="language-btn" onclick="selectLanguage('french')">
                            <span class="flag">🇫🇷</span>
                            French
                        </div>
                        <div class="language-btn" onclick="selectLanguage('german')">
                            <span class="flag">🇩🇪</span>
                            German
                        </div>
                        <div class="language-btn" onclick="selectLanguage('italian')">
                            <span class="flag">🇮🇹</span>
                            Italian
                        </div>
                        <div class="language-btn" onclick="selectLanguage('japanese')">
                            <span class="flag">🇯🇵</span>
                            Japanese
                        </div>
                        <div class="language-btn" onclick="selectLanguage('korean')">
                            <span class="flag">🇰🇷</span>
                            Korean
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3>📚 Quick Stats</h3>
                    <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #58cc02;">247</div>
                            <div style="color: #666; font-size: 0.9rem;">Words Learned</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #667eea;">15</div>
                            <div style="color: #666; font-size: 0.9rem;">Days Streak</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; font-weight: 700; color: #ff6b6b;">89%</div>
                            <div style="color: #666; font-size: 0.9rem;">Accuracy</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3>🎯 Quick Actions</h3>
                    <button class="btn" onclick="showPage('practice')" style="width: 100%; margin-bottom: 10px;">Start Practice Session</button>
                    <button class="btn" onclick="showPage('library')" style="width: 100%; background: #58cc02;">Browse Word Library</button>
                </div>
            </div>
        </div>

        <!-- Practice Page -->
        <div id="practice" class="page">
            <div class="practice-header">
                <div style="font-weight: 600; color: #667eea;">Score: <span id="score">0</span></div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressBar"></div>
                </div>
                <div style="font-weight: 600; color: #58cc02;">Streak: <span id="streak">3</span></div>
            </div>

            <div class="question-card">
                <div id="practiceContent">
                    <div class="question-text" id="questionText">Translate this word to English:</div>
                    <div style="font-size: 2.5rem; color: #667eea; margin: 20px 0; font-weight: 700;" id="wordToTranslate">Hola</div>
                    <input type="text" class="translation-input" id="translationInput" placeholder="Enter your translation...">
                    <div style="margin: 20px 0;">
                        <button class="btn" onclick="checkTranslation()">Check Answer</button>
                        <button class="btn" onclick="skipQuestion()" style="background: #ff6b6b;">Skip</button>
                        <button class="btn success" onclick="saveToLibrary()">Save to Library</button>
                    </div>
                    <div id="feedback" class="feedback" style="display: none;"></div>
                </div>
            </div>
        </div>

        <!-- Library Page -->
        <div id="library" class="page">
            <h2 style="color: white; margin-bottom: 20px; text-align: center;">📚 Your Word Library</h2>
            
            <input type="text" class="search-bar" placeholder="Search your saved words..." onkeyup="searchLibrary(this.value)">
            
            <div class="word-grid" id="libraryGrid">
                <!-- Words will be populated by JavaScript -->
            </div>
        </div>

        <!-- Progress Page -->
        <div id="progress" class="page">
            <h2 style="color: white; margin-bottom: 30px; text-align: center;">📊 Your Progress</h2>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">247</span>
                    <div class="stat-label">Total Words Learned</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">15</span>
                    <div class="stat-label">Day Streak</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">89%</span>
                    <div class="stat-label">Accuracy Rate</div>
                </div>
                <div class="stat-card">
                    <span class="stat-number">5</span>
                    <div class="stat-label">Current Level</div>
                </div>
            </div>

            <div class="card">
                <h3>🎯 Learning Goals</h3>
                <div style="margin: 20px 0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Daily Goal: 20 words</span>
                        <span style="color: #58cc02; font-weight: 600;">15/20</span>
                    </div>
                    <div style="background: #e1e1e1; height: 8px; border-radius: 4px;">
                        <div style="background: #58cc02; height: 8px; border-radius: 4px; width: 75%;"></div>
                    </div>
                </div>
                <div style="margin: 20px 0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Weekly Goal: 100 words</span>
                        <span style="color: #58cc02; font-weight: 600;">87/100</span>
                    </div>
                    <div style="background: #e1e1e1; height: 8px; border-radius: 4px;">
                        <div style="background: #58cc02; height: 8px; border-radius: 4px; width: 87%;"></div>
                    </div>
                </div>
                <button class="btn" onclick="saveProgress()">Save Progress</button>
            </div>
        </div>
    </div>

        <!-- To save space, you can include your same script and JS as before -->
    <script>
        // Paste your entire JS code here as is (no change needed)
        // all your showPage(), selectLanguage(), etc.
    // App State
    let currentLanguage = 'spanish';
    let score = 0;
    let streak = 3;
    let currentQuestionIndex = 0;
    let savedWords = JSON.parse(localStorage.getItem('wordlyLibrary') || '[]');

    // Sample questions for different languages
    const questions = {
        spanish: [
            { word: 'Hola', translation: 'hello', difficulty: 'easy' },
            { word: 'Gracias', translation: 'thank you', difficulty: 'easy' },
            { word: 'Adiós', translation: 'goodbye', difficulty: 'easy' },
            { word: 'Por favor', translation: 'please', difficulty: 'easy' },
            { word: 'Amigo', translation: 'friend', difficulty: 'medium' },
            { word: 'Familia', translation: 'family', difficulty: 'medium' },
            { word: 'Trabajar', translation: 'to work', difficulty: 'hard' },
            { word: 'Hermoso', translation: 'beautiful', difficulty: 'hard' }
        ],
        french: [
            { word: 'Bonjour', translation: 'hello', difficulty: 'easy' },
            { word: 'Merci', translation: 'thank you', difficulty: 'easy' },
            { word: 'Au revoir', translation: 'goodbye', difficulty: 'easy' },
            { word: 'S\'il vous plaît', translation: 'please', difficulty: 'medium' },
            { word: 'Ami', translation: 'friend', difficulty: 'medium' },
            { word: 'Famille', translation: 'family', difficulty: 'medium' }
        ],
        german: [
            { word: 'Hallo', translation: 'hello', difficulty: 'easy' },
            { word: 'Danke', translation: 'thank you', difficulty: 'easy' },
            { word: 'Auf Wiedersehen', translation: 'goodbye', difficulty: 'medium' },
            { word: 'Bitte', translation: 'please', difficulty: 'easy' },
            { word: 'Freund', translation: 'friend', difficulty: 'medium' }
        ],
        korean: [
                { word: '안녕하세요', translation: 'hello', difficulty: 'easy' },
                { word: '감사합니다', translation: 'thank you', difficulty: 'easy' },
                { word: '안녕히 가세요', translation: 'goodbye', difficulty: 'easy' },
                { word: '제발', translation: 'please', difficulty: 'easy' },
                { word: '친구', translation: 'friend', difficulty: 'medium' },
                { word: '가족', translation: 'family', difficulty: 'medium' },
                { word: '일하다', translation: 'to work', difficulty: 'hard' },
                { word: '아름답다', translation: 'beautiful', difficulty: 'hard' }
            ],

            japanese: [
                { word: 'こんにちは', translation: 'hello', difficulty: 'easy' },
                { word: 'ありがとうございます', translation: 'thank you', difficulty: 'easy' },
                { word: 'さようなら', translation: 'goodbye', difficulty: 'easy' },
                { word: 'お願いします', translation: 'please', difficulty: 'easy' },
                { word: '友達', translation: 'friend', difficulty: 'medium' },
                { word: '家族', translation: 'family', difficulty: 'medium' },
                { word: '働く', translation: 'to work', difficulty: 'hard' },
                { word: '美しい', translation: 'beautiful', difficulty: 'hard' }
            ],

            italian: [
                { word: 'Ciao', translation: 'hello', difficulty: 'easy' },
                { word: 'Grazie', translation: 'thank you', difficulty: 'easy' },
                { word: 'Arrivederci', translation: 'goodbye', difficulty: 'easy' },
                { word: 'Per favore', translation: 'please', difficulty: 'easy' },
                { word: 'Amico', translation: 'friend', difficulty: 'medium' },
                { word: 'Famiglia', translation: 'family', difficulty: 'medium' },
                { word: 'Lavorare', translation: 'to work', difficulty: 'hard' },
                { word: 'Bello', translation: 'beautiful', difficulty: 'hard' }
            ]
    };

    // Page Navigation
    function showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        
        document.getElementById(pageId).classList.add('active');
        event.target.classList.add('active');

        if (pageId === 'library') {
            loadLibrary();
        }
    }

    // Language Selection
    function selectLanguage(language) {
        currentLanguage = language;
        currentQuestionIndex = 0;
        
        document.querySelectorAll('.language-btn').forEach(btn => {
            btn.classList.remove('selected');
        });
        event.target.classList.add('selected');
        
        // Update practice session with new language
        loadNextQuestion();
        
        alert(`Language changed to ${language.charAt(0).toUpperCase() + language.slice(1)}!`);
    }

    // Practice Functions
    function loadNextQuestion() {
        const currentQuestions = questions[currentLanguage] || questions.spanish;
        const currentQuestion = currentQuestions[currentQuestionIndex % currentQuestions.length];
        
        document.getElementById('wordToTranslate').textContent = currentQuestion.word;
        document.getElementById('translationInput').value = '';
        document.getElementById('feedback').style.display = 'none';
        
        updateProgress();
    }

    function checkTranslation() {
        const userAnswer = document.getElementById('translationInput').value.toLowerCase().trim();
        const currentQuestions = questions[currentLanguage] || questions.spanish;
        const correctAnswer = currentQuestions[currentQuestionIndex % currentQuestions.length].translation.toLowerCase();
        
        const feedback = document.getElementById('feedback');
        
        if (userAnswer === correctAnswer) {
            feedback.textContent = '🎉 Correct! Well done!';
            feedback.className = 'feedback correct';
            score += 10;
            streak++;
        } else {
            feedback.textContent = `❌ Incorrect. The correct answer is: ${correctAnswer}`;
            feedback.className = 'feedback incorrect';
            if (streak > 0) streak--;
        }
        
        feedback.style.display = 'block';
        updateScore();
        
        setTimeout(() => {
            nextQuestion();
        }, 2000);
    }

    function skipQuestion() {
        const currentQuestions = questions[currentLanguage] || questions.spanish;
        const correctAnswer = currentQuestions[currentQuestionIndex % currentQuestions.length].translation;
        
        const feedback = document.getElementById('feedback');
        feedback.textContent = `Skipped. The answer was: ${correctAnswer}`;
        feedback.className = 'feedback incorrect';
        feedback.style.display = 'block';
        
        setTimeout(() => {
            nextQuestion();
        }, 1500);
    }

    function nextQuestion() {
        currentQuestionIndex++;
        loadNextQuestion();
    }

    function saveToLibrary() {
        const currentQuestions = questions[currentLanguage] || questions.spanish;
        const currentQuestion = currentQuestions[currentQuestionIndex % currentQuestions.length];
        
        const wordData = {
            original: currentQuestion.word,
            translation: currentQuestion.translation,
            language: currentLanguage,
            difficulty: currentQuestion.difficulty,
            dateAdded: new Date().toLocaleDateString()
        };
        
        // Check if word already exists
        const exists = savedWords.some(word => 
            word.original.toLowerCase() === wordData.original.toLowerCase() && 
            word.language === wordData.language
        );
        
        if (!exists) {
            savedWords.push(wordData);
            localStorage.setItem('wordlyLibrary', JSON.stringify(savedWords));
            alert('Word saved to your library! 📚');
        } else {
            alert('This word is already in your library! 📖');
        }
    }

    // Library Functions
    function loadLibrary() {
        const libraryGrid = document.getElementById('libraryGrid');
        
        if (savedWords.length === 0) {
            libraryGrid.innerHTML = `
                <div class="card" style="text-align: center; padding: 40px;">
                    <h3>📚 Your library is empty</h3>
                    <p>Start practicing and save words to build your personal library!</p>
                    <button class="btn" onclick="showPage('practice')">Start Practice</button>
                </div>
            `;
            return;
        }
        
        libraryGrid.innerHTML = savedWords.map(word => `
            <div class="word-card">
                <div class="word-original">${word.original}</div>
                <div class="word-translation">${word.translation}</div>
                <div style="font-size: 0.9rem; color: #999; margin-bottom: 5px;">
                    ${word.language.charAt(0).toUpperCase() + word.language.slice(1)} • ${word.difficulty} • ${word.dateAdded}
                </div>
                <div class="word-actions">
                    <button class="btn btn-small" onclick="practiceWord('${word.original}')">Practice</button>
                    <button class="btn btn-small danger" onclick="removeFromLibrary('${word.original}', '${word.language}')">Remove</button>
                </div>
            </div>
        `).join('');
    }

    function searchLibrary(query) {
        if (!query.trim()) {
            loadLibrary();
            return;
        }
        
        const filteredWords = savedWords.filter(word => 
            word.original.toLowerCase().includes(query.toLowerCase()) ||
            word.translation.toLowerCase().includes(query.toLowerCase()) ||
            word.language.toLowerCase().includes(query.toLowerCase())
        );
        
        const libraryGrid = document.getElementById('libraryGrid');
        libraryGrid.innerHTML = filteredWords.map(word => `
            <div class="word-card">
                <div class="word-original">${word.original}</div>
                <div class="word-translation">${word.translation}</div>
                <div style="font-size: 0.9rem; color: #999; margin-bottom: 5px;">
                    ${word.language.charAt(0).toUpperCase() + word.language.slice(1)} • ${word.difficulty} • ${word.dateAdded}
                </div>
                <div class="word-actions">
                    <button class="btn btn-small" onclick="practiceWord('${word.original}')">Practice</button>
                    <button class="btn btn-small danger" onclick="removeFromLibrary('${word.original}', '${word.language}')">Remove</button>
                </div>
            </div>
        `).join('');
    }

    function removeFromLibrary(original, language) {
        if (confirm('Are you sure you want to remove this word from your library?')) {
            savedWords = savedWords.filter(word => 
                !(word.original.toLowerCase() === original.toLowerCase() && word.language === language)
            );
            localStorage.setItem('wordlyLibrary', JSON.stringify(savedWords));
            loadLibrary();
        }
    }

    function practiceWord(original) {
        const currentQuestions = questions[currentLanguage] || questions.spanish;
        const wordIndex = currentQuestions.findIndex(q => q.word.toLowerCase() === original.toLowerCase());
        
        if (wordIndex !== -1) {
            currentQuestionIndex = wordIndex;
            showPage('practice');
            loadNextQuestion();
        } else {
            alert('This word is not available for practice in the current language.');
        }
    }

    // Progress Functions
    function saveProgress() {
        const progressData = {
            score: score,
            streak: streak,
            currentLanguage: currentLanguage,
            savedWords: savedWords.length,
            lastSaved: new Date().toLocaleString()
        };
        
        localStorage.setItem('wordlyProgress', JSON.stringify(progressData));
        alert('Progress saved successfully! 💾');
    }

    function loadProgress() {
        const savedProgress = localStorage.getItem('wordlyProgress');
        if (savedProgress) {
            const progress = JSON.parse(savedProgress);
            score = progress.score || 0;
            streak = progress.streak || 0;
            currentLanguage = progress.currentLanguage || 'spanish';
            updateScore();
        }
    }

    // UI Update Functions
    function updateScore() {
        document.getElementById('score').textContent = score;
        document.getElementById('streak').textContent = streak;
    }

    function updateProgress() {
        const progress = ((currentQuestionIndex % 10) / 10) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
    }

    // Initialize app
    window.addEventListener('load', () => {
        loadProgress();
        loadNextQuestion();
        updateScore();
    });

    // Auto-save progress every 30 seconds
    setInterval(() => {
        const progressData = {
            score: score,
            streak: streak,
            currentLanguage: currentLanguage,
            savedWords: savedWords.length,
            lastSaved: new Date().toLocaleString()
        };
        localStorage.setItem('wordlyProgress', JSON.stringify(progressData));
    }, 30000);

    </script>
</body>
</html>
