-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 10:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_topics`
--

CREATE TABLE `all_topics` (
  `atid` int(11) NOT NULL,
  `topics` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_topics`
--

INSERT INTO `all_topics` (`atid`, `topics`) VALUES
(1, 'android'),
(2, 'python'),
(3, 'php'),
(4, 'java'),
(5, 'c language'),
(6, 'c++ '),
(7, 'kotlin'),
(8, 'blender'),
(9, 'front end'),
(10, 'backend');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `aid` int(255) NOT NULL,
  `qid` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `ans_text` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `likes` int(255) NOT NULL,
  `dislikes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`aid`, `qid`, `uid`, `ans_text`, `date`, `likes`, `dislikes`) VALUES
(14, 251, 48, 'this is a continent', '6, March 2021', 0, 0),
(15, 251, 48, 's', '6, March 2021', 0, 0),
(16, 251, 48, 'wwwwww', '6, March 2021', 0, 0),
(17, 251, 49, 'This is my answer', '6, March 2021', 0, 0),
(18, 251, 49, 'MY another answer', '6, March 2021', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qtns`
--

CREATE TABLE `qtns` (
  `qid` int(11) NOT NULL,
  `uid` int(255) NOT NULL,
  `qtn_text` varchar(200) NOT NULL,
  `date` varchar(20) NOT NULL,
  `likes` int(255) NOT NULL,
  `dislikes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qtns`
--

INSERT INTO `qtns` (`qid`, `uid`, `qtn_text`, `date`, `likes`, `dislikes`) VALUES
(251, 48, 'what is america', '5, March 2021', 0, 0),
(253, 48, 'aaaa', '6, March 2021', 0, 0),
(254, 48, 'jdjdj', '6, March 2021', 0, 0),
(255, 48, 'who are you', '6, March 2021', 0, 0),
(256, 48, 'qqqq', '6, March 2021', 0, 0),
(257, 48, 'eeee', '6, March 2021', 0, 0),
(258, 48, 'wwwww', '6, March 2021', 0, 0),
(259, 48, 'eeeeeeeee', '6, March 2021', 0, 0),
(260, 48, 'wew', '6, March 2021', 0, 0),
(261, 48, 'wwww', '6, March 2021', 0, 0),
(262, 48, 'qqqqqqqqq', '6, March 2021', 0, 0),
(263, 48, 'wwwwww', '6, March 2021', 0, 0),
(264, 48, 'wwwwwww', '6, March 2021', 0, 0),
(265, 48, 'who is this user', '6, March 2021', 0, 0),
(266, 49, 'Akshay asked this qtn', '6, March 2021', 0, 0),
(267, 49, 'akshay another qtn', '6, March 2021', 0, 0),
(268, 48, 'a', '7, March 2021', 0, 0),
(269, 48, 'what is this', '8, March 2021', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `stid` int(255) NOT NULL,
  `uid` int(1) NOT NULL,
  `oncomment` int(1) NOT NULL,
  `onanswer` int(1) NOT NULL,
  `onfollowing` int(1) NOT NULL,
  `onrequest` int(1) NOT NULL,
  `follow_approve` int(1) NOT NULL,
  `indexing` int(1) NOT NULL,
  `discover` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`stid`, `uid`, `oncomment`, `onanswer`, `onfollowing`, `onrequest`, `follow_approve`, `indexing`, `discover`) VALUES
(2, 48, 1, 1, 1, 1, 1, 1, 1),
(3, 49, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `sid` int(11) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `sdesc` varchar(255) NOT NULL,
  `ldesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`sid`, `sname`, `sdesc`, `ldesc`) VALUES
(9, 'new space', 'aaaaaaaa', ''),
(10, 'new spaces', 'aaaaaaaa', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `uname`, `email`, `pwd`, `education`, `profession`, `place`, `bio`) VALUES
(48, 'Rajesh Bethu', 'rajeshbethu', 'rajeshb877@gmail.com', 'rajeshadmin', 'Engineering', 'Software', 'Kolkata', 'This is my Bio'),
(49, 'Akshay', 'akshaykumar', 'akshay@gmail.com', 'rajeshadmin', 'Engineering', 'Web developer', 'Kolkata', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_topics`
--
ALTER TABLE `all_topics`
  ADD PRIMARY KEY (`atid`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `qtns`
--
ALTER TABLE `qtns`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`stid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_topics`
--
ALTER TABLE `all_topics`
  MODIFY `atid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `aid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `qtns`
--
ALTER TABLE `qtns`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `stid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
