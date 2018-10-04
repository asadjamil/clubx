-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2018 at 10:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `club_size`
--

CREATE TABLE IF NOT EXISTS `club_size` (
  `ClubID` int(50) NOT NULL AUTO_INCREMENT,
  `NoOfTables` int(11) NOT NULL,
  PRIMARY KEY (`ClubID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 'Single', 1, 0, 2),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `FirstName`, `LastName`, `ContactNo`, `Address`, `AccessLevel`) VALUES
(1, 'admin', '12345', 'Waqas', 'Afzal', '0321-8881234', 'House no 494,Block N, DHA, Lahore', 1),
(2, 'asad', 'asad', 'Asad', 'Jamil', '0322-2890396', 'house no 282 , johar town,lahore', 1),
(3, 'asad', '1122', 'Asad', 'Jamil', '0322-2890396', 'house no 282 , johar town,lahore', 2);

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
  ADD CONSTRAINT `table_state_ibfk_2` FOREIGN KEY (`PlayerSelectStageID`) REFERENCES `player_select_stage` (`PlayerSelectStageID`),
  ADD CONSTRAINT `table_state_ibfk_3` FOREIGN KEY (`GameTypeID`) REFERENCES `game_details` (`GameTypeID`),
  ADD CONSTRAINT `table_state_ibfk_4` FOREIGN KEY (`GameID`) REFERENCES `game_transactions` (`GameID`),
  ADD CONSTRAINT `table_state_ibfk_5` FOREIGN KEY (`TableStageID`) REFERENCES `table_stage` (`TableStageID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
