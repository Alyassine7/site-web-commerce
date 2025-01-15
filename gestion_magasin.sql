-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 déc. 2024 à 23:23
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_magasin`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_commandes`
--

CREATE TABLE `details_commandes` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `detail_commande_id` int(11) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `date_paiement` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `order_id`, `email`, `montant`, `statut`, `date_paiement`) VALUES
(1, 'cs_test_a1FCKpT9d4nRCFNzx3EZsYCfS7Zl36MtLMEeGZIECRXqdIveFf1v9qI4ZG', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-11-25 16:32:05'),
(2, 'cs_test_b1SKd1LBwu7HbWdDOrOAHjC4ozPIL5Lx3Bzhsvhdha4vuKRLuswiAewP42', 'alyassian20@gmail.com', 1300.00, 'succeeded', '2024-11-25 17:20:19'),
(3, 'cs_test_a15hrY9dcqtvTTOAmxK5EYbEgxMIbsPIZDzO4T2i8RjQTzI3r6G3akItcM', 'alyassian20@gmail.com', 300.00, 'succeeded', '2024-11-26 15:05:05'),
(4, 'cs_test_a1m0GD7rw9zaenQ09R5xIbDkobkgQQrH5dh54eo51dhzUxidzrOels8sfN', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-11-26 15:06:51'),
(5, 'cs_test_a1lZL6lPRkOAopguHhKfCoUOVID3QYxSvBtwI1tNKJPtHc9FeWiRwxpBsg', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-11-26 15:29:54'),
(6, 'cs_test_a1rDUKEQiQi0WYBGCUo4LYMSgiZryxYlV1OWPff0hg1Pop8fDvDBgxjiz9', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-11-27 09:40:41'),
(7, 'cs_test_a18mz5LBApFX7NnenASJxFcPrUSiMdiaTNRFeVqCBELL8UKhVHD0DYtra8', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-11-27 10:57:01'),
(8, 'cs_test_a18mz5LBApFX7NnenASJxFcPrUSiMdiaTNRFeVqCBELL8UKhVHD0DYtra8', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-11-27 11:01:13'),
(9, 'cs_test_a1qelXlFMGKWMM0YBj4VbVAyvBlUmc2mUnrdhR7llc9wyOTYfdIHDcQFVE', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-11-27 11:08:05'),
(10, 'cs_test_a1V2A2zhzWLkewdgGpDp9JBFWzJYdvTap9FWejtd6TPZEJ6Z3Dn9I42Fi7', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-11-27 11:32:51'),
(11, 'cs_test_a19C74oQ47nhNgaDSryA800W5EDDMgSOQx5y8SZVNkhOzTkhUSVED6EXrr', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 17:27:56'),
(12, 'cs_test_a1t2N4lttqui3kyYpUj7RzgOCjRAc5IKvf3tTyitenfDeXfb8BhosJ2RT7', 'alyassian20@gmail.com', 300.00, 'succeeded', '2024-12-02 17:29:43'),
(13, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 17:35:22'),
(14, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 21:40:18'),
(15, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 21:44:45'),
(16, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 22:01:38'),
(17, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 22:02:07'),
(18, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 22:11:58'),
(19, 'cs_test_a101kVgMaCnRnNcGO3t2Xv4otMILi4hQ9z7lJGNVf1VdHUqfqglcVsgWJO', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-02 22:58:05'),
(20, 'cs_test_a1ZYslJlenkD1OO5SZBeN1LeqarvvIvboyEep9PdRJ6IXfUmoh4BIwiiEZ', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-03 08:33:58'),
(21, 'cs_test_a1rGVK91oQlTNN0XYpDlvS4sw9L3a8fZbGPjaIotLB3cbDPnrk8M7db7wr', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 09:32:43'),
(22, 'cs_test_a1sKRMlZ7MTD2dQ3rP4JbV5aSKvMCKGF27akbZ1MWncbh5fbCbeij3XknE', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 10:10:03'),
(23, 'cs_test_a1mm7ljiCeRVhVT4FPLbjTc23H5REMun3GlYESNVslTJSOW3Lq8UsLeAiN', 'alyassian20@gmail.com', 300.00, 'succeeded', '2024-12-03 10:17:18'),
(24, 'cs_test_a19nBM3V1iBehjFaINVOPdnRBtnhvfU7M1iLmKIT65MGLM0ZaqNwQQzP0F', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-03 10:18:40'),
(25, 'cs_test_a1MKor1BXBACs06xjY1cQXfxrfdlKJZ50kSgIlsFsOT9Rf9AL4JOLdLygE', 'brundahelmine@gmail.com', 150.00, 'succeeded', '2024-12-03 10:22:47'),
(26, 'cs_test_a1TvHUKQqe7dDEYKRQPuASnBeXlFWpSumzFMLHOwYFr7Zhqy4ZNK46iRSE', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 11:39:58'),
(27, 'cs_test_a1TYlHrlD50yWflydR7ueCQEGAmPLuECNDYx0xX296VjOaKEGI25Q6zCZi', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 11:41:08'),
(28, 'cs_test_a18o0vJQjzF9hL3kYJj20AvjUtOsqYutxw4EAxmzo6kEZhbMWpsjjagIaU', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 11:57:57'),
(29, 'cs_test_a1cztBdA07VZDpmAHcbO3RXDw2U8KOTBwxn8I0ELI5yLpJppyvGgYLZ64V', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-03 12:13:59'),
(30, 'cs_test_a1cztBdA07VZDpmAHcbO3RXDw2U8KOTBwxn8I0ELI5yLpJppyvGgYLZ64V', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-03 12:14:31'),
(31, 'cs_test_a1OzcA9psWxf32I5lNn6sFwwG2g9BWIqhJP7aYwBv7xlw6wp9AGJCrepWK', 'alyassian20@gmail.com', 300.00, 'succeeded', '2024-12-03 12:19:08'),
(32, 'cs_test_a1OzcA9psWxf32I5lNn6sFwwG2g9BWIqhJP7aYwBv7xlw6wp9AGJCrepWK', 'alyassian20@gmail.com', 300.00, 'succeeded', '2024-12-03 12:20:58'),
(33, 'cs_test_a1bwbDUBWUHmwIkOpVyxbX2XgVbb53JJWlyogvpSQ3XOwYtncwyNQYHKep', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 12:21:29'),
(34, 'cs_test_a1bwbDUBWUHmwIkOpVyxbX2XgVbb53JJWlyogvpSQ3XOwYtncwyNQYHKep', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 12:21:44'),
(35, 'cs_test_a1u0IjvFVlWwkoT1ZkQ84fgxZpT4RpSfiMlpkqvdgrl10HvKe0oMICET2Q', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 17:17:02'),
(36, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-03 17:18:51'),
(37, 'cs_test_a1lgDUSfoDrVnO32TnlLsuvb25CfBT4LfZSJLw95xDXdiqBVgVlhy2uPP3', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-03 17:23:50'),
(38, 'cs_test_a1stXrkluVulbjX1MOqM84r5hgs6I1n1DahfFN1WUPPPvYMRJRZ0mYcrLb', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 17:25:47'),
(39, 'cs_test_a1MoYDsCP2p7qiNgI7eGIiJuvvQpRiNZuWdXvFWBvO7bMpX4rvWqUvdptT', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-03 17:32:31'),
(40, 'cs_test_a1wRepK3R7iamBOUbK07tIXwFvcpHVUWuKt6hrYHV3tEmtsiBrXO3SzTnt', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 17:48:32'),
(41, 'cs_test_a1wRepK3R7iamBOUbK07tIXwFvcpHVUWuKt6hrYHV3tEmtsiBrXO3SzTnt', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 17:48:43'),
(42, 'cs_test_a1NYzQ6fvwbBARS29D745YOTiLySvloBSd8EA9DDXFvFE49IKhddyUGT0T', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-03 17:49:26'),
(43, 'cs_test_a1TQOrzl6L4NtNPNbt2VtMVvVVEdYj7yWqUNx1XKZuKNVAUbt2ZZkfJzYO', 'thelegendanelka@gmail.com', 300.00, 'succeeded', '2024-12-03 17:54:03'),
(44, 'cs_test_a1rW1ZKASU9ugLBStQIgbaYfsKuUtmtxhF5jUbD1DbIwg2pnjb0stFo2FD', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 17:57:46'),
(45, 'cs_test_a129kCN8gMLFpXf1zpwnRzHaLqTrqtwZ1L7BYAEl258oifSwHjdKAFMHYs', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 18:03:20'),
(46, 'cs_test_a1WOsxoc0mWs1ETljXXOmL4KIHD9hjhLQI3GOBv61WHNWpNJXZunu3n2Cb', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 18:05:34'),
(47, 'cs_test_a1WOsxoc0mWs1ETljXXOmL4KIHD9hjhLQI3GOBv61WHNWpNJXZunu3n2Cb', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 18:06:36'),
(48, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-03 18:13:24'),
(49, 'cs_test_a11VKOa1sgagNiy02ti7uAIpb2qSAw8KDF1Xt5RFS3w5e5P2N6dzi4VLer', 'hervehadjee29@gmail.com', 100.00, 'succeeded', '2024-12-03 18:15:05'),
(50, 'cs_test_a1mPiF3SZ0N317pah4S47zzrk2izkN5fqZKXkFyslBwr8Nac7fNO2Ad9WD', 'alyassian20@gmail.com', 1000.00, 'succeeded', '2024-12-03 19:51:34'),
(51, 'cs_test_a1RtfE5JJir6S6HkPnky7bum5Uy1w7kiGNTVoyfzSgYJBgqyOGHC04CdpY', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 19:58:03'),
(52, 'cs_test_a1RtfE5JJir6S6HkPnky7bum5Uy1w7kiGNTVoyfzSgYJBgqyOGHC04CdpY', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:01:10'),
(53, 'cs_test_a1RtfE5JJir6S6HkPnky7bum5Uy1w7kiGNTVoyfzSgYJBgqyOGHC04CdpY', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:02:41'),
(54, 'cs_test_a1RtfE5JJir6S6HkPnky7bum5Uy1w7kiGNTVoyfzSgYJBgqyOGHC04CdpY', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:03:42'),
(55, 'cs_test_a1RtfE5JJir6S6HkPnky7bum5Uy1w7kiGNTVoyfzSgYJBgqyOGHC04CdpY', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:05:16'),
(56, 'cs_test_a1Qz4t8x2f5efEOVDevl9nov5hwg5Sfk8QrQIjY9ukNO6oq2NgtsZ6X1Cp', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:12:04'),
(57, 'cs_test_a1Qz4t8x2f5efEOVDevl9nov5hwg5Sfk8QrQIjY9ukNO6oq2NgtsZ6X1Cp', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:22:01'),
(58, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:23:21'),
(59, 'cs_test_a1rW1ZKASU9ugLBStQIgbaYfsKuUtmtxhF5jUbD1DbIwg2pnjb0stFo2FD', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-03 20:34:41'),
(60, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:40:31'),
(61, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:46:42'),
(62, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:51:10'),
(63, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:53:13'),
(64, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 20:58:50'),
(65, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 21:01:54'),
(66, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 21:04:07'),
(67, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 21:05:38'),
(68, 'cs_test_a1hg1V5DBS0Ntf5UtOb7GpEMyF0USmWxUdHwskWumYpYjf95I3CcGdApW1', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-03 21:06:46'),
(69, 'cs_test_a1r941V7UW30ukRtBiSrnHRvlPSuCbCWlNKV5nuiD0sjiKXfEq2ZNGW8u1', 'brundahelmine@gmail.com', 1000.00, 'succeeded', '2024-12-03 21:16:09'),
(70, 'cs_test_a1O4lc4qUbAKVTH3EcZBK6tSs57cwO8C6q8dSx8Mot81NjGdBWpVKj9ZME', 'alyassian20@gmail.com', 1000.00, 'succeeded', '2024-12-03 21:17:15'),
(71, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 07:58:14'),
(72, 'cs_test_a1rW1ZKASU9ugLBStQIgbaYfsKuUtmtxhF5jUbD1DbIwg2pnjb0stFo2FD', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-04 08:04:27'),
(73, 'cs_test_a1rW1ZKASU9ugLBStQIgbaYfsKuUtmtxhF5jUbD1DbIwg2pnjb0stFo2FD', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-04 08:06:04'),
(74, 'cs_test_a1rW1ZKASU9ugLBStQIgbaYfsKuUtmtxhF5jUbD1DbIwg2pnjb0stFo2FD', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-04 08:09:18'),
(75, 'cs_test_a1O4lc4qUbAKVTH3EcZBK6tSs57cwO8C6q8dSx8Mot81NjGdBWpVKj9ZME', 'alyassian20@gmail.com', 1000.00, 'succeeded', '2024-12-04 09:06:49'),
(76, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:10:49'),
(77, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:12:53'),
(78, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:14:14'),
(79, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:15:08'),
(80, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:18:46'),
(81, 'cs_test_a1Ak2CK90fwXW1VAO0GARkm7fL9VB2JawUz4yDo8dJPg2GBXSafOMWY4Tw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:19:58'),
(82, 'cs_test_a1mReeIBT7Z1FZ31wJEJLT56jOdizgO2DzqZJ4kvQTXN9Yz7x7fnF3Rz3i', 'brundahelmine@gmail.com', 500.00, 'succeeded', '2024-12-04 09:22:35'),
(83, 'cs_test_a17oq7UqNr0MGNJISoz0a57BR6HRbjzbwYrxP0ZgpKLqS5pMZqTMkokU6H', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-04 09:27:31'),
(84, 'cs_test_a1yS4zmrtfZwLySNwHJTbRfrNC1KIsKtSfbaNyH6kRYnp3yppMyZXY1b2a', 'brundahelmine@gmail.com', 150.00, 'succeeded', '2024-12-04 09:29:36'),
(85, 'cs_test_a1mtndzWl58lH7pDK63cqZWhaiky09sZBnGXbX5I7mQng3fnZrv6OJ8hyw', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-04 09:33:29'),
(86, 'cs_test_a17eHxAQoaXrWHPJBvlEKGmuxOadDHtKf9ieP5Enrrq5qWMQaIWnuVwPvT', 'aouladi99@gmail.com', 1000.00, 'succeeded', '2024-12-04 15:43:10'),
(87, 'cs_test_a1tzFbY6YNUQU0i2pCbGCHXCwZWdJLUXylSpYv0LpkA2XdnF3ABSTCEckz', 'aouladi99@gmail.com', 150.00, 'succeeded', '2024-12-04 16:33:54'),
(88, 'cs_test_a1MVvNsflzrBdhrWncEx6lmb2RDsBfZaONVdUEmNiWj2FiuLCcnzvvyjez', 'alyassian20@gmail.com', 1000.00, 'succeeded', '2024-12-04 22:04:10'),
(89, 'cs_test_a1MVvNsflzrBdhrWncEx6lmb2RDsBfZaONVdUEmNiWj2FiuLCcnzvvyjez', 'alyassian20@gmail.com', 1000.00, 'succeeded', '2024-12-05 08:13:08'),
(90, 'cs_test_a1DqPQ8svALiw34msF8cIBlqgVBJziKU1Ioe37CARMT13rkmhgw9UjomWu', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-05 17:03:30'),
(91, 'cs_test_a11BOSbPfT4721f7LY3FeUOERNsg0FieeVuBNZLKwRDv2PLS5HGQ1RtZAy', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-06 17:45:04'),
(92, 'cs_test_a1TNNOcC3LC7eCzTbMM65WPntceRDBCbdwHhT4tvGp4ZcnPY9T4bmfml2i', 'alyassian20@gmail.com', 150.00, 'succeeded', '2024-12-07 09:07:58'),
(93, 'cs_test_a1opb3DlhkTY0Yk2uZdPLqd7ohBzhFn48yJlLzOEaWacqTApGZOACa54eY', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-07 12:00:58'),
(94, 'cs_test_a12z2Bpb738IljH2WFHYmq4qdPhkOwN88YWZeF3vL6XsXl7tNApdR9fPDw', 'alyassian20@gmail.com', 200.00, 'succeeded', '2024-12-07 15:13:57'),
(95, 'cs_test_a1JT3rJVRoQXJgBdboqHiM94jTquhXmqNqfu9bcXuYaKWs8fLylccZUDrL', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-07 17:03:47'),
(96, 'cs_test_a1uFTbusMHuh96MuKa80ORgwKEFrLmpMcdmQR50WnWFbQrHblcbf0Dmxag', 'alyassian20@gmail.com', 100.00, 'succeeded', '2024-12-07 17:49:08'),
(97, 'cs_test_a1x4d5C1syRzPfJW8xAOxbmxE9Wt07TKehKKcWj1uNPpYaxFCV8kWeQtjI', 'alyassian20@gmail.com', 500.00, 'succeeded', '2024-12-18 09:06:40');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `categorie`, `stock`, `image`, `created_at`) VALUES
(1, 'tété', 'télé 32 pouces', 200.00, 'simple', 15, 'tele.jpg', '2024-11-25 15:21:43'),
(2, 'bureau', 'bureau salon', 500.00, 'complet', 30, 'meuble.jpg', '2024-11-25 15:35:37'),
(3, 'lit', 'deux places', 300.00, 'double', 6, 'lit.jpg', '2024-11-25 16:24:21'),
(4, 'armoir', 'simple', 100.00, 'simple', 10, 'petit armoir.jpg', '2024-11-25 16:25:06'),
(5, 'table', 'simple table', 150.00, 'simple', 4, 'table.jpg', '2024-11-25 16:25:40'),
(6, 'ii', 's', 0.39, 's', 2, 'font.png', '2024-11-25 16:57:11'),
(10, 'Canapé complet', 'SALON ANGLE GONFLABLE 1710X900X660/350 ', 1000.00, 'complet', 4, 'chaise.jpg', '2024-11-27 19:45:05'),
(11, 'chaise simple', 'unique chaise', 100.00, 'simple', 4, 'chaise1.jpg', '2024-11-27 19:47:04');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `password`, `created_at`) VALUES
(1, 'alyassine', 'alyassian20@gmail.com', '$2y$10$0aHSTnm.4/K7gTsLBsgfJe.xy1y8yfvkb.NxdRZ5GmOFIGQeaUs8i', '2024-11-25 15:13:41'),
(2, 'said', 'alyas@gmail.com', '$2y$10$D2pWVw2r6X3DSq1E/JCqKuCvZrcomt8RvZuRH06RWYlr/MCQ7yHnu', '2024-11-25 20:00:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_commande_id` (`detail_commande_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD CONSTRAINT `details_commandes_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_commandes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`detail_commande_id`) REFERENCES `details_commandes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
