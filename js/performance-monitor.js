/**
 * Performance Monitoring for Image Loading
 * Tracks and logs image loading performance
 */

(function () {
    "use strict";

    // Track page load time
    window.addEventListener("load", function () {
        const perfData = window.performance.timing;
        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;

        console.log("📊 Performance Metrics:");
        console.log(`⏱️  Page Load Time: ${(pageLoadTime / 1000).toFixed(2)}s`);

        // Track image loading
        const images = performance
            .getEntriesByType("resource")
            .filter((r) => r.initiatorType === "img");

        const totalImageSize = images.reduce(
            (sum, img) => sum + img.transferSize,
            0
        );
        const avgImageLoadTime =
            images.reduce((sum, img) => sum + img.duration, 0) / images.length;

        console.log(`🖼️  Images Loaded: ${images.length}`);
        console.log(
            `📦 Total Image Size: ${(totalImageSize / 1024 / 1024).toFixed(
                2
            )} MB`
        );
        console.log(`⚡ Avg Image Load Time: ${avgImageLoadTime.toFixed(2)}ms`);

        // Track lazy loaded images
        let lazyLoadedCount = 0;
        const lazyObserver = new PerformanceObserver((list) => {
            for (const entry of list.getEntries()) {
                if (entry.initiatorType === "img") {
                    lazyLoadedCount++;
                }
            }
        });

        try {
            lazyObserver.observe({ entryTypes: ["resource"] });
        } catch (e) {
            // PerformanceObserver not supported
        }

        // Log after 5 seconds
        setTimeout(() => {
            if (lazyLoadedCount > 0) {
                console.log(`🔄 Lazy Loaded Images: ${lazyLoadedCount}`);
            }
        }, 5000);
    });

    // Track Largest Contentful Paint (LCP)
    if ("PerformanceObserver" in window) {
        try {
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                console.log(
                    `🎯 LCP: ${lastEntry.renderTime || lastEntry.loadTime}ms`
                );
            });
            lcpObserver.observe({ entryTypes: ["largest-contentful-paint"] });
        } catch (e) {
            // Not supported
        }
    }

    // Track Cumulative Layout Shift (CLS)
    if ("PerformanceObserver" in window) {
        try {
            let clsScore = 0;
            const clsObserver = new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    if (!entry.hadRecentInput) {
                        clsScore += entry.value;
                    }
                }
            });
            clsObserver.observe({ entryTypes: ["layout-shift"] });

            window.addEventListener("beforeunload", () => {
                console.log(`📐 CLS Score: ${clsScore.toFixed(4)}`);
            });
        } catch (e) {
            // Not supported
        }
    }
})();
