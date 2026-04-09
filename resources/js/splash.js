// Splash Screen JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const loadingProgress = document.querySelector('.loading-progress');
    const percentageText = document.querySelector('.percentage');
    const loadingDots = document.querySelector('.loading-dots');
    const splashContainer = document.querySelector('.splash-container');
    
    let progress = 0;
    const duration = 3000; // 3 detik
    const interval = 20; // Update setiap 20ms
    const increment = (100 / (duration / interval));

    // Simulasi loading progress
    const loadingInterval = setInterval(() => {
        progress += increment;
        
        if (progress >= 100) {
            progress = 100;
            clearInterval(loadingInterval);
            
            // Setelah loading selesai, fade out splash screen
            setTimeout(() => {
                splashContainer.style.opacity = '0';
                splashContainer.style.transform = 'scale(0.95)';
                
                // Redirect ke halaman utama setelah fade out
                setTimeout(() => {
                    window.location.href = '/home';
                }, 500);
            }, 300);
        }
        
        // Update progress bar dan percentage
        loadingProgress.style.width = `${progress}%`;
        percentageText.textContent = `${Math.round(progress)}%`;
        
    }, interval);

    // Fallback: jika loading terlalu lama, langsung redirect
    setTimeout(() => {
        if (progress < 100) {
            clearInterval(loadingInterval);
            loadingProgress.style.width = '100%';
            percentageText.textContent = '100%';
            
            setTimeout(() => {
                splashContainer.style.opacity = '0';
                splashContainer.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    window.location.href = '/home';
                }, 500);
            }, 300);
        }
    }, duration + 1000);

    // Optional: Skip splash screen dengan klik
    splashContainer.addEventListener('click', function(e) {
        if (e.target === splashContainer) {
            clearInterval(loadingInterval);
            loadingProgress.style.width = '100%';
            percentageText.textContent = '100%';
            
            splashContainer.style.opacity = '0';
            splashContainer.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                window.location.href = '/home';
            }, 500);
        }
    });
});