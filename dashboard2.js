function logout() {
  alert("You have been logged out!");
  window.location.href = "login.html"; 
}


// Bar Chart
const barChart = document.getElementById('barChart').getContext('2d');

        const maxValue = Math.max(cardholders, allottedSlots, collectedRation, disabilities, seniorCitizens, workingIndividuals);
        const yMax = Math.ceil(maxValue / 5) * 5 + 5; 

        const myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ['Cardholders', 'Allotted Slots', 'Collected Rations (%)', 'Disabilities', 'Senior Citizens', 'Working Individuals'],
                datasets: [{
                    label: 'Ration Distribution Statistics',
                    data: [cardholders, allottedSlots, collectedRation, disabilities, seniorCitizens, workingIndividuals],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40', '#9966FF'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40', '#9966FF'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5, 
                            min: 0, 
                            max: yMax, 
                        },
                    },
                },
            },
        });









        document.addEventListener('DOMContentLoaded', () => {
            let currentSlide = 0; // Initial slide index
        
            function showSlide(index) {
                const slides = document.querySelectorAll('.slider-image');
                const totalSlides = slides.length;
        
                if (index >= totalSlides) {
                    currentSlide = 0;
                } else if (index < 0) {
                    currentSlide = totalSlides - 1;
                } else {
                    currentSlide = index;
                }
        
                const sliderContainer = document.querySelector('.slider-container');
                sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
        
            // Event listeners for manual navigation
            document.querySelector('.prev-slide').addEventListener('click', () => {
                showSlide(currentSlide - 1);
            });
            document.querySelector('.next-slide').addEventListener('click', () => {
                showSlide(currentSlide + 1);
            });
        
            // Automatic slide navigation every 5 seconds
            setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000);
        
            // Initialize slider
            showSlide(currentSlide);
        });

// Event Listeners for manual slide navigation
document.querySelector('.prev-slide').addEventListener('click', () => {
    showSlide(currentSlide - 1); // Go to the previous slide
});
document.querySelector('.next-slide').addEventListener('click', () => {
    showSlide(currentSlide + 1); // Go to the next slide
});

// Initialize the slider on page load
document.addEventListener("DOMContentLoaded", () => {
    showSlide(currentSlide);
});