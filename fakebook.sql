-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 08:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`) VALUES
(12, 47, 1, 'hello urself daddyo'),
(23, 50, 2, 'who are u babay'),
(27, 53, 3, 'yooo kur veiksmas'),
(29, 54, 2, '*taip berniukui pupelių');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(48, 40, 1),
(49, 39, 1),
(50, 40, 2),
(51, 34, 2),
(52, 38, 2),
(53, 39, 2),
(54, 37, 2),
(55, 43, 2),
(56, 47, 1),
(57, 45, 1),
(58, 47, 2),
(59, 45, 2),
(60, 35, 2),
(61, 49, 3),
(62, 47, 3),
(63, 45, 3),
(64, 43, 3),
(65, 40, 3),
(66, 34, 3),
(67, 35, 3),
(68, 38, 3),
(69, 39, 3),
(70, 50, 3),
(71, 50, 1),
(72, 49, 1),
(73, 51, 1),
(74, 51, 2),
(75, 43, 1),
(76, 52, 3),
(77, 53, 3),
(78, 54, 1),
(79, 56, 1),
(80, 67, 1),
(81, 70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` varchar(3000) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `likes` int(6) DEFAULT 0,
  `comments` int(6) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `image`, `post_date`, `likes`, `comments`) VALUES
(40, 1, 'bull', NULL, '2021-06-03 11:37:00', 3, 0),
(43, 2, 'labas krabas', NULL, '2021-06-03 14:43:04', 3, 0),
(47, 1, 'henlo folks', NULL, '2021-06-03 15:49:28', 3, 1),
(49, 3, 'ayeeeeeeeewwueueeeyeeep', NULL, '2021-06-03 16:40:00', 2, 0),
(50, 3, 'im da last muchkin deal with it haha', NULL, '2021-06-06 22:45:39', 2, 1),
(53, 3, 'wazap fellou humanz ;))', NULL, '2021-06-10 18:50:39', 1, 1),
(54, 2, 'yeah boy some beans', NULL, '2021-06-10 18:58:07', 1, 1),
(56, 1, 'sometimes i feel like small daddy :)', NULL, '2021-06-10 19:34:36', 1, 0),
(67, 1, 'daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto daug teksto ', 'uploads/d8d9be89925a49b781b2bd59ca717af0.jpg', '2021-06-11 19:08:50', 1, 0),
(69, 1, 'monekey', 'uploads/monky.jpg', '2021-06-11 19:11:51', 0, 0),
(70, 1, 'onemoree', 'uploads/118029537_748985859009239_8487576388921379518_n.jpg', '2021-06-11 19:36:10', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `picture`) VALUES
(1, 'BigDaddy', 'abcd1234', 'pictures/bigdaddy.jpg'),
(2, 'SomeBeans', 'aaaa1111', 'pictures/somebeans.jpg'),
(3, 'Munchkin', 'mmmm1111', 'pictures/munchkin.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
