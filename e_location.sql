-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 04 Mars 2020 à 08:33
-- Version du serveur :  5.7.11
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_location`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_de_la_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `calendrier`
--

INSERT INTO `calendrier` (`id`, `date`, `id_produit`, `id_user`, `date_de_la_demande`) VALUES
(96, '2020-02-09 00:00:00', 5, 28, '2020-02-11 13:41:13'),
(97, '2020-02-12 00:00:00', 5, 28, '2020-02-11 13:41:15'),
(94, '2020-02-11 00:00:00', 5, 28, '2020-02-11 13:41:10'),
(98, '2020-02-13 00:00:00', 5, 28, '2020-02-11 13:41:18'),
(95, '2020-02-10 00:00:00', 5, 28, '2020-02-11 13:41:12'),
(99, '2020-02-04 00:00:00', 31, 54, '2020-03-02 11:17:43'),
(100, '2020-02-05 00:00:00', 31, 54, '2020-03-02 11:17:45');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(5, 'miroir'),
(6, 'fleur à pied'),
(7, 'caisse'),
(8, 'bonbonnière'),
(9, 'machine à bulle'),
(10, 'dominos'),
(11, 'chandelier'),
(12, 'fleurs'),
(13, 'Globe'),
(14, 'Bonbonnière vertical'),
(15, 'Dominos'),
(16, 'fsdfsd'),
(17, 'fsdfsd'),
(18, 'Cadre'),
(19, 'Cadre'),
(20, 'cadre N°2'),
(21, 'Cadre N°2'),
(22, 'Urne'),
(23, 'Boite Alliance'),
(24, 'Love'),
(25, 'Love'),
(26, 'cadre N°3'),
(27, 'cadre N°3'),
(28, 'Décoration');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `commentaire` varchar(250) NOT NULL,
  `date_creat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `auteur` varchar(100) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `name_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creat` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id_image`, `name_photo`, `date_creat`, `status`, `id_produit`) VALUES
(105, 'IMG_3738 - Copie.jpg', '2020-01-26 19:15:59', '1', 2),
(106, 'IMG_3741 - Copie.jpg', '2020-01-26 19:15:59', '1', 2),
(107, 'IMG_3748 - Copie.jpg', '2020-01-26 19:15:59', '1', 2),
(112, 'IMG_3716 - Copie.jpg', '2020-01-26 19:21:12', '1', 31),
(113, 'IMG_3716 - Copie.jpg', '2020-01-26 19:21:50', '1', 32),
(114, 'IMG_3716 - Copie.jpg', '2020-01-26 19:21:50', '1', 33),
(123, 'IMG_3752.jpg', '2020-01-28 13:35:04', '1', 7),
(125, 'IMG_3731.jpg', '2020-01-28 13:38:52', '1', 3),
(126, 'IMG_3732.jpg', '2020-01-28 13:38:52', '1', 3),
(127, 'IMG_3733.jpg', '2020-01-28 13:38:52', '1', 3),
(128, 'IMG_3716.jpg', '2020-01-28 13:39:01', '1', 1),
(132, 'IMG_3753.jpg', '2020-01-28 13:40:18', '1', 34),
(133, 'IMG_3754.jpg', '2020-01-28 13:40:18', '1', 34),
(134, 'IMG_3755.jpg', '2020-01-28 13:40:18', '1', 34),
(135, 'IMG_3753.jpg', '2020-01-28 13:40:26', '1', 35),
(136, 'IMG_3754.jpg', '2020-01-28 13:40:26', '1', 35),
(137, 'IMG_3755.jpg', '2020-01-28 13:40:26', '1', 35),
(138, 'IMG_3753.jpg', '2020-01-28 13:40:36', '1', 36),
(139, 'IMG_3754.jpg', '2020-01-28 13:40:36', '1', 36),
(140, 'IMG_3755.jpg', '2020-01-28 13:40:36', '1', 36),
(141, 'IMG_3753.jpg', '2020-01-28 13:40:46', '1', 37),
(142, 'IMG_3754.jpg', '2020-01-28 13:40:46', '1', 37),
(143, 'IMG_3755.jpg', '2020-01-28 13:40:46', '1', 37),
(144, 'IMG_3758.jpg', '2020-01-28 13:41:01', '1', 6),
(146, 'IMG_3700.jpg', '2020-01-28 13:41:20', '1', 30),
(147, 'IMG_3728.jpg', '2020-01-28 13:42:08', '1', 4),
(148, 'IMG_3730.jpg', '2020-01-28 13:42:08', '1', 4),
(149, 'IMG_3728.jpg', '2020-01-28 13:45:55', '1', 38),
(150, 'IMG_3730.jpg', '2020-01-28 13:45:55', '1', 38),
(151, 'IMG_3753.jpg', '2020-01-28 14:20:52', '1', 11),
(152, 'IMG_3755.jpg', '2020-01-28 14:20:52', '1', 11),
(153, 'IMG_3739.jpg', '2020-01-28 16:28:11', '1', 39),
(154, 'IMG_3749.jpg', '2020-01-28 16:28:11', '1', 39),
(156, 'IMG_3760.jpg', '2020-01-28 16:31:15', '1', 9),
(157, 'IMG_3760.jpg', '2020-01-28 16:32:54', '1', 40),
(163, 'IMG_3698.jpg', '2020-02-25 17:52:27', '1', 41),
(164, 'IMG_3698.jpg', '2020-02-25 17:52:27', '1', 42),
(165, 'IMG_3701.jpg', '2020-02-25 17:54:06', '1', 43),
(167, 'IMG_3711.jpg', '2020-02-25 17:55:23', '1', 45),
(168, 'IMG_3712.jpg', '2020-02-25 17:55:23', '1', 45),
(169, 'IMG_3713.jpg', '2020-02-25 17:55:23', '1', 45),
(171, 'IMG_3946.jpg', '2020-02-25 17:57:05', '1', 47),
(172, 'IMG_3946.jpg', '2020-02-25 17:57:05', '1', 48),
(173, 'IMG_3948.jpg', '2020-02-25 17:58:34', '1', 49),
(175, 'IMG_3951.jpg', '2020-02-25 17:59:04', '1', 51),
(181, 'IMG_3700 - Copie (2).jpg', '2020-03-03 14:01:28', '1', 5),
(182, 'IMG_3700 - Copie (3).jpg', '2020-03-03 14:01:28', '1', 5),
(183, 'IMG_3700 - Copie (4).jpg', '2020-03-03 14:01:28', '1', 5),
(184, 'IMG_3700 - Copie.jpg', '2020-03-03 14:01:28', '1', 5),
(185, 'IMG_3700.jpg', '2020-03-03 14:01:28', '1', 5),
(190, 'IMG_3701.jpg', '2020-03-03 14:20:37', '1', 44),
(191, 'IMG_3701.jpg', '2020-03-03 14:23:47', '1', 50),
(192, 'IMG_3738.jpg', '2020-03-04 09:17:30', '1', 10),
(193, 'IMG_3739.jpg', '2020-03-04 09:17:30', '1', 10),
(194, 'IMG_3741.jpg', '2020-03-04 09:17:30', '1', 10),
(195, 'IMG_3748.jpg', '2020-03-04 09:17:30', '1', 10),
(196, 'IMG_3749.jpg', '2020-03-04 09:17:30', '1', 10),
(197, 'IMG_3944 - Copie (2).jpg', '2020-03-04 09:18:48', '1', 46),
(198, 'IMG_3944 - Copie (3).jpg', '2020-03-04 09:18:48', '1', 46),
(199, 'IMG_3944 - Copie (4).jpg', '2020-03-04 09:18:48', '1', 46),
(200, 'IMG_3944 - Copie.jpg', '2020-03-04 09:18:48', '1', 46),
(201, 'IMG_3944.jpg', '2020-03-04 09:18:48', '1', 46);

-- --------------------------------------------------------

--
-- Structure de la table `index_image`
--

CREATE TABLE `index_image` (
  `id_index_image` int(11) NOT NULL,
  `titre_image` varchar(250) NOT NULL,
  `images_index` varchar(255) DEFAULT NULL,
  `actif` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `index_image`
--

INSERT INTO `index_image` (`id_index_image`, `titre_image`, `images_index`, `actif`) VALUES
(7, 'Love', 'IMG_3946.jpg', 1),
(9, 'Pilier d\'accueil', 'Pilier.jpg', 1),
(17, 'Miroir exterieur', 'Miroir.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `liaisons_produits`
--

CREATE TABLE `liaisons_produits` (
  `id_liaisons_produits` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liaisons_produits`
