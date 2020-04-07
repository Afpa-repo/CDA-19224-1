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
    ]
    let tabSortHat = ['Gryffondor', 'Serdaigle', 'Poufsouffle', 'Serpentard'];
    let tabIndex = Math.floor(Math.random() * 4);
    let house = tabSortHat[tabIndex];
    let description = tabDesc[tabIndex];
    document.getElementById('descriptionHouses').innerText = description;
    document.getElementById('sortHatHouses').setAttribute('src', `build/images/register/Sort_Hat/sort_hat_${house}.png`)
    document.getElementById('housesImg').setAttribute('src', `build/images/houses/${house}.png`)
    document.getElementById('houseAccept').innerText = house;

    element = document.getElementById('btnSortHat');
    element.addEventListener('click', function (event) {

        let btnSubmit = document.getElementById('submitBtnRegistration');
        btnSubmit.classList.remove('hide');
        element.classList.add('hide');

    })
}