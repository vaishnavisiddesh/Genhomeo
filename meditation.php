<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Breathing Exercises</title>
    <style>
        .d {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            background-color: black;
            padding: 10px;
            border-radius: 10px;
            justify-content: flex-end;
            width: calc(100% - 20px);
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
        }

        .a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .left-text {
            color: white;
            font-size: 20px;
            margin-right: auto;
        }

        body {
            background: linear-gradient(to right, black, linen);
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items horizontally */
            justify-content: flex-start;
            min-height: 100vh;
            margin: 0;
            padding-top: 20px;
            font-family: sans-serif;
            text-align: center; /* Center inline content */
        }

        .category-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .category-buttons button {
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
        }

        .category-buttons button.active {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .exercise-container {
            display: none;
            align-items: center;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .exercise-container.active {
            display: flex;
        }

        .visualization {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: white;
            transition: transform 0.1s ease;
            margin-bottom: 10px;
        }

        #controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        #controls div {
            margin: 8px;
        }

        .control-row {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center; /* Center buttons horizontally */
            margin-top: 20px; /* Add margin-top */
        }

        #start,
        #stop {
            font-size: 4em; /* Enlarge font size to 2em */
            padding: 15px 25px;
            margin: 10px;
            border-radius: 20px;
            cursor: pointer;
            border: none;
            color: white;
        }

        #start {
            background-color: #28a745;
        }

        #stop {
            background-color: #dc3545;
        }

        #progress {
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .timer-display {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            margin-top:20px;
            margin-bottom:20px;
        }
    </style>
