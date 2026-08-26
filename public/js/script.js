// Preloader Logic
function hidePreloader() {
    const preloader = document.getElementById('preloader');
    if (preloader && preloader.style.opacity !== '0') {
        preloader.style.opacity = '0';
        setTimeout(function () {
            preloader.style.display = 'none';
        }, 500);
    }
}

// Window Load (ideal scenario)
window.addEventListener("load", hidePreloader);

// Safety Timeout (max 2 seconds)
setTimeout(hidePreloader, 2000);

// Fallback for DOMContentLoaded (if waiting for video takes too long)
document.addEventListener('DOMContentLoaded', function () {
    // If window.load doesn't fire in 1.5s after DOM ready, force hide
    setTimeout(hidePreloader, 1500);
});
// Counter Animation
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // The lower the slower

    const animateCounters = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const targetText = counter.innerText;
                const target = +targetText.replace(/\D/g, ''); // Extract number
                const suffix = targetText.replace(/[0-9]/g, ''); // Extract suffix like +

                let count = 0;
                const inc = target / speed;

                const updateCount = () => {
                    count += inc;
                    if (count < target) {
                        counter.innerText = Math.ceil(count) + suffix;
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };

                updateCount();
                observer.unobserve(counter); // Run only once
            }
        });
    };

    const observer = new IntersectionObserver(animateCounters, {
        threshold: 0.5
    });

    counters.forEach(counter => {
        observer.observe(counter);
    });
});
