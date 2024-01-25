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
-- Database: `sgp1`
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
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `ville`, `password`, `role`, `avatar`) VALUES
(2, 'Admin', 'admin', 'admin@admin.com', '21653842756', 'ville admin', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'admin', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `moniteurs`
--

CREATE TABLE `moniteurs` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'moniteur',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moniteurs`
--

INSERT INTO `moniteurs` (`id`, `fname`, `lname`, `email`, `phone`,`ville`, `password`, `role`, `avatar`) VALUES
(6, 'Ahmed', 'Daldoul', 'ahmed@daldoul.com', '21653842756', 'ville Ahmed','$2y$10$q47GJObI5t2mQ1CNwbmFyOlqDC/yKkxFRv4XOxryuhZvKeMhhxc7.', 'moniteur', 'avatar.png'),
(7, 'Amina', 'Daldoul', 'amina@daldoul.com', '21653842756', 'ville Amina1','$2y$10$7l2gCp07viznC2PyWouDeuKB85JuxOtHUYmMt8Fs.8LDa7RZBEaRW', 'moniteur', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `adherents`
--

CREATE TABLE `adherents` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'adherent',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adherents`
--

INSERT INTO `adherents` (`id`, `fname`, `lname`, `email`, `phone`, `ville`,`password`, `role`, `avatar`) VALUES
(7, 'Adherent', 'Two', 'adherent@two.com', '21653842756','ville 1', '$2y$10$5pi1bPBuaQt4s83hGFcTH.eRZvFqsMDDN.onp6.HJENwo0jqJqKjq', 'adherent', 'avatar.png'),
(8, 'Adherent', 'Three', 'adherent@three.com', '0170000000','ville 1', '$2y$10$RqNzWY0cxl9UCf01J.N9LOTTPb7GKarWAwM7/i8T8koNoFqQQk1Li', 'adherent', 'avatar.png'),
(9, 'Adherent', 'Four', 'adherent@four.com', '21653842756','ville 1', '$2y$10$GVggPVg5obYkaX87nzDA/u7uyMA.ej4A96RNXtLXpFWeENLxed.T6', 'adherent', 'avatar.png'),
(10, 'Adherent', 'Five', 'adherent@five.com', '21653842756','ville 1', '$2y$10$It21v0CAlfE8vMM4BN2hIukLIiR/RFBWvRdN3PirzkW6.r28Ls0AW', 'adherent', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `seances`
--

CREATE TABLE `seances` (  
  `id` int(11) NOT NULL,
  `idM` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `dateS` DATE NOT NULL,
  `heureS` TIME NOT NULL,
  `nbHeures` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- Dumping data for table `seances`
--

INSERT INTO `seances` (`id`,`idM`, `idA`, `dateS`, `heureS`, `nbHeures`)
VALUES 
    (7, 6, 7, '2024-01-24', '09:00:00', 2),
    (8, 7, 8, '2024-01-25', '14:30:00', 1),
    (9, 7, 9, '2024-01-26', '11:45:00', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moniteurs`
--
ALTER TABLE `moniteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `seances`
--
ALTER TABLE `seances`
  ADD PRIMARY KEY (`id`),
  ADD FOREIGN KEY (`idM`) REFERENCES `moniteurs`(`id`),
  ADD FOREIGN KEY (`idA`) REFERENCES `adherents`(`id`)

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `moniteurs`
--
ALTER TABLE `moniteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `adherents`
--
ALTER TABLE `adherents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seances`
--
ALTER TABLE `seances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