</head>
<body>
    <div class="d">
        <div class="left-text">HOMEO-GEN</div>
        <div><a class="a" href="home.php">Home</a></div>
        <div><a class="a" href="gridpage.html">Contents</a></div>
        <div><a class="a" href="aboutus.pdf">About Us</a></div>
        <div><a class="a" href="account.php">Profile</a></div>
    </div>

    <div class="category-buttons">
        <button data-category="stress" class="active">Stress Management</button>
        <button data-category="anger">Anger Management</button>
        <button data-category="depression">Depression</button>
    </div>

    <div id="stress" class="exercise-container active">
        <h2>Stress Relief Breathing (4-4-6)</h2>
        <div id="visualization-stress" class="visualization"></div>
        <div class="timer-display" id="timer-stress"></div>
        <div id="controls-stress">
            <div class="control-row">
                <button id="start-stress">Start</button>
                <button id="stop-stress">Stop</button>
            </div>
            <div class="control-row">
                <label for="audioVolume-stress">Volume:</label>
                <input type="range" id="audioVolume-stress" min="0" max="1" step="0.01" value="0.5">
            </div>
        </div>
        <div id="progress-stress"></div>
    </div>

    <div id="anger" class="exercise-container">
        <h2>Anger Management Breathing (4-0-6)</h2>
        <div id="visualization-anger" class="visualization"></div>
        <div class="timer-display" id="timer-anger"></div>
        <div id="controls-anger">
            <div class="control-row">
                <button id="start-anger">Start</button>
                <button id="stop-anger">Stop</button>
            </div>
            <div class="control-row">
                <label for="audioVolume-anger">Volume:</label>
                <input type="range" id="audioVolume-anger" min="0" max="1" step="0.01" value="0.5">
            </div>
        </div>
        <div id="progress-anger"></div>
    </div>

    <div id="depression" class="exercise-container">
        <h2>Uplifting Breathing (6-2-4)</h2>
        <div id="visualization-depression" class="visualization"></div>
        <div class="timer-display" id="timer-depression"></div>
        <div id="controls-depression">
            <div class="control-row">
                <button id="start-depression">Start</button>
                <button id="stop-depression">Stop</button>
            </div>
            <div class="control-row">
                <label for="audioVolume-depression">Volume:</label>
                <input type="range" id="audioVolume-depression" min="0" max="1" step="0.01" value="0.5">
            </div>
        </div>
        <div id="progress-depression"></div>
    </div>

    <script>
        const categoryButtons = document.querySelectorAll('.category-buttons button');
        const exerciseContainers = document.querySelectorAll('.exercise-container');
        const visualizations = {
            stress: document.getElementById('visualization-stress'),
            anger: document.getElementById('visualization-anger'),
            depression: document.getElementById('visualization-depression')
        };
        const startButtons = {
            stress: document.getElementById('start-stress'),
            anger: document.getElementById('start-anger'),
            depression: document.getElementById('start-depression')
        };
        const stopButtons = {
            stress: document.getElementById('stop-stress'),
            anger: document.getElementById('stop-anger'),
            depression: document.getElementById('stop-depression')
        };
        const progressDivs = {
            stress: document.getElementById('progress-stress'),
            anger: document.getElementById('progress-anger'),
            depression: document.getElementById('progress-depression')
        };
        const audioVolumeInputs = {
            stress: document.getElementById('audioVolume-stress'),
            anger: document.getElementById('audioVolume-anger'),
            depression: document.getElementById('audioVolume-depression')
        };
        const timerDisplays = {
            stress: document.getElementById('timer-stress'),
            anger: document.getElementById('timer-anger'),
            depression: document.getElementById('timer-depression')
        };

        let intervals = {};
        let audioContexts = {};
        let oscillators = {};
        let gainNodes = {};
        let cycleTimers = {};

        const breathingPatterns = {
            stress: [4, 4, 6],
            anger: [4, 0, 6],
            depression: [6, 2, 4]
        };

        function playTone(category, frequency, duration) {
            if (!audioContexts[category]) {
                audioContexts[category] = new (window.AudioContext || window.webkitAudioContext)();
                oscillators[category] = audioContexts[category].createOscillator();
                gainNodes[category] = audioContexts[category].createGain();
                oscillators[category].connect(gainNodes[category]);
                gainNodes[category].connect(audioContexts[category].destination);
                oscillators[category].type = 'sine';
            }
            oscillators[category].frequency.setValueAtTime(frequency, audioContexts[category].currentTime);
            gainNodes[category].gain.setValueAtTime(audioVolumeInputs[category].value, audioContexts[category].currentTime);
            oscillators[category].start();
            setTimeout(() => {
                oscillators[category].stop(audioContexts[category].currentTime);
                audioContexts[category] = null;
            }, duration * 1000);
        }

        function updateTimerDisplay(category, time) {
            timerDisplays[category].textContent = time > 0 ? time : '';
        }

        function breathe(category) {
            const pattern = breathingPatterns[category];
            const inhaleDuration = pattern[0];
            const holdDuration = pattern[1];
            const exhaleDuration = pattern[2];
            const viz = visualizations[category];
            const progress = progressDivs[category];
            const timerDisplay = timerDisplays[category];

            let cycle = 0;
            let phaseTime = 0;
            let currentPhase = 'inhale';

            clearInterval(intervals[category]);

            intervals[category] = setInterval(() => {
                if (currentPhase === 'inhale') {
                    viz.style.transform = 'scale(1.2)';
                    playTone(category, 440, inhaleDuration);
                    progress.textContent = 'Inhale';
                    phaseTime = inhaleDuration;
                    currentPhase = holdDuration > 0 ? 'hold' : 'exhale';
                } else if (currentPhase === 'hold') {
                    playTone(category, 220, holdDuration);
                    progress.textContent = 'Hold';
                    phaseTime = holdDuration;
                    currentPhase = 'exhale';
                } else {
                    viz.style.transform = 'scale(0.8)';
                    playTone(category, 330, exhaleDuration);
                    progress.textContent = 'Exhale';
                    phaseTime = exhaleDuration;
                    currentPhase = 'inhale';
                    cycle++;
                }

                let timer = phaseTime;
                clearInterval(cycleTimers[category]);
                cycleTimers[category] = setInterval(() => {
                    updateTimerDisplay(category, timer);
                    timer--;
                    if (timer < 0) {
                        clearInterval(cycleTimers[category]);
                        updateTimerDisplay(category, '');
                    }
                }, 1000);
            }, (inhaleDuration + holdDuration + exhaleDuration) * 1000);
        }

        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                exerciseContainers.forEach(container => container.classList.remove('active'));
                document.getElementById(this.dataset.category).classList.add('active');
                for (const key in intervals) {
                    clearInterval(intervals[key]);
                    progressDivs[key].textContent = 'Stopped';
                    timerDisplays[key].textContent = '';
                    if (audioContexts[key]) {
                        if (oscillators[key]) oscillators[key].stop();
                        audioContexts[key] = null;
                    }
                    clearInterval(cycleTimers[key]);
                }
                breathe(this.dataset.category);
            });
        });

        for (const category in startButtons) {
            startButtons[category].addEventListener('click', () => {
                clearInterval(intervals[category]);
                breathe(category);
            });

            stopButtons[category].addEventListener('click', () => {
                clearInterval(intervals[category]);
                progressDivs[category].textContent = 'Stopped';
                timerDisplays[category].textContent = '';
                if (audioContexts[category]) {
                    if (oscillators[category]) oscillators[category].stop();
                    audioContexts[category] = null;
                }
                clearInterval(cycleTimers[category]);
            });

            audioVolumeInputs[category].addEventListener('input', () => {
                if (audioContexts[category] && gainNodes[category]) {
                    gainNodes[category].gain.setValueAtTime(audioVolumeInputs[category].value, audioContexts[category].currentTime);
                }
            });
        }

        breathe('stress');
    </script>
</body>
</html>