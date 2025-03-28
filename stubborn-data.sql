-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 mars 2025 à 15:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stubborn`
--

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250317124911', '2025-03-17 13:49:26', 37),
('DoctrineMigrations\\Version20250317131604', '2025-03-17 14:16:16', 10),
('DoctrineMigrations\\Version20250317164429', '2025-03-17 17:44:44', 70),
('DoctrineMigrations\\Version20250317165334', '2025-03-17 17:53:42', 8),
('DoctrineMigrations\\Version20250317171108', '2025-03-17 18:11:16', 5),
('DoctrineMigrations\\Version20250318103340', '2025-03-18 11:33:48', 27),
('DoctrineMigrations\\Version20250318135149', '2025-03-18 14:52:49', 17);

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `img`, `top`) VALUES
(1, 'Blackbelt', 29.90, 'uploads/1.jpeg', 1),
(2, 'BlueBelt', 29.90, 'uploads/2.jpeg', 0),
(3, 'Street', 34.50, 'uploads/3.jpeg', 0),
(4, 'Pokeball', 45.00, 'uploads/4.jpeg', 1),
(5, 'PinkLady', 29.90, 'uploads/5.jpeg', 0),
(6, 'Snow', 32.00, 'uploads/6.jpeg', 0),
(7, 'Greyback', 28.50, 'uploads/7.jpeg', 0),
(8, 'BlueCloud', 45.00, 'uploads/8.jpeg', 0),
(9, 'BornInUsa', 59.90, 'uploads/9.jpeg', 1),
(10, 'GreenSchool', 42.20, 'uploads/10.jpeg', 0);

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `size`, `quantity`) VALUES
(1, 1, 'XS', 5),
(2, 1, 'S', 14),
(3, 1, 'M', 26),
(4, 1, 'L', 29),
(5, 1, 'XL', 8),
(6, 2, 'XS', 8),
(7, 2, 'S', 16),
(8, 2, 'M', 24),
(9, 2, 'L', 12),
(10, 2, 'XL', 16),
(11, 3, 'XS', 15),
(12, 3, 'S', 24),
(13, 3, 'M', 14),
(14, 3, 'L', 28),
(15, 3, 'XL', 8),
(16, 4, 'XS', 14),
(17, 4, 'S', 14),
(18, 4, 'M', 29),
(19, 4, 'L', 13),
(20, 4, 'XL', 6),
(21, 5, 'XS', 18),
(22, 5, 'S', 15),
(23, 5, 'M', 17),
(24, 5, 'L', 10),
(25, 5, 'XL', 25),
(26, 6, 'XS', 8),
(27, 6, 'S', 19),
(28, 6, 'M', 15),
(29, 6, 'L', 16),
(30, 6, 'XL', 2),
(31, 7, 'XS', 21),
(32, 7, 'S', 9),
(33, 7, 'M', 8),
(34, 7, 'L', 14),
(35, 7, 'XL', 15),
(36, 8, 'XS', 2),
(37, 8, 'S', 22),
(38, 8, 'M', 13),
(39, 8, 'L', 29),
(40, 8, 'XL', 18),
(41, 9, 'XS', 30),
(42, 9, 'S', 7),
(43, 9, 'M', 30),
(44, 9, 'L', 11),
(45, 9, 'XL', 24),
(46, 10, 'XS', 26),
(47, 10, 'S', 27),
(48, 10, 'M', 29),
(49, 10, 'L', 30),
(50, 10, 'XL', 5);

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `roles`, `password`, `is_verified`, `address`) VALUES
(1, 'admin', 'admin123@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$OUmogpHhZmUSvsVggjhQF.es/QcjaCEWEaHLh9pETnpWiFTezYyou', 0, '8 rue du bac 54100 Nancy'),
(2, 'laurac', 'biblio89@hotmail.fr', '[\"ROLE_CUSTOMER\"]', '$2y$13$2zG7boUWufbv61E6U4uROOWdb647oP0uTtuBoIxTiQmLsY5n6hoGC', 0, '3 rue des'),
(3, 'Toto', 'toto@gmail.com', '[\"ROLE_CUSTOMER\"]', '$2y$13$KevsIX/gSYtcZFnYupUSk.i1RsEFm3q5xH0qdJbVscoCm23Z/MKlW', 0, '3 rue des prunes'),
(4, 'Jojo', 'jojo@gmail.com', '[\"ROLE_CUSTOMER\"]', '$2y$13$KF/RBT9A6U4wcVwSD8E1BepTLWeXIneJo/ICODNoK33w9NaeWJfC2', 0, '3 rue des poires'),
(5, 'ursula von der leyen', 'test@hotmail.fr', '[\"ROLE_CUSTOMER\"]', '$2y$13$ddppJ0YaiqHVtXoRibnCn.1BQZ9jXj0Ss7/vQjvv5.xb9qXR3Ndi2', 0, '3 rue des roses'),
(6, 'Momo', 'biblio89@gmail.com', '[\"ROLE_CUSTOMER\"]', '$2y$13$wg2Gwg.hMeHTOV9PxaBdIu/LUiwhI0TJUnOgETxyQaBHZZIpw/vnq', 0, '3 rue des fenetres'),
(7, 'Hoho', 'hoho@gmail.com', '[\"ROLE_CUSTOMER\"]', '$2y$13$mDpD6G9QuVIInPhAHdvdgO1Lz2R7KT2dh2QHj6eqlgIJYPi0iFkI6', 0, '3 rue des fleurs');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
