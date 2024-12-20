-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2023 at 09:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novelty`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `description`, `status`, `image`, `created_at`) VALUES
(6, 'Robert Kiyosaki', '“I believe that one key to success is to accept truth : no matter how it\'s spoken.” “Quitting is the easiest thing to do.” “Inside every problem lies an opportunity.” “Face your fears and dou', 0, '1690475268.jpg', '2023-07-27 16:27:48'),
(8, 'Ankur Warikoo', '“Sit on as many chairs as you can before you find the one chair on which you feel you belong.” \r\n“This book is not going to be a revelation. It is meant to be a reminder. A reminder of how li', 0, '1690476143.png', '2023-07-27 16:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(316, 46, 56, 1, '2023-08-22 02:59:34'),
(317, 47, 55, 1, '2023-08-23 14:15:12'),
(325, 34, 47, 1, '2023-10-03 04:19:54'),
(326, 34, 46, 1, '2023-10-03 04:20:23'),
(327, 34, 45, 1, '2023-10-03 04:20:35'),
(328, 34, 52, 1, '2023-10-03 04:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(53, 'Fiction', 'aadii4055', 'Fiction Books', 0, 0, '1691512420.', 'Fiction Books', 'Fiction Books', 'Fiction Books', '2023-08-08 16:33:40'),
(54, 'Non - Fiction', 'aadii3583', 'Non - Fiction Books', 0, 0, '1691512441.', 'Non - Fiction Books', 'Non - Fiction Books', 'Non - Fiction Books', '2023-08-08 16:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `email`, `created_at`) VALUES
(1, '', '2023-08-04 15:32:19'),
(2, 'guptaaaditya999@gmail.com', '2023-08-04 15:34:14'),
(3, 'guptaaaditya999@gmail.com', '2023-08-04 15:37:42'),
(4, '', '2023-08-04 19:17:45'),
(5, '', '2023-08-05 13:20:03'),
(6, '', '2023-08-06 14:59:12'),
(7, 'guotara@asd', '2023-09-24 09:01:00'),
(8, '', '2023-10-03 04:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(191) NOT NULL,
  `total_price` int(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `city`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(65, 'aadi2428', 36, 'Daquan Rocha', 'wymohax@mailinator.com', '17', 'Duis proident sint ', 'A sed qui alias enim', 638, 'COD', '-', 1, NULL, '2023-08-10 09:06:04'),
(66, 'aadi487408389105', 34, 'Aaditya Gupta', 'aditya@gmail.com', '9808389105', 'Thankot', 'Kathmandu', 1838, 'COD', '-', 1, NULL, '2023-08-11 16:19:21'),
(67, 'aadi708008389105', 46, 'Aamosh Maharjan', 'aamosh@gmail.com', '9808389105', 'Thankot', 'Kathmandu', 638, 'COD', '-', 2, NULL, '2023-08-22 02:57:21'),
(68, 'aadi952018976453', 38, 'Nisha Ghimire', 'nisha@gmail.com', '9818976453', 'Thapakhel', 'Kathmandu', 1776, 'COD', '-', 1, NULL, '2023-09-24 07:21:38'),
(69, 'aadi385787879', 34, 'jhkjh', 'kjhkj@ere.ff', '0987879', 'kjhkj', 'mhkn', 3832, 'COD', '-', 2, NULL, '2023-10-03 04:02:09'),
(70, 'aadi666108389105', 48, 'Aaditya Lama', 'aditya@gmail.com', '9808389105', 'Lapakhel', 'Kathmandu', 6240, 'COD', '-', 1, NULL, '2023-10-08 19:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(191) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(191) NOT NULL,
  `price` int(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(246, 65, 47, 1, 638, '2023-08-10 09:06:04'),
(247, 66, 46, 1, 1200, '2023-08-11 16:19:21'),
(248, 66, 47, 1, 638, '2023-08-11 16:19:21'),
(249, 67, 53, 1, 638, '2023-08-22 02:57:21'),
(250, 68, 45, 1, 500, '2023-09-24 07:21:38'),
(251, 68, 48, 1, 638, '2023-09-24 07:21:38'),
(252, 68, 47, 1, 638, '2023-09-24 07:21:38'),
(253, 69, 50, 1, 1278, '2023-10-03 04:02:09'),
(254, 69, 47, 1, 638, '2023-10-03 04:02:09'),
(255, 69, 56, 2, 958, '2023-10-03 04:02:09'),
(256, 70, 57, 2, 1118, '2023-10-08 19:13:07'),
(257, 70, 60, 3, 1122, '2023-10-08 19:13:07'),
(258, 70, 47, 1, 638, '2023-10-08 19:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` int(191) NOT NULL,
  `selling_price` int(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` int(191) NOT NULL,
  `author` varchar(191) NOT NULL,
  `page_count` varchar(191) NOT NULL,
  `weight` varchar(191) NOT NULL,
  `isbn` varchar(191) NOT NULL,
  `language` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `author`, `page_count`, `weight`, `isbn`, `language`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(45, 54, 'Rich Dad Poor Dad', 'aadi6898book', 'April 2017 marks 20 years since Robert Kiyosaki\'s Rich Dad Poor Dad first made waves in the Personal Finance arena. It has since become the #1 Personal Finance book of all time... translated into dozens of languages and sold around the world. Rich Dad Poor Dad is Robert\'s story of growing up with two dads -- his real father and the father of his best friend, his rich dad -- and the ways in which both men shaped his thoughts about money and investing. The book explodes the myth that you need to earn a high income to be rich and explains the difference between working for money and having your money work for you', 'April 2017 marks 20 years since Robert Kiyosaki\'s Rich Dad Poor Dad first made waves in the Personal Finance arena. It has since become the #1 Personal Finance book of all time... translated into dozens of languages and sold around the world. Rich Dad Poor Dad is Robert\'s story of growing up with two dads -- his real father and the father of his best friend, his rich dad -- and the ways in which both men shaped his thoughts about money and investing. The book explodes the myth that you need to earn a high income to be rich and explains the difference between working for money and having your money work for you', 300, 500, '1691430058.jpg', 294, 'Robert T. Kiyoaki', '336 Pages', '245g', '9781612680194', 'English', 0, 0, '', 'Paper Back', 'Business,\r\nBusiness and Investing,\r\nFinance,\r\nEconomics,\r\nInvesting,\r\nSelf Improvement and Relationships', '2023-08-07 17:40:58'),
(46, 53, 'September Love', 'aadi3999book', 'A book that will change the way you think about love, relationships, heartbreak, and self-empowerment. Breaking the rules, challenging perceptions, and exploring the secret desires we keep hidden from the world. Beautifully composed and written by international bestselling author Lang Leav, this new collection of poetry and prose will positively influence your life. September Love captures the magic of each passing season, a pearl of wisdom waiting to be discovered with every page turned. A book that will inspire you to reach for the stars.', 'A book that will change the way you think about love, relationships, heartbreak, and self-empowerment. Breaking the rules, challenging perceptions, and exploring the secret desires we keep hidden from the world. Beautifully composed and written by international bestselling author Lang Leav, this new collection of poetry and prose will positively influence your life. September Love captures the magic of each passing season, a pearl of wisdom waiting to be discovered with every page turned. A book that will inspire you to reach for the stars.', 400, 1200, '1691430969.jpg', 297, 'Lang Leav', '224 Pages', '240g', '9781524859596', 'English', 0, 0, 'September Love', 'Paper Back', 'Fiction and Literature,\r\nPoetry and Prose', '2023-08-07 17:56:09'),
(47, 54, 'Deep Work', 'aadi3719book', 'Cal Newport discusses in his new book, Deep Work: Rules For Focused Success In A Distracted World, about how professionals of today have started valuing quantity over quality; and how this has turned young professionals of today into puppets who try to indulge in extensive multitasking, dealing with multiple emails and projects. This prevents them from doing \'deep work\'; which is focused work free from all other distractions. This also means that the professionals of today should sort out their priorities. Newport uses principles of psychology and neuroscience to enhance his points.', 'Cal Newport discusses in his new book, Deep Work: Rules For Focused Success In A Distracted World, about how professionals of today have started valuing quantity over quality; and how this has turned young professionals of today into puppets who try to indulge in extensive multitasking, dealing with multiple emails and projects. This prevents them from doing \'deep work\'; which is focused work free from all other distractions. This also means that the professionals of today should sort out their priorities. Newport uses principles of psychology and neuroscience to enhance his points.', 300, 638, '1691431062.jpg', 292, 'Cal Newport', '304 Pages', '230g', '9780349413686', 'English', 0, 0, 'Deep Work', 'Paper Back', 'Business,\r\nBusiness and Investing,\r\nSelf Improvement and Relationships,\r\nSelf Help,\r\nProductivity,\r\nTime Management,\r\nHistory, Biography, and Social Science', '2023-08-07 17:57:42'),
(48, 53, 'One of Us Is Lying', 'aadi9952book', 'On Thursday afternoon, five students at Bayview High walk into detention. Bronwyn,the brain, is Yale-bound and never breaks a rule. Addy, the beauty, is the picture-perfect homecoming princess. Nate,the criminal,is already on probation for dealing. Cooper,the athlete,is the all-star baseball pitcher. And Simon,the outcast,is the creator of Bayview High\'s notorious gossip app. Only, Simon never makes it out of that classroom.', 'On Thursday afternoon, five students at Bayview High walk into detention. Bronwyn,the brain, is Yale-bound and never breaks a rule. Addy, the beauty, is the picture-perfect homecoming princess. Nate,the criminal,is already on probation for dealing. Cooper,the athlete,is the all-star baseball pitcher. And Simon,the outcast,is the creator of Bayview High\'s notorious gossip app. Only, Simon never makes it out of that classroom.', 300, 638, '1691431139.jpg', 299, 'Karen M. Mcmanus', '368 Pages', '270g', '9780141375632', 'English', 0, 0, '', 'Paper Back', 'Fiction and Literature,\r\nMystery, Thriller & Suspense,\r\nYoung Adult', '2023-08-07 17:58:59'),
(50, 54, 'Atomic Habits', 'aadi7014book', 'Transform your life with tiny changes in behaviour - starting now. *The instant New York Times bestseller* *Financial Times Book of the Month* People think when you want to change your life, you need to think big. But world-renowned habits expert James Clear has discovered another way. He knows that real change comes from the compound effect of hundreds of small decisions - doing two push-ups a day, waking up five minutes early, or holding a single short phone call. ', 'Transform your life with tiny changes in behaviour - starting now. *The instant New York Times bestseller* *Financial Times Book of the Month* People think when you want to change your life, you need to think big. But world-renowned habits expert James Clear has discovered another way. He knows that real change comes from the compound effect of hundreds of small decisions - doing two push-ups a day, waking up five minutes early, or holding a single short phone call. ', 500, 1278, '1691431585.png', 298, 'James Clear', '320 Pages', '350g', '9781847941831', 'English', 0, 0, '', 'Jacketed', 'Business,\r\nBusiness and Investing,\r\nSelf Improvement and Relationships,\r\nSelf Help,\r\nLeadership,\r\nProductivity,\r\nTime Management,\r\nHistory, Biography, and Social Science', '2023-08-07 18:06:25'),
(51, 53, 'Red, White & Royal Blue', 'aadi7660book', '* Instant NEW YORK TIMES and USA TODAY bestseller ** GOODREADS CHOICE AWARD WINNER for BEST DEBUT and BEST ROMANCE of 2019 ** BEST BOOK OF THE YEAR* for VOGUE, NPR, VANITY FAIR, and more! *What happens when America\'s First Son falls in love with the Prince of Wales?When his mother became President, Alex Claremont-Diaz was promptly cast as the American equivalent of a young royal. Handsome, charismatic, genius—his image is pure millennial-marketing gold for the White House. There\'s only one problem: Alex has a beef with the actual prince, Henry, across the pond. And when the tabloids get hold of a photo involving an Alex-Henry altercation, U.S./British relations take a turn for the worse. Heads of family, state, and other handlers devise a plan for damage control: staging a truce between the two rivals. ', '* Instant NEW YORK TIMES and USA TODAY bestseller ** GOODREADS CHOICE AWARD WINNER for BEST DEBUT and BEST ROMANCE of 2019 ** BEST BOOK OF THE YEAR* for VOGUE, NPR, VANITY FAIR, and more! *What happens when America\'s First Son falls in love with the Prince of Wales?When his mother became President, Alex Claremont-Diaz was promptly cast as the American equivalent of a young royal. Handsome, charismatic, genius—his image is pure millennial-marketing gold for the White House. There\'s only one problem: Alex has a beef with the actual prince, Henry, across the pond. ', 400, 958, '1691431930.jpg', 297, 'Casey Mcquiston', '432 Pages', '320g', '9781250316776', 'English', 0, 0, '', 'Paper Back', 'Fiction and Literature,\r\nLGBTQIA,\r\nRomance,\r\nYoung Adult', '2023-08-07 18:12:10'),
(52, 54, 'Ikigai', 'aadi5414book', 'It\'s the Japanese word for ‘a reason to live’ or ‘a reason to jump out of bed in the morning’. It’s the place where your needs, desires, ambitions, and satisfaction meet. A place of balance. Small wonder that finding your ikigai is closely linked to living longer. Finding your ikigai is easier than you might think. This book will help you work out what your own ikigai really is, and equip you to change your life. You have a purpose in this world: your skills, your interests, your desires and your history have made you the perfect candidate for something. All you have to do is find it.', 'It\'s the Japanese word for ‘a reason to live’ or ‘a reason to jump out of bed in the morning’. It’s the place where your needs, desires, ambitions, and satisfaction meet. A place of balance. Small wonder that finding your ikigai is closely linked to living longer. Finding your ikigai is easier than you might think. This book will help you work out what your own ikigai really is, and equip you to change your life. You have a purpose in this world: your skills, your interests, your desires and your history have made you the perfect candidate for something. All you have to do is find it.', 300, 880, '1691432087.jpg', 300, 'Hector Garcia Puigcerver', '194 Pages', '250g', '9781786330895', 'English', 0, 0, '', 'Hard Cover', 'Self Improvement and Relationships,\r\nSelf Help,\r\nHistory, Biography, and Social Science,\r\nPsychology,\r\nSpirituality and Philosophy', '2023-08-07 18:14:47'),
(53, 53, 'The Fault in Our Stars', 'aadi4168book', 'The multi-million #1 bestseller, now a major motion picture starring Shailene Woodley and Ansel Elgort. \"I fell in love the way you fall asleep: slowly, then all at once.\"Despite the tumor-shrinking medical miracle that has bought her a few years, Hazel has never been anything but terminal, her final chapter inscribed upon diagnosis. But when a gorgeous plot twist named Augustus Waters suddenly appears at Cancer Kid Support Group, Hazel\'s story is about to be completely rewritten.Insightful, bold, irreverent, and raw, The Fault in Our Stars is award-winning author John Green\'s most ambitious and heartbreaking work yet, brilliantly exploring the funny, thrilling, and tragic business of being alive and in love.', 'The multi-million #1 bestseller, now a major motion picture starring Shailene Woodley and Ansel Elgort. \"I fell in love the way you fall asleep: slowly, then all at once.\"Despite the tumor-shrinking medical miracle that has bought her a few years, Hazel has never been anything but terminal, her final chapter inscribed upon diagnosis. But when a gorgeous plot twist named Augustus Waters suddenly appears at Cancer Kid Support Group, Hazel\'s story is about to be completely rewritten.Insightful, bold, irreverent, and raw, The Fault in Our Stars is award-winning author John Green\'s most ambitious and heartbreaking work yet, brilliantly exploring the funny, thrilling, and tragic business of being alive and in love.', 300, 638, '1691432344.jpg', 299, 'John Green', '316 Pages', '245g', '9780141345659', 'English', 0, 0, '', 'Paper Back', 'Fiction and Literature,\r\nDrama,\r\nRomance,\r\nYoung Adult', '2023-08-07 18:19:04'),
(54, 54, 'PSYCHOLOGY OF MONEY', 'aadi7806book', 'Timeless lessons on wealth, greed, and happiness doing well with money isn’t necessarily about what you know. It’s about how you behave. And behavior is hard to teach, even to really smart people. How to manage money, invest it, and make business decisions are typically considered to involve a lot of mathematical calculations, where data and formulae tell us exactly what to do.', 'Timeless lessons on wealth, greed, and happiness doing well with money isn’t necessarily about what you know. It’s about how you behave. And behavior is hard to teach, even to really smart people. How to manage money, invest it, and make business decisions are typically considered to involve a lot of mathematical calculations, where data and formulae tell us exactly what to do.', 500, 638, '1691434557.jfif', 300, 'Morgan. Housel', '242 Pages', '225g', '9789390166268', 'English', 0, 0, '', 'Paper back', 'Business,\r\nBusiness and Investing,\r\nFinance,\r\nEconomics,\r\nInvesting,\r\nSelf Improvement and Relationships,\r\nSelf Help,\r\nHistory, Biography, and Social Science', '2023-08-07 18:54:35'),
(55, 54, 'Kaizen', 'aadi3866book', 'Perfect for fans of Ikigai and Marie Kondo, Kaizen is the step-by-step Japanese way to bring positive changes into your life.', 'Perfect for fans of Ikigai and Marie Kondo, Kaizen is the step-by-step Japanese way to bring positive changes into your life.', 500, 958, '1691434676.jfif', 299, 'Sarah Harvey', '288 Pages', '460g', '9781529005356', 'English', 0, 0, '', 'Hard Cover', 'Self Improvement and Relationships,\r\nSelf Help,\r\nHistory, Biography, and Social Science,\r\nPsychology,\r\nSpirituality and Philosophy', '2023-08-07 18:57:56'),
(56, 54, 'The Little Book of Hygge', 'aadi7507book', 'THE INTERNATIONAL, NEW YORK TIMES and SUNDAY TIMES BESTSELLER, WITH OVER A MILLION COPIES SOLD AROUND THE WORLD** Guaranteed to bring warmth and comfort into your life, The Little Book of Hygge is the book we all need! Denmark has an international reputation for being one of the happiest nations in the world, and hygge is widely recognised to be the magic ingredient to this happiness. Hygge has been described as everything from \"cosines of the soul\" to \"the pursuit of everyday pleasures\". The Little Book of Hygge is the book we all need right now, guaranteed to bring warmth and comfort into your life. Hooga? Hhyooguh? Heurgh? It is not really important how you choose to pronounce or even spell \'hygge\'.', 'THE INTERNATIONAL, NEW YORK TIMES and SUNDAY TIMES BESTSELLER, WITH OVER A MILLION COPIES SOLD AROUND THE WORLD** Guaranteed to bring warmth and comfort into your life, The Little Book of Hygge is the book we all need! Denmark has an international reputation for being one of the happiest nations in the world, and hygge is widely recognized to be the magic ingredient to this happiness. Hygge has been described as everything from \"cosines of the soul\" to \"the pursuit of everyday pleasures\".', 500, 958, '1691434816.png', 298, 'Meik Wiking', '287 Pages', '499g', '9780241283912', 'English', 0, 0, '', 'Hard Cover', 'Self Improvement and Relationships,\r\nSelf Help,\r\nHistory, Biography, and Social Science,\r\nPsychology,\r\nSpirituality and Philosophy', '2023-08-07 19:00:16'),
(57, 54, 'Thinking Fast and Slow', 'aadi5336book', 'The phenomenal New York TimesBestseller by Nobel Prize-winner Daniel Kahneman, Thinking Fast and Slowoffers a whole new look at the way our minds work, and how we make decisions. Why is there more chance we\'ll believe something if it\'s in a bold type face? Why are judges more likely to deny parole before lunch? Why do we assume a good-looking person will be more competent? The answer lies in the two ways we make choices- fast, intuitive thinking, and slow, rational thinking.', 'The phenomenal New York TimesBestseller by Nobel Prize-winner Daniel Kahneman, Thinking Fast and Slowoffers a whole new look at the way our minds work, and how we make decisions. Why is there more chance we\'ll believe something if it\'s in a bold type face? Why are judges more likely to deny parole before lunch? Why do we assume a good-looking person will be more competent? The answer lies in the two ways we make choices- fast, intuitive thinking, and slow, rational thinking.', 700, 1118, '1691435046.jfif', 298, 'Daniel Kahneman', '499 Pages', '390g', '9780141033570', 'English', 0, 0, '', 'Hard Cover', 'Business,\r\nBusiness and Investing,\r\nEconomics,\r\nSelf Improvement and Relationships,\r\nSelf Help,\r\nHistory, Biography, and Social Science,\r\nPsychology,\r\nLearning and Reference', '2023-08-07 19:04:06'),
(58, 53, 'Looking for Alaska', 'aadi3937book', 'Before. Miles “Pudge” Halter is done with his safe life at home. His whole life has been one big non-event, and his obsession with famous last words has only made him crave “the Great Perhaps” even more (Francois Rabelais, poet). He heads off to the sometimes crazy and anything-but-boring world of Culver Creek Boarding School, and his life becomes the opposite of safe. Because down the hall is Alaska Young. The gorgeous, clever, funny, sexy, self-destructive, screwed up, and utterly fascinating Alaska Young. ', 'Before. Miles “Pudge” Halter is done with his safe life at home. His whole life has been one big non-event, and his obsession with famous last words has only made him crave “the Great Perhaps” even more (Francois Rabelais, poet). He heads off to the sometimes crazy and anything-but-boring world of Culver Creek Boarding School, and his life becomes the opposite of safe. Because down the hall is Alaska Young. The gorgeous, clever, funny, sexy, self-destructive, screwed up, and utterly fascinating Alaska Young. ', 200, 560, '1691435474.jpg', 299, 'John Green', '288 Pages', '230g', '9780008384128', 'English', 0, 0, '', 'Jacketed', 'Fiction and Literature,\r\nRomance,\r\nYoung Adult', '2023-08-07 19:11:14'),
(59, 53, 'Everything, Everything', 'aadi8821book', 'Maddy is allergic to the world; stepping outside the sterile sanctuary of her home could kill her. But then Olly moves in next door. And just like that, Maddy realizes there\'s more to life than just being alive. You only get one chance at first love. And Maddy is ready to risk everything, everything to see where it leads. \'Powerful, lovely, heart-wrenching, and so absorbing I devoured it in one sitting\' – Jennifer Niven, author of All the Bright Places And don\'t miss Nicola Yoon\'s #1 New York Times bestseller The Sun Is Also a Star, in which two teens are brought together just when the universe is sending them in opposite directions.', 'Maddy is allergic to the world; stepping outside the sterile sanctuary of her home could kill her. But then Olly moves in next door. And just like that, Maddy realizes there\'s more to life than just being alive. You only get one chance at first love. And Maddy is ready to risk everything, everything to see where it leads. \'Powerful, lovely, heart-wrenching, and so absorbing I devoured it in one sitting\' – Jennifer Niven, author of All the Bright Places And don\'t miss Nicola Yoon\'s #1 New York Times bestseller The Sun Is Also a Star, in which two teens are brought together just when the universe is sending them in opposite directions.', 300, 638, '1691435613.jpg', 300, 'Nicola Yoon', '306 Pages', '260g', '9780552574235', 'English', 0, 0, '', 'Jacketed', 'Fiction and Literature,\r\nRomance,\r\nYoung Adult', '2023-08-07 19:13:33'),
(60, 53, 'Circe ', 'aadi6099book', 'n the house of Helios, god of the sun and mightiest of the Titans, a daughter is born. But Circe is a strange child—not powerful, like her father, nor viciously alluring like her mother. Turning to the world of mortals for companionship, she discovers that she does possess power—the power of witchcraft, which can transform rivals into monsters and menace the gods themselves.', 'In the house of Helios, god of the sun and mightiest of the Titans, a daughter is born. But Circe is a strange child—not powerful, like her father, nor viciously alluring like her mother. Turning to the world of mortals for companionship, she discovers that she does possess power—the power of witchcraft, which can transform rivals into monsters and menace the gods themselves.', 300, 1122, '1691436085.jfif', 2996, 'Madeline Miller', '393 pages', '635g', '9780316556347', 'English', 0, 0, '', 'Hard Cover', 'Novel, Historical Fiction, Fantasy, Fantasy Fiction', '2023-08-07 19:21:25'),
(61, 53, 'To Kill a Mockingbird', 'aadi5032book', '\'Shoot all the Bluejays you want, if you can hit \'em, but remember it\'s a sin to kill a Mockingbird.\'A lawyer\'s advice to his children as he defends the real mockingbird of Harper Lee\'s classic novel - a black man charged with the rape of a white girl. Through the young eyes of Scout and Jem Finch, Harper Lee explores with exuberant humour the irrationality of adult attitudes to race and class in the Deep South of the thirties. The conscience of a town steeped in prejudice, violence and hypocrisy is pricked by the stamina of one man\'s struggle for justice. But the weight of history will only tolerate so much-', '\'Shoot all the Bluejays you want, if you can hit \'em, but remember it\'s a sin to kill a Mockingbird.\'A lawyer\'s advice to his children as he defends the real mockingbird of Harper Lee\'s classic novel - a black man charged with the rape of a white girl. Through the young eyes of Scout and Jem Finch, Harper Lee explores with exuberant humour the irrationality of adult attitudes to race and class in the Deep South of the thirties. The conscience of a town steeped in prejudice, violence and hypocrisy is pricked by the stamina of one man\'s struggle for justice. But the weight of history will only tolerate so much-', 300, 720, '1691436419.png', 300, 'Harper Lee', '309 Pages', '190g', '9780099549482', 'English', 0, 0, '', 'Paper Back', 'Fiction and Literature,\r\nclassics', '2023-08-07 19:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `city` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone`, `city`, `password`, `role_as`, `created_at`) VALUES
(33, 'Yurika Tiwari', 'yurika@gmail.com', 'Satdobato', '9808061717', 'Lalitpur', '1234', 0, '2023-08-01 19:21:55'),
(34, 'Admin', 'admin@gmail.com', 'Thankot', '9808389109', 'Kathmandu', '1234', 1, '2023-08-01 19:23:04'),
(36, 'User', 'user@gmail.com', NULL, '9808389105', NULL, '1234', 0, '2023-08-01 19:42:07'),
(37, 'Aamosh Maharjan', 'aamosh@gmail.com', NULL, '9808381298', NULL, '1234', 0, '2023-08-01 19:52:36'),
(38, 'Nisha Ghimire', 'nisha@gmail.com', NULL, '9841231432', NULL, '1234', 0, '2023-08-02 06:27:42'),
(39, 'Aaditya Gupta', 'gupta54@gmail.com', NULL, '9808389105', NULL, '1234', 0, '2023-08-02 13:39:38'),
(40, 'Aaditya Gupta', 'aaditya_1@gmail.com', NULL, '9808389105', NULL, '1234567890', 0, '2023-08-02 17:14:35'),
(41, 'Aaditya Gupta', 'aaditya999@gmail.com', NULL, '9808389105', NULL, '123456789', 0, '2023-08-03 03:20:06'),
(42, 'Yurika Tiwari', 'yurika1@gmail.com', NULL, '9808061726', NULL, '123456789', 0, '2023-08-03 06:23:34'),
(43, 'Aaditya Gupta', 'gupta@gmail.com', NULL, '9808389105', NULL, '123456789', 0, '2023-08-03 19:18:07'),
(44, 'Raazan', 'rajan@gmail.com', NULL, '9818576772', NULL, '123456789', 0, '2023-08-06 15:40:48'),
(45, 'Ram Shah', 'ram@gmail.com', 'Thankot', '9808345458', 'Kathmandu', '123456789', 0, '2023-08-08 19:31:42'),
(46, 'Aamosh Maharjan', 'aamoshmaharjan@gmail.com', 'Dakshin kali', '9803728325', 'Kathmandu', 'password123', 0, '2023-08-22 02:52:47'),
(47, 'Salina Kushwar', 'salina@gmail.com', NULL, '9818345288', NULL, '123456789', 0, '2023-08-23 13:40:09'),
(48, 'User Gupta', 'user23@gmail.com', NULL, '9808389105', NULL, '123456789', 0, '2023-10-08 19:11:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `for` (`user_id`),
  ADD KEY `forn` (`prod_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forie` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`order_id`),
  ADD KEY `frn` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fori` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `for` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forn` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `forie` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `frn` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fori` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
