document.addEventListener('DOMContentLoaded', function () {
    var filtresForm = document.getElementById('filtresForm');
    var annoncesContainer = document.getElementById('annoncesContainer');

    filtresForm.addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(filtresForm);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/annonces');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var annonces = JSON.parse(xhr.responseText);

                // Mettre à jour le contenu des annonces avec les données filtrées
                annoncesContainer.innerHTML = '';

                for (var i = 0; i < annonces.length; i++) {
                    var annonce = annonces[i];

                    // Créer les éléments HTML pour chaque annonce
                    // et les ajouter à annoncesContainer
                }
            }
        };
        xhr.send(formData);
    });
});