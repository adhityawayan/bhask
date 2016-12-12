-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2016 at 02:33 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bhaskara`
--

-- --------------------------------------------------------

--
-- Table structure for table `repair_spk`
--

CREATE TABLE `repair_spk` (
  `id_repair_spk` int(11) NOT NULL,
  `id_k` int(11) DEFAULT NULL,
  `judul_repair_spk` varchar(255) DEFAULT NULL,
  `no_pengajuan_repair_spk` varchar(255) DEFAULT NULL,
  `no_repair_spk` varchar(255) DEFAULT NULL,
  `no_invoice` varchar(255) DEFAULT NULL,
  `tanggal_pengajuan_repair_spk` date DEFAULT NULL,
  `tanggal_repair_spk` date DEFAULT NULL,
  `tanggal_invoice` date DEFAULT NULL,
  `tanggal_payment_invoice_repair_spk` date NOT NULL,
  `id_k_logistik` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `repair_spk`
--
ALTER TABLE `repair_spk`
  ADD PRIMARY KEY (`id_repair_spk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `repair_spk`
--
ALTER TABLE `repair_spk`
  MODIFY `id_repair_spk` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
