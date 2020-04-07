import '../css/cart.css';
// Récupère le nombre de produit (span avec id compteur)
var compteur = parseInt(document.getElementById("compteur").textContent);
// Si la valeur récupérée est un nombre
if (typeof(compteur) == "number"){
    //On boucle un event qui toggle la classe show du dropdown lors d'un click sur le bouton correspondant, et cela pour tous les produits
    for (let x = 1; x <= compteur; x++) {
          document.getElementById("dropbtn"+x+"").addEventListener("click", function(){
            document.getElementById("myDropdownn"+x+"").classList.toggle("show");
          }); 
          
      }
}
// Close any dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdownn-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  } 
