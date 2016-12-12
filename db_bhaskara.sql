-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2016 at 02:43 PM
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
-- Table structure for table `atm`
--

CREATE TABLE `atm` (
  `id_a` int(11) NOT NULL,
  `id_k` int(11) NOT NULL,
  `kode_a` varchar(255) NOT NULL,
  `type_a` tinyint(1) NOT NULL COMMENT '1 = Onsite; 2 = Ofsite',
  `alamat_a` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atm`
--

INSERT INTO `atm` (`id_a`, `id_k`, `kode_a`, `type_a`, `alamat_a`, `updated_at`, `created_at`) VALUES
(1, 2, '', 1, 'Jl. Kabagusan 2', '2016-10-12 16:40:44', '2016-10-12 16:27:31'),
(5, 8, 'ATM000002', 0, 'Jl. Keselamatan', '2016-10-12 16:57:26', '2016-10-12 16:53:40'),
(6, 8, 'ATM000001', 1, 'None', '2016-10-12 16:56:30', '2016-10-12 16:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_b` int(11) NOT NULL,
  `kode_b` varchar(11) NOT NULL,
  `nama_b` varchar(255) NOT NULL,
  `harga_tukang_b` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_b`, `kode_b`, `nama_b`, `harga_tukang_b`, `updated_at`, `created_at`) VALUES
(6, 'H-4', 'Pylon ALCOM Besar 4 slot', 4500000, '2016-10-25 23:10:56', '2016-10-25 23:10:00'),
(7, 'M-3', 'Pylon ALCOM Sedang 3 slot', 3300000, '2016-10-25 23:11:19', '2016-10-25 23:11:19'),
(8, 'K-2', 'Pylon ALCOM Kecil 2 slot ', 2400000, '2016-10-25 23:14:09', '2016-10-25 23:14:09'),
(9, 'HG-2', 'Pylon Hanging 2 slot ', 1250000, '2016-10-25 23:14:20', '2016-10-25 23:14:20'),
(10, 'T-2', 'Pylon Tiang SS 5 " 2 slot', 1550000, '2016-10-25 23:14:31', '2016-10-25 23:14:31'),
(11, 'WS', 'Signage', 750000, '2016-10-25 23:14:51', '2016-10-25 23:14:51'),
(12, 'CSA-1', 'Cover ATM tipe CSA 1', 250000, '2016-10-25 23:15:59', '2016-10-25 23:15:59'),
(13, 'CSA-2', 'Cover ATM tipe CSA 2', 250000, '2016-10-25 23:16:12', '2016-10-25 23:16:12'),
(14, 'A', 'Pylon ATM tipe A / Alcom besar', 4500000, '2016-10-25 23:16:31', '2016-10-25 23:16:31'),
(15, 'B', 'Pylon ATM tipe B / Alcom sedang', 3300000, '2016-10-25 23:16:51', '2016-10-25 23:16:51'),
(16, 'C-1', 'Pylon ATM tipe C 1 / Alcom kecil', 2400000, '2016-10-25 23:17:06', '2016-10-25 23:17:06'),
(17, 'C-2', 'Pylon ATM tipe C 2 - Tiang SS 5"', 1550000, '2016-10-25 23:17:19', '2016-10-25 23:17:19'),
(18, 'D', 'Pylon ATM tipe D ', 1250000, '2016-10-25 23:17:33', '2016-10-25 23:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `harga_bahan`
--

CREATE TABLE `harga_bahan` (
  `id_hb` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_z` int(11) NOT NULL,
  `harga_b` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_bahan`
--

INSERT INTO `harga_bahan` (`id_hb`, `id_b`, `id_z`, `harga_b`, `updated_at`, `created_at`) VALUES
(8, 6, 2, 79500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(9, 7, 2, 61000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(10, 8, 2, 48600000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(11, 9, 2, 23000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(12, 10, 2, 32000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(13, 11, 2, 3100000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(14, 12, 2, 12500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(15, 13, 2, 10800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(16, 14, 2, 75000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(17, 15, 2, 55500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(18, 16, 2, 45000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(19, 17, 2, 32000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(20, 18, 2, 10500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(21, 6, 3, 71800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(22, 7, 3, 53000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(23, 8, 3, 40500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(24, 9, 3, 19000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(25, 10, 3, 28000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(26, 11, 3, 2900000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(27, 12, 3, 11500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(28, 13, 3, 9250000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(29, 14, 3, 64500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(30, 15, 3, 47500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(31, 16, 3, 33500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(32, 17, 3, 28000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(33, 18, 3, 10000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(34, 6, 4, 66500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(35, 7, 4, 50000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(36, 8, 4, 37000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(37, 9, 4, 18000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(38, 10, 4, 26000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(39, 11, 4, 2600000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(40, 12, 4, 11000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(41, 13, 4, 9000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(42, 14, 4, 61500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(43, 15, 4, 44000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(44, 16, 4, 32500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(45, 17, 4, 26000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(46, 18, 4, 9200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(47, 6, 5, 62000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(48, 7, 5, 47500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(49, 8, 5, 35000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(50, 9, 5, 17500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(51, 10, 5, 24500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(52, 11, 5, 2400000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(53, 12, 5, 10000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(54, 13, 5, 8500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(55, 14, 5, 57000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(56, 15, 5, 42500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(57, 16, 5, 31500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(58, 17, 5, 24500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(59, 18, 5, 8700000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(60, 6, 6, 55000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(61, 7, 6, 42000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(62, 8, 6, 31800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(63, 9, 6, 16500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(64, 10, 6, 22200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(65, 11, 6, 2100000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(66, 12, 6, 9250000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(67, 13, 6, 8000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(68, 14, 6, 52800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(69, 15, 6, 38500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(70, 16, 6, 28500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(71, 17, 6, 22200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(72, 18, 6, 8200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kantor`
--

CREATE TABLE `jenis_kantor` (
  `id_jk` int(11) NOT NULL,
  `nama_jk` varchar(255) NOT NULL,
  `created_at_jk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kantor`
--

INSERT INTO `jenis_kantor` (`id_jk`, `nama_jk`, `created_at_jk`) VALUES
(1, 'Kantor Wilayah', '2016-10-11 06:11:50'),
(2, 'Kantor Cabang', '2016-10-11 06:12:01'),
(3, 'Kantor Cabang Pembantu', '2016-10-11 06:12:39'),
(4, 'Kantor Kas', '2016-10-11 06:12:59'),
(5, 'Kantor Unit', '2016-10-11 06:14:22'),
(6, 'Teras BRI', '2016-10-11 06:14:33'),
(7, 'ATM On Site', '2016-10-25 15:52:51'),
(8, 'ATM Off Site', '2016-10-25 15:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id_k` int(11) NOT NULL,
  `kode_k` varchar(255) NOT NULL,
  `id_jk` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama_k` varchar(255) NOT NULL,
  `alamat_k` varchar(255) NOT NULL,
  `id_z` int(11) NOT NULL,
  `status_k` tinyint(1) NOT NULL COMMENT '1 = Aktif; 2 = Tidak Aktif',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id_k`, `kode_k`, `id_jk`, `id_parent`, `nama_k`, `alamat_k`, `id_z`, `status_k`, `updated_at`, `created_at`) VALUES
(12, '', 1, 0, 'Kalimantan Timur', '', 3, 1, '2016-10-25 23:02:05', '2016-10-25 23:00:52'),
(13, '', 2, 12, 'Samarinda', 'Alamat Samarinda', 3, 1, '2016-10-25 23:02:26', '2016-10-25 23:02:26'),
(14, '13213', 3, 13, 'Samarinda Utara', 'Alamat jalan', 3, 1, '2016-11-14 08:52:22', '2016-10-25 23:03:06'),
(15, '', 7, 12, 'ATM 1', '', 3, 1, '2016-10-25 23:08:01', '2016-10-25 23:08:01'),
(16, '', 7, 12, 'ATM 2', '', 3, 1, '2016-10-25 23:08:27', '2016-10-25 23:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_p` int(11) NOT NULL,
  `id_k` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_p`, `id_k`, `updated_at`, `created_at`) VALUES
(2, 15, '2016-10-25 23:34:23', '2016-10-25 23:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_u` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `level` enum('admin','member') NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_u`, `username`, `password`, `nama_lengkap`, `level`, `updated_at`, `created_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2016-10-23 14:33:07', '2016-10-23 14:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `pylon`
--

CREATE TABLE `pylon` (
  `id_py` int(11) NOT NULL,
  `id_p` int(11) DEFAULT NULL,
  `survey_py` date DEFAULT NULL,
  `montage_py` tinyint(1) DEFAULT NULL,
  `file_py` varchar(255) DEFAULT NULL,
  `id_b` int(11) DEFAULT NULL,
  `sticker_py` date DEFAULT NULL,
  `pemasangan_py` date DEFAULT NULL,
  `foto_pemasangan_py` date DEFAULT NULL,
  `file_foto_py` varchar(255) NOT NULL,
  `bast_py` date DEFAULT NULL,
  `bapp_py` date DEFAULT NULL,
  `nama_tukang_py` varchar(255) DEFAULT NULL,
  `payment_py` double DEFAULT NULL,
  `tanggal_payment_py` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pylon`
--

INSERT INTO `pylon` (`id_py`, `id_p`, `survey_py`, `montage_py`, `file_py`, `id_b`, `sticker_py`, `pemasangan_py`, `foto_pemasangan_py`, `file_foto_py`, `bast_py`, `bapp_py`, `nama_tukang_py`, `payment_py`, `tanggal_payment_py`, `updated_at`, `created_at`) VALUES
(1, 2, '2016-11-02', 0, '44dd79d92492eedf405ee619baba4eb1.doc', 6, NULL, NULL, NULL, '6bf07c40ce998aec9b8875846215dfa8.jpg', NULL, NULL, 'Sopo', NULL, NULL, '2016-11-18 13:52:41', '2016-11-18 09:37:54'),
(2, 2, '2016-11-02', 0, 'b7fc1a4a1fa03a520e9ef5a1718156b5.doc', 7, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2016-11-18 13:26:55', '2016-11-18 13:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `id_repair_detail` int(11) NOT NULL,
  `id_repair_pekerjaan` int(11) DEFAULT NULL,
  `survey_repair_detail` date DEFAULT NULL,
  `montage_repair_detail` tinyint(1) DEFAULT NULL,
  `file_repair_detail` varchar(255) DEFAULT NULL,
  `id_repair_subkon` int(11) DEFAULT NULL,
  `sticker_repair_detail` date DEFAULT NULL,
  `pemasangan_repair_detail` date DEFAULT NULL,
  `foto_pemasangan_repair_detail` date DEFAULT NULL,
  `file_foto_repair_detail` varchar(255) NOT NULL,
  `bast_repair_detail` date DEFAULT NULL,
  `bapp_repair_detail` date DEFAULT NULL,
  `nama_tukang_repair_detail` varchar(255) DEFAULT NULL,
  `payment_repair_detail` double DEFAULT NULL,
  `tanggal_payment_repair_detail` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_detail`
--

INSERT INTO `repair_detail` (`id_repair_detail`, `id_repair_pekerjaan`, `survey_repair_detail`, `montage_repair_detail`, `file_repair_detail`, `id_repair_subkon`, `sticker_repair_detail`, `pemasangan_repair_detail`, `foto_pemasangan_repair_detail`, `file_foto_repair_detail`, `bast_repair_detail`, `bapp_repair_detail`, `nama_tukang_repair_detail`, `payment_repair_detail`, `tanggal_payment_repair_detail`, `updated_at`, `created_at`) VALUES
(1, 3, '2016-11-01', 0, '2b0dec33d840fd573a818edd723587c9.pdf', 6, '2016-11-22', '2016-11-29', '2016-12-06', 'a14115f370ac55a7510a8b46732ae611.jpg', '2016-11-25', '2016-12-08', 'sdsad', 5800000, '2016-12-01', '2016-11-18 14:30:17', '2016-11-12 20:44:37'),
(2, 3, '2016-11-10', 0, NULL, 6, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2016-11-12 20:51:16', '2016-11-12 20:51:16'),
(3, 3, NULL, 0, '57f219efd1ba9760b83b5dc455e924af.pdf', 6, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2016-11-18 14:32:13', '2016-11-18 14:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `repair_harga`
--

CREATE TABLE `repair_harga` (
  `id_repair_harga` int(11) NOT NULL,
  `id_repair_subkon` int(11) NOT NULL,
  `id_z` int(11) NOT NULL,
  `harga_repair_harga` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_harga`
--

INSERT INTO `repair_harga` (`id_repair_harga`, `id_repair_subkon`, `id_z`, `harga_repair_harga`, `updated_at`, `created_at`) VALUES
(8, 6, 2, 79500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(9, 7, 2, 61000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(10, 8, 2, 48600000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(11, 9, 2, 23000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(12, 10, 2, 32000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(13, 11, 2, 3100000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(14, 12, 2, 12500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(15, 13, 2, 10800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(16, 14, 2, 75000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(17, 15, 2, 55500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(18, 16, 2, 45000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(19, 17, 2, 32000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(20, 18, 2, 10500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(21, 6, 3, 71800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(22, 7, 3, 53000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(23, 8, 3, 40500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(24, 9, 3, 19000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(25, 10, 3, 28000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(26, 11, 3, 2900000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(27, 12, 3, 11500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(28, 13, 3, 9250000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(29, 14, 3, 64500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(30, 15, 3, 47500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(31, 16, 3, 33500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(32, 17, 3, 28000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(33, 18, 3, 10000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(34, 6, 4, 66500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(35, 7, 4, 50000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(36, 8, 4, 37000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(37, 9, 4, 18000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(38, 10, 4, 26000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(39, 11, 4, 2600000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(40, 12, 4, 11000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(41, 13, 4, 9000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(42, 14, 4, 61500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(43, 15, 4, 44000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(44, 16, 4, 32500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(45, 17, 4, 26000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(46, 18, 4, 9200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(47, 6, 5, 62000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(48, 7, 5, 47500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(49, 8, 5, 35000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(50, 9, 5, 17500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(51, 10, 5, 24500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(52, 11, 5, 2400000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(53, 12, 5, 10000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(54, 13, 5, 8500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(55, 14, 5, 57000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(56, 15, 5, 42500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(57, 16, 5, 31500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(58, 17, 5, 24500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(59, 18, 5, 8700000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(60, 6, 6, 55000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(61, 7, 6, 42000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(62, 8, 6, 31800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(63, 9, 6, 16500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(64, 10, 6, 22200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(65, 11, 6, 2100000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(66, 12, 6, 9250000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(67, 13, 6, 8000000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(68, 14, 6, 52800000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(69, 15, 6, 38500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(70, 16, 6, 28500000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(71, 17, 6, 22200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00'),
(72, 18, 6, 8200000, '2016-10-01 00:00:00', '2016-10-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `repair_pekerjaan`
--

CREATE TABLE `repair_pekerjaan` (
  `id_repair_pekerjaan` int(11) NOT NULL,
  `id_k` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_pekerjaan`
--

INSERT INTO `repair_pekerjaan` (`id_repair_pekerjaan`, `id_k`, `updated_at`, `created_at`) VALUES
(2, 15, '2016-10-25 23:34:23', '2016-10-25 23:34:23'),
(3, 14, '2016-11-14 08:51:45', '2016-11-11 09:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `repair_relasi_spk`
--

CREATE TABLE `repair_relasi_spk` (
  `id_repair_relasi_spk` int(11) NOT NULL,
  `id_repair_spk` int(11) NOT NULL,
  `id_repair_pekerjaan` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_relasi_spk`
--

INSERT INTO `repair_relasi_spk` (`id_repair_relasi_spk`, `id_repair_spk`, `id_repair_pekerjaan`, `updated_at`, `created_at`) VALUES
(8, 6, 3, '2016-11-13 20:20:20', '2016-11-13 20:20:20');

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
  `id_k_logistik` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_spk`
--

INSERT INTO `repair_spk` (`id_repair_spk`, `id_k`, `judul_repair_spk`, `no_pengajuan_repair_spk`, `no_repair_spk`, `no_invoice`, `tanggal_pengajuan_repair_spk`, `tanggal_repair_spk`, `tanggal_invoice`, `id_k_logistik`, `updated_at`, `created_at`) VALUES
(5, 14, 'Pengadaan dan Pemasangan', '01/Pengajuan/X/2016', 'B.0925.P-MAT/PGD/08/2014', '5 - 1611085', '2016-10-25', '2016-10-27', '2016-11-08', 12, '2016-11-08 14:44:00', '2016-10-26 00:29:24'),
(6, 14, 'Pengerjaan', '11223344', '12333324', '6 - 1611146', '2016-11-29', '2016-11-22', '2016-11-14', 12, '2016-11-14 08:51:02', '2016-11-13 19:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `repair_subkon`
--

CREATE TABLE `repair_subkon` (
  `id_repair_subkon` int(11) NOT NULL,
  `kode_repair_subkon` varchar(11) NOT NULL,
  `nama_repair_subkon` varchar(255) NOT NULL,
  `harga_repair_subkon` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_subkon`
--

INSERT INTO `repair_subkon` (`id_repair_subkon`, `kode_repair_subkon`, `nama_repair_subkon`, `harga_repair_subkon`, `updated_at`, `created_at`) VALUES
(6, 'H-4', 'Pylon ALCOM Besar 4 slot', 4500000, '2016-10-25 23:10:56', '2016-10-25 23:10:00'),
(7, 'M-3', 'Pylon ALCOM Sedang 3 slot', 3300000, '2016-10-25 23:11:19', '2016-10-25 23:11:19'),
(8, 'K-2', 'Pylon ALCOM Kecil 2 slot ', 2400000, '2016-10-25 23:14:09', '2016-10-25 23:14:09'),
(9, 'HG-2', 'Pylon Hanging 2 slot ', 1250000, '2016-10-25 23:14:20', '2016-10-25 23:14:20'),
(10, 'T-2', 'Pylon Tiang SS 5 " 2 slot', 1550000, '2016-10-25 23:14:31', '2016-10-25 23:14:31'),
(11, 'WS', 'Signage', 750000, '2016-10-25 23:14:51', '2016-10-25 23:14:51'),
(12, 'CSA-1', 'Cover ATM tipe CSA 1', 250000, '2016-10-25 23:15:59', '2016-10-25 23:15:59'),
(13, 'CSA-2', 'Cover ATM tipe CSA 2', 250000, '2016-10-25 23:16:12', '2016-10-25 23:16:12'),
(14, 'A', 'Pylon ATM tipe A / Alcom besar', 4500000, '2016-10-25 23:16:31', '2016-10-25 23:16:31'),
(15, 'B', 'Pylon ATM tipe B / Alcom sedang', 3300000, '2016-10-25 23:16:51', '2016-10-25 23:16:51'),
(16, 'C-1', 'Pylon ATM tipe C 1 / Alcom kecil', 2400000, '2016-10-25 23:17:06', '2016-10-25 23:17:06'),
(17, 'C-2', 'Pylon ATM tipe C 2 - Tiang SS 5"', 1550000, '2016-10-25 23:17:19', '2016-10-25 23:17:19'),
(18, 'D', 'Pylon ATM tipe D ', 1250000, '2016-10-25 23:17:33', '2016-10-25 23:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `r_sp`
--

CREATE TABLE `r_sp` (
  `id_rsp` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_sp`
--

INSERT INTO `r_sp` (`id_rsp`, `id_sp`, `id_p`, `updated_at`, `created_at`) VALUES
(5, 5, 2, '2016-10-26 00:38:16', '2016-10-26 00:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `signage`
--

CREATE TABLE `signage` (
  `id_s` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `survey_s` date DEFAULT NULL,
  `montage_s` tinyint(1) DEFAULT NULL,
  `file_s` varchar(255) DEFAULT NULL,
  `panjang_s` double DEFAULT NULL,
  `lebar_s` double DEFAULT NULL,
  `id_b` int(11) DEFAULT NULL,
  `sticker_s` date DEFAULT NULL,
  `pemasangan_s` date DEFAULT NULL,
  `foto_pemasangan_s` date DEFAULT NULL,
  `file_foto_s` varchar(255) NOT NULL,
  `bast_s` date DEFAULT NULL,
  `bapp_s` date DEFAULT NULL,
  `nama_tukang_s` varchar(255) DEFAULT NULL,
  `payment_s` double DEFAULT NULL,
  `tanggal_payment_s` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signage`
--

INSERT INTO `signage` (`id_s`, `id_p`, `survey_s`, `montage_s`, `file_s`, `panjang_s`, `lebar_s`, `id_b`, `sticker_s`, `pemasangan_s`, `foto_pemasangan_s`, `file_foto_s`, `bast_s`, `bapp_s`, `nama_tukang_s`, `payment_s`, `tanggal_payment_s`, `updated_at`, `created_at`) VALUES
(6, 2, '2016-10-28', 0, '819409d9c0e2388804aba586941d189e.doc', 2, 1, 11, '2016-10-18', '2016-10-25', '2016-10-15', '16916f1f7e51f95fceb90202b1238405.jpg', '2016-10-27', '2016-10-26', 'Joju', 750000, '2016-10-26', '2016-11-18 13:53:08', '2016-10-25 23:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `signage_atm`
--

CREATE TABLE `signage_atm` (
  `id_sa` int(11) NOT NULL,
  `id_p` int(11) DEFAULT NULL,
  `survey_sa` date DEFAULT NULL,
  `montage_sa` tinyint(1) DEFAULT NULL,
  `file_sa` varchar(255) DEFAULT NULL,
  `depan_sa` double DEFAULT NULL,
  `kanan_sa` double DEFAULT NULL,
  `kiri_sa` double DEFAULT NULL,
  `belakang_sa` double DEFAULT NULL,
  `tinggi_sa` double DEFAULT NULL,
  `id_b` int(11) DEFAULT NULL,
  `sticker_sa` date DEFAULT NULL,
  `pemasangan_sa` date DEFAULT NULL,
  `foto_pemasangan_sa` date DEFAULT NULL,
  `file_foto_sa` varchar(255) NOT NULL,
  `bast_sa` date DEFAULT NULL,
  `bapp_sa` date DEFAULT NULL,
  `nama_tukang_sa` varchar(255) DEFAULT NULL,
  `payment_sa` double DEFAULT NULL,
  `tanggal_payment_sa` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signage_atm`
--

INSERT INTO `signage_atm` (`id_sa`, `id_p`, `survey_sa`, `montage_sa`, `file_sa`, `depan_sa`, `kanan_sa`, `kiri_sa`, `belakang_sa`, `tinggi_sa`, `id_b`, `sticker_sa`, `pemasangan_sa`, `foto_pemasangan_sa`, `file_foto_sa`, `bast_sa`, `bapp_sa`, `nama_tukang_sa`, `payment_sa`, `tanggal_payment_sa`, `updated_at`, `created_at`) VALUES
(1, 2, '2016-11-11', 0, 'b1bc7587604c913a39dddae93373c4f5.doc', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, 'af4bb70d773c8468aa07baca999f092a.jpg', NULL, NULL, NULL, NULL, NULL, '2016-11-18 14:19:18', '2016-11-18 09:47:44'),
(2, 2, '2016-11-16', 0, '027ef4af3643f12812dfe72fd1c4820f.pdf', NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2016-11-18 14:23:55', '2016-11-18 14:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE `spk` (
  `id_sp` int(11) NOT NULL,
  `id_k` int(11) DEFAULT NULL,
  `judul_sp` varchar(255) DEFAULT NULL,
  `no_pengajuan_sp` varchar(255) DEFAULT NULL,
  `no_sp` varchar(255) DEFAULT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `tanggal_pengajuan_sp` date DEFAULT NULL,
  `tanggal_sp` date DEFAULT NULL,
  `tanggal_invoice` date NOT NULL,
  `id_k_logistik` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spk`
--

INSERT INTO `spk` (`id_sp`, `id_k`, `judul_sp`, `no_pengajuan_sp`, `no_sp`, `no_invoice`, `tanggal_pengajuan_sp`, `tanggal_sp`, `tanggal_invoice`, `id_k_logistik`, `updated_at`, `created_at`) VALUES
(5, 14, 'Pengadaan dan Pemasangan', '01/Pengajuan/X/2016', 'B.0925.P-MAT/PGD/08/2014', '5 - 1611085', '2016-10-25', '2016-10-27', '2016-11-08', 12, '2016-11-08 14:44:00', '2016-10-26 00:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `zona`
--

CREATE TABLE `zona` (
  `id_z` int(11) NOT NULL,
  `nama_z` varchar(255) NOT NULL,
  `deskripsi_z` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zona`
--

INSERT INTO `zona` (`id_z`, `nama_z`, `deskripsi_z`, `updated_at`, `created_at`) VALUES
(2, 'I', 'Irian, Maluku, Kepri, Aceh, NTT', '2016-10-13 22:23:34', '2016-10-13 22:23:34'),
(3, '2', 'Sulut, Gorontalo, Kaltim, Kalteng, Sulteng, Sul tenggara, Sulbar', '2016-10-25 22:55:52', '2016-10-25 22:55:52'),
(4, '3', 'Medan, Padang, Pekanbaru, DPS, NTB, Kalbar, Kalsel, Sulsel', '2016-10-25 22:56:01', '2016-10-25 22:56:01'),
(5, '4', 'Jambi, Palembang, Bengkulu, Lampung', '2016-10-25 22:56:11', '2016-10-25 22:56:11'),
(6, '5', 'Banten, DKI Jkt, Jabar, Jateng, DIY, Jatim, Madura', '2016-10-25 22:56:19', '2016-10-25 22:56:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm`
--
ALTER TABLE `atm`
  ADD PRIMARY KEY (`id_a`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_b`);

--
-- Indexes for table `harga_bahan`
--
ALTER TABLE `harga_bahan`
  ADD PRIMARY KEY (`id_hb`);

--
-- Indexes for table `jenis_kantor`
--
ALTER TABLE `jenis_kantor`
  ADD PRIMARY KEY (`id_jk`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_k`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_p`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_u`);

--
-- Indexes for table `pylon`
--
ALTER TABLE `pylon`
  ADD PRIMARY KEY (`id_py`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`id_repair_detail`);

--
-- Indexes for table `repair_harga`
--
ALTER TABLE `repair_harga`
  ADD PRIMARY KEY (`id_repair_harga`);

--
-- Indexes for table `repair_pekerjaan`
--
ALTER TABLE `repair_pekerjaan`
  ADD PRIMARY KEY (`id_repair_pekerjaan`);

--
-- Indexes for table `repair_relasi_spk`
--
ALTER TABLE `repair_relasi_spk`
  ADD PRIMARY KEY (`id_repair_relasi_spk`);

--
-- Indexes for table `repair_spk`
--
ALTER TABLE `repair_spk`
  ADD PRIMARY KEY (`id_repair_spk`);

--
-- Indexes for table `repair_subkon`
--
ALTER TABLE `repair_subkon`
  ADD PRIMARY KEY (`id_repair_subkon`);

--
-- Indexes for table `r_sp`
--
ALTER TABLE `r_sp`
  ADD PRIMARY KEY (`id_rsp`);

--
-- Indexes for table `signage`
--
ALTER TABLE `signage`
  ADD PRIMARY KEY (`id_s`);

--
-- Indexes for table `signage_atm`
--
ALTER TABLE `signage_atm`
  ADD PRIMARY KEY (`id_sa`);

--
-- Indexes for table `spk`
--
ALTER TABLE `spk`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indexes for table `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id_z`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atm`
--
ALTER TABLE `atm`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `harga_bahan`
--
ALTER TABLE `harga_bahan`
  MODIFY `id_hb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `jenis_kantor`
--
ALTER TABLE `jenis_kantor`
  MODIFY `id_jk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pylon`
--
ALTER TABLE `pylon`
  MODIFY `id_py` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `repair_detail`
--
ALTER TABLE `repair_detail`
  MODIFY `id_repair_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `repair_harga`
--
ALTER TABLE `repair_harga`
  MODIFY `id_repair_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `repair_pekerjaan`
--
ALTER TABLE `repair_pekerjaan`
  MODIFY `id_repair_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `repair_relasi_spk`
--
ALTER TABLE `repair_relasi_spk`
  MODIFY `id_repair_relasi_spk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `repair_spk`
--
ALTER TABLE `repair_spk`
  MODIFY `id_repair_spk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `repair_subkon`
--
ALTER TABLE `repair_subkon`
  MODIFY `id_repair_subkon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `r_sp`
--
ALTER TABLE `r_sp`
  MODIFY `id_rsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `signage`
--
ALTER TABLE `signage`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `signage_atm`
--
ALTER TABLE `signage_atm`
  MODIFY `id_sa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `spk`
--
ALTER TABLE `spk`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `zona`
--
ALTER TABLE `zona`
  MODIFY `id_z` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
