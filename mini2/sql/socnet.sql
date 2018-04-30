-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 06:14 PM
-- Server version: 5.6.36
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `IDimg` int(5) NOT NULL,
  `imgName` varchar(256) NOT NULL,
  `foreignID` int(5) NOT NULL,
  `catID` int(1) NOT NULL,
  `isMainPic` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`IDimg`, `imgName`, `foreignID`, `catID`, `isMainPic`) VALUES
(1, 'pic-coming-soon.jpg', 3, 3, 1),
(2, 'pic-coming-soon.jpg', 4, 3, 1),
(3, 'pic-coming-soon.jpg', 5, 3, 1),
(4, 'pic-coming-soon.jpg', 6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `IDmbr` int(5) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(15) NOT NULL,
  `pswd` varchar(256) NOT NULL,
  `joinTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`IDmbr`, `firstName`, `lastName`, `email`, `user`, `pswd`, `joinTime`) VALUES
(1, 'Brian', 'McClain', 'brian.mcclain@codeimmersives.com', 'Brian1', '$2y$10$riut7HfHSv0GCnKSgOaDvulASwCDd6rN2T/ykuz.QzGLUi/Z8Z3ya', '2018-04-11 18:53:13'),
(2, 'Tony', 'Oliva', 'toa@asod.com', 'TonyO', '$2y$10$CjvwXN31hHNsDVUs6l0wQep89oZuoSM3zwI42qhcQ.Tuj0bzET80G', '2018-04-11 19:17:55'),
(3, 'Rod', 'Carew', 'sadfasd@asdfo.co', 'Rodney29', '$2y$10$SpwYqWyfyNYrslHZ7exkX.kjTJQUm9XuWxem4dqStp2i46iuOLjnq', '2018-04-11 19:41:14'),
(4, 'Harmon', 'Killebrew', 'asdf@asdf.com', 'Harmon', '$2y$10$i13F85cvtquNO78o7BzDvuV9cm6aZI/AQ9mMFo1HYqDZOAk0uspfe', '2018-04-11 19:53:30'),
(5, 'Max', 'McCoy', 'jk@mets.com', 'Maximum', '$2y$10$GHa5GNbE8HQnnaMt6vX0M.S/tYW02pJ1XIWq6F5XyDsthMHMQcUjm', '2018-04-12 12:40:50'),
(6, 'Hank', 'Aaron', 'hank@dfaf.com', 'Hank44', '$2y$10$eGRBjVYyUgZiYme.N7SNQuDCyd9C2EiaGBBHynWXhtB6V.hYzTURK', '2018-04-12 14:50:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`IDimg`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`IDmbr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `IDimg` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `IDmbr` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
