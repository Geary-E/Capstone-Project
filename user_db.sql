-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 09:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `opportunity`
--

CREATE TABLE `opportunity` (
  `opportunityID` int(255) NOT NULL,
  `ownerID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` datetime(6) NOT NULL,
  `compensation` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opportunity`
--

INSERT INTO `opportunity` (`opportunityID`, `ownerID`, `name`, `description`, `location`, `date`, `compensation`) VALUES
(1, 5, 'testOpportunity', 'testOpportunityDescription', 'Denton, TX', '2023-11-23 23:59:00.000000', 1),
(2, 5, 'oppasd', 'asdasdasdasd', 'denton', '2023-11-14 21:40:00.000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opportunitycomment`
--

CREATE TABLE `opportunitycomment` (
  `commentID` int(255) NOT NULL,
  `opportunityID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `commentNum` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study`
--

CREATE TABLE `study` (
  `studyID` int(255) NOT NULL,
  `ownerID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` datetime(6) NOT NULL,
  `compensation` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study`
--

INSERT INTO `study` (`studyID`, `ownerID`, `name`, `description`, `location`, `date`, `compensation`) VALUES
(1, 5, 'test study', 'test study description', 'denton, TX', '2023-11-23 20:40:00.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supportgroup`
--

CREATE TABLE `supportgroup` (
  `supportGroupID` int(255) NOT NULL,
  `ownerID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supportgroup`
--

INSERT INTO `supportgroup` (`supportGroupID`, `ownerID`, `name`, `description`) VALUES
(1, 5, 'support group test', 'support group description test'),
(2, 5, 'asdasd', 'asdasda');

-- --------------------------------------------------------

--
-- Table structure for table `supportgroupcomment`
--

CREATE TABLE `supportgroupcomment` (
  `commentID` int(255) NOT NULL,
  `supportGroupID` int(255) NOT NULL,
  `postID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `commentNum` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supportgrouppost`
--

CREATE TABLE `supportgrouppost` (
  `postID` int(255) NOT NULL,
  `supportGroupID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `surveyID` int(255) NOT NULL,
  `ownerID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`surveyID`, `ownerID`, `name`, `description`) VALUES
(1, 5, 'test', 'testing'),
(2, 2, 'secondtest', 'secondsurveytest'),
(4, 4, 'survey 3', 'test description 3'),
(25, 5, 'survey 4', 'survey 4 test');

-- --------------------------------------------------------

--
-- Table structure for table `surveyquestion`
--

CREATE TABLE `surveyquestion` (
  `questionID` int(255) NOT NULL,
  `surveyID` int(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `questionNumber` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveyquestion`
--

INSERT INTO `surveyquestion` (`questionID`, `surveyID`, `question`, `questionNumber`) VALUES
(1, 25, 'What is your name?', 1),
(2, 25, 'What is your age?', 2),
(3, 25, 'Where do you live?', 3),
(10, 1, 'survey 1 first question', 1),
(11, 1, 'survey 1 second question', 2);

-- --------------------------------------------------------

--
-- Table structure for table `surveyresponse`
--

CREATE TABLE `surveyresponse` (
  `responseID` int(255) NOT NULL,
  `surveyID` int(255) NOT NULL,
  `questionID` int(255) NOT NULL,
  `response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveyresponse`
--

INSERT INTO `surveyresponse` (`responseID`, `surveyID`, `questionID`, `response`) VALUES
(36, 25, 1, 'Jeremy'),
(37, 25, 2, '29'),
(38, 25, 3, 'McKinney'),
(40, 1, 10, 'test 1'),
(41, 1, 11, 'test 2'),
(42, 1, 10, 'FUCK'),
(43, 1, 11, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_opportunity`
--

CREATE TABLE `tag_opportunity` (
  `tagID` int(255) NOT NULL,
  `opportunityID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_study`
--

CREATE TABLE `tag_study` (
  `tagID` int(255) NOT NULL,
  `studyID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_supportgroup`
--

CREATE TABLE `tag_supportgroup` (
  `tagID` int(255) NOT NULL,
  `supportGroupID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_survey`
--

CREATE TABLE `tag_survey` (
  `tagID` int(255) NOT NULL,
  `surveyID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_user`
--

CREATE TABLE `tag_user` (
  `tagID` int(255) NOT NULL,
  `userID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'person',
  `accessibility` int(255) NOT NULL,
  `notifications` int(255) NOT NULL,
  `tags` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstname`, `lastname`, `email`, `password`, `user_type`, `accessibility`, `notifications`, `tags`) VALUES
(2, 'flumped', '', 'jrtollison@yahoo.com', 'bd5135bbbeabfc06d5ed458d76509793', 'researcher', 0, 0, 0),
(4, 'sarah', 'o', 'saraho@google.com', '827ccb0eea8a706c4c34a16891f84e7b', 'person', 0, 0, 0),
(5, 'adminFirstName', 'adminLastName', 'admin@1', '21232f297a57a5a743894a0e4a801fc3', 'researcher', 0, 0, 0),
(8, 'userFirstName', 'userLastName', 'user@1', 'ee11cbb19052e40b07aac0ca060c23ee', 'person', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_opportunity`
--

CREATE TABLE `user_opportunity` (
  `userOpportunityID` int(11) NOT NULL,
  `userID` int(255) NOT NULL,
  `opportunityID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_opportunity`
--

INSERT INTO `user_opportunity` (`userOpportunityID`, `userID`, `opportunityID`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_study`
--

CREATE TABLE `user_study` (
  `userStudyID` int(11) NOT NULL,
  `userID` int(255) NOT NULL,
  `studyID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_study`
--

INSERT INTO `user_study` (`userStudyID`, `userID`, `studyID`) VALUES
(3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_supportgroup`
--

CREATE TABLE `user_supportgroup` (
  `userSupportGroupID` int(11) NOT NULL,
  `userID` int(255) NOT NULL,
  `supportGroupID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_supportgroup`
--

INSERT INTO `user_supportgroup` (`userSupportGroupID`, `userID`, `supportGroupID`) VALUES
(1, 5, 1),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_survey`
--

CREATE TABLE `user_survey` (
  `userSurveyID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `surveyID` int(255) NOT NULL,
  `questionID` int(255) NOT NULL,
  `responseID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_survey`
--

INSERT INTO `user_survey` (`userSurveyID`, `userID`, `surveyID`, `questionID`, `responseID`) VALUES
(26, 5, 25, 1, 36),
(27, 5, 25, 2, 37),
(28, 5, 25, 3, 38),
(30, 5, 1, 10, 40),
(31, 5, 1, 11, 41),
(32, 8, 1, 10, 42),
(33, 8, 1, 11, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD PRIMARY KEY (`opportunityID`),
  ADD KEY `userID` (`ownerID`);

--
-- Indexes for table `opportunitycomment`
--
ALTER TABLE `opportunitycomment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `opportunityID` (`opportunityID`),
  ADD KEY `userid` (`userID`);

--
-- Indexes for table `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`studyID`),
  ADD KEY `userid` (`ownerID`);

--
-- Indexes for table `supportgroup`
--
ALTER TABLE `supportgroup`
  ADD PRIMARY KEY (`supportGroupID`),
  ADD KEY `userid` (`ownerID`);

--
-- Indexes for table `supportgroupcomment`
--
ALTER TABLE `supportgroupcomment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `supportGroupID` (`supportGroupID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `supportgrouppost`
--
ALTER TABLE `supportgrouppost`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `supportGroupID` (`supportGroupID`),
  ADD KEY `userid` (`userID`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`surveyID`),
  ADD KEY `userID` (`ownerID`);

--
-- Indexes for table `surveyquestion`
--
ALTER TABLE `surveyquestion`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `surveyID` (`surveyID`);

--
-- Indexes for table `surveyresponse`
--
ALTER TABLE `surveyresponse`
  ADD PRIMARY KEY (`responseID`),
  ADD KEY `surveyID` (`surveyID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagID`);

--
-- Indexes for table `tag_opportunity`
--
ALTER TABLE `tag_opportunity`
  ADD KEY `tagID` (`tagID`),
  ADD KEY `opportunityID` (`opportunityID`);

--
-- Indexes for table `tag_study`
--
ALTER TABLE `tag_study`
  ADD KEY `tagID` (`tagID`),
  ADD KEY `studyID` (`studyID`);

--
-- Indexes for table `tag_supportgroup`
--
ALTER TABLE `tag_supportgroup`
  ADD KEY `tagID` (`tagID`),
  ADD KEY `supportGroupID` (`supportGroupID`);

--
-- Indexes for table `tag_survey`
--
ALTER TABLE `tag_survey`
  ADD KEY `tagID` (`tagID`),
  ADD KEY `surveyID` (`surveyID`);

--
-- Indexes for table `tag_user`
--
ALTER TABLE `tag_user`
  ADD KEY `tagID` (`tagID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_opportunity`
--
ALTER TABLE `user_opportunity`
  ADD PRIMARY KEY (`userOpportunityID`),
  ADD KEY `userid` (`userID`),
  ADD KEY `opportunityID` (`opportunityID`);

--
-- Indexes for table `user_study`
--
ALTER TABLE `user_study`
  ADD PRIMARY KEY (`userStudyID`),
  ADD KEY `userid` (`userID`),
  ADD KEY `studyid` (`studyID`);

--
-- Indexes for table `user_supportgroup`
--
ALTER TABLE `user_supportgroup`
  ADD PRIMARY KEY (`userSupportGroupID`),
  ADD KEY `userid` (`userID`),
  ADD KEY `supportgroupID` (`supportGroupID`);

--
-- Indexes for table `user_survey`
--
ALTER TABLE `user_survey`
  ADD PRIMARY KEY (`userSurveyID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `surveyID` (`surveyID`),
  ADD KEY `questionID` (`questionID`),
  ADD KEY `responseID` (`responseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `opportunity`
--
ALTER TABLE `opportunity`
  MODIFY `opportunityID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opportunitycomment`
--
ALTER TABLE `opportunitycomment`
  MODIFY `commentID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study`
--
ALTER TABLE `study`
  MODIFY `studyID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supportgroup`
--
ALTER TABLE `supportgroup`
  MODIFY `supportGroupID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supportgroupcomment`
--
ALTER TABLE `supportgroupcomment`
  MODIFY `commentID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supportgrouppost`
--
ALTER TABLE `supportgrouppost`
  MODIFY `postID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `surveyID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `surveyquestion`
--
ALTER TABLE `surveyquestion`
  MODIFY `questionID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `surveyresponse`
--
ALTER TABLE `surveyresponse`
  MODIFY `responseID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_opportunity`
--
ALTER TABLE `user_opportunity`
  MODIFY `userOpportunityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_study`
--
ALTER TABLE `user_study`
  MODIFY `userStudyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_supportgroup`
--
ALTER TABLE `user_supportgroup`
  MODIFY `userSupportGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_survey`
--
ALTER TABLE `user_survey`
  MODIFY `userSurveyID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD CONSTRAINT `opportunity_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `opportunitycomment`
--
ALTER TABLE `opportunitycomment`
  ADD CONSTRAINT `opportunitycomment_ibfk_1` FOREIGN KEY (`opportunityID`) REFERENCES `opportunity` (`opportunityID`),
  ADD CONSTRAINT `opportunitycomment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `supportgroup`
--
ALTER TABLE `supportgroup`
  ADD CONSTRAINT `supportgroup_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `supportgroupcomment`
--
ALTER TABLE `supportgroupcomment`
  ADD CONSTRAINT `supportgroupcomment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `supportgroupcomment_ibfk_2` FOREIGN KEY (`supportGroupID`) REFERENCES `supportgroup` (`supportGroupID`),
  ADD CONSTRAINT `supportgroupcomment_ibfk_3` FOREIGN KEY (`postID`) REFERENCES `supportgrouppost` (`postID`);

--
-- Constraints for table `supportgrouppost`
--
ALTER TABLE `supportgrouppost`
  ADD CONSTRAINT `supportgrouppost_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `supportgrouppost_ibfk_2` FOREIGN KEY (`supportGroupID`) REFERENCES `supportgroup` (`supportGroupID`);

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `surveyquestion`
--
ALTER TABLE `surveyquestion`
  ADD CONSTRAINT `surveyquestion_ibfk_1` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`surveyID`);

--
-- Constraints for table `surveyresponse`
--
ALTER TABLE `surveyresponse`
  ADD CONSTRAINT `surveyresponse_ibfk_1` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`surveyID`),
  ADD CONSTRAINT `surveyresponse_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `surveyquestion` (`questionID`);

--
-- Constraints for table `tag_opportunity`
--
ALTER TABLE `tag_opportunity`
  ADD CONSTRAINT `tag_opportunity_ibfk_1` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`),
  ADD CONSTRAINT `tag_opportunity_ibfk_2` FOREIGN KEY (`opportunityID`) REFERENCES `opportunity` (`opportunityID`);

--
-- Constraints for table `tag_study`
--
ALTER TABLE `tag_study`
  ADD CONSTRAINT `tag_study_ibfk_1` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`),
  ADD CONSTRAINT `tag_study_ibfk_2` FOREIGN KEY (`studyID`) REFERENCES `study` (`studyID`);

--
-- Constraints for table `tag_supportgroup`
--
ALTER TABLE `tag_supportgroup`
  ADD CONSTRAINT `tag_supportgroup_ibfk_1` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`),
  ADD CONSTRAINT `tag_supportgroup_ibfk_2` FOREIGN KEY (`supportGroupID`) REFERENCES `supportgroup` (`supportGroupID`);

--
-- Constraints for table `tag_survey`
--
ALTER TABLE `tag_survey`
  ADD CONSTRAINT `tag_survey_ibfk_1` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`),
  ADD CONSTRAINT `tag_survey_ibfk_2` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`surveyID`);

--
-- Constraints for table `tag_user`
--
ALTER TABLE `tag_user`
  ADD CONSTRAINT `tag_user_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `tag_user_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `tag` (`tagID`);

--
-- Constraints for table `user_opportunity`
--
ALTER TABLE `user_opportunity`
  ADD CONSTRAINT `user_opportunity_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `user_opportunity_ibfk_2` FOREIGN KEY (`opportunityID`) REFERENCES `opportunity` (`opportunityID`);

--
-- Constraints for table `user_study`
--
ALTER TABLE `user_study`
  ADD CONSTRAINT `user_study_ibfk_1` FOREIGN KEY (`studyID`) REFERENCES `study` (`studyID`),
  ADD CONSTRAINT `user_study_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `user_supportgroup`
--
ALTER TABLE `user_supportgroup`
  ADD CONSTRAINT `user_supportgroup_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `user_supportgroup_ibfk_2` FOREIGN KEY (`supportGroupID`) REFERENCES `supportgroup` (`supportGroupID`);

--
-- Constraints for table `user_survey`
--
ALTER TABLE `user_survey`
  ADD CONSTRAINT `user_survey_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `user_survey_ibfk_2` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`surveyID`),
  ADD CONSTRAINT `user_survey_ibfk_3` FOREIGN KEY (`questionID`) REFERENCES `surveyquestion` (`questionID`),
  ADD CONSTRAINT `user_survey_ibfk_4` FOREIGN KEY (`responseID`) REFERENCES `surveyresponse` (`responseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
