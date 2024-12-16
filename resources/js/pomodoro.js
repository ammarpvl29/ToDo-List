document.addEventListener('DOMContentLoaded', () => {
    const timerDisplay = document.getElementById('timer');
    const startBtn = document.getElementById('start-btn');
    const pauseBtn = document.getElementById('pause-btn');
    const resetBtn = document.getElementById('reset-btn');

    let interval;
    let timeLeft = 25 * 60; // 25 minutes
    let isRunning = false;

    function updateDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    startBtn.addEventListener('click', () => {
        if (!isRunning) {
            isRunning = true;
            interval = setInterval(() => {
                if (timeLeft > 0) {
                    timeLeft--;
                    updateDisplay();
                } else {
                    clearInterval(interval);
                    isRunning = false;
                }
            }, 1000);
        }
    });

    pauseBtn.addEventListener('click', () => {
        clearInterval(interval);
        isRunning = false;
    });

    resetBtn.addEventListener('click', () => {
        clearInterval(interval);
        timeLeft = 25 * 60;
        isRunning = false;
        updateDisplay();
    });

    updateDisplay();
});