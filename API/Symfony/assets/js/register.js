// Imports
import Gryffondor from "../images/houses/Gryffondor.png";
import GryffondorHat from "../images/register/Sort_Hat/sort_hat_Gryffondor.png"
import Serdaigle from "../images/houses/Serdaigle.png";
import SerdaigleHat from "../images/register/Sort_Hat/sort_hat_Serdaigle.png"
import Poufsouffle from "../images/houses/Poufsouffle.png";
import PoufsouffleHat from "../images/register/Sort_Hat/sort_hat_Poufsouffle.png"
import Serpentard from "../images/houses/Serpentard.png";
import SerpentardHat from "../images/register/Sort_Hat/sort_hat_Serpentard.png"

/** Functions **/
const getHouseImg = house => {
    switch (house) {
        case 'Gryffondor':
            return Gryffondor
        case 'Serdaigle':
            return Serdaigle
        case 'Poufsouffle':
            return Poufsouffle
        case 'Serpentard':
            return Serpentard
    }
}

const getHouseHatImg = house => {
    switch (house) {
        case 'Gryffondor':
            return GryffondorHat
        case 'Serdaigle':
            return SerdaigleHat
        case 'Poufsouffle':
            return PoufsouffleHat
        case 'Serpentard':
            return SerpentardHat
    }
}

/*** REGISTRATION FORM ***/
// CHOIXPEAU
// Verify that I'm on the registration page
/*
    I choose to use the Materialize class.
    Like this, the submit button is still accessible if the JS disabled.
*/
if (document.getElementById('divFormRegister')) {
    const tabDesc = [
        'C\'est la maison du courage, de la force, de la bravoure et de la hardiesse.\n' +
        'La directrice de cette maison est Minerva McGonagall.\n' +
        'Par ailleurs, s\'y trouve l\'un des nombreux fantômes de Poudlard :\n' +
        'Sir Nicholas de Mimsy Porpington, dit Nick Quasi-Sans-Tête.',

        'C\'est la maison de l\'érudition, de la curiosité, de la sagesse et de la créativité.\n' +
        'Son directeur est Filius Flitwick, et son fantôme Helena Serdaigle.\n' +
        'Aussi appelée la Dame grise, cette dernière est la fille de Rowena Serdaigle, cofondatrice de Poudlard.',

        'C\'est la maison du travail, de la justice et de la loyauté.\n' +
        'La directrice est Pomona Chourave, également professeur de botanique.\n' +
        'C\'est aussi la maison de Cedric Diggory, le rival de Harry lors de la Coupe de feu.',

        'C\'est la maison de la ruse et de l\'ambition.\n' +
        'La maison Serpentard est soumise à de nombreux clichés dus à celui dont on ne prononce pas le nom.\n' +
        'Néanmoins elle est considérée comme l\'une des meilleures maisons de Poudlard'
    ];

    const tabSortHat = ['Gryffondor', 'Serdaigle', 'Poufsouffle', 'Serpentard'];
    const tabIndex = Math.floor(Math.random() * tabSortHat.length) + 1;
    const house = tabSortHat[tabIndex];
    
    document.getElementById('descriptionHouses').innerText = tabDesc[tabIndex];
    document.getElementById('sortHatHouses').setAttribute('src', getHouseHatImg(house))
    document.getElementById('housesImg').setAttribute('src', getHouseImg(house))
    document.getElementById('houseAccept').innerText = house;

    const element = document.getElementById('btnSortHat');
    element.addEventListener('click', function (event) {
        const btnSubmit = document.getElementById('submitBtnRegistration');
        btnSubmit.classList.remove('hide');
        element.classList.add('hide');
    })
}
