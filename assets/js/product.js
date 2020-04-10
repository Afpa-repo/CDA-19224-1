/* IMPORT CSS */
import '../css/product.css';

var productCategory = document.getElementById("productCategory").value;
var productTitle = document.getElementById("productTitle");

// Conditions used to load the background of each category

if (productCategory ==  "Baguettes") {
  productTitle.style.backgroundImage = "url('https://static.warnerbros.fr/static/version1585662335/frontend/Warner/wizardingworld/fr_FR/images/fanstore/wizardingworld/home/baguettes-ollivander-2.webp')";
}

if (productCategory ==  "Vêtements") {
  productTitle.style.backgroundImage = "url('https://static.warnerbros.fr/static/version1585662335/frontend/Warner/wizardingworld/fr_FR/images/fanstore/wizardingworld/home/vetements-2.webp')";
}

if (productCategory ==  "Bijoux") {
  productTitle.style.backgroundImage = "url('https://static.warnerbros.fr/static/version1585734374/frontend/Warner/wizardingworld/fr_FR/images/fanstore/wizardingworld/home/bijoux-2.webp')";
}

if (productCategory ==  "Papeterie") {
  productTitle.style.backgroundImage = "url('https://static.warnerbros.fr/static/version1585734374/frontend/Warner/wizardingworld/fr_FR/images/fanstore/wizardingworld/home/papeterie-2.webp')";
}

if (productCategory ==  "Accessoires") {
  productTitle.style.backgroundImage = "url('https://static.warnerbros.fr/static/version1585734374/frontend/Warner/wizardingworld/fr_FR/images/fanstore/wizardingworld/home/accessoires-2.webp')";
}
