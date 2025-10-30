// Lazy Loading Images with Intersection Observer
// Note: Native lazy loading is already handled by the browser
// This is just for additional optimization if needed

document.addEventListener("DOMContentLoaded", function () {
    // Only add observer for images with data-src attribute
    const lazyImages = document.querySelectorAll("img[data-src]");

    if (lazyImages.length === 0) {
        return; // No lazy images to process
    }

    const imageObserverConfig = {
        rootMargin: "50px 0px",
        threshold: 0.01,
    };

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;

                // Load the image
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute("data-src");
                }

                // Stop observing this image
                observer.unobserve(img);
            }
        });
    }, imageObserverConfig);

    lazyImages.forEach((img) => {
        imageObserver.observe(img);
    });

    // Fallback for browsers without Intersection Observer
    if (!("IntersectionObserver" in window)) {
        lazyImages.forEach((img) => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    }
});
