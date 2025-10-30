import "./bootstrap";
import "./lazy-load";

// Smooth scroll functionality
window.scrollToSection = function (sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
};

// WhatsApp button toggle for mobile
document.addEventListener("DOMContentLoaded", function () {
    const whatsappContainer = document.querySelector(".whatsapp-container");
    const whatsappButton = document.querySelector(".whatsapp-button");

    if (whatsappButton && whatsappContainer) {
        // Toggle on mobile touch
        whatsappButton.addEventListener("click", function (e) {
            // Only toggle on touch devices
            if (
                window.matchMedia("(hover: none) and (pointer: coarse)").matches
            ) {
                e.preventDefault();
                whatsappContainer.classList.toggle("active");
            }
        });

        // Close when clicking outside
        document.addEventListener("click", function (e) {
            if (
                !whatsappContainer.contains(e.target) &&
                whatsappContainer.classList.contains("active")
            ) {
                whatsappContainer.classList.remove("active");
            }
        });
    }
});
