CREATE DATABASE IF NOT EXISTS Garage_VParrot CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
use Garage_VParrot;
--
-- Structure de la table `annonces`
--
CREATE TABLE `annonces` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `id_voiture` INT NOT NULL REFERENCES voitures(id)
);
--
-- Structure de la table `avis`
--
CREATE TABLE `avis` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(60) NOT NULL,
    `note` TINYINT(1),
    `commentaire_avis` TEXT NOT NULL
);
--
-- Structure de la table `garages`
--
CREATE TABLE `garages` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(60) NOT NULL
);
--
-- Structure de la table `horaires`
--
CREATE TABLE `horaires` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `jour_ouverture` DATE,
    `heure_ouverture` TIME,
    `heure_fermeture` TIME,
    `id_garage` INT NOT NULL REFERENCES garages(id)
);
--
-- Structure de la table `images`
--
CREATE TABLE `images` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `path_image` VARCHAR(255)
);
--
-- Structure de la table `informations`
--
CREATE TABLE `informations` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `adresse` VARCHAR(255),
    `telephone` VARCHAR(10),
    `email` VARCHAR(255),
    `id_garage` INT NOT NULL REFERENCES garages(id)
);
--
-- Structure de la table `users`
--
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(60),
    `prenom` VARCHAR(60),
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `roles` JSON NOT NULL
);
--
-- Structure de la table `voitures`
--
CREATE TABLE `voitures` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `marque` VARCHAR(60),
    `carburant` VARCHAR(30),
    `prix` FLOAT(30) NOT NULL,
    `kilometrage` VARCHAR(30) NOT NULL,
    `annee_mise-en-circulation` VARCHAR(30),
    `description` TEXT,
    `id_image` INT NOT NULL REFERENCES images(id)
);

--
-- Structure de la table `services`
--
CREATE TABLE `services` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(60) NOT NULL,
    `description` TEXT,
    `prix` FLOAT(30) NOT NULL,
    `id_image` INT NOT NULL REFERENCES images(id)
);


--
-- Insertion ADMIN
--
INSERT INTO `users` (
        `nom`,
        `prenom`,
        `email`,
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