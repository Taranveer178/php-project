-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 06:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `is_correct` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `option`, `is_correct`) VALUES
(7, 5, 'Personal Home Page', 0),
(8, 5, 'Private Home Page', 0),
(9, 5, 'PHP: Hypertext Preprocessor', 1),
(10, 5, 'Predefined Hypertext Processor', 0),
(11, 6, '<php>', 0),
(12, 6, '<?php', 1),
(13, 6, '<script php>', 0),
(14, 6, '<?', 0),
(15, 7, '$_POST[]', 1),
(16, 7, '$_GET[]', 0),
(17, 7, '$_FORM[]', 0),
(18, 7, '$_DATA[]', 0),
(19, 8, '10', 0),
(20, 8, '55', 1),
(21, 8, 'Error', 0),
(22, 8, '5 5', 0),
(23, 9, 'include()', 0),
(24, 9, 'require()', 1),
(25, 9, 'require_once()', 0),
(26, 9, 'fetch()', 0),
(27, 10, 'True', 1),
(28, 10, 'False', 0),
(29, 11, 'True', 1),
(30, 11, 'False', 0),
(31, 12, 'True', 0),
(32, 12, 'False', 1),
(33, 13, 'True', 0),
(34, 13, 'False', 1),
(35, 14, 'True', 0),
(36, 14, 'False', 1),
(47, 20, 'def', 1),
(48, 20, 'func', 0),
(49, 20, 'function', 0),
(50, 20, 'printf()', 0),
(51, 22, '//', 0),
(52, 22, '--', 0),
(53, 22, '#', 1),
(54, 22, '/* */', 0),
(55, 23, 'error', 0),
(56, 23, 'try', 0),
(57, 23, 'catch', 0),
(58, 23, 'except', 1),
(59, 21, ' Dennis Ritchie', 0),
(60, 21, 'Guido van Rossum', 1),
(61, 24, 'James Gosling', 1),
(62, 24, 'Dennis Ritchie', 0),
(63, 24, 'Bjarne Stroustrup', 0),
(64, 24, 'Guido van Rossum', 0),
(65, 25, '.java', 0),
(66, 25, '.class', 1),
(67, 25, '.exe', 0),
(68, 25, '.jar', 0),
(69, 26, 'include', 0),
(70, 26, 'unsigned', 0),
(71, 26, 'extends', 1),
(72, 26, 'define', 0),
(73, 27, 'Windows', 0),
(74, 27, 'MacOS', 0),
(75, 27, 'BIOS', 0),
(76, 27, 'JVM', 1),
(77, 28, 'True', 1),
(78, 28, 'False', 0),
(79, 29, 'True', 1),
(80, 29, 'False', 0),
(81, 30, 'True', 0),
(82, 30, 'False', 1),
(83, 31, 'True', 0),
(84, 31, 'False', 1),
(85, 32, 'True', 1),
(86, 32, 'False', 0),
(102, 40, 'True', 1),
(103, 40, 'False', 0),
(104, 41, 'True', 1),
(105, 41, 'False', 0),
(106, 42, 'True', 0),
(107, 42, 'False', 1),
(108, 43, 'True', 0),
(109, 43, 'False', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `chapter_name` varchar(111) NOT NULL,
  `link` varchar(111) NOT NULL,
  `Chapter_number` int(11) NOT NULL,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `course_id`, `chapter_name`, `link`, `Chapter_number`, `deleted_at`) VALUES
