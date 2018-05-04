-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2018 at 05:28 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` int(191) NOT NULL,
  `user_two` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(9, 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `user_requested` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `requester`, `user_requested`, `status`) VALUES
(23, 12, 16, 0),
(24, 12, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_from` int(191) NOT NULL,
  `user_to` int(191) NOT NULL,
  `conversation_id` int(191) NOT NULL,
  `msg` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_from`, `user_to`, `conversation_id`, `msg`, `status`) VALUES
(126, 12, 16, 7, 'Hello B...', 1),
(127, 16, 16, 7, 'hey!', 1),
(149, 12, 13, 8, 'hi', 1),
(171, 12, 13, 9, 'hey', 1),
(172, 13, 13, 9, 'hi..', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_12_073203_create_profile_table', 2),
(4, '2018_04_12_143628_drop_profile_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_logged` int(11) NOT NULL,
  `user_hero` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` varchar(191) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_logged`, `user_hero`, `status`, `note`, `updated_at`, `created_at`) VALUES
(16, 13, 12, 0, 'accepted your friend request', '2018-04-29 15:33:49', '2018-04-29 07:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 'This is demo post- a', 0, '2018-04-21 07:17:21', '0000-00-00 00:00:00'),
(2, 12, 'Try- post for example', 0, '2018-04-21 07:18:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `about` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `city`, `country`, `about`, `updated_at`, `created_at`) VALUES
(2, 12, 'demo city', 'demo country', 'about demo', '2018-04-16 02:41:59', '2018-04-12 07:04:49'),
(3, 13, 'London', 'UK', 'aa about details', '2018-04-20 06:36:38', '2018-04-12 21:23:13'),
(4, 14, 'demo', 'demo', 'demo about', '2018-04-17 04:10:08', '2018-04-15 22:32:34'),
(5, 15, 'London', 'UK', 'BBB about', '2018-04-16 06:55:43', '2018-04-15 22:33:16'),
(6, 16, 'B City', 'B Country', 'bbb about', '2018-04-18 05:01:44', '2018-04-17 20:58:00'),
(7, 17, 'C Sample', 'C country', 'ccc About', '2018-04-18 05:00:11', '2018-04-17 20:58:39'),
(8, 18, 'd city', 'd country', 'ddd about', '2018-04-24 05:28:26', '2018-04-23 21:27:10'),
(9, 19, 'test city', 'test country', 'test about', '2018-04-24 08:08:21', '2018-04-24 00:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `pic`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'try', 'try', 'try', '5jPjlmDr.jpg', 'try@mail.com', '$2y$10$bNg0VgoFeUlkMuZ66xCnO.c71rPpmJmyitvSTmCEHDxrbJ/05LPpq', 'Zm1UGEJGlfZsBbYidtFiqHY8f8LQLJnsbLKIdc63MeQ60rZkEImnvOsKZRne', '2018-04-12 07:04:49', '2018-04-12 07:04:49'),
(13, 'a', 'a', 'a', 'depositphotos_110583994-stock-illustration-female-cartoon-avatar.jpg', 'a@mail.com', '$2y$10$I0FqJzdxqxoA35MGz6dU0OyVPKk3I3jNcXdH64ufSmm.LtGuxkXxm', 'S42SWwYmcF07jDOlxOiJs7Q4WIDHB5yJz20ON9Dhq5mIjr6Faw9tie7mbRdY', '2018-04-12 21:23:13', '2018-04-12 21:23:13'),
(14, 'demo', 'demo', 'demo', 'smiling-men-avatar.jpg', 'demo@mail.com', '$2y$10$LJ6tO24c3ECL3hYdf8PxZu2oS7e9OZdS9.etdC585I5wBb9QqcIHy', 'FM1q5npHwMoNFThKtb92HDOcqHYwUApKgsv4VyrEBd45m9MbAhIOSkobYWWt', '2018-04-15 22:32:33', '2018-04-15 22:32:33'),
(16, 'bbb', 'bbb', 'bbb', 'profile-icon-male-emotion-avatar-hipster-man-vector-15173610.jpg', 'b@mail.com', '$2y$10$b.hiapfmgih5O6AVi1yE8udyFmPltdOMnKqd/79SDj13uhsNazu7i', 'kLzyUVFvkghTQlEA1UHSfLnJmNjnbaWKU7jJ49fCBOFWXP3uLrr1HPbJMqOZ', '2018-04-17 20:58:00', '2018-04-17 20:58:00'),
(17, 'ccc', 'ccc', 'ccc', 'depositphotos_110992516-stock-illustration-female-cartoon-avatar-icon.jpg', 'ccc@mail.com', '$2y$10$f0ZMTWrFeBWQVPJT3FfD0.o4qIm7Tm.HLnB7Mv7nZitD2y2w7dO0a', 'YIBHoZajfJ8Fky5HxEY7dJaKEtnpofpopPsrtC9A1WRtENURUhZlibG8Rfqq', '2018-04-17 20:58:39', '2018-04-17 20:58:39'),
(18, 'ddd', 'ddd', 'ddd', 'smiling-men-avatar.jpg', 'ddd@mail.com', '$2y$10$YXJxxXUCqVkgxLmt.F6s5.NZynv4MMuRz1HZp3ppbSN2PZ2J1MMIq', 'liNZOKaL7s7bECPNG6HIUvvGTBLeamXjCPW4AbXqkkTYbvJtTcaz6wSOxl9B', '2018-04-23 21:27:10', '2018-04-23 21:27:10'),
(19, 'test', 'test1', 'test1', 'images1.png', 'test@mail.com', '$2y$10$NsMC7vbYMIEvYE2Ju006LuyrD1EK/QPqW/hDrbzvJU8mCPAoAnzfy', 'YBIasKl1ZfuQr42m3fy3fCwvyoBlysIPewJxvo6lOm7Dx8wHNfMXX6d9t1Si', '2018-04-24 00:06:52', '2018-04-24 00:06:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
