-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 12:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modul_webpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `username` varchar(20) NOT NULL,
  `sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`username`, `sandi`) VALUES
('munif', '123'),
('Munif', '$2y$10$TZ2H9u5HQSzDH'),
('shahli', '$2y$10$K5WJpsLusbNihvmgQU7IEOcV4s8byGQgMrGZZPE2MYDkV3KHJgeNC');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lokasi_sungai` varchar(100) NOT NULL,
  `waktu_pengukuran` varchar(100) NOT NULL,
  `tinggi_air` varchar(100) NOT NULL,
  `status_banjir` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto_bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id`, `user_id`, `lokasi_sungai`, `waktu_pengukuran`, `tinggi_air`, `status_banjir`, `deskripsi`, `foto_bukti`) VALUES
(1, 0, 'bekasi', 'senin siang', '50 cm', 'sedang', 'tidak ada', ''),
(6, 0, 'asd', 'sdf', 'sd', 'sdf', 'sdf', '69e8a0ec59d12.png'),
(7, 0, '123', '123', '123', '123', '123', '69e761b76f1f9.png'),
(8, 0, 'bekasi', '2026-04-25 18:33:16', '23', 'Aman', 'erfgaErgagagrdf', 'Screenshot_5.png'),
(9, 0, 'Bekasi', '2026-04-26 17:05:23', '2', 'Aman', 'lorem', 'Screenshot_4.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
