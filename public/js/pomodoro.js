document.addEventListener('DOMContentLoaded', () => {
    const timer = document.getElementById('timer');
    const controlButton = document.getElementById('control-button');
    const pomodoroButton = document.getElementById('pomodoro-button');
    const shortBreakButton = document.getElementById('short-break-button');
    const longBreakButton = document.getElementById('long-break-button');

    let timeLeft;
    let timerInterval;
    let isRunning = false;

    const times = {
        pomodoro: 25 * 60,
        shortBreak: 5 * 60,
        longBreak: 15 * 60
    };

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

    function startTimer() {
        if (!isRunning) {
            isRunning = true;
            controlButton.textContent = 'Pause';
            timerInterval = setInterval(() => {
                timeLeft--;
                timer.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    isRunning = false;
                    controlButton.textContent = 'Start';
                    alert('Time is up!');
                }
            }, 1000);
        } else {
            clearInterval(timerInterval);
            isRunning = false;
            controlButton.textContent = 'Start';
        }
    }

    function resetTimer(type) {
        clearInterval(timerInterval);
        isRunning = false;
        timeLeft = times[type];
        timer.textContent = formatTime(timeLeft);
        controlButton.textContent = 'Start';
    }

    // Event Listeners
    controlButton.addEventListener('click', () => {
        if (timeLeft === undefined) {
            resetTimer('pomodoro');
        }
        startTimer();
    });

    pomodoroButton.addEventListener('click', () => resetTimer('pomodoro'));
    shortBreakButton.addEventListener('click', () => resetTimer('shortBreak'));
    longBreakButton.addEventListener('click', () => resetTimer('longBreak'));
});