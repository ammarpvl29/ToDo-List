const MILLISECONDS = 1000;
const SECONDS_IN_MINUTE = 60;

class PomodoroTimer {
    constructor() {
        // Initialize DOM elements
        this.timerDisplay = document.getElementById('timer');
        this.timerMode = document.getElementById('timer-mode');
        this.startButton = document.getElementById('start-btn');
        this.pauseButton = document.getElementById('pause-btn');
        this.resetButton = document.getElementById('reset-btn');
        this.restButton = document.getElementById('rest-btn');
        
        // Time input elements
        this.workMinutes = document.getElementById('work-minutes');
        this.workSeconds = document.getElementById('work-seconds');
        this.restMinutes = document.getElementById('rest-minutes');
        this.restSeconds = document.getElementById('rest-seconds');

        // Initialize timer state
        this.isWorkMode = true;
        this.timeLeft = this.getWorkTime();
        this.isRunning = false;
        this.timerId = null;

        // Bind event listeners
        this.startButton.addEventListener('click', () => this.startTimer());
        this.pauseButton.addEventListener('click', () => this.pauseTimer());
        this.resetButton.addEventListener('click', () => this.resetTimer());
        this.restButton.addEventListener('click', () => this.startRestTimer());

        // Add input validation
        this.setupInputValidation();

        // Initial UI setup
        this.updateDisplay();
        this.updateButtonStates();
    }

    setupInputValidation() {
        // Setup validation for all time inputs
        [this.workMinutes, this.workSeconds, this.restMinutes, this.restSeconds].forEach(input => {
            input.addEventListener('change', () => {
                let value = parseInt(input.value);
                const isSeconds = input.id.includes('seconds');
                
                // Enforce limits
                if (isNaN(value) || value < 0) value = 0;
                if (isSeconds && value > 59) value = 59;
                if (!isSeconds && value > 99) value = 99;
                
                input.value = value;
                if (!this.isRunning) {
                    this.timeLeft = this.isWorkMode ? this.getWorkTime() : this.getRestTime();
                    this.updateDisplay();
                }
            });
        });
    }

    getWorkTime() {
        return (parseInt(this.workMinutes.value) * SECONDS_IN_MINUTE) + parseInt(this.workSeconds.value);
    }

    getRestTime() {
        return (parseInt(this.restMinutes.value) * SECONDS_IN_MINUTE) + parseInt(this.restSeconds.value);
    }

    startTimer() {
        if (!this.isRunning) {
            this.isRunning = true;
            this.updateButtonStates();

            this.timerId = setInterval(() => {
                this.timeLeft--;
                this.updateDisplay();

                if (this.timeLeft <= 0) {
                    this.timerComplete();
                }
            }, MILLISECONDS);
        }
    }

    startRestTimer() {
        this.pauseTimer();
        this.isWorkMode = false;
        this.timeLeft = this.getRestTime();
        this.updateDisplay();
        this.timerMode.textContent = 'Rest Time';
        this.startTimer();
    }

    pauseTimer() {
        if (this.isRunning) {
            this.isRunning = false;
            clearInterval(this.timerId);
            this.updateButtonStates();
        }
    }

    resetTimer() {
        this.pauseTimer();
        this.isWorkMode = true;
        this.timeLeft = this.getWorkTime();
        this.updateDisplay();
        this.timerMode.textContent = 'Work Time';
        this.updateButtonStates();
    }

    updateButtonStates() {
        this.startButton.disabled = this.isRunning;
        this.startButton.classList.toggle('opacity-50', this.isRunning);
        this.startButton.classList.toggle('cursor-not-allowed', this.isRunning);
        
        this.pauseButton.disabled = !this.isRunning;
        this.pauseButton.classList.toggle('opacity-50', !this.isRunning);
        this.pauseButton.classList.toggle('cursor-not-allowed', !this.isRunning);
        
        this.restButton.disabled = this.isRunning;
        this.restButton.classList.toggle('opacity-50', this.isRunning);
        this.restButton.classList.toggle('cursor-not-allowed', this.isRunning);
    }

    updateDisplay() {
        const minutes = Math.floor(this.timeLeft / SECONDS_IN_MINUTE);
        const seconds = this.timeLeft % SECONDS_IN_MINUTE;
        this.timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    timerComplete() {
        this.pauseTimer();
        this.playNotificationSound();
        this.showNotification();
    }

    playNotificationSound() {
        const audio = new Audio('mixkit-doorbell-tone-2864.wav');
        audio.play();
    }

    showNotification() {
        const message = this.isWorkMode ? 'Work time is up! Take a break.' : 'Break time is over! Back to work.';
        
        if ('Notification' in window) {
            if (Notification.permission === 'granted') {
                new Notification('Pomodoro Timer', {
                    body: message,
                    icon: '/favicon.ico'
                });
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        new Notification('Pomodoro Timer', {
                            body: message,
                            icon: '/favicon.ico'
                        });
                    }
                });
            }
        }
    }
}

// Initialize the Pomodoro timer
document.addEventListener('DOMContentLoaded', () => {
    new PomodoroTimer();
});