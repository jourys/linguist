-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2024 at 03:03 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linguist`
--

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

CREATE TABLE `learner` (
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT '''prolile.png''',
  `Firstname` varchar(110) NOT NULL,
  `Lastname` varchar(120) NOT NULL,
  `password` varchar(225) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `location` varchar(110) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `reset_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`email`, `image`, `Firstname`, `Lastname`, `password`, `city`, `location`, `ID`, `reset_token`) VALUES
('AndrewPaul@ksu', 'profile.png', 'Andrew', 'Paul', 'pass', NULL, NULL, 1, ''),
('munirah@ksu', 'profile.png', 'Munirah', 'Ibrahem', 'pass', NULL, NULL, 2, ''),
('real@gmail.com', 'profile.png', 'Amy', 'Ralph', '1234', 'Riyadh', 'Riyadh', 3, ''),
('AmyRalph@gmail.com', 'maleIcon.png', 'Cath', 'Roberts', '1234', NULL, NULL, 6, ''),
('dkk@ff.com', 'sunset-1373171_1280.jpg', 'dd', 'dd', 'eeeeeee33333333', 'dd', 'dd', 7, NULL),
('ff@hh.com', '', 'ff', 'f', 'ddd4r4rr4r4rr4', 'rrr', 'rrrrr', 8, NULL),
('ccc@h.com', '', 'vv', 'cc', 'dddd4r4444', 'dd', 'ddd', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `P_ID` int(11) NOT NULL,
  `L_ID` int(11) NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `Duration` int(10) NOT NULL,
  `Language` varchar(15) NOT NULL,
  `Level` varchar(15) NOT NULL,
  `Status` varchar(15) NOT NULL DEFAULT 'Pending',
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`P_ID`, `L_ID`, `Time`, `Date`, `Duration`, `Language`, `Level`, `Status`, `Price`) VALUES
(1, 1, '22:20:00', '2024-05-15', 30, 'English', 'Advanced', 'Pending', 0),
(1, 3, '10:30:00', '2024-05-08', 20, 'English', 'Advanced', 'accepted', 0),
(1, 3, '21:31:29', '2024-05-09', 60, 'French', 'Advanced', 'Pending', 20),
(1, 9, '17:20:00', '2024-05-10', 30, 'French', 'Advanced', 'Pending', 20);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `L_ID` int(11) NOT NULL,
  `starts` int(11) NOT NULL,
  `ReviewText` varchar(200) DEFAULT NULL,
  `P_ID` int(11) NOT NULL,
  `SWESSION_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`L_ID`, `starts`, `ReviewText`, `P_ID`, `SWESSION_ID`) VALUES
(6, 5, 'bad', 1, NULL),
(6, 5, 'bad', 1, NULL),
(3, 4, 'Exceptional tutor! Clear explanations, engaging teaching style, and a genuine passion for helping students succeed. Highly recommend for anyone looking to improve their skills', 1, NULL),
(1, 2, 'ugly I HATE IT', 1, NULL),
(1, 2, 'kinda good', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `T_id` int(11) NOT NULL,
  `L_id` int(11) NOT NULL,
  `ID` int(10) NOT NULL,
  `language` varchar(120) NOT NULL,
  `Date` date NOT NULL,
  `Time` time(6) NOT NULL,
  `Duration` int(10) NOT NULL,
  `Status` varchar(60) NOT NULL,
  `level` varchar(60) NOT NULL,
  `Price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`T_id`, `L_id`, `ID`, `language`, `Date`, `Time`, `Duration`, `Status`, `level`, `Price`) VALUES
