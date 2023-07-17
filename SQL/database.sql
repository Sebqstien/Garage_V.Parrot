CREATE DATABASE IF NOT EXISTS garage_vparrot;


CREATE TABLE `annonces` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `marque` varchar(60) DEFAULT NULL,
  `modele` varchar(255) DEFAULT NULL,
  `carburant` varchar(30) DEFAULT NULL,
  `prix` double NOT NULL,
  `kilometrage` varchar(30) NOT NULL,
  `annee` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8mb4;


INSERT INTO `annonces` (`id`, `titre`, `description`, `marque`, `modele`, `carburant`, `prix`, `kilometrage`, `annee`, `created_at`) VALUES
(1, 'PEUGEOT 308 1.5 BLUEHDI 130CH S&S ACTIVE BUSINESS', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'PEUGEOT', '308 1.5 BLUEHDI 130CH S&S ACTIVE BUSINESS', 'DIESEL', 13900, '118000', '2019', '2023-06-28 21:22:47'),
(2, 'BMW SERIE 1 (F21/F20) 116DA 116CH URBANCHIC 5P', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'BMW', 'SERIE 1 (F21/F20) 116DA 116CH URBANCHIC 5P', 'DIESEL', 14900, '140684', '2016', '2023-06-28 21:22:47'),
(3, 'ALFA ROMEO GIULIETTA 1.6 JTDM 105CH DISTINCTIVE BUSINESS STOP&START', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'ALPHA ROMEO', 'GIULIETTA 1.6 JTDM 105CH DISTINCTIVE BUSINESS STOP&START', 'DIESEL', 12990, '102422', '2016', '2023-06-28 21:32:00'),
(4, 'FIAT 500 1.2 8V 69CH POP', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'FIAT', '500 1.2 8V 69CH POP', 'ESSENCE', 6500, '99190', '2009', '2023-06-28 21:32:00');


CREATE TABLE `avis` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `note` tinyint(1) NOT NULL,
  `commentaire_avis` text NOT NULL,
  `approved` tinyint(1) DEFAULT '0'
) DEFAULT CHARSET=utf8mb4;


INSERT INTO `avis` (`id`, `nom`, `note`, `commentaire_avis`, `approved`) VALUES
(1, 'Client_test', 5, 'Super !', 1),
(5, 'client test', 4, 'ceci est mon commentaire!', 1),
(6, 'test', 5, 'awdawd', 0),
(8, 'test', 2, 'awdawd', 0),
(9, 'Marcus', 5, 'Revision au top !\r\nEquipe formidable !', 1);


CREATE TABLE `garages` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telephone` int NOT NULL,
  `adresse` varchar(50) NOT NULL
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `garages` (`id`, `nom`, `email`, `telephone`, `adresse`) VALUES
(1, 'Garage Vincent Parrot', 'contact@vparrot.com', 251999999, '99 Roving street, 22 456');


CREATE TABLE `horaires` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `jours_ouverture` varchar(30) NOT NULL,
  `heures_PM` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `heures_AM` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `horaires` (`id`, `jours_ouverture`, `heures_PM`, `heures_AM`) VALUES
(1, 'Lundi', '8h45-12h00', '14h00-18h00'),
(2, 'Mardi', '8h45-12h00', '14h00-18h00'),
(3, 'Mercredi', '8h45-12h00', '14h00-18h00'),
(4, 'Jeudi', '8h45-12h00', '14h00-18h00'),
(5, 'Vendredi', '8h45-12h00', '14h00-18h00'),
(6, 'Samedi', '8h45-12h00', 'Fermé'),
(7, 'Dimanche', 'Fermé', 'Fermé');


CREATE TABLE `images` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `path_image` varchar(255) DEFAULT NULL,
  `id_voiture` int NOT NULL
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `images` (`id`, `path_image`, `id_voiture`) VALUES
(1, 'upload/peugeot_308-1.jpg', 1),
(2, 'upload/peugeot_308-2.jpg', 1),
(3, 'upload/peugeot_308-3.jpg', 1),
(4, 'upload/peugeot_308-4.jpg', 1),
(5, 'upload/peugeot_308-5.jpg', 1),
(6, 'upload/BMW_116-1.jpg', 2),
(7, 'upload/BMW_116-2.jpg', 2),
(8, 'upload/BMW_116-3.jpg', 2),
(9, 'upload/BMW_116-4.jpg', 2),
(10, 'upload/BMW_116-5.jpg', 2),
(16, 'upload/ALPHA_giuletta-1.jpg', 3),
(17, 'upload/ALPHA_giuletta-2.jpg', 3),
(18, 'upload/ALPHA_giuletta-3.jpg', 3),
(19, 'upload/ALPHA_giuletta-4.jpg', 3),
(50, 'upload/64a82110cd34a_fiat_500-1.jpg', 4),
(51, 'upload/64a82110cd519_fiat_500-2.jpg', 4),
(52, 'upload/64a82110cd67d_fiat_500-3.jpg', 4),
(53, 'upload/64a82110cd7c8_fiat_500-4.jpg', 4),
(54, 'upload/64a82110cd915_fiat_500-5.jpg', 4);


CREATE TABLE `services` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titre` varchar(60) NOT NULL,
  `description` text,
  `prix` double NOT NULL
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `services` (`id`, `titre`, `description`, `prix`) VALUES
(1, 'revision et vidange', 'changement des filtres\r\nmise a niveau des liquides\r\npression des pneusdiagnostique expert', 100),
(2, 'diagnostic freinage', 'remplacement plaquettes \r\ndiagnostic ABS ou ESP\r\nPurge liquide de frein\r\nConfiguration ABS', 159),
(3, 'Distribution', 'Remplacement courroie de distribution\r\nRemplacement galets tendeur\r\nRemplacement pompes a eau\r\nLecture des codes defauts', 325);


CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(60) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `is_admin`) VALUES
(1, 'Parrot', 'Vincent', 'contact@vparrot.fr', '$2y$10$6xX1wYSBq5pAxUQQh1G4Me..Mzdz1vXkmqLmJq6.l/mdZr2l/wSfK', 1),
(2, 'Doe', 'John', 'j.doe@vparrot.fr', '$2y$10$tliEbbNJOI6GQ1qpbxLP.u1n/BOgHRSfa5291W0HeVoVO0EyirJZu', 0);


ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_voiture_id` FOREIGN KEY (`id_voiture`) REFERENCES `annonces` (`id`) ON DELETE CASCADE;


COMMIT;
