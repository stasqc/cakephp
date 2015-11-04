-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2015 at 11:48 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thelibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'JRR Tolkien'),
(3, 'George RR Martin'),
(4, 'J. K. Rowling'),
(5, 'Suzanne Collins'),
(6, 'Ernest Hemingway'),
(7, 'Stephen King');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) NOT NULL,
  `title` varchar(45) NOT NULL,
  `datePublication` date NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `cover_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn_UNIQUE` (`isbn`),
  KEY `fk_book_author1_idx` (`author_id`),
  KEY `fk_book_cover1_idx` (`cover_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `datePublication`, `filename`, `author_id`, `cover_id`) VALUES
(2, '12314567890', 'Something', '2015-02-14', NULL, 1, 1),
(3, '1111111111112', 'The Two Towers', '2015-09-30', NULL, 1, 1),
(4, '1111111111113', 'Game of Thrones I', '2015-09-30', NULL, 3, 1),
(7, '0261102354', 'The Fellowship of the Ring', '2007-04-17', 'uploads/fellowship.jpg', 1, 1),
(8, '0261102737', 'The Silmarillion', '2007-08-01', 'uploads/silmar.jpg', 1, 1),
(9, '0007309368', 'Children of Hurin', '2010-11-15', 'uploads/childrenofhurin.jpg', 1, 2),
(10, '0618126996', 'Atlas of Middle-Earth', '2000-10-04', 'uploads/atlas.jpg', 1, 1),
(12, '3333333333330', 'Testing autocomplete', '2015-11-04', 'uploads/imagedragon.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `books_categories`
--

CREATE TABLE IF NOT EXISTS `books_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_categories_books1_idx` (`book_id`),
  KEY `fk_book_categories_categories1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `books_categories`
--

INSERT INTO `books_categories` (`id`, `book_id`, `category_id`) VALUES
(5, 3, 1),
(6, 3, 4),
(7, 4, 1),
(8, 4, 3),
(10, 2, 8),
(11, 2, 9),
(12, 2, 10),
(21, 7, 1),
(22, 7, 3),
(23, 7, 4),
(24, 8, 1),
(25, 9, 1),
(26, 10, 1),
(27, 10, 3),
(28, 10, 4),
(29, 10, 5),
(31, 12, 1),
(32, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `books_users`
--

CREATE TABLE IF NOT EXISTS `books_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservation_user1_idx` (`user_id`),
  KEY `fk_reservation_book1_idx` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `books_users`
--

INSERT INTO `books_users` (`id`, `user_id`, `book_id`) VALUES
(3, 2, 3),
(4, 5, 2),
(5, 2, 4),
(6, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Fantasy'),
(3, 'Arts & Photography'),
(4, 'Biographies & Memoirs'),
(5, 'Children''s Books'),
(6, 'Comics & Graphic Novels'),
(7, 'Computers & Technology'),
(8, 'Crafts, Hobbies & Home'),
(9, 'Education & Teaching'),
(10, 'Health, Fitness & Dieting'),
(11, 'History'),
(12, 'Mystery, Thriller & Suspense'),
(13, 'Science Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `covers`
--

CREATE TABLE IF NOT EXISTS `covers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `covers`
--

INSERT INTO `covers` (`id`, `type`) VALUES
(1, 'Hardcover'),
(2, 'Softcover');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateTaken` date NOT NULL,
  `dateDue` date NOT NULL,
  `dateReturned` date DEFAULT NULL,
  `books_users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservations_books_users1_idx` (`books_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `dateTaken`, `dateDue`, `dateReturned`, `books_users_id`) VALUES
(3, '2015-10-04', '2015-10-18', NULL, 3),
(4, '2015-10-04', '2015-10-18', NULL, 4),
(5, '2015-10-04', '2015-10-18', NULL, 5),
(6, '2015-10-12', '2015-10-26', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phoneNumber` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `phoneNumber`, `password`, `role`) VALUES
(1, 'Admin', 'admin@hotmail.com', 'Stan', '514-514-5145', '$2a$10$vPsfXW5phydYmRXScgrkBOBMq.1phfIj/TqYvSj.Ksi.AX61j4pna', 'Admin'),
(2, 'NotAdmin', 'notAdmin@hotmail.com', 'Someone', '514-514-5145', '$2a$10$FuvFI2C.s1FCwqE7NeWsa.uzLo8ksVa7sHsBxu/dQsWnXRUDqtC8u', 'User'),
(3, 'TestingUser', 'something@hotmail.com', 'Tester A', '(514)-514-5145', '$2a$10$oBfs/FR.n5UUrxIfSnELuOXyHPnjRMrFdoxl2eP8ITnNhydBC6eMa', 'Admin'),
(5, 'NotAdmin2', 'notadmin2@hotmail.com', 'Not Admin', '5145145145', '$2a$10$zRmIS7JXauPnLjw/UB1kGuas1IB5TNVcCEPFCA8QqEbmLXih4PEFm', 'User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_book_author1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_cover1` FOREIGN KEY (`cover_id`) REFERENCES `covers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `books_categories`
--
ALTER TABLE `books_categories`
  ADD CONSTRAINT `fk_book_categories_books1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_book_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `books_users`
--
ALTER TABLE `books_users`
  ADD CONSTRAINT `fk_reservation_book1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_books_users1` FOREIGN KEY (`books_users_id`) REFERENCES `books_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
