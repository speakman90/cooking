-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 01 juin 2022 à 08:40
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cooking-project`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220528083430', '2022-05-28 08:35:00', 75),
('DoctrineMigrations\\Version20220528125614', '2022-05-28 12:56:34', 43),
('DoctrineMigrations\\Version20220528134158', '2022-05-28 13:42:11', 65),
('DoctrineMigrations\\Version20220528134511', '2022-05-28 13:45:15', 34);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() COMMENT '(DC2Type:datetime_immutable)',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `title`, `slug`, `content`, `created_at`, `img`) VALUES
(13, 'Et.', 'et', 'Ipsa odio voluptas nulla illo tempora aut aut. Cupiditate error dignissimos sit illum rerum est officia.', '2022-05-28 13:59:29', 'Dolor similique.'),
(286, 'Ut.', 'ut', 'Quia totam neque similique ex repellendus dolor fuga. Corrupti eum at nemo reiciendis consequatur nobis nihil. Dignissimos veniam ut blanditiis ad officiis deleniti aperiam.', '2022-05-28 13:59:29', 'Recusandae debitis.'),
(334, 'tarte au poison', 'tarte-poison', 'loremp izdoqpzfkpfgkesfqfqezfqe', '2017-01-01 00:00:00', 'C:\\xampp\\tmp\\php31E4.tmp'),
(536, 'Quia.', 'quia', 'Quia cumque fuga quia et dolor ut. Modi ipsam qui ad repellendus vel sed rerum.', '2022-05-28 13:59:29', 'Praesentium saepe.'),
(635, 'Qui.', 'qui', 'Sint quia molestiae quia. In placeat non sit deserunt praesentium. Quo assumenda excepturi natus est aspernatur reiciendis ea. Qui omnis accusamus eos provident.', '2022-05-28 13:59:29', 'Itaque voluptate.'),
(1126, 'Quia.', 'quia', 'Occaecati corrupti laudantium ut molestiae. Et eum est doloribus officiis voluptas cupiditate expedita illum. Consequatur similique rem voluptatem omnis.', '2022-05-28 13:59:29', 'Vero neque.'),
(1147, 'Qui.', 'qui', 'Aut nihil sed facilis sint est. Sed fugiat molestiae impedit a ad. Voluptas sunt eligendi laudantium beatae. Harum tempore a nemo tempore.', '2022-05-28 13:59:29', 'Libero perferendis.'),
(1178, 'Eos.', 'eos', 'Possimus voluptatem eaque neque eius nisi dolore ullam. Quis et ut reprehenderit cum provident et quia.', '2022-05-28 13:59:29', 'Autem eligendi at.'),
(1194, 'At.', 'at', 'Aut eos quos dolorem fuga qui. Tenetur quia est nobis. Fugiat inventore sint sed est debitis laboriosam.', '2022-05-28 13:59:29', 'Qui enim rerum.'),
(1232, 'AA', 'zqdqzd', 'qzdqdqz', NULL, 'C:\\xampp\\tmp\\phpCF39.tmp'),
(1350, 'Ex.', 'ex', 'Et alias quo in sit. Voluptatem facilis culpa et sunt. Cupiditate qui qui necessitatibus ut debitis. Sit eos beatae optio voluptatem ratione occaecati. Est qui quidem ullam non eligendi cum aut.', '2022-05-28 13:59:29', 'Rerum doloribus est.'),
(1893, 'Qui.', 'qui', 'Laboriosam iure earum ut eum aut dolor autem. Nihil eum sed aliquam ullam et eum ad. Rerum qui iure cupiditate rerum expedita. Beatae optio commodi qui corporis.', '2022-05-28 13:59:29', 'Iusto vel et.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`) VALUES
(9, 'pierredumas@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$qOZZAIMkiVAdKyKOHuWR7.pIldCQnDurOJ/gZLNIZoEEwPDYSJYEa'),
(10, 'sophie.pineau@bernier.fr', '[]', '$2y$13$2q6MxZjxcCu7ddGvvA0vue5uPPCriXb2CkkxTcsazsxd48uT0X0Ju'),
(11, 'joseph51@etienne.com', '[]', '$2y$13$BkMbao6g.YQElXdpd/HwXO7RpUC59HtTSHQcZQ1kFYe0SmS4cVHTW'),
(12, 'udavid@maillard.com', '[]', '$2y$13$4T/Ce3wQ.lyjvMZnGBazJexQX.kEoQmPtzBHeAPJevB9T25NJ7Kea'),
(13, 'joseph51@free.fr', '[]', '$2y$13$WlrcDlutuTwWouA5EMu1FeI2BbTKKPsI/GBfeAR1rUg1441HR75xG'),
(14, 'monique20@yahoo.fr', '[]', '$2y$13$PSiGRq7p8w/NSS34cs56HeBmvRkX07eNqMYPsXk4ll3xD8adn05KC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
