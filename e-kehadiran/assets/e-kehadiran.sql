-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 11:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-kehadiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_Admin` int(5) NOT NULL,
  `Kad_Pengenalan` varchar(50) NOT NULL,
  `Kata_Laluan` varchar(12) NOT NULL,
  `Nama_Admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_Admin`, `Kad_Pengenalan`, `Kata_Laluan`, `Nama_Admin`) VALUES
(1, '089356-07-8764', 'lisa123', 'Lisa'),
(2, '089350-07-8752', 'rachel123', 'Rachel');

-- --------------------------------------------------------

--
-- Table structure for table `gkk`
--

CREATE TABLE `gkk` (
  `ID_GKK` varchar(10) NOT NULL,
  `Tarikh` varchar(50) NOT NULL,
  `Aktiviti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gkk`
--

INSERT INTO `gkk` (`ID_GKK`, `Tarikh`, `Aktiviti`) VALUES
('GKK01', '2024-03-01', 'Meeting'),
('GKK02', '2024-04-01', '3D Modeling'),
('GKK03', '2024-05-04', 'Water Bottle Rocket Building');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `ID_GKK` varchar(10) NOT NULL,
  `Status_Kehadiran` varchar(10) NOT NULL,
  `ID_Pelajar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`ID_GKK`, `Status_Kehadiran`, `ID_Pelajar`) VALUES
('GKK01', 'Hadir', 1),
('GKK02', 'Lewat', 1),
('GKK03', 'Hadir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_Kelas` varchar(5) NOT NULL,
  `Kelas` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID_Kelas`, `Kelas`) VALUES
('B4-4A', '4SA'),
('B4-4D', '4SF');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `ID_Pelajar` int(4) NOT NULL,
  `Nama_Murid` varchar(50) NOT NULL,
  `ID_Kelas` varchar(10) NOT NULL,
  `Jantina` varchar(20) NOT NULL,
  `Kad_Pengenalan` varchar(50) NOT NULL,
  `No_Telefon` varchar(15) NOT NULL,
  `Kata_Laluan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`ID_Pelajar`, `Nama_Murid`, `ID_Kelas`, `Jantina`, `Kad_Pengenalan`, `No_Telefon`, `Kata_Laluan`) VALUES
(1, 'Dylan', 'B4-4D', 'Lelaki', '123456-12-1235', '012345678', 'dylan123'),
(2, 'Lilly', 'B4-4D', 'Perempuan', '123478-06-1238', '011233458', 'lily123'),
(3, 'Muthu', 'B4-4A', 'Lelaki', '123478-03-1237', '014578941', 'muthu123'),
(4, 'June', 'B4-4D', 'Perempuan', '123456-12-1236', '0145109876', 'june123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indexes for table `gkk`
--
ALTER TABLE `gkk`
  ADD PRIMARY KEY (`ID_GKK`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`ID_GKK`,`ID_Pelajar`),
  ADD KEY `ID_GKK` (`ID_GKK`),
  ADD KEY `ID_Pelajar` (`ID_Pelajar`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_Kelas`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`ID_Pelajar`),
  ADD KEY `ID_Kelas` (`ID_Kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20392;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `ID_Pelajar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`ID_GKK`) REFERENCES `gkk` (`ID_GKK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`ID_Pelajar`) REFERENCES `murid` (`ID_Pelajar`);

--
-- Constraints for table `murid`
--
ALTER TABLE `murid`
  ADD CONSTRAINT `murid_ibfk_1` FOREIGN KEY (`ID_Kelas`) REFERENCES `kelas` (`ID_Kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
