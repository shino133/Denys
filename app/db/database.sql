-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2024 at 02:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denys`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_table`
--

CREATE TABLE `comments_table` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `content` text,
  `mediaType` varchar(255) DEFAULT NULL,
  `mediaUrl` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `createdAt` timestamp NULL DEFAULT (now()),
  `updatedAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts_table`
--

CREATE TABLE `posts_table` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `content` text,
  `mediaType` varchar(255) DEFAULT NULL,
  `mediaUrl` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `createdAt` timestamp NULL DEFAULT (now()),
  `updatedAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments_table`
--

CREATE TABLE `post_comments_table` (
  `id` int NOT NULL,
  `postId` int NOT NULL,
  `commentsId` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes_table`
--

CREATE TABLE `post_likes_table` (
  `id` int NOT NULL,
  `postId` int NOT NULL,
  `userId` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatarUrl` varchar(255) DEFAULT NULL,
  `role` tinyint DEFAULT '2',
  `verifyEmailAt` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `createdAt` timestamp NULL DEFAULT (now()),
  `updatedAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_follows_table`
--

CREATE TABLE `user_follows_table` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `followerId` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles_table`
--

CREATE TABLE `user_profiles_table` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `bannerUrl` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `socialAccounts` json DEFAULT NULL,
  `bio` text,
  `status` varchar(255) DEFAULT 'active',
  `createdAt` timestamp NULL DEFAULT (now()),
  `updatedAt` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_table`
--
ALTER TABLE `comments_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_table_userId_users_table_id_fk` (`userId`),
  ADD KEY `mediaType_idx` (`mediaType`),
  ADD KEY `status_idx` (`status`);

--
-- Indexes for table `posts_table`
--
ALTER TABLE `posts_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_table_userId_users_table_id_fk` (`userId`),
  ADD KEY `mediaType_idx` (`mediaType`),
  ADD KEY `status_idx` (`status`);

--
-- Indexes for table `post_comments_table`
--
ALTER TABLE `post_comments_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId_idx` (`postId`),
  ADD KEY `commentsId_idx` (`commentsId`);

--
-- Indexes for table `post_likes_table`
--
ALTER TABLE `post_likes_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId_idx` (`postId`),
  ADD KEY `userId_idx` (`userId`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_table_userName_unique` (`userName`),
  ADD UNIQUE KEY `users_table_email_unique` (`email`),
  ADD KEY `role_idx` (`role`),
  ADD KEY `status_idx` (`status`);

--
-- Indexes for table `user_follows_table`
--
ALTER TABLE `user_follows_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId_idx` (`userId`),
  ADD KEY `followerId_idx` (`followerId`);

--
-- Indexes for table `user_profiles_table`
--
ALTER TABLE `user_profiles_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_table_userId_users_table_id_fk` (`userId`),
  ADD KEY `status_idx` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_table`
--
ALTER TABLE `comments_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts_table`
--
ALTER TABLE `posts_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_comments_table`
--
ALTER TABLE `post_comments_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes_table`
--
ALTER TABLE `post_likes_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_follows_table`
--
ALTER TABLE `user_follows_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles_table`
--
ALTER TABLE `user_profiles_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments_table`
--
ALTER TABLE `comments_table`
  ADD CONSTRAINT `comments_table_userId_users_table_id_fk` FOREIGN KEY (`userId`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `posts_table`
--
ALTER TABLE `posts_table`
  ADD CONSTRAINT `posts_table_userId_users_table_id_fk` FOREIGN KEY (`userId`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `post_comments_table`
--
ALTER TABLE `post_comments_table`
  ADD CONSTRAINT `post_comments_table_commentsId_comments_table_id_fk` FOREIGN KEY (`commentsId`) REFERENCES `comments_table` (`id`),
  ADD CONSTRAINT `post_comments_table_postId_posts_table_id_fk` FOREIGN KEY (`postId`) REFERENCES `posts_table` (`id`);

--
-- Constraints for table `post_likes_table`
--
ALTER TABLE `post_likes_table`
  ADD CONSTRAINT `post_likes_table_postId_posts_table_id_fk` FOREIGN KEY (`postId`) REFERENCES `posts_table` (`id`),
  ADD CONSTRAINT `post_likes_table_userId_users_table_id_fk` FOREIGN KEY (`userId`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `user_follows_table`
--
ALTER TABLE `user_follows_table`
  ADD CONSTRAINT `user_follows_table_followerId_users_table_id_fk` FOREIGN KEY (`followerId`) REFERENCES `users_table` (`id`),
  ADD CONSTRAINT `user_follows_table_userId_users_table_id_fk` FOREIGN KEY (`userId`) REFERENCES `users_table` (`id`);

--
-- Constraints for table `user_profiles_table`
--
ALTER TABLE `user_profiles_table`
  ADD CONSTRAINT `user_profiles_table_userId_users_table_id_fk` FOREIGN KEY (`userId`) REFERENCES `users_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