(1, 2, 2, 'English', '2024-05-07', '20:30:00.000000', 30, '', 'Beginner', 20),
(1, 1, 3, 'English', '2024-05-04', '18:20:00.000000', 60, '', 'Beginner', 40),
(1, 2, 1010, 'english', '2024-05-04', '10:30:00.000000', 30, 'upcoming', 'Beginner', 20),
(1, 6, 1011, 'English', '2024-05-04', '23:44:59.000000', 40, '', '', 26.66),
(1, 3, 1013, '', '2024-05-03', '22:45:03.000000', 60, '', '', 40),
(2, 1, 1017, 'French', '2024-05-04', '16:30:00.000000', 40, '', 'Advanced', NULL),
(2, 1, 1018, 'French', '2024-05-06', '17:20:00.000000', 30, '', 'Advanced', NULL),
(2, 1, 1019, 'French', '2024-05-04', '16:30:00.000000', 40, '', 'Advanced', NULL),
(2, 1, 1020, 'French', '2024-05-06', '17:20:00.000000', 30, '', 'Advanced', NULL),
(1, 3, 1021, 'English', '2024-05-10', '13:30:43.000000', 60, 'upcoming', 'Advanced', 40),
(2, 6, 1022, 'English', '2024-05-08', '16:30:43.000000', 60, '', 'Beginner', NULL),
(1, 3, 1023, 'Arabic', '2024-05-09', '15:30:00.000000', 40, '', '', 40),
(1, 6, 1024, 'English', '2024-05-09', '17:20:00.000000', 30, '', '', 20),
(1, 3, 1025, 'English', '2024-05-08', '10:30:00.000000', 20, 'accepted', 'Advanced', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Firstname` varchar(70) NOT NULL,
  `Lastname` varchar(70) NOT NULL,
  `age` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `PhoneNumber` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `bio` varchar(900) DEFAULT NULL,
  `experience` varchar(800) DEFAULT NULL,
  `eduction` varchar(800) DEFAULT NULL,
  `reset_token` varchar(200) DEFAULT NULL,
  `Price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='not sure + needs editing + gender ';

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`ID`, `Email`, `image`, `Firstname`, `Lastname`, `age`, `gender`, `password`, `PhoneNumber`, `city`, `bio`, `experience`, `eduction`, `reset_token`, `Price`) VALUES
(1, 'GloriaHarold@ksu.com', 'femaleIcon.png', 'Gloria', 'Harold', '45', 'female', 'pass12345', '5032345435', '', '     English is easy, start today! or never', '     Relevant Coursework: Advanced Grammar & Syntax,  Rhetoric & Composition Theory,  Second Language Acquisition,  Multicultural Literature.\r\n\r\nCertification: TEFL (Teaching English as a Foreign Language)\r\n\r\nOngoing Professional Development: Regularly attend workshops on new teaching methodologies, such as gamification in language learning and using technology to personalize instruction.', '     Doctor of Philosophy (PhD) in English Literature\r\n\r\nStanford University, Stanford, California', '', NULL),
(2, 'AmeliaSharma@gmail.com', 'femaleIcon2.png', 'Amelia', 'Sharma', '2012-04-11', 'female', '123', '503234577', NULL, '\r\nDr. Amelia Sharma (PhD), passionate English tutor (15+ yrs). Creates supportive, engaging lessons for all ages & goals (grammar, writing, conversation, test prep). Tailors to your learning style - visual, kinesthetic, or tech-savvy! #YourSuccessIsMyPassion', '\r\n15+ yrs experience! Tutored middle school to adults in grammar, writing, conversation & test prep (SAT, ACT, TOEFL). Combine assessments & feedback with engaging methods (visual aids, games, tech) to fit your learning style. Boosted one student\'s SAT score by 200 points! ', 'Doctor of Philosophy (PhD) in English Literature\r\n\r\nStanford University, Stanford, California\r\n\r\n2009\r\n\r\nRelevant Coursework: Advanced Grammar & Syntax,  Rhetoric & Composition Theory,  Second Language Acquisition,  Multicultural Literature.\r\n\r\nCertification: TEFL (Teaching English as a Foreign Language)\r\n\r\nOngoing Professional Development: Regularly attend workshops on new teaching methodologies, such as gamification in language learning and using technology to personalize instruction.', '', NULL),
(3, 'ddd@g.comr', 'Unknown.jpeg', 'dd', 'ddrfr6', '33', 'male', 'eeeeeee333e', '503', 'eehhjjmm', ' teacher of English,', '                            ', '                            ', NULL, NULL),
(4, 'eeee@h.com', '', 'sss', 'sss', '33', 'female', 'dcddeedeeee', '5773333', 'dd', 'ss', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutor_languages`
--

CREATE TABLE `tutor_languages` (
  `P_ID` int(11) NOT NULL,
  `Language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor_languages`
--

INSERT INTO `tutor_languages` (`P_ID`, `Language`) VALUES
(2, 'Spanish'),
(1, 'English'),
(1, 'French');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`P_ID`,`L_ID`,`Time`,`Date`),
  ADD KEY `P_Email` (`P_ID`),
  ADD KEY `L_Email` (`L_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review_ibfk_1` (`L_ID`),
  ADD KEY `review_ibfk_2` (`P_ID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `T_email` (`T_id`),
  ADD KEY `L_email` (`L_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tutor_languages`
--
ALTER TABLE `tutor_languages`
  ADD KEY `tutor_languages_ibfk_1` (`P_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `learner`
--
ALTER TABLE `learner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1026;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `learner` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`P_ID`) REFERENCES `tutor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `learner` (`ID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`P_ID`) REFERENCES `tutor` (`ID`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`T_id`) REFERENCES `tutor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`L_id`) REFERENCES `learner` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor_languages`
--
ALTER TABLE `tutor_languages`
  ADD CONSTRAINT `tutor_languages_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `tutor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