--

INSERT INTO `liaisons_produits` (`id_liaisons_produits`, `id_produit`, `id_categorie`) VALUES
(1, 5, 5),
(2, 30, 5),
(9, 11, 6),
(10, 34, 6),
(11, 35, 6),
(12, 36, 6),
(13, 37, 6),
(14, 3, 7),
(15, 2, 8),
(16, 10, 8),
(17, 6, 9),
(18, 9, 10),
(20, 7, 12),
(21, 1, 11),
(22, 31, 11),
(23, 32, 11),
(24, 33, 11),
(25, 58, 41),
(26, 58, 41),
(27, 38, 13),
(28, 39, 14),
(29, 40, 15),
(30, 41, 16),
(31, 41, 17),
(32, 41, 18),
(33, 42, 19),
(34, 43, 20),
(35, 44, 21),
(36, 45, 22),
(37, 46, 23),
(38, 47, 24),
(39, 48, 25),
(40, 49, 26),
(41, 50, 27),
(42, 51, 28);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_de_paiement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `numero_facture` varchar(250) NOT NULL,
  `commentaire` varchar(250) DEFAULT NULL,
  `recup_par_client` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_user`, `date_de_paiement`, `numero_facture`, `commentaire`, `recup_par_client`) VALUES
(8, 28, '2020-02-18 17:02:45', '5e392e745daa7', NULL, 0),
(9, 28, '2020-02-18 17:02:43', '5e4168bd19aff', NULL, 0),
(10, 25, '2020-02-18 17:02:40', '5e4a7129a4f7a', NULL, 0),
(11, 54, '2020-02-18 15:43:18', '5e4ab10d2fb55', 'le client recupere le 27/02 à 14h00 !!', 0),
(12, 54, '2020-02-18 17:03:54', '5e4c18fa6af13', NULL, 0),
(13, 54, '2020-02-26 09:59:42', '5e56418e80afe', NULL, 0),
(18, 54, '2020-02-26 10:26:41', '5e5647e1a784b', NULL, 0),
(19, 54, '2020-02-26 10:33:31', '5e56497b10ff6', NULL, 0),
(20, 54, '2020-02-26 10:36:02', '5e564a128ebc4', NULL, 0),
(21, 54, '2020-02-26 10:41:04', '5e564b4029fe0', NULL, 0),
(22, 54, '2020-03-02 09:08:19', '5e5ccd03dc170', NULL, 0),
(23, 54, '2020-03-02 09:15:48', '5e5ccec4c7e87', NULL, 0),
(24, 54, '2020-03-02 09:34:28', '5e5cd324dcb24', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `date_demande` date NOT NULL,
  `confirmation_panier` int(1) NOT NULL DEFAULT '0',
  `id_user` varchar(11) NOT NULL,
  `id_produit` varchar(11) NOT NULL,
  `date_de_la_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_paiement` int(11) NOT NULL DEFAULT '0',
  `relance` varchar(25) NOT NULL DEFAULT 'non',
  `commentaire` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `date_demande`, `confirmation_panier`, `id_user`, `id_produit`, `date_de_la_demande`, `id_paiement`, `relance`, `commentaire`) VALUES
(70, '2020-02-01', 3, '28', '1', '2020-02-04 08:42:28', 8, 'non', ''),
(71, '2020-02-02', 3, '28', '32', '2020-02-04 08:42:28', 8, 'non', ''),
(81, '2020-01-31', 3, '25', '30', '2020-02-17 10:55:37', 10, 'non', ''),
(85, '2020-02-20', 3, '28', '1', '2020-02-10 14:29:17', 9, 'non', ''),
(89, '2020-02-11', 2, '28', '5', '2020-02-11 13:41:24', 0, 'non', ''),
(92, '2020-02-18', 3, '25', '5', '2020-02-17 10:55:37', 10, 'non', ''),
(93, '2020-02-19', 2, '28', '6', '2020-02-17 14:37:53', 0, 'non', ''),
(97, '2020-02-20', 3, '54', '1', '2020-02-18 09:21:24', 11, 'oui', ''),
(99, '2020-02-28', 3, '54', '7', '2020-02-17 15:28:13', 11, 'non', ''),
(103, '2020-02-28', 3, '54', '5', '2020-02-17 15:28:13', 11, 'non', ''),
(104, '2020-02-27', 3, '54', '30', '2020-02-18 17:03:54', 12, 'oui', ''),
(105, '2020-02-20', 3, '54', '1', '2020-02-18 17:03:54', 12, 'oui', ''),
(106, '2020-02-20', 3, '54', '31', '2020-02-18 10:54:41', 11, 'non', ''),
(107, '2020-02-20', 3, '54', '10', '2020-02-26 10:09:15', 14, 'non', NULL),
(108, '2020-02-28', 3, '54', '2', '2020-02-26 09:59:42', 13, 'non', NULL),
(109, '2020-02-28', 3, '54', '3', '2020-02-26 10:36:02', 20, 'non', NULL),
(110, '2020-02-26', 3, '54', '42', '2020-02-26 10:41:04', 21, 'non', NULL),
(111, '2020-02-26', 3, '54', '1', '2020-02-26 10:16:56', 15, 'non', NULL),
(112, '2020-02-27', 3, '54', '5', '2020-02-26 10:33:31', 19, 'non', NULL),
(113, '2020-03-17', 3, '54', '48', '2020-03-02 15:44:19', 22, 'oui', NULL),
(114, '2020-03-18', 3, '54', '51', '2020-03-02 09:34:28', 24, 'non', NULL),
(115, '2020-03-19', 3, '54', '10', '2020-03-02 09:15:48', 23, 'non', NULL),
(116, '2020-03-10', 2, '54', '11', '2020-03-02 13:14:23', 0, 'oui', NULL),
(118, '2020-03-11', 2, '54', '48', '2020-03-02 15:44:19', 0, 'oui', NULL),
(120, '2020-03-20', 1, '54', '51', '2020-03-02 13:38:42', 0, 'non', NULL),
(121, '2020-03-28', 1, '54', '5', '2020-03-04 08:20:07', 0, 'non', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(250) NOT NULL,
  `produit_court` varchar(2500) NOT NULL,
  `produit_long` varchar(2500) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `tva` float(4,2) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `ordernum` int(11) DEFAULT '0',
  `ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `produit_court`, `produit_long`, `prix`, `tva`, `actif`, `ordernum`, `ref`) VALUES
