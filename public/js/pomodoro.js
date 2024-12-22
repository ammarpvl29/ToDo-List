// Time configuration (in minutes)
const POMODORO_TIME = 25;
const MILLISECONDS = 1000;
const SECONDS_IN_MINUTE = 60;

class PomodoroTimer {
    constructor() {
        // Initialize DOM elements
        this.timerDisplay = document.getElementById('timer');
        this.startButton = document.getElementById('start-btn');
        this.pauseButton = document.getElementById('pause-btn');
        this.resetButton = document.getElementById('reset-btn');

        // Initialize timer state
        this.timeLeft = POMODORO_TIME * SECONDS_IN_MINUTE;
        this.isRunning = false;
        this.timerId = null;

        // Bind event listeners
        this.startButton.addEventListener('click', () => this.startTimer());
        this.pauseButton.addEventListener('click', () => this.pauseTimer());
        this.resetButton.addEventListener('click', () => this.resetTimer());

        // Initial UI setup
        this.updateDisplay();
        this.pauseButton.disabled = true;
        this.pauseButton.classList.add('opacity-50', 'cursor-not-allowed');
    }

    startTimer() {
        if (!this.isRunning) {
            this.isRunning = true;
            this.startButton.disabled = true;
            this.startButton.classList.add('opacity-50', 'cursor-not-allowed');
            this.pauseButton.disabled = false;
            this.pauseButton.classList.remove('opacity-50', 'cursor-not-allowed');

            this.timerId = setInterval(() => {
                this.timeLeft--;
                this.updateDisplay();

                if (this.timeLeft <= 0) {
                    this.timerComplete();
                }
            }, MILLISECONDS);
        }
    }

    pauseTimer() {
        if (this.isRunning) {
            this.isRunning = false;
            clearInterval(this.timerId);
            this.startButton.disabled = false;
            this.startButton.classList.remove('opacity-50', 'cursor-not-allowed');
            this.pauseButton.disabled = true;
            this.pauseButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    resetTimer() {
        this.pauseTimer();
        this.timeLeft = POMODORO_TIME * SECONDS_IN_MINUTE;
        this.updateDisplay();
        this.startButton.disabled = false;
        this.startButton.classList.remove('opacity-50', 'cursor-not-allowed');
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
        // Create and play a notification sound
        const audio = new Audio('path/to/notification-sound.mp3');
        audio.play();
    }

    showNotification() {
        // Check if browser supports notifications
        if ('Notification' in window) {
            if (Notification.permission === 'granted') {
                new Notification('Pomodoro Timer', {
                    body: 'Time is up! Take a break.',
                    icon: '/favicon.ico'
                });
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        new Notification('Pomodoro Timer', {
                            body: 'Time is up! Take a break.',
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