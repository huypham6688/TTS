// public/js/app.js
document.addEventListener('DOMContentLoaded', () => {
    const countdownElement = document.querySelector('.countdown');
    let timeLeft = 12 * 24 * 60 * 60 + 8 * 60 * 60 + 42 * 60 + 16; // 12D 08H 42M 16S in seconds

    const updateCountdown = () => {
        const days = Math.floor(timeLeft / (24 * 60 * 60));
        const hours = Math.floor((timeLeft % (24 * 60 * 60)) / (60 * 60));
        const minutes = Math.floor((timeLeft % (60 * 60)) / 60);
        const seconds = timeLeft % 60;

        countdownElement.textContent = `${days}D : ${hours.toString().padStart(2, '0')}H : ${minutes.toString().padStart(2, '0')}M : ${seconds.toString().padStart(2, '0')}S`;

        if (timeLeft > 0) {
            timeLeft--;
        } else {
            countdownElement.textContent = 'Started!';
            clearInterval(countdownInterval);
        }
    };

    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);
});
