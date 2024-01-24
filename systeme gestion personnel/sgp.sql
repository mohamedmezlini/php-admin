-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 12:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(2, 'Admin', 'admin', 'admin@admin.com', '21653842756', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'admin', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'manager',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(6, 'Ahmed', 'Daldoul', 'ahmed@daldoul.com', '21653842756', '$2y$10$q47GJObI5t2mQ1CNwbmFyOlqDC/yKkxFRv4XOxryuhZvKeMhhxc7.', 'manager', 'avatar.png'),
(7, 'Amina', 'Daldoul', 'amina@daldoul.com', '21653842756', '$2y$10$7l2gCp07viznC2PyWouDeuKB85JuxOtHUYmMt8Fs.8LDa7RZBEaRW', 'manager', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `professeurs`
--

CREATE TABLE `professeurs` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'professeur',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professeurs`
--

INSERT INTO `professeurs` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(7, 'Professeur', 'Two', 'professeur@two.com', '21653842756', '$2y$10$5pi1bPBuaQt4s83hGFcTH.eRZvFqsMDDN.onp6.HJENwo0jqJqKjq', 'professeur', 'avatar.png'),
(8, 'Professeur', 'Three', 'professeur@three.com', '0170000000', '$2y$10$RqNzWY0cxl9UCf01J.N9LOTTPb7GKarWAwM7/i8T8koNoFqQQk1Li', 'professeur', 'avatar.png'),
(9, 'Professeur', 'Four', 'professeur@four.com', '21653842756', '$2y$10$GVggPVg5obYkaX87nzDA/u7uyMA.ej4A96RNXtLXpFWeENLxed.T6', 'professeur', 'avatar.png'),
(10, 'Professeur', 'Five', 'professeur@five.com', '21653842756', '$2y$10$It21v0CAlfE8vMM4BN2hIukLIiR/RFBWvRdN3PirzkW6.r28Ls0AW', 'professeur', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'etudiant',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(9, 'Etudiant', 'One', 'etudiant@one.com', '21653842756', '$2y$10$QcBETp.yv7xnE2gtnGKN2eQiwCW4jwobEPoOBGK/qQ3knrW4OsEdG', 'etudiant', 'avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
