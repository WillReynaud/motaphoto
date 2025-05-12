//====== VARIABLES GLOBALES ======
let photoList = [];
let currentIndex = 0;

// ====== MENU BURGER ======

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".burger-btn").addEventListener("click", function () {
        document.querySelector(".menu-overlay").classList.toggle("active");
        this.classList.toggle("active"); // Ajoute l'effet de transformation du burger en croix
        document.querySelector("body").classList.toggle("no-scroll"); //désactive le scroll à l'ouverture
    });
});

// ====== MODAL ======
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var buttons = document.querySelectorAll(".myBtn, .myBtn2");

buttons.forEach(function (btn) {
    btn.addEventListener("click", function () {

        // Afficher la modal
        modal.classList.add("show");
        if(document.querySelector('#reference')){
            document.querySelector('#ref').value=document.querySelector('#reference').textContent;
        }
    });
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.classList.remove("show");
    }
}




// ========================== AJAX ============================
document.addEventListener('DOMContentLoaded', function () {
    let page = 2;
    const loadMoreBtn = document.getElementById('load-more-btn');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const data = new FormData();
            data.append('action', 'charger_plus_photos');
            data.append('page', page);
            fetch(ajaxurl.ajaxurl, {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(html => {
                if (html.trim() !== '') {
                    document.querySelector('.photo-grid').innerHTML+=html;
                    page++;
                    setupLightbox(); // Re-attache les événements
                    console.log(page);
                } else {
                    loadMoreBtn.style.display = 'none';
                }
                console.log(html);
            });
        });
        setupLightbox();
    }
});

function filterPhotos() {
    const category = document.getElementById("categories").value;
    const format = document.getElementById("formats").value;
    const sort = document.getElementById("sort").value; // ou $('#sort').val() si tu veux rester en jQuery

    const data = new FormData();
    data.append('action', 'filtrer_photos');
    data.append('category', category);
    data.append('format', format);
    data.append('sort', sort); // On envoie aussi le tri

    fetch(ajaxurl.ajaxurl, {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(html => {
        document.querySelector(".photo-grid").innerHTML = html;
        document.getElementById("load-more-btn").style.display = "none";
        setupLightbox(); // Re-attache les événements
    });
}


// utilisation de "select 2" et écoute du changement des filtres
jQuery(document).ready(function($) {
    $('#categories, #formats, #sort').select2({
        minimumResultsForSearch: Infinity // ← désactive la barre de recherche
    });

    $('#categories, #formats, #sort').on('change', function () {
        filterPhotos();
    });
});




//=============== GENERER LE TABLEAU D'IMAGE AU CHARGEMENT =====================

document.addEventListener("DOMContentLoaded", function () {
    setupLightbox();
});

function loadlist(){
    photoList = [];
    document.querySelectorAll(".image-photo").forEach((el, index) => {
        photoList.push({
            url: el.dataset.url,
            ref: el.dataset.ref,
            cat: el.dataset.categorie,
        });

        el.closest(".grid-item").querySelector(".fullscreenlogo").addEventListener("click", () => {
            currentIndex = index;
            openLightbox(currentIndex);
        });
    });

}

function setupLightbox() {
    loadlist();

    document.querySelector(".close-lightbox").addEventListener("click", () => {
        const overlay = document.querySelector(".lightbox-overlay");
        overlay.classList.remove("show");
    });

    document.querySelector(".lightbox-prev").addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + photoList.length) % photoList.length;
        openLightbox(currentIndex);
    });

    document.querySelector(".lightbox-next").addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % photoList.length;
        openLightbox(currentIndex);
    });
}

function openLightbox(index) {
    loadlist();
    const photo = photoList[index];
    document.getElementById("lightbox-image").src = photo.url;
    document.getElementById("lightbox-reference").textContent = photo.ref;
    document.getElementById("lightbox-category").textContent = photo.cat;

    const overlay = document.querySelector(".lightbox-overlay");
    overlay.classList.add("show");
}

// ========== PREVIEW AU SURVOL DES FLÈCHES ==========
document.addEventListener('DOMContentLoaded', function () {
    const preview = document.querySelector('.photo-preview');
    const arrows = document.querySelectorAll('.arrow-btn');

    arrows.forEach(arrow => {
        arrow.addEventListener('mouseenter', () => {
            const thumbUrl = arrow.dataset.thumb;
            if (thumbUrl) {
                preview.innerHTML = `<img src="${thumbUrl}" alt="Aperçu">`;
            }
        });

        arrow.addEventListener('mouseleave', () => {
            preview.innerHTML = '';
        });
    });
});