(1, 'Chandelier', 'chandelier', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere expedita in amet non explicabo adipisci enim deserunt obcaecati aperiam dolorum dicta impedit, ', '15', 0.20, 1, 3, 1),
(2, 'Bonbonnière ronde', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez com', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plusPolitique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '5', 0.20, 0, 3, 2),
(3, 'Caisse', 'Caisse', 'BELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel Design Cœurs Sweet Home - Cagettes en Bois Vintage avec Poignées Décoration pour Chambre, Cuisine ou SalonBELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel Design Cœurs Sweet Home - Cagettes en Bois Vintage avec Poignées Décoration pour Chambre, Cuisine ou Salon', '20', 0.20, 1, 13, 1),
(5, 'Miroir', 'Miroir', 'Large choix de Miroirs. Profitez-en &amp; Commandez en ligne! Idées pour la maison. Tendances des meubles. Super prix. Meilleures offres. Acheter ici. Types: Meubles, Lampes, Accessoires de la Maison, Armoires et Rayons, Décorations, Accessoires de Cuisine.Large choix de Miroirs. Profitez-en &amp; Commandez en ligne! Idées pour la maison. Tendances des meubles. Super prix. Meilleures offres. Acheter ici. Types: Meubles, Lampes, Accessoires de la Maison, Armoires et Rayons, Décorations, Accessoires de Cuisine.', '80', 0.20, 1, 1, 1),
(6, 'Machine à bulle', 'Machine à bulle', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '30', 0.20, 1, 10, 1),
(7, 'Boule de fleur', 'Boule de fleur', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plusPolitique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '5', 0.20, 1, 16, 1),
(9, 'dominos', 'BELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel Desig', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '15', 0.20, 0, 10, 1),
(10, 'Bonbonnière ', 'Bonbonnière ', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plusPolitique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '5', 0.20, 1, 8, 1),
(11, 'Fleur avec pied', 'Fleur avec pied', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plusPolitique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez commandé auprès d\'Amazon.fr ou si celui-ci est défectueux ou endommagé, vous pouvez nous le retourner sous 30 jours suivant la date de livraison, et nous vous rembourserons ou remplacerons l\'intégralité de l\'article. Pour plus', '10', 0.20, 1, 2, 1),
(30, 'Miroir 2', 'Politique de retour Amazon.fr: Si vous n’êtes pas satisfait d\'un produit que vous avez com', 'Large choix de Miroirs. Profitez-en &amp; Commandez en ligne! Idées pour la maison. Tendances des meubles. Super prix. Meilleures offres. Acheter ici. Types: Meubles, Lampes, Accessoires de la Maison, Armoires et Rayons, Décorations, Accessoires de Cuisine.Large choix de Miroirs. Profitez-en &amp; Commandez en ligne! Idées pour la maison. Tendances des meubles. Super prix. Meilleures offres. Acheter ici. Types: Meubles, Lampes, Accessoires de la Maison, Armoires et Rayons, Décorations, Accessoires de Cuisine.', '15', 0.20, 1, 0, 2),
(31, 'chandelier 2', 'chandelier 2chandelier 2chandelier 2', 'chandelier 2chandelier 2chandelier 2', '15', 0.20, 1, 0, 2),
(32, 'chandelier 3', 'chandelier 3chandelier 3chandelier 3', 'chandelier 3chandelier 3chandelier 3', '15', 0.20, 1, 0, 3),
(33, 'chandelier 4', 'chandelier 3chandelier 3chandelier 3', 'chandelier 3chandelier 3chandelier 3', '15', 0.20, 1, 0, 4),
(34, 'fleur avec pied 2', 'fleur avec piedfleur avec piedfleur avec pied', 'fleur avec piedfleur avec piedfleur avec pied', '25', 0.20, 1, 0, 2),
(35, 'fleur avec pied 3', 'fleur avec piedfleur avec piedfleur avec pied', 'fleur avec piedfleur avec piedfleur avec pied', '25', 0.20, 1, 0, 3),
(36, 'fleur avec pied 4', 'fleur avec pied 4fleur avec pied 4fleur avec pied 4', 'fleur avec pied 4fleur avec pied 4fleur avec pied 4fleur avec pied 4', '25', 0.20, 1, 0, 4),
(37, 'fleur avec pied 5', 'fleur avec pied 4fleur avec pied 4fleur avec pied 4', 'fleur avec pied 4fleur avec pied 4fleur avec pied 4fleur avec pied 4', '25', 0.20, 1, 0, 5),
(38, 'Globe', 'Globe', 'Ces globes ont été financés par le cardinal d\'Estrées pour les offrir au roi de France Louis XIV, dont il était l\'ambassadeur auprès du Saint-Siège. Le Cardinal avait en effet été très impressionné par les globes d\'un mètre cinquante de diamètre fabriqués en 1678 pour le Duc de Parme par le cartographe italien Vincenzo Coronelli, « le plus grand fabricant de globes de tous les temps »3, dont il obtient de réaliser deux globes de grande dimension pour Louis XIV. Ils sont fabriqués à Paris de 1681 à 1683, probablement à l\'Hôtel de Lionne (aujourd\'hui détruit). Le mobilier de présentation est réalisé par Jules Hardouin-Mansart et l\'Anglais Michael Butterfield.\r\n\r\nBien que destinés à orner le château de Versailles, ils restent à Paris dans l\'attente d\'une solution architecturale pour les présenter. Un projet d\'exposition dans la petite Orangerie est évoqué en 1690, mais abandonné. Ils sont finalement installés à Marly en 1703 ; c\'est à ce séjour qu\'ils doiCes globes ont été financés par le c', '5', 0.20, 1, 14, 1),
(39, 'Bonbonnière vertical', 'La bonbonnière est souvent disponible en verre, en cristal, mais aussi en faïence ou en po', 'La bonbonnière est souvent disponible en verre, en cristal, mais aussi en faïence ou en porcelaine. Dans lequel on place en général des bonbons. De même, le drageoir, comme son nom l\'indique servait à présenter les dragées, confiseries diverses et les épices.La bonbonnière est souvent disponible en verre, en cristal, mais aussi en faïence ou en porcelaine. Dans lequel on place en général des bonbons. De même, le drageoir, comme son nom l\'indique servait à présenter les dragées, confiseries diverses et les épices.', '5', 0.20, 0, 7, 1),
(40, 'Dominos', 'Dominos', 'BELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel DesigBELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel DesigBELLE VOUS Boite De Rangement en Bois - Lot de 3 Caisse de Rangement en Bois Naturel Desig', '10', 0.20, 1, 15, 1),
(41, 'Cadre', 'Cadre', 'Cadre', '5', 0.20, 0, 0, 1),
(42, 'Cadre', 'Cadre', 'Cadre', '5', 0.20, 1, 17, 1),
(43, 'Cadre N°2', 'Cadre N°2', 'Cadre N°2', '5', 0.20, 0, 0, 1),
(44, 'Cadre N°2', 'Cadre N°2', 'Cadre N°2', '5', 0.20, 1, 5, 1),
(45, 'Urne', 'Urne', 'Urne', '5', 0.20, 1, 4, 1),
(46, 'Boite Alliance', 'Boite Alliance', 'Boite Alliance', '5', 0.20, 1, 11, 1),
(47, 'Love', 'Love', 'Love', '5', 0.20, 0, 0, 1),
(48, 'Love', 'Love', 'Love', '5', 0.20, 1, 6, 1),
(49, 'Cadre N°3', 'cadre N°3', 'cadre N°3', '5', 0.20, 1, 12, 1),
(50, 'cadre N°2', 'cadre N°2', 'cadre N°2', '5', 0.20, 1, 9, 1),
(51, 'Décoration', 'Décoration', 'Décoration', '5', 0.20, 1, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `civilite` varchar(50) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `passeword` varchar(250) NOT NULL,
  `date_creat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `niv` int(11) NOT NULL DEFAULT '5',
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `civilite`, `nom`, `prenom`, `mail`, `phone`, `passeword`, `date_creat`, `niv`, `actif`) VALUES
(1, 'Monsieur', 'Tuan', 'KENE', 'tuan.kene@gmail.com', '0606060606', '$2y$10$xfJJyxmj1pTXPTaKosUlwOaw9QpuaaARKAFHGNCGfyQXIjgkVffNa', '2020-03-02 08:14:33', 1, 1),
(25, 'Monsieur', 'david', 'david', 'david@gmail.com', '0606060606', '$2y$10$a//y7VtMENsUFAMMPWYjReF630Pded0OBMsp.re3uFtZnCtYG1X2W', '2020-01-16 13:44:57', 5, 1),
(27, 'Monsieur', 'fabien', 'fabien', 'fabien@gmail.com', '0606060606', '$2y$10$emla.vgkbHm1MKlWnVD01OLKU9jTL2hQpymxEjA/kzOidq4lNzb..', '2020-01-16 13:47:49', 5, 1),
(28, 'Madame', 'alice', 'alice', 'alice@gmail.com', '0606060606', '$2y$10$reDqOUqIG0C6yyWJBLAKKuHwzSu/a6pGtBgmwWrDqHaF5HXEniVaq', '2020-01-20 13:04:19', 5, 1),
(30, 'Monsieur', 'julien', 'julien', 'julien@gmail.com', '0606584523', '$2y$10$I3IF13DlchXknZeHtC3x9ei8hZ8DGt7AneDMMnFF1MOPVZZEivyvW', '2020-01-20 13:19:58', 5, 1),
(53, 'Monsieur', 'alex', 'alex', 'alex@gmail.com', '0606060606', '$2y$10$7c0wf51SXU2.iDdwVBqCYOa2Z9rFwmZ6XOBFP/YD/U6Efgrm6H9R.', '2020-02-13 15:23:28', 5, 1),
(54, 'Monsieur', 'kene', 'tuan', 'tuan.kene@yahoo.fr', '0606060606', '$2y$10$ijr4J3bgJiKCfmm3e9FvDOiW3JD69f9EJ7nvumCWl9yGYwEy5Gr9K', '2020-03-02 08:42:06', 5, 1),
(55, 'Monsieur', 'hello', 'hello', 'survivant44230@hotmail.com', '0606060606', '$2y$10$jgZZkU0qSrLdONcemBPBguiY1M2oSYMKIqJqYKdww6qbqkpICDYb2', '2020-03-03 08:59:36', 5, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `index_image`
--
ALTER TABLE `index_image`
  ADD PRIMARY KEY (`id_index_image`);

--
-- Index pour la table `liaisons_produits`
--
ALTER TABLE `liaisons_produits`
  ADD PRIMARY KEY (`id_liaisons_produits`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT pour la table `index_image`
--
ALTER TABLE `index_image`
  MODIFY `id_index_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `liaisons_produits`
--
ALTER TABLE `liaisons_produits`
  MODIFY `id_liaisons_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
