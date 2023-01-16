-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 08:29 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-eo`
--

-- --------------------------------------------------------

--
-- Table structure for table `modul_katagori`
--

CREATE TABLE `modul_katagori` (
  `id` int(11) NOT NULL,
  `nama_katagori` varchar(100) NOT NULL,
  `function` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `modul_katagori`
--

INSERT INTO `modul_katagori` (`id`, `nama_katagori`, `function`, `icon`, `order_by`) VALUES
(1, 'Administrator', 'administrator', '<i class=\"nc-icon nc-bank\"></i>', 2),
(2, 'Master', 'master', '<i class=\"nc-icon nc-bank\"></i>', 3),
(3, 'Transaksi', 'transaksi', '<i class=\"nc-icon nc-bank\"></i>', 4),
(4, 'Report', 'report', '<i class=\"nc-icon nc-bank\"></i>', 5),
(5, 'Dashboard', 'dashboard', '<i class=\"nc-icon nc-bank\"></i>', 1),
(6, 'Logout', 'login/logout', '<i class=\"nc-icon nc-bank\"></i>', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modul_menu`
--

CREATE TABLE `modul_menu` (
  `id` int(11) NOT NULL,
  `id_katagori` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `function` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul_menu`
--

INSERT INTO `modul_menu` (`id`, `id_katagori`, `nama_menu`, `function`, `icon`, `order_by`) VALUES
(1, 2, 'Perusahaan', 'mstrperusahaan', '<i class=\"nc-icon nc-air-baloon\"></i>', 0),
(2, 2, 'Jabatan', 'mstrjabatan', '<i class=\"nc-icon nc-album-2\"></i>', 0),
(3, 2, 'Bank', 'mstrbank', '<i class=\"nc-icon nc-bold\"></i>', 0),
(4, 2, 'Branch of Bank', 'mstrbranchbank', '<i class=\"nc-icon nc-bold\"></i>', 0),
(5, 2, 'Rekening Bank', 'mstrrekbank', '<i class=\"nc-icon nc-bold\"></i>', 0),
(6, 2, 'Rekening Bank Perusahaan', 'mstrrekbankcomp', '<i class=\"nc-icon nc-bold\"></i>', 0),
(7, 2, 'Marketing', 'mstrmarketing', '<i class=\"nc-icon nc-bold\"></i>', 0),
(8, 2, 'Jenis Kendaraan', 'mstrjeniskendaraan', '<i class=\"nc-icon nc-bold\"></i>', 0),
(9, 2, 'Brand', 'mstrbrand', '<i class=\"nc-icon nc-bold\"></i>', 0),
(10, 2, 'M-code', 'mstrmcode', '<i class=\"nc-icon nc-bold\"></i>', 0),
(11, 2, 'Customer', 'mstrcustomer', '<i class=\"nc-icon nc-bold\"></i>', 0),
(12, 2, 'Lokasi', 'mstrlokasi', '<i class=\"nc-icon nc-bold\"></i>', 0),
(13, 2, 'Area', 'mstrarea', '<i class=\"nc-icon nc-bold\"></i>', 0),
(14, 2, 'Jenis Project', 'mstrjenisproject', '<i class=\"nc-icon nc-bold\"></i>', 0),
(15, 2, 'Barang Dekorasi', 'mstrbrgdekorasi', '<i class=\"nc-icon nc-bold\"></i>', 0),
(16, 2, 'Jenis Dekorasi', 'mstrjenisdekorasi', '<i class=\"nc-icon nc-bold\"></i>', 0),
(17, 2, 'Dekorasi', 'mstrdekorasi', '<i class=\"nc-icon nc-bold\"></i>', 0),
(18, 2, 'Dekorasi Detail', 'mstrdekordetail', '<i class=\"nc-icon nc-bold\"></i>', 0),
(19, 1, 'Role User', 'role', '<i class=\"nc-icon nc-album-2\"></i>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mstr_perusahaan`
--

CREATE TABLE `tbl_mstr_perusahaan` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `alamat_npwp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mstr_perusahaan`
--

INSERT INTO `tbl_mstr_perusahaan` (`id`, `kode`, `nama`, `npwp`, `alamat_npwp`) VALUES
(16, 'ANGNT', 'PT. Anugrehar Nusantara', '01.021920.00091', 'Jl. Banteng no.42, Bandung'),
(17, 'XX', 'xX', '093203230232', 'dsjhjds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modul_katagori`
--
ALTER TABLE `modul_katagori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul_menu`
--
ALTER TABLE `modul_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mstr_perusahaan`
--
ALTER TABLE `tbl_mstr_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modul_katagori`
--
ALTER TABLE `modul_katagori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modul_menu`
--
ALTER TABLE `modul_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_mstr_perusahaan`
--
ALTER TABLE `tbl_mstr_perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
