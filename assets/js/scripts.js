document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".burger-btn").addEventListener("click", function () {
        document.querySelector(".menu-overlay").classList.toggle("active");
        this.classList.toggle("active"); // Ajoute l'effet de transformation du burger en croix
    });
});