(6, 1, 'Introduction to PHP', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=-IzfiDK9X98ANBXL', 1, NULL),
(7, 1, 'Variables and Operators', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=1875', 2, NULL),
(8, 1, 'Data Types', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=3147', 3, NULL),
(9, 1, 'Conditional Statements', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=3440', 4, NULL),
(10, 1, 'Arrays', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=3947', 5, NULL),
(11, 1, 'Functions', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=4759', 6, NULL),
(12, 1, 'Strings', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=4961', 7, NULL),
(13, 1, 'Project', 'https://www.youtube.com/embed/1SnPKhCdlsU?si=HpBxqMlV6QocKUTh&amp;start=5377', 8, NULL),
(14, 2, 'Introduction to Python', 'https://www.youtube.com/embed/UrsmFxEIp5k?si=VxXYq9a9_A0LPlbI', 1, NULL),
(15, 2, 'Variables and Datatypes', 'https://www.youtube.com/embed/UrsmFxEIp5k?si=aWTYzjbalQwydhkX&amp;start=2100', 2, NULL),
(16, 2, 'Strings', 'https://www.youtube.com/embed/UrsmFxEIp5k?si=aWTYzjbalQwydhkX&amp;start=4560', 3, NULL),
(17, 2, 'Conditional Expressions', 'https://www.youtube.com/embed/UrsmFxEIp5k?si=aWTYzjbalQwydhkX&amp;start=11384', 4, NULL),
(18, 2, 'Functions', 'https://www.youtube.com/embed/UrsmFxEIp5k?si=aWTYzjbalQwydhkX&amp;start=17455', 5, NULL),
(19, 3, 'Introduction to Java', 'https://www.youtube.com/embed/UmnCZ7-9yDY?si=3FlXd29_vTQ7dV8E', 1, NULL),
(20, 3, 'Variables and Datatypes', 'https://www.youtube.com/embed/UmnCZ7-9yDY?si=sopXLI86NW4i81YB&amp;start=684', 2, NULL),
(21, 3, 'Operators', 'https://www.youtube.com/embed/UmnCZ7-9yDY?si=DYe8YKxa0le196Ef&amp;start=2992', 3, NULL),
(22, 3, 'Conditional Statements', 'https://www.youtube.com/embed/UmnCZ7-9yDY?si=CN7zXmVTQ9Fs3G6z&amp;start=4033', 4, NULL),
(26, 3, 'dsf', 'f', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `skills` varchar(30) NOT NULL,
  `about` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `description`, `skills`, `about`, `image`, `deleted_at`) VALUES
(1, 'PHP', 'Enroll in our free PHP course to learn one of the most beginner-friendly and powerful programming languages. This course introduces Python fundamentals including variables, data types, operators, control flow, loops, and functions. Learn by doing with ', 'PHP, Web sDevelopments', 'If you are a beginner looking to get started with PHP, this course is for you! This beginner-friendly course covers essential Python concepts such as installation, syntax, comments, variables, conditional statements, loops, and function definitions. Pe', 'img_PHP.jpg', NULL),
(2, 'Python', 'Enroll in our free Python course to learn one of the most beginner-friendly and powerful programming languages. This course introduces Python fundamentals including variables, data types, operators, control flow, loops, and functions. Learn by doing with ', 'Python, Web Development', 'If you are a beginner looking to get started with Python, this course is for you! This beginner-friendly course covers essential Python concepts such as installation, syntax, comments, variables, conditional statements, loops, and function definitions. Pe', 'img_Python.jpg', NULL),
(3, 'Java', 'Enroll in ou free Python course to learn one of the most beginner-friendly and powerful programming languages. This course introduces Python fundamentals including variables, data types, operators, control flow, loops, and functions. Learn by doing with ', 'Python, Web sDevelopment', 'If you are a bseginner looking to get started with Python, this course is for you! This beginner-friendly course covers essential Python concepts such as installation, syntax, comments, variables, conditional statements, loops, and function definitions. P', 'img_Java.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enrolled_courses` varchar(111) NOT NULL,
  `completed_chapters` varchar(255) NOT NULL,
  `completed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`id`, `user_id`, `enrolled_courses`, `completed_chapters`, `completed`) VALUES
(1, 1, '1 2 3', ' 1 2 6 7 8 9 10 11 12 13', '   1'),
(2, 2, '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'How do I enroll in a course?', 'You can browse available courses and click the “Enroll” button on the course page. Some courses may require approval or payment before enrollment.'),
(2, 'Can I access courses offline?', 'Currently, our platform requires an internet connection to access course materials. However, downloadable resources are available for some courses'),
(3, 'How do I track my progress?', 'Your dashboard shows your enrolled courses and progress percentage. You can also view completed lessons, quizzes, and certificates earned.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `contact`, `query`, `reply`) VALUES
(1, 'taran', '0', 34565, '3454', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `question_num`) VALUES
(5, 3, ' What does PHP stand for?', 1),
(6, 3, 'Which of the following is the correct way to start a PHP block of code?', 2),
(7, 3, 'Which of the following is used to get data from a form using the POST method in PHP?', 3),
(8, 3, 'What will echo 5 . \"5\"; output in PHP?', 4),
(9, 3, 'Which function is used to include a file in PHP, and stop script execution if the file is not found?', 5),
(10, 4, 'PHP is a server-side scripting language.', 1),
(11, 4, 'Variables in PHP must start with a dollar sign ($).', 2),
(12, 4, 'The == operator checks both value and data type in PHP.', 3),
(13, 4, 'The include() function stops script execution if the file is not found.', 4),
(14, 4, 'PHP file extensions must always be .php to run on the server.', 5),
(20, 6, 'Which of the following is used to define a function in Python?', 1),
(21, 6, ' Who developed Python programming language?', 2),
(22, 6, ' Which of the following is a valid way to start a comment in Python?', 3),
(23, 6, 'Which keyword is used to handle exceptions in Python?', 4),
(24, 7, 'Who developed the Java programming language?', 1),
(25, 7, 'What is the extension of compiled Java classes?', 2),
(26, 7, 'Which of the following is a valid keyword in Java?', 3),
(27, 7, 'Which platform does Java primarily run on?', 4),
(28, 8, 'Java is a platform-independent language.', 1),
(29, 8, 'The main() method is the entry point of any Java program.', 2),
(30, 8, 'Java supports multiple inheritance using classes.', 3),
(31, 8, 'Java does not support Object-Oriented Programming (OOP).', 4),
(32, 8, 'Java source files have a .java extension.', 5),
(40, 13, 'a', 1),
(41, 13, 'Which method is used to send form data securely in PHP?', 2),
(42, 13, '12', 3),
(43, 6, 'Which method is used to send form data securely in PHP??', 5);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `total_points` int(11) NOT NULL,
  `passing_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `course_id`, `quiz_name`, `total_points`, `passing_marks`) VALUES
(3, 1, 'MCQ', 100, 40),
(4, 1, 'True/False', 100, 40),
(5, 2, 'True/False', 100, 40),
(6, 2, 'MCQ', 100, 40),
(7, 3, 'MCQ', 100, 40),
(8, 3, 'True/False', 100, 40),
(13, 3, 'taran', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`id`, `quiz_id`, `user_id`, `course_id`, `score`) VALUES
(5, 3, 1, 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `image`, `review`) VALUES
(1, 'Taran', 'img_Taran.jpg', 'Hi, this is good'),
(2, 'Tanmay', 'img_Tanmay.jpg', 'hello sdknihf asfbusbf sdubfuisghf\r\n'),
(3, 'Harman', 'img_Harman.jpg', 'dsefre dgftrg dhmjxdz fdght');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `role` varchar(11) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `dob`, `role`) VALUES
(1, 'taran', 'taran@gmail.com', '$2y$10$rpUeX/Av01wZiurKVLRfAOsDOxdz1hyBVAE1DNbMS..O.z3wVjwZK', 'Male', '2025-05-21', 'admin'),
(2, 'Harman', 'harman@gmail.com', '$2y$10$bdtG3NxiOzzAdKkpOMMJEObhTpus44cWQ8SNApzc5iFlJ2bui9S42', 'Male', '2025-05-05', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_ibfk_1` (`question_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_ibfk_1` (`course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolled_ibfk_1` (`user_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_ibfk_1` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD CONSTRAINT `quiz_result_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_result_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_result_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
