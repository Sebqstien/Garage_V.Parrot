CREATE DATABASE IF NOT EXISTS Garage_VParrot CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
use Garage_VParrot;
--
-- Structure de la table `annonces`
--
CREATE TABLE `annonces` (
    `id_annonce` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre_annonce` VARCHAR(255) NOT NULL,
    `description_annonce` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `id_voiture` INT NOT NULL REFERENCES voitures(id_voiture)
);
--
-- Structure de la table `avis`
--
CREATE TABLE `avis` (
    `id_avis` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom-client_avis` VARCHAR(60) NOT NULL,
    `note_avis` TINYINT(1),
    `commentaire_avis` TEXT NOT NULL
);
--
-- Structure de la table `garages`
--
CREATE TABLE `garages` (
    `id_garage` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom_garage` VARCHAR(60) NOT NULL
);
--
-- Structure de la table `horaires`
--
CREATE TABLE `horaires` (
    `id_horaires` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `jour-ouverture` DATE,
    `heure_ouverture` TIME,
    `heure_fermeture` TIME,
    `id_garage` INT NOT NULL REFERENCES garages(id_garage)
);
--
-- Structure de la table `images`
--
CREATE TABLE `images` (
    `id_image` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `path_image` VARCHAR(255)
);
--
-- Structure de la table `informations`
--
CREATE TABLE `informations` (
    `id_information` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `adresse` VARCHAR(255),
    `telephone` VARCHAR(10),
    `email` VARCHAR(255),
    `id_garage` INT NOT NULL REFERENCES garages(id_garage)
);
--
-- Structure de la table `users`
--
CREATE TABLE `users` (
    `id_users` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom_user` VARCHAR(60),
    `prenom_user` VARCHAR(60),
    `email_user` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `roles` JSON NOT NULL
);
--
-- Structure de la table `voitures`
--
CREATE TABLE `voitures` (
    `id_voiture` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `marque_voiture` VARCHAR(60),
    `carburant` VARCHAR(30),
    `prix_voiture` FLOAT(30) NOT NULL,
    `kilometrage` VARCHAR(30) NOT NULL,
    `annee_mise-en-circulation` VARCHAR(30),
    `description_voiture` TEXT,
    `id_image` INT NOT NULL REFERENCES images(id_image)
);

--
-- Structure de la table `services`
--
CREATE TABLE `services` (
    `id_service` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre_service` VARCHAR(60) NOT NULL,
    `description_service` TEXT,
    `prix_service` FLOAT(30) NOT NULL,
    `id_image` INT NOT NULL REFERENCES images(id_image)
);


--
-- Insertion ADMIN
--
INSERT INTO `users` (
        `nom_user`,
        `prenom_user`,
        `email_user`,
        `password`,
        `roles`
    )
VALUES (
        'Parrot',
        'Vincent',
        'v.parrot@contact.com',
        'pass',
        '[\"ROLE_ADMIN\", \"ROLE_EMPLOYE\"]'
    );