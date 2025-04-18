-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2025 at 11:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `stok`, `deskripsi`, `foto`) VALUES
(3, 'osiloskop', 11, '1', 'umpku-removebg-preview.png'),
(4, 'x', 136, '2', 'umpku-removebg-preview.png'),
(5, 'ax', 5, 'ngetes ajabos', 'hfdd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int NOT NULL,
  `matkul` varchar(100) DEFAULT NULL,
  `dosen` varchar(100) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `id_ruangan` int NOT NULL,
  `semester_mulai` date NOT NULL,
  `semester_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `matkul`, `dosen`, `hari`, `waktu_mulai`, `waktu_selesai`, `id_ruangan`, `semester_mulai`, `semester_selesai`) VALUES
(1, 'Pemrograman Web', 'Pak Budi', 'Senin', '08:00:00', '10:00:00', 5, '2025-03-01', '2025-07-31'),
(2, 'life support', 'udin', 'Kamis', '08:00:00', '09:00:00', 1, '2025-03-01', '2025-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `pinjambarang`
--

CREATE TABLE `pinjambarang` (
  `id` int NOT NULL,
  `id_barang` int NOT NULL,
  `id_user` int NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `email_peminjam` varchar(100) NOT NULL,
  `qty` int NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `lokasi_barang` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjambarang`
--

INSERT INTO `pinjambarang` (`id`, `id_barang`, `id_user`, `nama_peminjam`, `email_peminjam`, `qty`, `tgl_mulai`, `tgl_selesai`, `lokasi_barang`, `status`) VALUES
(26, 5, 3, 'z', '012021050011@students.itspku.ac.id', 3, '2025-04-18 17:22:00', '2025-04-18 17:23:00', 'ruang f', 'selesai'),
(27, 4, 3, 'z', '012021050011@students.itspku.ac.id', 135, '2025-04-18 17:24:00', '2025-04-18 17:26:00', 'ruang f', 'selesai'),
(28, 5, 3, 'z', '012021050011@students.itspku.ac.id', 4, '2025-04-18 17:26:00', '2025-04-18 17:27:00', 'ruang f', 'selesai'),
(29, 4, 3, 'z', '012021050011@students.itspku.ac.id', 1, '2025-04-18 17:27:00', '2025-04-18 17:28:00', 'ruang f', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pinjamruangan`
--

CREATE TABLE `pinjamruangan` (
  `id` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_user` int NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('menunggu','approve','selesai') DEFAULT 'menunggu',
  `nama_peminjam` varchar(255) DEFAULT NULL,
  `email_peminjam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_ruang`
--

CREATE TABLE `pinjam_ruang` (
  `id` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_user` int NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('menunggu','approve','selesai') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('free','dipinjam') DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `deskripsi`, `foto`, `status`) VALUES
(1, 'Lab kom', 'kom', '4x6.png', 'dipinjam'),
(5, 'Lab Life Supporrt123', '1', '', 'free');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `email`, `nohp`, `username`, `password`, `level`) VALUES
(1, 'x', '022021050011@students.itspku.ac.id', '1', 'hfd', '123', 'admin'),
(3, 'z', '012021050011@students.itspku.ac.id', '1', 'z', '123', 'user'),
(6, 'hafid', 'oksigen290@gmail.com', '1', 'b', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `pinjambarang`
--
ALTER TABLE `pinjambarang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pinjam_ruang`
--
ALTER TABLE `pinjam_ruang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pinjambarang`
--
ALTER TABLE `pinjambarang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pinjam_ruang`
--
ALTER TABLE `pinjam_ruang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id`);

--
-- Constraints for table `pinjambarang`
--
ALTER TABLE `pinjambarang`
  ADD CONSTRAINT `pinjambarang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pinjambarang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `pinjamruangan`
--
ALTER TABLE `pinjamruangan`
  ADD CONSTRAINT `pinjamruangan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id`),
  ADD CONSTRAINT `pinjamruangan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `pinjam_ruang`
--
ALTER TABLE `pinjam_ruang`
  ADD CONSTRAINT `pinjam_ruang_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id`),
  ADD CONSTRAINT `pinjam_ruang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
