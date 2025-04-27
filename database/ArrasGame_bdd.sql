-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2025 at 10:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arrasgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscriptions`
--

CREATE TABLE `Inscriptions` (
  `id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `tournoi_id` int NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscriptions`
--

INSERT INTO `Inscriptions` (`id`, `utilisateur_id`, `tournoi_id`, `date_inscription`) VALUES
(14, 9, 3, '2025-03-25 18:13:58'),
(15, 9, 5, '2025-03-25 18:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `tournois`
--

CREATE TABLE `Tournois` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_tournoi` date NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('ouvert','fermé') COLLATE utf8mb4_general_ci DEFAULT 'ouvert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournois`
--

INSERT INTO `Tournois` (`id`, `nom`, `date_tournoi`, `description`, `status`) VALUES
(3, 'Fifa', '2024-11-19', '', 'ouvert'),
(4, 'Smash Bros', '2024-09-12', '', 'fermé'),
(5, 'Fortnite', '2024-11-01', '', 'ouvert'),
(6, 'candy', '2024-10-16', '', 'ouvert');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('invité','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'invité'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `Utilisateurs` (`id`, `username`, `email`, `mot_de_passe`, `role`) VALUES
(9, 'guest', 'guest@gmail.com', '$2y$10$vaexnja9T1VjUjI2iiiX8uoCoQ3c07Z2H.NrX7Cdoz35J.ysyLzeS', 'invité'),
(16, 'Enzo', 'enzolux62000@gmail.com', '$2y$10$DlSc0Z7tH1whXakJ8vKalOmloyYLvGChJhRElleyv50m5KdsqFIT.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscriptions`
--
ALTER TABLE `Inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur` (`utilisateur_id`),
  ADD KEY `fk_tournoi` (`tournoi_id`);

--
-- Indexes for table `tournois`
--
ALTER TABLE `Tournois`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inscriptions`
--
ALTER TABLE `Inscriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tournois`
--
ALTER TABLE `Tournois`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inscriptions`
--
ALTER TABLE `Inscriptions`
  ADD CONSTRAINT `fk_tournoi` FOREIGN KEY (`tournoi_id`) REFERENCES `Tournois` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `Utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
