-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2024 at 02:26 AM
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
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int NOT NULL,
  `aktivitas` text NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` enum('belum','progress','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `aktivitas`, `start`, `end`, `status`, `user_id`) VALUES
(12, 'Desain Feed 17 agustus', '2024-05-03', '2024-05-31', 'progress', 2),
(13, 'landing page', '2024-05-16', '2024-05-29', 'progress', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(65) NOT NULL,
  `email` varchar(90) NOT NULL,
  `password` text NOT NULL,
  `role` enum('superuser','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'bayu', 'bayu@gmail.com\r\n', 'ee460938559a0d5bcae5fca8e1faa2f8', 'user'),
(2, 'Bima', 'Bima@gmail.com', 'da885942b7e475875cb609acc351ea84', 'user'),
(3, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'superuser'),
(4, 'staff', 'staff@gmail.com', '$2y$10$FRUOB7YMHQjtJhcJy7NOiO4t3ik4v/jg1Vd57Qh7MWzaRX6y0UeKi', 'user'),
(5, 'gus', 'gus@gmail.com', '$2y$10$0TaB52/aMjCiEnkxvHnrbuY7rKyge1MlUKGjCfYu3Rog/78MNK4nG', 'user'),
(7, 'tes', 'desa@gmail.com', 'e54cc06625bbadf12163b41a3cb92bf8', 'user'),
(8, 'k', 'kilang@gmail.cpm', '17ac9f6c46bd285606bd8f4b028beccd', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
