document.addEventListener('DOMContentLoaded', function () {
    const filtresForm = document.getElementById('filtresForm');

    filtresForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const annonces = document.getElementsByClassName('card');
        const prixMin = document.getElementById('prixMinInput').value;
        const prixMax = document.getElementById('prixMaxInput').value;
        const kilometresMin = document.getElementById('kilometresMinInput').value;
        const kilometresMax = document.getElementById('kilometresMaxInput').value;
        const anneeMin = document.getElementById('anneeMinInput').value;
        const anneeMax = document.getElementById('anneeMaxInput').value;
        const marque = document.getElementById('marqueSelect').value;
        const carburant = document.getElementById('carburantSelect').value;

        for (let i = 0; i < annonces.length; i++) {
            const annonce = annonces[i];
            const annoncePrix = parseInt(annonce.getAttribute('data-prix'));
            const annonceKilometres = parseInt(annonce.getAttribute('data-kilometres'));
            const annonceAnnee = parseInt(annonce.getAttribute('data-annee'));
            const annonceMarque = annonce.getAttribute('data-marque');
            const annonceCarburant = annonce.getAttribute('data-carburant');

            const correspondancePrix = (prixMin === '' || annoncePrix >= prixMin) && (prixMax === '' || annoncePrix <= prixMax);
            const correspondanceKilometres = (kilometresMin === '' || annonceKilometres >= kilometresMin) && (kilometresMax === '' || annonceKilometres <= kilometresMax);
            const correspondanceAnnee = (anneeMin === '' || annonceAnnee >= anneeMin) && (anneeMax === '' || annonceAnnee <= anneeMax);
            const correspondanceMarque = marque === '' || annonceMarque === marque;
            const correspondanceCarburant = carburant === '' || annonceCarburant === carburant;

            if (correspondancePrix && correspondanceKilometres && correspondanceAnnee && correspondanceMarque && correspondanceCarburant) {
                annonce.style.display = 'block';
            } else {
                annonce.style.display = 'none';
            }
        }
    });
});