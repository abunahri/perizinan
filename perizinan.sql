-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 03:43 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perizinan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `absen_nis` int(11) NOT NULL,
  `absen_kamar` int(11) NOT NULL,
  `absen_musrif` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` int(11) NOT NULL,
  `absen_priode` int(11) NOT NULL,
  `bulan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `absen_nis`, `absen_kamar`, `absen_musrif`, `tanggal`, `keterangan`, `absen_priode`, `bulan`) VALUES
(1, 555555, 4, 9999, '2024-03-01', 1, 5, 'March'),
(2, 2022009, 4, 9999, '2024-03-01', 1, 5, 'March'),
(3, 555555, 4, 9999, '2024-03-02', 2, 5, 'March'),
(4, 2022009, 4, 9999, '2024-03-02', 1, 5, 'March'),
(5, 555555, 4, 9999, '2024-03-29', 1, 5, 'March'),
(6, 2022009, 4, 9999, '2024-03-29', 1, 5, 'March'),
(7, 555555, 4, 9999, '2024-02-01', 1, 5, 'February'),
(8, 2022009, 4, 9999, '2024-02-01', 1, 5, 'February'),
(9, 2147483647, 2, 7777, '2024-03-01', 1, 5, 'March'),
(10, 3333333, 2, 7777, '2024-03-01', 1, 5, 'March'),
(11, 234234234, 2, 7777, '2024-03-01', 1, 5, 'March'),
(12, 1234567890, 2, 7777, '2024-03-01', 1, 5, 'March'),
(13, 98989, 2, 7777, '2024-03-01', 1, 5, 'March'),
(14, 2147483647, 2, 7777, '2024-03-02', 2, 5, 'March'),
(15, 3333333, 2, 7777, '2024-03-02', 1, 5, 'March'),
(16, 234234234, 2, 7777, '2024-03-02', 1, 5, 'March'),
(17, 1234567890, 2, 7777, '2024-03-02', 1, 5, 'March'),
(18, 98989, 2, 7777, '2024-03-02', 1, 5, 'March'),
(19, 2147483647, 2, 7777, '2024-03-29', 1, 5, 'March'),
(20, 3333333, 2, 7777, '2024-03-29', 1, 5, 'March'),
(21, 234234234, 2, 7777, '2024-03-29', 1, 5, 'March'),
(22, 1234567890, 2, 7777, '2024-03-29', 1, 5, 'March'),
(23, 98989, 2, 7777, '2024-03-29', 2, 5, 'March'),
(24, 2147483647, 2, 7777, '2024-02-01', 1, 5, 'February'),
(25, 3333333, 2, 7777, '2024-02-01', 1, 5, 'February'),
(26, 234234234, 2, 7777, '2024-02-01', 1, 5, 'February'),
(27, 1234567890, 2, 7777, '2024-02-01', 1, 5, 'February'),
(28, 98989, 2, 7777, '2024-02-01', 1, 5, 'February'),
(29, 2147483647, 2, 7777, '2024-03-04', 1, 5, 'March'),
(30, 3333333, 2, 7777, '2024-03-04', 1, 5, 'March'),
(31, 234234234, 2, 7777, '2024-03-04', 1, 5, 'March'),
(32, 1234567890, 2, 7777, '2024-03-04', 1, 5, 'March'),
(33, 98989, 2, 7777, '2024-03-04', 1, 5, 'March'),
(34, 2147483647, 2, 7777, '2024-03-05', 1, 5, 'March'),
(35, 3333333, 2, 7777, '2024-03-05', 1, 5, 'March'),
(36, 234234234, 2, 7777, '2024-03-05', 1, 5, 'March'),
(37, 1234567890, 2, 7777, '2024-03-05', 1, 5, 'March'),
(38, 98989, 2, 7777, '2024-03-05', 1, 5, 'March'),
(39, 2147483647, 2, 7777, '2024-03-06', 1, 5, 'March'),
(40, 3333333, 2, 7777, '2024-03-06', 2, 5, 'March'),
(41, 234234234, 2, 7777, '2024-03-06', 2, 5, 'March'),
(42, 1234567890, 2, 7777, '2024-03-06', 1, 5, 'March'),
(43, 98989, 2, 7777, '2024-03-06', 1, 5, 'March'),
(44, 2147483647, 2, 7777, '2024-03-03', 2, 5, 'March'),
(45, 3333333, 2, 7777, '2024-03-03', 2, 5, 'March'),
(46, 234234234, 2, 7777, '2024-03-03', 1, 5, 'March'),
(47, 1234567890, 2, 7777, '2024-03-03', 2, 5, 'March'),
(48, 98989, 2, 7777, '2024-03-03', 1, 5, 'March'),
(49, 345345435, 7, 5555, '2024-03-29', 1, 5, 'March'),
(50, 324234234, 7, 5555, '2024-03-29', 1, 5, 'March'),
(51, 45435455, 7, 5555, '2024-03-29', 1, 5, 'March'),
(52, 324234234, 7, 5555, '2024-03-01', 2, 5, 'March'),
(53, 345345435, 7, 5555, '2024-03-01', 2, 5, 'March'),
(54, 45435455, 7, 5555, '2024-03-01', 2, 5, 'March'),
(55, 324234234, 7, 5555, '2024-02-01', 1, 5, 'February'),
(56, 345345435, 7, 5555, '2024-02-01', 1, 5, 'February'),
(57, 45435455, 7, 5555, '2024-02-01', 1, 5, 'February'),
(58, 2147483647, 2, 7777, '2024-03-30', 1, 5, 'March'),
(59, 3333333, 2, 7777, '2024-03-30', 1, 5, 'March'),
(60, 234234234, 2, 7777, '2024-03-30', 1, 5, 'March'),
(61, 1234567890, 2, 7777, '2024-03-30', 1, 5, 'March'),
(62, 98989, 2, 7777, '2024-03-30', 1, 5, 'March'),
(63, 2147483647, 2, 7777, '2024-01-01', 1, 5, 'January'),
(64, 3333333, 2, 7777, '2024-01-01', 1, 5, 'January'),
(65, 234234234, 2, 7777, '2024-01-01', 1, 5, 'January'),
(66, 1234567890, 2, 7777, '2024-01-01', 1, 5, 'January'),
(67, 98989, 2, 7777, '2024-01-01', 1, 5, 'January'),
(68, 678545654, 9, 8888, '2024-03-30', 1, 5, 'March'),
(69, 98876678, 9, 8888, '2024-03-30', 1, 5, 'March'),
(70, 678545654, 9, 8888, '2024-02-01', 1, 5, 'February'),
(71, 98876678, 9, 8888, '2024-02-01', 1, 5, 'February'),
(72, 678545654, 9, 8888, '2024-01-31', 2, 5, 'January'),
(73, 98876678, 9, 8888, '2024-01-31', 1, 5, 'January'),
(74, 678545654, 9, 8888, '2024-03-01', 1, 5, 'March'),
(75, 98876678, 9, 8888, '2024-03-01', 1, 5, 'March');

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `izin_nomor` char(20) NOT NULL,
  `izin_tgl` date NOT NULL,
  `izin_tglkembali` date DEFAULT NULL,
  `izin_jam` time DEFAULT NULL,
  `izin_jamkmbli` time DEFAULT NULL,
  `izin_nis` int(11) NOT NULL,
  `izin_priode` int(11) NOT NULL,
  `izin_kelas` int(11) NOT NULL,
  `izin_kamar` int(11) NOT NULL,
  `izin_type` varchar(100) DEFAULT NULL,
  `izin_keperluan` varchar(255) NOT NULL,
  `izin_status` enum('Masih Izin','Telah Kembali','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`izin_nomor`, `izin_tgl`, `izin_tglkembali`, `izin_jam`, `izin_jamkmbli`, `izin_nis`, `izin_priode`, `izin_kelas`, `izin_kamar`, `izin_type`, `izin_keperluan`, `izin_status`) VALUES
('SIK0112220001', '2022-12-01', '2022-12-01', '00:14:00', '01:00:00', 3333333, 3, 7, 2, 'Keluar', 'belanja', 'Telah Kembali'),
('SIK0402230001', '2023-02-04', '2023-02-04', '09:42:00', '10:00:00', 555555, 3, 14, 4, 'Keluar', 'belanjajatos', 'Telah Kembali'),
('SIK0604230004', '2023-04-06', '2023-04-06', '20:49:00', '22:00:00', 3333333, 3, 7, 2, 'Keluar', 'jatos', 'Telah Kembali'),
('SIK0908230002', '2023-08-09', '2023-08-09', '21:21:00', '23:00:00', 45435455, 3, 6, 7, 'Keluar', 'belanja', 'Telah Kembali'),
('SIK1403230001', '2023-03-14', '2023-03-14', '02:24:00', '07:00:00', 3333333, 3, 7, 2, 'Keluar', 'belanja', 'Telah Kembali'),
('SIK2103230002', '2023-03-21', '2023-03-21', '01:09:00', '02:00:00', 45435455, 3, 6, 7, 'Keluar', 'belanja', 'Telah Kembali'),
('SIK3101230002', '2023-01-31', '2023-01-31', '23:08:00', '01:10:00', 3333333, 3, 7, 2, 'Keluar', 'ambil uang', 'Telah Kembali'),
('SIP0112220002', '2022-12-01', '2022-12-02', NULL, NULL, 2147483647, 3, 7, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0602230001', '2023-02-06', '2023-02-07', NULL, NULL, 555555, 3, 14, 4, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0602230002', '2023-02-06', '2023-02-08', NULL, NULL, 45435455, 3, 6, 7, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0604230001', '2023-04-06', '2023-04-07', NULL, NULL, 98989, 3, 14, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0604230002', '2023-04-06', '2023-04-07', NULL, NULL, 555555, 3, 1, 4, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0604230003', '2023-04-06', '2023-04-07', NULL, NULL, 98989, 3, 14, 2, 'Pulang', 'berobat sakit', 'Telah Kembali'),
('SIP0604230004', '2023-04-06', '2023-04-07', NULL, NULL, 234234234, 3, 14, 2, 'Pulang', 'sakit', 'Telah Kembali'),
('SIP0908230001', '2023-08-09', '2023-08-11', NULL, NULL, 98989, 3, 14, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP0908230002', '2023-08-09', '2023-08-11', NULL, NULL, 324234234, 3, 14, 7, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP1103230001', '2023-03-11', '2023-03-12', NULL, NULL, 3333333, 3, 7, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP1603230001', '2023-03-16', '2023-03-17', NULL, NULL, 98989, 3, 14, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP1803240001', '2024-03-18', '2024-03-20', NULL, NULL, 34234, 3, 6, 8, 'Pulang', 'Sakit', 'Masih Izin'),
('SIP1811230001', '2023-11-18', '2023-11-19', NULL, NULL, 555555, 3, 1, 4, 'Pulang', 'berobat', 'Masih Izin'),
('SIP2002230001', '2023-02-20', '2023-02-21', NULL, NULL, 34234, 3, 6, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP2002230002', '2023-02-20', '2023-02-22', NULL, NULL, 34234, 3, 6, 2, 'Pulang', 'berobat', 'Telah Kembali'),
('SIP2103230001', '2023-03-21', '2023-03-22', NULL, NULL, 34234, 3, 6, 2, 'Pulang', 'sakit', 'Telah Kembali'),
('SIP2903240001', '2024-03-29', '2024-03-31', NULL, NULL, 2022009, 5, 1, 4, 'Pulang', 'berobat', 'Masih Izin'),
('SIP2903240002', '2024-03-29', '2024-03-31', NULL, NULL, 555555, 5, 1, 4, 'Pulang', 'berobat', 'Masih Izin'),
('SIP3011220001', '2022-11-30', '2022-12-01', NULL, NULL, 34234, 3, 6, 2, 'Pulang', 'sakit', 'Telah Kembali'),
('SIP3101230001', '2023-01-31', '2023-02-01', NULL, NULL, 34234, 3, 6, 2, 'Pulang', 'sakit', 'Telah Kembali');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`) VALUES
(2, 'Abu Bakar'),
(4, 'Umar bin Khottob (UBK)'),
(6, 'Khodijah'),
(7, 'Aisyah'),
(8, 'Usman Bin Affan'),
(9, 'Umu kulsum');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `kehadiran` enum('Hadir','Pulang','Tanpa keterangan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `kehadiran`) VALUES
(1, 'Hadir'),
(2, 'Pulang'),
(3, 'Tanpa keterangan');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'VII A'),
(2, 'VII B'),
(6, 'VII C'),
(7, 'VII D'),
(11, 'X MIA I'),
(14, 'X IIS II');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `levelid` int(11) NOT NULL,
  `levelnama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`levelid`, `levelnama`) VALUES
(1, 'admin'),
(2, 'pengasuhan'),
(3, 'musrif');

-- --------------------------------------------------------

--
-- Table structure for table `musrif`
--

CREATE TABLE `musrif` (
  `kode_musrif` int(11) NOT NULL,
  `nama_musrif` varchar(255) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') NOT NULL,
  `tlp_musrif` varchar(20) NOT NULL,
  `kamar_musrif` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `pass_musrif` varchar(255) NOT NULL,
  `musrif_levelid` int(1) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musrif`
--

INSERT INTO `musrif` (`kode_musrif`, `nama_musrif`, `jenkel`, `tlp_musrif`, `kamar_musrif`, `foto`, `pass_musrif`, `musrif_levelid`) VALUES
(2222, 'Ust Rizal', 'Laki-laki', '456546546', 8, './assets/upload/2222.jpg', '$2y$10$71jr01jwBpjSKzRoQdIKC.NbbAIDUYEWQs6iT2G7ynkyKX/LvHfkK', 3),
(3333, 'M. Rivaldo', 'Laki-laki', '567567567', 2, '', '$2y$10$WADZF4Z6QhA99nC7gsXeBOIyjpXQHF2YgLIu/AcrszxgXcssBaKcq', 3),
(4444, 'Ustdz Putri', 'Perempuan', '67868768', 6, '', '$2y$10$vpzfL59.cGw0su9y3xC/keKz7qqpkFnx8gYFOZvN3rAEIE5Hnm/wy', 3),
(5555, 'Ustz Irfa', 'Perempuan', '546546', 7, '', '$2y$10$0JQmMu0C3QcgWCLVQdXOFeiq.gkq/NL.kytltbRwSWNRG1qZTaELy', 3),
(7777, 'Ust. Widan Arifin', 'Laki-laki', '546546546', 2, 'assets/upload/7777.jpg', '$2y$10$oHn5uEOWKRz7Rdw.eMiKeuW6DBAFlFZXLWLQnnloS8Yq1kOXaQoha', 3),
(8888, 'Ustzh. Indah', 'Perempuan', '768768678', 9, 'assets/upload/8888.jpg', '$2y$10$0JQmMu0C3QcgWCLVQdXOFeiq.gkq/NL.kytltbRwSWNRG1qZTaELy', 3),
(9999, 'Ust. Fahmi', 'Laki-laki', '678678678', 4, './assets/upload/9999.jpg', '$2y$10$0JQmMu0C3QcgWCLVQdXOFeiq.gkq/NL.kytltbRwSWNRG1qZTaELy', 3);

-- --------------------------------------------------------

--
-- Table structure for table `priode`
--

CREATE TABLE `priode` (
  `priode_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `priode` varchar(25) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `priode`
--

INSERT INTO `priode` (`priode_id`, `tahun`, `priode`, `status`) VALUES
(1, 2020, '2020/2021', 0),
(2, 2021, '2021/2022', 0),
(3, 2022, '2022/2023', 0),
(4, 2019, '2019/2020', 0),
(5, 2024, '2023/2024', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sakit`
--

CREATE TABLE `sakit` (
  `id_sakit` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `priode_id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `kode_musrif` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `sakit` varchar(255) NOT NULL,
  `penanganan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sakit`
--

INSERT INTO `sakit` (`id_sakit`, `tanggal`, `priode_id`, `nis`, `kode_musrif`, `id_kamar`, `id_kelas`, `sakit`, `penanganan`) VALUES
(1, '2023-07-25', 3, 324234234, 5555, 7, 14, 'buduk', 'dibawa pulang'),
(2, '2023-07-25', 3, 45435455, 5555, 7, 6, 'batuk', 'dibawa ke klinik'),
(3, '2023-07-25', 3, 324234234, 5555, 7, 14, 'asdsa', 'asdasdsad'),
(4, '2023-07-26', 3, 34234, 2222, 8, 6, 'buduk', 'dibawa ke klinik'),
(5, '2023-08-20', 3, 98989, 7777, 2, 14, 'asma', 'bawa klinik'),
(6, '2023-10-27', 3, 34234, 2222, 8, 6, 'sesak nafas', 'belum lapor ke pak dadang'),
(7, '2024-03-18', 5, 98989, 7777, 2, 14, 'kepala suka pusing', 'masih dikamar'),
(8, '2024-03-26', 5, 98989, 7777, 2, 14, 'Pusing', 'di ruang isolasi'),
(9, '2024-03-26', 5, 98989, 7777, 2, 14, 'Pusing', 'di ruang isolasi'),
(10, '2024-03-30', 5, 98876678, 8888, 9, 7, 'pusing kalo lapar', 'di ruang kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `nis` int(11) NOT NULL,
  `nisn` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tmp_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenkel` enum('Laki-laki','Perempuan','','') DEFAULT NULL,
  `santri_idkelas` int(11) NOT NULL,
  `santri_idkamar` int(11) NOT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `musrif_kamar` int(11) DEFAULT NULL,
  `foto_santri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`nis`, `nisn`, `nama`, `tmp_lahir`, `tgl_lahir`, `jenkel`, `santri_idkelas`, `santri_idkamar`, `nama_wali`, `alamat`, `telp`, `musrif_kamar`, `foto_santri`) VALUES
(34234, 2147483647, 'Agus', 'Bandung', '2012-12-05', 'Laki-laki', 6, 8, 'Tatang', 'Sumedang', '546456546', 2222, './assets/upload/34234.jpg'),
(98989, 888888, 'Ude', 'Sumedang', '2011-08-12', 'Laki-laki', 14, 2, 'darwis', 'cibeusi', '4234234324', 7777, './assets/upload/98989.jpg'),
(555555, 656565656, 'Eman', 'Sumedang', '2011-09-17', 'Laki-laki', 1, 4, 'dodi', 'sumedang cibeusi', '123123123', 9999, './assets/upload/555555.jpg'),
(2022009, 345435345, 'khalif', 'wonosobo', '2013-03-13', 'Laki-laki', 1, 4, 'mbak is', 'wonosobo', '45345435345', 9999, './assets/upload/2022009.jpg'),
(3333333, 5656565, 'Eman Suherman', 'Bandung', '2010-10-10', 'Laki-laki', 7, 2, 'udin', 'Bandung', '213123', 7777, 'assets/upload/3333333.jpg'),
(6666666, 5656565, 'Winwin', 'Bandung', '2010-10-10', 'Perempuan', 6, 2, 'Amut', 'Bandung', '234324234', NULL, ''),
(9999999, 5656565, 'Sueb', 'Bandung', '2010-10-10', 'Laki-laki', 7, 2, 'udin', 'Bandung', '213123', NULL, ''),
(45435455, 2147483647, 'Wati', 'Bandung', '2011-01-25', 'Perempuan', 6, 7, 'udin', 'Surabaya', '435435345', 5555, 'assets/upload/45435455.jpg'),
(98876678, 2147483647, 'riri', 'Bandung', '2010-10-10', 'Perempuan', 7, 9, 'erna', 'Bandung', '213123', 8888, ''),
(234234234, 2147483647, 'sunyi', 'bandung', '2010-12-21', 'Laki-laki', 14, 2, 'dudung', 'bandung', '234234234', 7777, ''),
(324234234, 234234234, 'Ema', 'Bogor', '2011-02-20', 'Perempuan', 14, 7, 'deni', 'sumedang', '324234234', 5555, ''),
(345345435, 345345345, 'najwa', 'jakarta', '2010-10-19', 'Perempuan', 1, 7, 'asdasd', 'jakarta pusat', '324234234234', 5555, 'assets/upload/345345435.jpg'),
(678545654, 2323232, 'Dena putri Koswara', 'Jakarta', '2010-12-25', 'Perempuan', 6, 6, 'ujang', 'jakarta', '678678678', 8888, ''),
(1234567890, 2147483647, 'Ubay Abdullah Siroj', 'Wonosobo', '2010-12-24', 'Laki-laki', 7, 2, 'ida', 'wonosobo', '234234234234', 7777, ''),
(2147483647, 2147483647, 'Arifin', 'Sumedang', '2011-03-10', 'Laki-laki', 7, 2, 'anis', 'Cibeusi Jatinangor Sumedang', '234324324234', 7777, '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `app_nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kec` varchar(255) NOT NULL,
  `kab` varchar(245) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `kepsek` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `cap` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `nama_sekolah`, `app_nama`, `alamat`, `kec`, `kab`, `telp`, `logo`, `kepsek`, `nip`, `cap`) VALUES
(1, 'PONDOK MODERN AL-AQSHA', 'KARTU PELAJAR', 'Jl. Raya Jatinangor No.2 Jatinangor Sumedang', 'Jatinangor', 'Sumedang', '123123123123', 'upload/logo/.png', 'Apip Hadi Susanto, MM', '-', 'upload/cap/.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` char(50) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `userlevelid` int(11) NOT NULL,
  `useraktif` char(1) NOT NULL DEFAULT '1',
  `foto` varchar(255) DEFAULT NULL,
  `jenkel` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `nama_user`, `userpassword`, `userlevelid`, `useraktif`, `foto`, `jenkel`) VALUES
('admin', 'administrator', '$2y$10$tFKNjTbYit6b02lnKlmaLee54beXzPgyZL1fl9Ew.X8HhvaC1M.cC', 1, '1', './assets/images/foto/admin.jpg', 'Laki-laki'),
('dedi', 'dedi hidayat', '$2y$10$xSQwkErX97g9eA8ugFToCO.pyIYc2s4Asofan./5RtKerzDJLBDBG', 2, '1', './assets/images/foto/dedi.jpg', 'Laki-laki'),
('jajang', 'jajang rahmat', '$2y$10$HdpqVkmPzlgl6KgKZ45YCORraEeiF84/Z7XRM6OFT8TprMT0kr4ne', 2, '1', './assets/images/foto/jajang.jpg', 'Laki-laki'),
('vina', 'vina', '$2y$10$PVOmNddGFvgAmt5EhCdfaOAjdIVvCkWVlSJiqh5lyFdc8JvE9PHza', 2, '1', NULL, 'Perempuan'),
('wahid', 'Muhammad Wahid', '$2y$10$63Hxw8RrBx5YuNqN4RuH..vpDz6IBas4wpJtrtDyA9ilaRk7gJ5kG', 2, '1', './assets/images/foto/wahid.jpg', 'Laki-laki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `absen_nis` (`absen_nis`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`izin_nomor`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`levelid`);

--
-- Indexes for table `musrif`
--
ALTER TABLE `musrif`
  ADD PRIMARY KEY (`kode_musrif`);

--
-- Indexes for table `priode`
--
ALTER TABLE `priode`
  ADD PRIMARY KEY (`priode_id`);

--
-- Indexes for table `sakit`
--
ALTER TABLE `sakit`
  ADD PRIMARY KEY (`id_sakit`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `santri_idkelas` (`santri_idkelas`),
  ADD KEY `santri_idkelas_2` (`santri_idkelas`),
  ADD KEY `santri_idkamar` (`santri_idkamar`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `levelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `priode`
--
ALTER TABLE `priode`
  MODIFY `priode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sakit`
--
ALTER TABLE `sakit`
  MODIFY `id_sakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_ibfk_1` FOREIGN KEY (`santri_idkelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `santri_ibfk_2` FOREIGN KEY (`santri_idkamar`) REFERENCES `kamar` (`id_kamar`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
