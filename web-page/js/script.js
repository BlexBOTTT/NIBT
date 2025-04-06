
document.addEventListener("DOMContentLoaded", function () {
    const requirementSection = document.getElementById("requirement-section");

    function checkVisibility() {
        const rect = requirementSection.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.85) {
            requirementSection.classList.add("visible");
        }
    }

    document.addEventListener("scroll", checkVisibility);
    checkVisibility(); // Run on page load in case already in view
});
