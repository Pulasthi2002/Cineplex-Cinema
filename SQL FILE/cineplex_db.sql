-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 05:01 PM
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
-- Database: `cineplex_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image_url`, `created_at`) VALUES
(17, 'Deadpool & Wolverine', 'Deadpool\'s peaceful existence comes crashing down when the Time Variance Authority recruits him to help safeguard the multiverse. He soon unites with his would-be pal, Wolverine, to complete the mission and save his world from an existential threat.', 'assets/images/Deadpool & Wolverine.JPG', '2025-10-22 07:20:47'),
(18, 'Joker: Folie à Deux', 'Struggling with his dual identity, failed comedian Arthur Fleck meets the love of his life, Harley Quinn, while incarcerated at Arkham State Hospital.', 'assets/images/Joker.JPG', '2025-10-22 07:23:08'),
(19, 'Alien: Romulus', 'Space colonizers come face to face with the most terrifying life-form in the universe while scavenging the deep ends of a derelict space station.', 'assets/images/Alien.JPG', '2025-10-22 07:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `seat_type` enum('Front Gallery','Balcony') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat_number`, `seat_type`, `price`, `available`) VALUES
(1, 'A1', 'Front Gallery', 500.00, 0),
(2, 'A2', 'Front Gallery', 500.00, 0),
(3, 'A3', 'Front Gallery', 500.00, 0),
(4, 'B1', 'Balcony', 800.00, 1),
(5, 'B2', 'Balcony', 800.00, 1),
(6, 'B3', 'Balcony', 800.00, 1),
(7, 'A1', 'Front Gallery', 500.00, 0),
(8, 'A2', 'Front Gallery', 500.00, 1),
(9, 'A3', 'Front Gallery', 500.00, 1),
(10, 'A4', 'Front Gallery', 500.00, 1),
(11, 'A5', 'Front Gallery', 500.00, 1),
(12, 'A6', 'Front Gallery', 500.00, 1),
(13, 'A7', 'Front Gallery', 500.00, 1),
(14, 'A8', 'Front Gallery', 500.00, 1),
(15, 'A9', 'Front Gallery', 500.00, 1),
(16, 'A10', 'Front Gallery', 500.00, 1),
(17, 'A11', 'Front Gallery', 500.00, 1),
(18, 'A12', 'Front Gallery', 500.00, 1),
(19, 'A13', 'Front Gallery', 500.00, 1),
(20, 'A14', 'Front Gallery', 500.00, 1),
(21, 'A15', 'Front Gallery', 500.00, 1),
(22, 'A16', 'Front Gallery', 500.00, 1),
(23, 'A17', 'Front Gallery', 500.00, 0),
(24, 'A18', 'Front Gallery', 500.00, 0),
(25, 'A19', 'Front Gallery', 500.00, 1),
(26, 'A20', 'Front Gallery', 500.00, 1),
(27, 'A21', 'Front Gallery', 500.00, 1),
(28, 'A22', 'Front Gallery', 500.00, 1),
(29, 'A23', 'Front Gallery', 500.00, 1),
(30, 'A24', 'Front Gallery', 500.00, 1),
(31, 'A25', 'Front Gallery', 500.00, 1),
(32, 'A26', 'Front Gallery', 500.00, 1),
(33, 'A27', 'Front Gallery', 500.00, 1),
(34, 'A28', 'Front Gallery', 500.00, 1),
(35, 'A29', 'Front Gallery', 500.00, 1),
(36, 'A30', 'Front Gallery', 500.00, 1),
(37, 'A31', 'Front Gallery', 500.00, 1),
(38, 'A32', 'Front Gallery', 500.00, 0),
(39, 'A33', 'Front Gallery', 500.00, 1),
(40, 'A34', 'Front Gallery', 500.00, 1),
(41, 'A35', 'Front Gallery', 500.00, 1),
(42, 'A36', 'Front Gallery', 500.00, 1),
(43, 'A37', 'Front Gallery', 500.00, 1),
(44, 'A38', 'Front Gallery', 500.00, 1),
(45, 'A39', 'Front Gallery', 500.00, 1),
(46, 'A40', 'Front Gallery', 500.00, 1),
(47, 'A41', 'Front Gallery', 500.00, 1),
(48, 'A42', 'Front Gallery', 500.00, 1),
(49, 'A43', 'Front Gallery', 500.00, 1),
(50, 'A44', 'Front Gallery', 500.00, 0),
(51, 'A45', 'Front Gallery', 500.00, 1),
(52, 'A46', 'Front Gallery', 500.00, 1),
(53, 'A47', 'Front Gallery', 500.00, 1),
(54, 'A48', 'Front Gallery', 500.00, 1),
(55, 'A49', 'Front Gallery', 500.00, 1),
(56, 'A50', 'Front Gallery', 500.00, 1),
(57, 'A51', 'Front Gallery', 500.00, 1),
(58, 'A52', 'Front Gallery', 500.00, 1),
(59, 'A53', 'Front Gallery', 500.00, 1),
(60, 'A54', 'Front Gallery', 500.00, 1),
(61, 'A55', 'Front Gallery', 500.00, 1),
(62, 'A56', 'Front Gallery', 500.00, 1),
(63, 'A57', 'Front Gallery', 500.00, 0),
(64, 'A58', 'Front Gallery', 500.00, 1),
(65, 'A59', 'Front Gallery', 500.00, 1),
(66, 'A60', 'Front Gallery', 500.00, 1),
(67, 'A61', 'Front Gallery', 500.00, 1),
(68, 'A62', 'Front Gallery', 500.00, 1),
(69, 'A63', 'Front Gallery', 500.00, 1),
(70, 'A64', 'Front Gallery', 500.00, 1),
(71, 'A65', 'Front Gallery', 500.00, 1),
(72, 'A66', 'Front Gallery', 500.00, 1),
(73, 'A67', 'Front Gallery', 500.00, 1),
(74, 'A68', 'Front Gallery', 500.00, 1),
(75, 'A69', 'Front Gallery', 500.00, 1),
(76, 'A70', 'Front Gallery', 500.00, 0),
(77, 'A71', 'Front Gallery', 500.00, 1),
(78, 'A72', 'Front Gallery', 500.00, 1),
(79, 'A73', 'Front Gallery', 500.00, 1),
(80, 'A74', 'Front Gallery', 500.00, 1),
(81, 'A75', 'Front Gallery', 500.00, 1),
(82, 'A76', 'Front Gallery', 500.00, 1),
(83, 'A77', 'Front Gallery', 500.00, 1),
(84, 'A78', 'Front Gallery', 500.00, 1),
(85, 'A79', 'Front Gallery', 500.00, 1),
(86, 'A80', 'Front Gallery', 500.00, 1),
(87, 'A81', 'Front Gallery', 500.00, 1),
(88, 'A82', 'Front Gallery', 500.00, 1),
(89, 'A83', 'Front Gallery', 500.00, 1),
(90, 'A84', 'Front Gallery', 500.00, 1),
(91, 'A85', 'Front Gallery', 500.00, 0),
(92, 'A86', 'Front Gallery', 500.00, 1),
(93, 'A87', 'Front Gallery', 500.00, 0),
(94, 'A88', 'Front Gallery', 500.00, 1),
(95, 'A89', 'Front Gallery', 500.00, 1),
(96, 'A90', 'Front Gallery', 500.00, 0),
(97, 'A91', 'Front Gallery', 500.00, 0),
(98, 'A92', 'Front Gallery', 500.00, 1),
(99, 'A93', 'Front Gallery', 500.00, 1),
(100, 'A94', 'Front Gallery', 500.00, 1),
(101, 'A95', 'Front Gallery', 500.00, 1),
(102, 'A96', 'Front Gallery', 500.00, 1),
(103, 'A97', 'Front Gallery', 500.00, 1),
(104, 'A98', 'Front Gallery', 500.00, 0),
(105, 'A99', 'Front Gallery', 500.00, 0),
(106, 'A100', 'Front Gallery', 500.00, 0),
(107, 'B1', 'Balcony', 800.00, 1),
(108, 'B2', 'Balcony', 800.00, 1),
(109, 'B3', 'Balcony', 800.00, 1),
(110, 'B4', 'Balcony', 800.00, 1),
(111, 'B5', 'Balcony', 800.00, 1),
(112, 'B6', 'Balcony', 800.00, 1),
(113, 'B7', 'Balcony', 800.00, 1),
(114, 'B8', 'Balcony', 800.00, 1),
(115, 'B9', 'Balcony', 800.00, 1),
(116, 'B10', 'Balcony', 800.00, 1),
(117, 'B11', 'Balcony', 800.00, 0),
(118, 'B12', 'Balcony', 800.00, 1),
(119, 'B13', 'Balcony', 800.00, 1),
(120, 'B14', 'Balcony', 800.00, 0),
(121, 'B15', 'Balcony', 800.00, 1),
(122, 'B16', 'Balcony', 800.00, 1),
(123, 'B17', 'Balcony', 800.00, 1),
(124, 'B18', 'Balcony', 800.00, 1),
(125, 'B19', 'Balcony', 800.00, 1),
(126, 'B20', 'Balcony', 800.00, 1),
(127, 'B21', 'Balcony', 800.00, 1),
(128, 'B22', 'Balcony', 800.00, 1),
(129, 'B23', 'Balcony', 800.00, 1),
(130, 'B24', 'Balcony', 800.00, 1),
(131, 'B25', 'Balcony', 800.00, 1),
(132, 'B26', 'Balcony', 800.00, 0),
(133, 'B27', 'Balcony', 800.00, 1),
(134, 'B28', 'Balcony', 800.00, 0),
(135, 'B29', 'Balcony', 800.00, 1),
(136, 'B30', 'Balcony', 800.00, 1),
(137, 'B31', 'Balcony', 800.00, 1),
(138, 'B32', 'Balcony', 800.00, 1),
(139, 'B33', 'Balcony', 800.00, 1),
(140, 'B34', 'Balcony', 800.00, 1),
(141, 'B35', 'Balcony', 800.00, 1),
(142, 'B36', 'Balcony', 800.00, 1),
(143, 'B37', 'Balcony', 800.00, 0),
(144, 'B38', 'Balcony', 800.00, 1),
(145, 'B39', 'Balcony', 800.00, 1),
(146, 'B40', 'Balcony', 800.00, 1),
(147, 'B41', 'Balcony', 800.00, 1),
(148, 'B42', 'Balcony', 800.00, 1),
(149, 'B43', 'Balcony', 800.00, 1),
(150, 'B44', 'Balcony', 800.00, 1),
(151, 'B45', 'Balcony', 800.00, 1),
(152, 'B46', 'Balcony', 800.00, 0),
(153, 'B47', 'Balcony', 800.00, 1),
(154, 'B48', 'Balcony', 800.00, 0),
(155, 'B49', 'Balcony', 800.00, 1),
(156, 'B50', 'Balcony', 800.00, 1),
(157, 'B51', 'Balcony', 800.00, 1),
(158, 'B52', 'Balcony', 800.00, 1),
(159, 'B53', 'Balcony', 800.00, 1),
(160, 'B54', 'Balcony', 800.00, 1),
(161, 'B55', 'Balcony', 800.00, 1),
(162, 'B56', 'Balcony', 800.00, 1),
(163, 'B57', 'Balcony', 800.00, 1),
(164, 'B58', 'Balcony', 800.00, 1),
(165, 'B59', 'Balcony', 800.00, 0),
(166, 'B60', 'Balcony', 800.00, 1),
(167, 'B61', 'Balcony', 800.00, 1),
(168, 'B62', 'Balcony', 800.00, 1),
(169, 'B63', 'Balcony', 800.00, 0),
(170, 'B64', 'Balcony', 800.00, 1),
(171, 'B65', 'Balcony', 800.00, 1),
(172, 'B66', 'Balcony', 800.00, 1),
(173, 'B67', 'Balcony', 800.00, 0),
(174, 'B68', 'Balcony', 800.00, 0),
(175, 'B69', 'Balcony', 800.00, 1),
(176, 'B70', 'Balcony', 800.00, 1),
(177, 'B71', 'Balcony', 800.00, 1),
(178, 'B72', 'Balcony', 800.00, 0),
(179, 'B73', 'Balcony', 800.00, 1),
(180, 'B74', 'Balcony', 800.00, 1),
(181, 'B75', 'Balcony', 800.00, 0),
(182, 'B76', 'Balcony', 800.00, 1),
(183, 'B77', 'Balcony', 800.00, 1),
(184, 'B78', 'Balcony', 800.00, 1),
(185, 'B79', 'Balcony', 800.00, 1),
(186, 'B80', 'Balcony', 800.00, 1),
(187, 'B81', 'Balcony', 800.00, 1),
(188, 'B82', 'Balcony', 800.00, 1),
(189, 'B83', 'Balcony', 800.00, 1),
(190, 'B84', 'Balcony', 800.00, 1),
(191, 'B85', 'Balcony', 800.00, 1),
(192, 'B86', 'Balcony', 800.00, 1),
(193, 'B87', 'Balcony', 800.00, 1),
(194, 'B88', 'Balcony', 800.00, 1),
(195, 'B89', 'Balcony', 800.00, 0),
(196, 'B90', 'Balcony', 800.00, 1),
(197, 'B91', 'Balcony', 800.00, 0),
(198, 'B92', 'Balcony', 800.00, 1),
(199, 'B93', 'Balcony', 800.00, 1),
(200, 'B94', 'Balcony', 800.00, 1),
(201, 'B95', 'Balcony', 800.00, 1),
(202, 'B96', 'Balcony', 800.00, 1),
(203, 'B97', 'Balcony', 800.00, 1),
(204, 'B98', 'Balcony', 800.00, 1),
(205, 'B99', 'Balcony', 800.00, 1),
(206, 'B100', 'Balcony', 800.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `showtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `movie_id`, `showtime`) VALUES
(12, 17, '2025-10-22 12:00:00'),
(13, 18, '2025-10-24 15:00:00'),
(14, 19, '2025-10-26 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','staff','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Anura', 'anura@gmail.com', '$2y$10$BBFkErtuc6sni3qzgaOMsOHeqQVrUjtHSUd.yQCyFb6KddYiVyYS6', 'customer', '2024-10-11 18:54:46'),
(2, 'Brian', 'brian@gmail.com', '$2y$10$Zk1t75LpaMwnKpUWE15Sd.mTme4j8EemWz8wazdnjaQtalcEgv1Ve', 'customer', '2024-10-16 05:25:09'),
(3, 'akila', 'akila@gmail.com', '$2y$10$RVRHBrveP0.ZUyVLyjSH6.74ekrnbFLOamWTJ9JyrZYEguNzCue4.', 'customer', '2024-10-16 18:21:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `showtime_id` (`showtime_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
