// Imports css for the cart entry
import '../css/cart.css';

// Récupère le nombre de produit (span avec id compteur)
const compteur = parseInt(document.getElementById("compteur").textContent);

// Si la valeur récupérée est un nombre
if (typeof (compteur) == "number") {
    // On boucle un event qui toggle la classe show du dropdown lors d'un click sur le bouton correspondant, et cela pour tous les produits
    for (let x = 1; x <= compteur; x++) {
        document.getElementById("dropbtn" + x + "").addEventListener("click", function () {
            document.getElementById("myDropdownn" + x + "").classList.toggle("show");
        });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Close any dropdown menu if the user clicks outside of it
    window.addEventListener("click", function (event) {
       if (!event.target.matches('.dropbtn')) {
           const dropdowns = document.getElementsByClassName("dropdownn-content");

           for (let i = 0; i < dropdowns.length; i++) {
               let openDropdown = dropdowns[i];
               if (openDropdown.classList.contains('show')) {
                   openDropdown.classList.remove('show');
               }
           }
       }
   });
});
