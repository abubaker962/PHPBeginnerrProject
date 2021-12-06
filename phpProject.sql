-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2021 at 01:42 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `bookName` varchar(500) NOT NULL,
  `publisherName` varchar(500) NOT NULL,
  `isbnNumber` varchar(13) NOT NULL,
  `coverImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bookName`, `publisherName`, `isbnNumber`, `coverImage`) VALUES
(3, 'Data Structures', 'R. Dalton', '12345678910', 'download.jpeg'),
(4, 'OOP', 'Abu Baker', '334455667788', '1.jpg'),
(6, 'Indian Occupation', 'Abu Baker', '34554', 'pexels-pixabay-531321.jpg'),
(7, 'Indian Occupation', 'Abu Baker', '34554', 'pexels-pixabay-531321.jpg'),
(8, 'Indian Occupation', 'Abu Baker', '34554', 'pexels-pixabay-531321.jpg'),
(9, 'Indian Occupation', 'Abu Baker', '34554', 'pexels-pixabay-531321.jpg'),
(22, 'Usman', 'AbuBaker', '23456', 'pexels-pixabay-531321.jpg'),
(23, 'Usman2', 'Abu Baker', '4567800', 'pexels-pixabay-531321.jpg'),
(25, 'this is', '33', '333', 'pexels-pixabay-531321.jpg'),
(26, '33', '33', '33', 'pexels-pixabay-531321.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `books` ADD FULLTEXT KEY `bookName` (`bookName`,`publisherName`,`isbnNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
