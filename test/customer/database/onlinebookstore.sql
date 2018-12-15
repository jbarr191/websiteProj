-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 03:38 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `user_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorNum` decimal(2,0) NOT NULL,
  `authorLast` char(12) DEFAULT NULL,
  `authorFirst` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorNum`, `authorLast`, `authorFirst`) VALUES
('1', 'Morrison', 'Toni'),
('2', 'Solotaroff', 'Paul'),
('3', 'Vintage', 'Vernor'),
('4', 'Francis', 'Dick'),
('5', 'Straub', 'Peter'),
('6', 'King', 'Stephen'),
('7', 'Pratt', 'Philip'),
('8', 'Chase', 'Truddi'),
('9', 'Collins', 'Bradley'),
('10', 'Heller', 'Joseph'),
('11', 'Wills', 'Gary'),
('12', 'Hofstadter', 'Douglas R.'),
('13', 'Lee', 'Harper'),
('14', 'Ambrose', 'Stephen E.'),
('15', 'Rowling', 'J.K.'),
('16', 'Salinger', 'J.D.'),
('17', 'Heaney', 'Seamus'),
('18', 'Camus', 'Albert'),
('19', 'Collins, Jr.', 'Bradley'),
('20', 'Steinbeck', 'John'),
('21', 'Castelman', 'Riva'),
('22', 'Owen', 'Barbara'),
('23', 'O\'Rourke', 'Randy'),
('24', 'Kidder', 'Tracy'),
('25', 'Schleining', 'Lon');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `book_id` int(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `comment_text` text,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `gen_id` int(100) NOT NULL,
  `gen_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`gen_id`, `gen_type`) VALUES
(1, 'SCI'),
(2, 'FIC');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `product_author` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` double NOT NULL,
  `product_bio` text NOT NULL,
  `product_genre` varchar(255) NOT NULL,
  `product_pub` text NOT NULL,
  `product_release` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_image`, `product_author`, `product_desc`, `product_price`, `product_bio`, `product_genre`, `product_pub`, `product_release`) VALUES
(5, 'To Kill a Mockingbird', 'mockingbird.jpg', 'Harper Lee', 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it, To Kill A Mockingbird became both an instant bestseller and a critical success when it was first published in 1960. It went on to win the Pulitzer Prize in 1961 and was later made into an Academy Award-winning film, also a classic.', 6.61, 'Nelle Harper Lee (April 28, 1926 â€“ February 19, 2016), better known by her pen name Harper Lee, was an American novelist widely known for To Kill a Mockingbird, published in 1960. Immediately successful, it won the 1961 Pulitzer Prize and has become a classic of modern American literature.', '2', 'Warner Books, Inc.', '1960-07-11'),
(6, 'Pride and Prejudice', 'pride.jpg', 'Jane Austen', 'â€œIt is a truth universally acknowledged, that a single man in possession of a good fortune must be in want of a wife.â€ So begins Pride and Prejudice, Jane Austenâ€™s witty comedy of mannersâ€”one of the most popular novels of all timeâ€”that features splendidly civilized sparring between the proud Mr. Darcy and the prejudiced Elizabeth Bennet', 6.99, 'Jane Austen (16 December 1775 â€“ 18 July 1817) was an English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century. ', '2', 'Thomas Egerton', '1813-01-28'),
(8, 'The Great Gatsby', 'greatGatsby.jpg', 'Francis Fitzgerald', 'Jay Gatsby is the man who has everything. But one thing will always be out of his reach. Everybody who is anybody is seen at his glittering parties. Day and night his Long Island mansion buzzes with bright young things drinking, dancing, and debating his mysterious character. ', 3.99, 'Francis Scott Key Fitzgerald was an American writer of novels and short stories, whose works have been seen as evocative of the Jazz Age, a term he himself allegedly coined. He is regarded as one of the greatest twentieth century writers.', '2', 'Charles Scribners Sons', '1925-04-10'),
(9, 'The Book Thief', 'bookthief.jpg', 'Markus Zusak', 'Itâ€™s just a small story really, about among other things: a girl, some words, an accordionist, some fanatical Germans, a Jewish fist-fighter, and quite a lot of thievery ...', 5.29, 'Markus Zusak was born in 1975 and is the author of five books, including the international bestseller, The Book Thief , which is translated into more than forty languages.', '2', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorNum`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `gen_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
