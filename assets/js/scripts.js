document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".burger-btn").addEventListener("click", function () {
        document.querySelector(".menu-overlay").classList.toggle("active");
        this.classList.toggle("active"); // Ajoute l'effet de transformation du burger en croix
    });
});

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var buttons = document.querySelectorAll(".myBtn");

buttons.forEach(function (btn) {
    btn.addEventListener("click", function () {
        modal.style.display = "block";
    });
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}