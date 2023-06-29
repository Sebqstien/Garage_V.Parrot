CREATE DATABASE IF NOT EXISTS Garage_VParrot CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
use Garage_VParrot;
--
-- Structure de la table `annonces`
--
CREATE TABLE `annonces` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `marque` VARCHAR(60),
    `modele` VARCHAR(255),
    `carburant` VARCHAR(30),
    `prix` FLOAT(30) NOT NULL,
    `kilometrage` VARCHAR(30) NOT NULL,
    `annee` VARCHAR(30),
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
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
-- Structure de la table `images`
--
CREATE TABLE `images` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `path_image` VARCHAR(255),
    `id_voiture` INT NOT NULL FOREIGN KEY REFERENCES annonces(id)
);
--
-- Structure de la table `informations`
--
CREATE TABLE `informations` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `adresse` VARCHAR(255),
    `telephone` VARCHAR(10),
    `email` VARCHAR(255),
    `jour_ouverture` VARCHAR(30),
    `heure_ouverture` VARCHAR(30),
    `heure_fermeture` VARCHAR(30),
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
-- Structure de la table `services`
--
CREATE TABLE `services` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(60) NOT NULL,
    `description` TEXT,
    `prix` FLOAT(30) NOT NULL
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