-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 10:47 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `club_size`
--

CREATE TABLE IF NOT EXISTS `club_size` (
  `ClubID` int(50) NOT NULL AUTO_INCREMENT,
  `NoOfTables` int(11) NOT NULL,
  PRIMARY KEY (`ClubID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `club_size`
--

INSERT INTO `club_size` (`ClubID`, `NoOfTables`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `game_details`
--

CREATE TABLE IF NOT EXISTS `game_details` (
  `GameTypeID` int(50) NOT NULL AUTO_INCREMENT,
  `GameTypeName` varchar(50) NOT NULL,
  `GameDuration(Min)` int(50) NOT NULL,
  `GameRate` int(50) NOT NULL,
  `ExtraTime(Min)` int(50) NOT NULL,
  PRIMARY KEY (`GameTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `game_details`
--

INSERT INTO `game_details` (`GameTypeID`, `GameTypeName`, `GameDuration(Min)`, `GameRate`, `ExtraTime(Min)`) VALUES
(1, 'Single', 1, 250, 2),
(2, 'Double', 45, 500, 5),
(3, 'Timer', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `game_transactions`
--

CREATE TABLE IF NOT EXISTS `game_transactions` (
  `GameID` int(50) NOT NULL AUTO_INCREMENT,
  `GameTypeID` int(50) DEFAULT NULL,
  `GameDate` date NOT NULL,
  `TableID` int(50) DEFAULT NULL,
  `StartTime` time NOT NULL,
  `PauseTime` time NOT NULL,
  `ResumeTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `TotalPauseTime` time NOT NULL,
  `ExtraTime` time NOT NULL,
  `Player1ID` int(50) NOT NULL,
  `Player1Name` varchar(100) NOT NULL,
  `Player2ID` int(50) NOT NULL,
  `Player2Name` varchar(100) NOT NULL,
  `Player3ID` int(50) NOT NULL,
  `Player3Name` varchar(100) NOT NULL,
  `Player4ID` int(50) NOT NULL,
  `Player4Name` varchar(100) NOT NULL,
  `WinnerID` varchar(50) NOT NULL,
  `WinnerName` varchar(100) NOT NULL,
  `LoserID` varchar(50) NOT NULL,
  `LoserName` varchar(100) NOT NULL,
  `LoggedBy` varchar(100) NOT NULL,
  PRIMARY KEY (`GameID`),
  KEY `GameTypeID` (`GameTypeID`),
  KEY `TableID` (`TableID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `game_transactions`
--

INSERT INTO `game_transactions` (`GameID`, `GameTypeID`, `GameDate`, `TableID`, `StartTime`, `PauseTime`, `ResumeTime`, `EndTime`, `TotalPauseTime`, `ExtraTime`, `Player1ID`, `Player1Name`, `Player2ID`, `Player2Name`, `Player3ID`, `Player3Name`, `Player4ID`, `Player4Name`, `WinnerID`, `WinnerName`, `LoserID`, `LoserName`, `LoggedBy`) VALUES
(1, 1, '2017-08-01', NULL, '05:17:39', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(2, 1, '2017-08-01', NULL, '05:17:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(3, 1, '2017-08-01', NULL, '05:18:16', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(4, 2, '2017-08-01', NULL, '05:18:18', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(5, 1, '2017-08-01', NULL, '05:25:02', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(6, 1, '2017-08-01', NULL, '05:25:48', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(7, 1, '2017-08-01', NULL, '05:26:05', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(8, 3, '2017-08-01', NULL, '05:26:08', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(9, 1, '2017-08-01', NULL, '05:27:19', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(10, 1, '2017-08-01', 1, '05:34:10', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(11, 3, '2017-08-01', 4, '05:34:18', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(12, 1, '2017-08-01', 2, '06:31:22', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(13, 1, '2017-08-01', 2, '06:39:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(14, 1, '2017-08-02', 1, '23:11:28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(15, 1, '2017-08-03', 1, '02:19:10', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(16, 1, '2017-08-03', 1, '03:48:34', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(17, 1, '2017-08-03', 1, '03:52:13', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(18, 1, '2017-08-03', 1, '04:12:55', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(19, 1, '2017-08-03', 1, '06:19:51', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(20, 1, '2017-08-03', 1, '06:23:23', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(21, 1, '2017-08-03', 1, '06:35:35', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(22, 1, '2017-08-03', 1, '06:42:37', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(23, 1, '2017-08-03', 1, '06:50:25', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(24, 1, '2017-08-03', 1, '06:51:55', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(25, 1, '2017-08-03', 1, '06:54:11', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(26, 1, '2017-08-03', 1, '06:56:37', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(27, 1, '2017-08-04', 1, '00:47:41', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(28, 1, '2017-08-04', 1, '01:01:36', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(29, 1, '2017-08-04', 1, '01:03:06', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(30, 1, '2017-08-04', 1, '01:05:23', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(31, 1, '2017-08-04', 1, '01:13:25', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(32, 1, '2017-08-04', 1, '01:20:25', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(33, 1, '2017-08-04', 1, '01:47:28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(34, 1, '2017-08-04', 1, '01:59:33', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(35, 1, '2017-08-04', 1, '02:07:55', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(36, 1, '2017-08-04', 1, '02:25:39', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(37, 1, '2017-08-04', 1, '02:33:53', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(38, 1, '2017-08-04', 1, '02:34:29', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(39, 1, '2017-08-04', 1, '02:36:46', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(40, 1, '2017-08-04', 1, '02:38:46', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(41, 1, '2017-08-04', 1, '02:41:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(42, 1, '2017-08-04', 1, '02:43:53', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(43, 1, '2017-08-04', 1, '02:46:49', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(44, 1, '2017-08-04', 1, '02:47:01', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(45, 1, '2017-08-04', 1, '02:49:27', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(46, 1, '2017-08-04', 1, '02:51:40', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(47, 1, '2017-08-04', 1, '02:57:20', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(48, 1, '2017-08-04', 1, '02:58:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(49, 1, '2017-08-04', 1, '02:59:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(50, 1, '2017-08-04', 1, '03:01:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(51, 1, '2017-08-04', 1, '03:02:21', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(52, 1, '2017-08-04', 1, '03:05:23', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(53, 1, '2017-08-04', 1, '03:06:52', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(54, 1, '2017-08-04', 1, '03:08:33', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(55, 1, '2017-08-04', 1, '03:45:57', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(56, 1, '2017-08-04', 1, '03:47:02', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(57, 1, '2017-08-04', 1, '03:48:19', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(58, 1, '2017-08-04', 1, '03:51:11', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(59, 1, '2017-08-04', 1, '05:13:35', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', ''),
(60, 1, '2017-08-04', 1, '06:02:48', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(61, 1, '2017-08-04', 1, '06:20:13', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(62, 1, '2017-08-04', 1, '06:23:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(63, 1, '2017-08-04', 1, '06:27:37', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(64, 1, '2017-08-04', 1, '06:29:40', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(65, 1, '2017-08-04', 1, '06:31:11', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(66, 1, '2017-08-04', 1, '06:34:18', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(67, 1, '2017-08-04', 1, '06:35:47', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(68, 1, '2017-08-04', 1, '06:36:58', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(69, 1, '2017-08-04', 1, '06:38:50', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(70, 1, '2017-08-04', 1, '06:41:19', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(71, 1, '2017-08-04', 1, '06:45:25', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(72, 1, '2017-08-04', 1, '06:47:28', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(73, 1, '2017-08-04', 1, '06:48:41', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(74, 1, '2017-08-04', 1, '06:57:53', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(75, 1, '2017-08-04', 1, '07:11:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(76, 1, '2017-08-04', 1, '07:25:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(77, 1, '2017-08-04', 1, '07:26:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(78, 1, '2017-08-04', 2, '07:28:06', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(79, 1, '2017-08-04', 2, '07:28:50', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(80, 1, '2017-08-04', 1, '07:36:54', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(81, 1, '2017-08-04', 1, '07:38:27', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(82, 1, '2017-08-04', 1, '07:40:23', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(83, 1, '2017-08-04', 1, '07:42:36', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(84, 1, '2017-08-04', 1, '07:43:03', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(85, 1, '2017-08-04', 1, '07:48:45', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(86, 1, '2017-08-04', 1, '07:49:15', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(87, 1, '2017-08-04', 1, '07:56:36', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(88, 1, '2017-08-05', 1, '03:58:59', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(89, 1, '2017-08-05', 1, '04:00:46', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '0', '', '0', '0', 'admin'),
(90, 1, '2017-08-05', 1, '06:38:56', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 9, 'Hammad afzal', 0, '', 7, 'WAQAS AFZAL', 0, '', '0', '', '0', '0', 'admin'),
(91, 1, '2017-08-05', 2, '06:41:23', '06:41:27', '00:00:00', '06:44:05', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(92, 1, '2017-08-05', 1, '07:07:51', '00:00:00', '00:00:00', '07:08:01', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(93, 1, '2017-08-05', 1, '07:09:15', '00:00:00', '00:00:00', '07:09:26', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '0', '', '0', '0', 'admin'),
(94, 1, '2017-08-05', 1, '07:09:51', '00:00:00', '00:00:00', '07:10:10', '00:00:00', '00:00:00', 8, 'RAZI', 0, '', 7, 'WAQAS AFZAL', 0, '', '0', '', '0', '0', 'admin'),
(95, 1, '2017-08-05', 2, '07:10:59', '00:00:00', '00:00:00', '07:11:10', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '0', '', '0', '0', 'admin'),
(96, 1, '2017-08-05', 1, '07:11:51', '00:00:00', '00:00:00', '07:12:05', '00:00:00', '00:00:00', 8, 'RAZI', 0, '', 7, 'WAQAS AFZAL', 0, '', '0', '', '0', '0', 'admin'),
(97, 1, '2017-08-06', 1, '02:42:08', '00:00:00', '00:00:00', '02:44:35', '00:00:00', '00:00:00', 19, 'Shahzaib Waseem', 0, '', 61, 'Jawad Adil', 0, '', '0', '', '0', '0', 'admin'),
(98, 1, '2017-08-06', 1, '02:48:03', '00:00:00', '00:00:00', '02:48:26', '00:00:00', '00:00:00', 33, 'jawad mirza', 0, '', 19, 'Shahzaib Waseem', 0, '', '0', '', '0', '0', 'admin'),
(99, 1, '2017-08-06', 1, '03:54:15', '00:00:00', '00:00:00', '03:54:38', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '0', '', '0', '0', 'admin'),
(100, 2, '2017-08-06', 2, '03:55:28', '00:00:00', '00:00:00', '03:55:58', '00:00:00', '00:00:00', 19, 'Shahzaib Waseem', 7, 'WAQAS AFZAL', 8, 'RAZI', 194, 'asad jamil', '19', 'Shahzaib Waseem', '8', 'RAZI/asad jamil', 'admin'),
(101, 1, '2017-08-06', 1, '04:03:54', '04:04:36', '00:00:00', '04:04:47', '00:00:00', '00:00:00', 33, 'jawad mirza', 0, '', 61, 'Jawad Adil', 0, '', '33', 'jawad mirza', '61', 'Jawad Adil', 'admin'),
(102, 2, '2017-08-06', 2, '04:05:40', '00:00:00', '00:00:00', '04:06:14', '00:00:00', '00:00:00', 26, 'Murad Azeem', 7, 'WAQAS AFZAL', 8, 'RAZI', 194, 'asad jamil', '26', 'Murad Azeem', '8', 'RAZI/asad jamil', 'admin'),
(103, 2, '2017-08-06', 2, '04:07:03', '00:00:00', '00:00:00', '04:09:12', '00:00:00', '00:00:00', 0, '', 0, '', 0, '', 0, '', '26', 'Murad Azeem', '8', 'RAZI/asad jamil', 'admin'),
(104, 1, '2017-08-06', 1, '04:09:28', '00:00:00', '00:00:00', '04:09:44', '00:00:00', '00:00:00', 9, 'Hammad afzal', 0, '', 7, 'WAQAS AFZAL', 0, '', '9', 'Hammad afzal', '7', 'WAQAS AFZAL', 'admin'),
(105, 2, '2017-08-06', 2, '04:10:05', '00:00:00', '00:00:00', '04:11:09', '00:00:00', '00:00:00', 11, 'jabran hammad', 7, 'WAQAS AFZAL', 8, 'RAZI', 194, 'asad jamil', '11', 'jabran hammad/WAQAS AFZAL', '8', 'RAZI/asad jamil', 'admin'),
(106, 1, '2017-08-06', 1, '05:33:43', '00:00:00', '00:00:00', '05:33:46', '00:00:00', '00:00:00', 0, 'Player1Name', 0, 'Player2Name', 0, 'Player3Name', 0, 'Player4Name', '0', 'Player1', '0', 'Player2', 'admin'),
(107, 1, '2017-08-06', 1, '05:36:21', '00:00:00', '00:00:00', '05:36:26', '00:00:00', '00:00:00', 0, 'Player1Name', 0, 'Player2Name', 0, 'Player3Name', 0, 'Player4Name', '0', 'Player1', '0', 'Player2', 'admin'),
(108, 1, '2017-08-06', 1, '05:38:52', '00:00:00', '00:00:00', '05:42:48', '00:00:00', '00:00:00', 9, 'Hammad afzal', 0, '', 19, 'Shahzaib Waseem', 0, '', '9', 'Hammad afzal', '19', 'Shahzaib Waseem', 'admin'),
(109, 1, '2017-08-07', 1, '03:13:08', '00:00:00', '00:00:00', '03:13:42', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 33, 'jawad mirza', 0, '', '7', 'WAQAS AFZAL', '33', 'jawad mirza', 'admin'),
(110, 2, '2017-08-07', 1, '03:14:07', '00:00:00', '00:00:00', '03:15:00', '00:00:00', '00:00:00', 50, 'mohsin wajid', 7, 'WAQAS AFZAL', 33, 'jawad mirza', 8, 'RAZI', '50/7', 'mohsin wajid/WAQAS AFZAL', '33/8', 'jawad mirza/RAZI', 'admin'),
(111, 3, '2017-08-07', 1, '03:15:31', '00:00:00', '00:00:00', '03:20:05', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 7, 'WAQAS AFZAL', 33, 'jawad mirza', 8, 'RAZI', '7/7', 'WAQAS AFZAL/WAQAS AFZAL', '33/8', 'jawad mirza/RAZI', 'admin'),
(112, 1, '2017-08-07', 1, '03:20:41', '00:00:00', '00:00:00', '03:22:57', '00:00:00', '00:00:00', 194, 'asad jamil', 7, 'WAQAS AFZAL', 11, 'jabran hammad', 8, 'RAZI', '194/7', 'asad jamil/WAQAS AFZAL', '11/8', 'jabran hammad/RAZI', 'admin'),
(113, 1, '2017-08-07', 1, '03:26:26', '00:00:00', '00:00:00', '03:29:30', '00:00:00', '00:00:00', 36, 'B J', 0, '', 56, 'Ijaz Ali', 0, '', '36', 'B J', '56', 'Ijaz Ali', 'admin'),
(114, 1, '2017-08-07', 1, '03:30:03', '00:00:00', '00:00:00', '03:30:38', '00:00:00', '00:00:00', 36, 'B J', 0, '', 56, 'Ijaz Ali', 0, '', '56', 'Ijaz Ali', '36', 'B J', 'admin'),
(115, 1, '2017-08-07', 1, '03:39:19', '00:00:00', '00:00:00', '03:39:30', '00:00:00', '00:00:00', 9, 'Hammad afzal', 0, '', 8, 'RAZI', 0, '', '8', 'RAZI', '9', 'Hammad afzal', 'admin'),
(116, 1, '2017-08-07', 1, '03:49:06', '00:00:00', '00:00:00', '03:50:55', '00:00:00', '00:00:00', 30, 'Asad Hashmi', 0, '', 194, 'asad jamil', 0, '', '30', 'Asad Hashmi', '194', 'asad jamil', 'admin'),
(117, 1, '2017-08-07', 1, '03:51:24', '00:00:00', '00:00:00', '03:52:16', '00:00:00', '00:00:00', 194, 'asad jamil', 0, '', 8, 'RAZI', 0, '', '194', 'asad jamil', '8', 'RAZI', 'admin'),
(118, 1, '2017-08-07', 1, '03:52:31', '03:52:57', '00:00:00', '03:53:05', '00:00:00', '00:00:00', 19, 'Shahzaib Waseem', 0, '', 7, 'WAQAS AFZAL', 0, '', '7', 'WAQAS AFZAL', '19', 'Shahzaib Waseem', 'admin'),
(119, 1, '2017-08-07', 1, '03:53:51', '00:00:00', '00:00:00', '03:54:39', '00:00:00', '00:00:00', 29, 'Ashar Haq', 0, '', 7, 'WAQAS AFZAL', 0, '', '', '', '', '', 'admin'),
(120, 1, '2017-08-07', 2, '03:53:58', '00:00:00', '00:00:00', '03:59:12', '00:00:00', '00:00:00', 0, 'Player1Name', 0, 'Player2Name', 0, 'Player3Name', 0, 'Player4Name', '', '', '', '', 'admin'),
(121, 1, '2017-08-07', 1, '03:55:49', '00:00:00', '00:00:00', '03:56:02', '00:00:00', '00:00:00', 0, 'Player1Name', 0, 'Player2Name', 0, 'Player3Name', 0, 'Player4Name', '', '', '', '', 'admin'),
(122, 1, '2017-08-07', 1, '03:56:07', '00:00:00', '00:00:00', '03:56:23', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '', '', '', '', 'admin'),
(123, 1, '2017-08-07', 1, '03:59:22', '00:00:00', '00:00:00', '03:59:37', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '8', 'RAZI', '7', 'WAQAS AFZAL', 'admin'),
(124, 1, '2017-08-10', 1, '04:36:25', '00:00:00', '00:00:00', '04:36:37', '00:00:00', '00:00:00', 7, 'WAQAS AFZAL', 0, '', 8, 'RAZI', 0, '', '7', 'WAQAS AFZAL', '8', 'RAZI', 'admin'),
(125, 1, '2017-08-10', 2, '04:36:41', '00:00:00', '00:00:00', '04:36:54', '00:00:00', '00:00:00', 29, 'Ashar Haq', 0, '', 30, 'Asad Hashmi', 0, '', '29', 'Ashar Haq', '30', 'Asad Hashmi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `player_select_stage`
--

CREATE TABLE IF NOT EXISTS `player_select_stage` (
  `PlayerSelectStageID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerSelectStageName` varchar(50) NOT NULL,
  `player1-select` bit(1) NOT NULL,
  `player2-select` bit(1) NOT NULL,
  `player3-select` bit(1) NOT NULL,
  `player4-select` bit(1) NOT NULL,
  `check-player-btn` bit(1) NOT NULL,
  PRIMARY KEY (`PlayerSelectStageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `player_select_stage`
--

INSERT INTO `player_select_stage` (`PlayerSelectStageID`, `PlayerSelectStageName`, `player1-select`, `player2-select`, `player3-select`, `player4-select`, `check-player-btn`) VALUES
(1, 'Single', b'1', b'1', b'0', b'0', b'1'),
(2, 'Single', b'0', b'0', b'0', b'0', b'0'),
(3, 'Double', b'1', b'1', b'1', b'1', b'1'),
(4, 'Double', b'0', b'0', b'0', b'0', b'0'),
(5, 'Timer', b'1', b'0', b'0', b'0', b'1'),
(6, 'Timer', b'0', b'0', b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `table_stage`
--

CREATE TABLE IF NOT EXISTS `table_stage` (
  `TableStageID` int(50) NOT NULL AUTO_INCREMENT,
  `TableStageName` varchar(50) NOT NULL,
  `clock` bit(1) NOT NULL,
  `extraTimeClock` bit(1) NOT NULL,
  `endBtn` bit(1) NOT NULL,
  `pauseBtn` bit(1) NOT NULL,
  `playBtn` bit(1) NOT NULL,
  `extraBtn` bit(1) NOT NULL,
  `player1Btn` bit(1) NOT NULL,
  `player2Btn` bit(1) NOT NULL,
  `finishedBtn` bit(1) NOT NULL,
  `restartBtn` bit(1) NOT NULL,
  PRIMARY KEY (`TableStageID`),
  KEY `TableStageName` (`TableStageName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `table_stage`
--

INSERT INTO `table_stage` (`TableStageID`, `TableStageName`, `clock`, `extraTimeClock`, `endBtn`, `pauseBtn`, `playBtn`, `extraBtn`, `player1Btn`, `player2Btn`, `finishedBtn`, `restartBtn`) VALUES
(1, 'StartGame', b'1', b'0', b'1', b'1', b'0', b'0', b'0', b'0', b'0', b'0'),
(2, 'PauseGame', b'1', b'0', b'1', b'0', b'1', b'0', b'0', b'0', b'0', b'0'),
(3, 'TimerEnd', b'1', b'0', b'1', b'0', b'0', b'1', b'0', b'0', b'0', b'0'),
(4, 'ExtraTime', b'0', b'1', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0'),
(5, 'ChooseWinner', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1', b'0', b'0'),
(6, 'EndGame', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'0', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `table_state`
--

CREATE TABLE IF NOT EXISTS `table_state` (
  `TableID` int(50) NOT NULL AUTO_INCREMENT,
  `GameTypeID` int(50) DEFAULT NULL,
  `GameID` int(50) DEFAULT NULL,
  `TableStageID` int(50) DEFAULT NULL,
  `PlayerSelectStageID` int(11) DEFAULT NULL,
  `ClockFace` time NOT NULL,
  `StartTime` time NOT NULL,
  `PauseTime` time NOT NULL,
  `ResumeTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `ClockFaceExtra` time NOT NULL,
  `ExtraTime` time NOT NULL,
  `TotalPauseTime` time NOT NULL,
  PRIMARY KEY (`TableID`),
  KEY `GameTypeID` (`GameTypeID`),
  KEY `TableStageID` (`TableStageID`),
  KEY `PlayerSelectStageID` (`PlayerSelectStageID`),
  KEY `GameID` (`GameID`),
  KEY `GameID_2` (`GameID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_state`
--

INSERT INTO `table_state` (`TableID`, `GameTypeID`, `GameID`, `TableStageID`, `PlayerSelectStageID`, `ClockFace`, `StartTime`, `PauseTime`, `ResumeTime`, `EndTime`, `ClockFaceExtra`, `ExtraTime`, `TotalPauseTime`) VALUES
(1, 1, 124, NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:36:37', '00:00:00', '00:00:00', '00:00:00'),
(2, 1, 125, NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '04:36:54', '00:00:00', '00:00:00', '00:00:00'),
(3, 1, 7, NULL, 1, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '05:27:06', '00:00:00', '00:00:00', '00:00:00'),
(4, 3, 11, NULL, 5, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '03:52:38', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(50) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `AccessLevel` int(3) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `FirstName`, `LastName`, `ContactNo`, `Address`, `AccessLevel`) VALUES
(1, 'admin', '12345', 'Waqas', 'Afzal', '0321-8881234', 'House no 494,Block N, DHA, Lahore', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game_transactions`
--
ALTER TABLE `game_transactions`
  ADD CONSTRAINT `game_transactions_ibfk_1` FOREIGN KEY (`GameTypeID`) REFERENCES `game_details` (`GameTypeID`);

--
-- Constraints for table `table_state`
--
ALTER TABLE `table_state`
  ADD CONSTRAINT `GameTypeID` FOREIGN KEY (`GameTypeID`) REFERENCES `game_details` (`GameTypeID`),
  ADD CONSTRAINT `table_state_ibfk_1` FOREIGN KEY (`TableStageID`) REFERENCES `table_stage` (`TableStageID`),
  ADD CONSTRAINT `table_state_ibfk_2` FOREIGN KEY (`PlayerSelectStageID`) REFERENCES `player_select_stage` (`PlayerSelectStageID`),
  ADD CONSTRAINT `table_state_ibfk_3` FOREIGN KEY (`GameID`) REFERENCES `game_transactions` (`GameID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
