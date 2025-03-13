document.addEventListener('DOMContentLoaded', function() {
    // Circle animation code for statistics
    setTimeout(function() {
        const progressCircle = document.querySelector('.circle-animation');
        if (progressCircle) {
            progressCircle.classList.add('animate-progress');
            
            setTimeout(function() {
                const percentageCounter = document.querySelector('.percentage-counter');
                if (percentageCounter) {
                    percentageCounter.classList.add('show');
                }
            }, 500);
        }
    }, 300);
    
    // Scroll to statistics button functionality
    document.getElementById('scrollToStats').addEventListener('click', function() {
        const statisticsSection = document.getElementById('statisticsSection');
        if (statisticsSection) {
            statisticsSection.scrollIntoView({ 
                behavior: 'smooth'
            });
        }
    });
});
