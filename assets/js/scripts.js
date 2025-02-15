document.addEventListener("DOMContentLoaded", function () {
    const burgerBtn = document.querySelector(".burger-btn");
    const menuOverlay = document.querySelector(".menu-overlay");

    if (burgerBtn && menuOverlay) {
        burgerBtn.addEventListener("click", function () {
            if (!menuOverlay.classList.contains("active")) {
                // Ouvre le menu avec animation
                menuOverlay.classList.add("active");
            } else {
                // Ferme le menu avec animation
                menuOverlay.classList.remove("active");
            }
        });
    }
});