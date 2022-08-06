-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 07:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `block_buster`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `contact_no`, `password`, `last_login`, `is_deleted`) VALUES
('ADM_001', 'Muditha', 'workmine70@gmail.com', '94768942127', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2021-01-06 16:38:41', 0),
('ADM_002', 'Rohan', 'adfly8079@gmail.com', '94723356328', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2020-12-29 23:25:15', 0);

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `tg_admins_insert` BEFORE INSERT ON `admins` FOR EACH ROW BEGIN
  INSERT INTO admins_seq VALUES (NULL);
  SET NEW.admin_id = CONCAT('ADM_', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins_seq`
--

CREATE TABLE `admins_seq` (
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins_seq`
--

INSERT INTO `admins_seq` (`admin_id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `cbr_id` varchar(7) NOT NULL,
  `admin_id` varchar(7) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_age` int(2) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `c_descrip` varchar(5000) NOT NULL,
  `years` int(3) NOT NULL,
  `ratings` int(2) NOT NULL,
  `number_of_films` int(5) NOT NULL,
  `number_of_tvseries` int(5) NOT NULL,
  `main_img` varchar(200) NOT NULL,
  `im_1` varchar(200) NOT NULL,
  `im_2` varchar(200) NOT NULL,
  `im_3` varchar(200) NOT NULL,
  `im_4` varchar(200) NOT NULL,
  `u_date_time` datetime NOT NULL,
  `l_u_date_time` varchar(25) NOT NULL,
  `l_u_admin` varchar(7) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`cbr_id`, `admin_id`, `c_name`, `c_age`, `birthday`, `c_descrip`, `years`, `ratings`, `number_of_films`, `number_of_tvseries`, `main_img`, `im_1`, `im_2`, `im_3`, `im_4`, `u_date_time`, `l_u_date_time`, `l_u_admin`, `is_deleted`) VALUES
('CBR001', 'ADM_001', 'Maisie Williams', 23, '15 April 1997', 'Margaret Constance \"Maisie\" Williams (born 15 April 1997) is an English actress. In 2011, she debuted in a professional acting role at age fourteen, starring as Arya Stark, a main-cast role in the HBO medieval fantasy epic drama series Game of Thrones (2011–2019), a portrayal that quickly brought the acting newcomer global attention. Williams received critical praise and accolades for her work on the show, including two nominations for the Primetime Emmy Award for Outstanding Supporting Actress in a Drama Series. Williams\' other television appearances include guest-starring in four episodes of the BBC science fiction series Doctor Who (2015), the British docudrama television film Cyberbully (2015), the British science-fiction teen thriller film iBoy (2017), and the comedy action drama series Two Weeks to Live (2020). Williams also voiced Cammie MacCloud in the American animated web series Gen: Lock (2019–present).\r\n\r\nIn 2014, she starred in her first feature film, the melodramatic coming-of-age mystery drama The Falling, for which she received critical acclaim and awards recognition. She had co-starring roles in films such as the romantic period-drama film Mary Shelley (2017), the animated prehistorical sports comedy film Early Man (2018), and the romantic comedy-drama film Then Came You (2018). In 2020 she starred in the superhero horror film The New Mutants and the psychological thriller The Owners. In 2018, she made her stage debut in Lauren Gunderson\'s play I and You at the Hampstead Theatre in London, to positive critical reviews.\r\n\r\nWilliams is also an internet entrepreneur. In 2019, she jointly developed and co-launched the social media platform Daisie, a multi-media networking app designed to be an alternative means to help artists and creators (especially those who are trying to get started) in their careers. One of the main purposes of the platform is to support collaboration between creators on artistic projects from across various creative industries, as well as a hosting service upon which creators can showcase their own and joint work.', 10, 8, 20, 6, '0618341dd98c257646c3353f031eb4302744d170_hq.jpg', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', 'cb2ab56a92f9495829b07746920e3887.jpg', '1505638458_T99OzJIjWgA.jpg', '2021-01-04 12:00:41', '2021-01-04 14:27:57pm', 'ADM_001', 1),
('CBR002', 'ADM_001', 'Maisie Williams', 23, '15 April 1997', 'Margaret Constance \"Maisie\" Williams (born 15 April 1997) is an English actress. In 2011, she debuted in a professional acting role at age fourteen, starring as Arya Stark, a main-cast role in the HBO medieval fantasy epic drama series Game of Thrones (2011–2019), a portrayal that quickly brought the acting newcomer global attention. Williams received critical praise and accolades for her work on the show, including two nominations for the Primetime Emmy Award for Outstanding Supporting Actress in a Drama Series. Williams\' other television appearances include guest-starring in four episodes of the BBC science fiction series Doctor Who (2015), the British docudrama television film Cyberbully (2015), the British science-fiction teen thriller film iBoy (2017), and the comedy action drama series Two Weeks to Live (2020). Williams also voiced Cammie MacCloud in the American animated web series Gen: Lock (2019–present).\r\n\r\nIn 2014, she starred in her first feature film, the melodramatic coming-of-age mystery drama The Falling, for which she received critical acclaim and awards recognition. She had co-starring roles in films such as the romantic period-drama film Mary Shelley (2017), the animated prehistorical sports comedy film Early Man (2018), and the romantic comedy-drama film Then Came You (2018). In 2020 she starred in the superhero horror film The New Mutants and the psychological thriller The Owners. In 2018, she made her stage debut in Lauren Gunderson\'s play I and You at the Hampstead Theatre in London, to positive critical reviews.\r\n\r\nWilliams is also an internet entrepreneur. In 2019, she jointly developed and co-launched the social media platform Daisie, a multi-media networking app designed to be an alternative means to help artists and creators (especially those who are trying to get started) in their careers. One of the main purposes of the platform is to support collaboration between creators on artistic projects from across various creative industries, as well as a hosting service upon which creators can showcase their own and joint work.', 10, 8, 20, 7, 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '0618341dd98c257646c3353f031eb4302744d170_hq.jpg', '1505638458_T99OzJIjWgA.jpg', 'cb2ab56a92f9495829b07746920e3887.jpg', '2021-01-04 12:10:10', '', '', 0),
('CBR003', 'ADM_001', 'Maisie Williams', 23, '15 April 1997', 'anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything anything ', 10, 5, 6, 9, '0618341dd98c257646c3353f031eb4302744d170_hq.jpg', 'cb2ab56a92f9495829b07746920e3887.jpg', '1505638458_T99OzJIjWgA.jpg', 'maisie_williams-game-of-thrones-season-7-e1545513150926.jpg', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', '2021-01-04 22:06:02', '', '', 0);

--
-- Triggers `celebrities`
--
DELIMITER $$
CREATE TRIGGER `tg_celebrities_insert` BEFORE INSERT ON `celebrities` FOR EACH ROW BEGIN
  INSERT INTO celebrities_seq VALUES (NULL);
  SET NEW.cbr_id = CONCAT('CBR', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `celebrities_seq`
--

CREATE TABLE `celebrities_seq` (
  `cbr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celebrities_seq`
--

INSERT INTO `celebrities_seq` (`cbr_id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` varchar(7) NOT NULL,
  `admin_id` varchar(7) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `main_img` varchar(200) NOT NULL,
  `small_descrip` varchar(150) NOT NULL,
  `m_descrip` varchar(5000) NOT NULL,
  `m_director` varchar(50) NOT NULL,
  `m_writer` varchar(50) NOT NULL,
  `stars` varchar(100) NOT NULL,
  `genres` varchar(100) NOT NULL,
  `main_category` varchar(20) NOT NULL,
  `action` varchar(4) NOT NULL,
  `sci_fi` varchar(4) NOT NULL,
  `animation` varchar(4) NOT NULL,
  `comady` varchar(4) NOT NULL,
  `thriller` varchar(4) NOT NULL,
  `horror` varchar(4) NOT NULL,
  `language` varchar(15) NOT NULL,
  `condi` varchar(30) NOT NULL,
  `relese_date` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `run_time` varchar(10) NOT NULL,
  `ratings` int(5) NOT NULL,
  `vid1_e_link` varchar(1000) NOT NULL,
  `vid2_e_link` varchar(1000) NOT NULL,
  `vid3_e_link` varchar(1000) NOT NULL,
  `off_t_e_link` varchar(1000) NOT NULL,
  `im_1` varchar(200) NOT NULL,
  `im_2` varchar(200) NOT NULL,
  `im_3` varchar(200) NOT NULL,
  `im_4` varchar(200) NOT NULL,
  `im_5` varchar(200) NOT NULL,
  `im_6` varchar(200) NOT NULL,
  `im_7` varchar(200) NOT NULL,
  `im_8` varchar(200) NOT NULL,
  `im_9` varchar(200) NOT NULL,
  `im_10` varchar(200) NOT NULL,
  `im_11` varchar(200) NOT NULL,
  `im_12` varchar(200) NOT NULL,
  `u_date` date NOT NULL,
  `u_time` time NOT NULL,
  `l_u_date_time` varchar(25) NOT NULL,
  `l_u_admin` varchar(7) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `admin_id`, `m_name`, `main_img`, `small_descrip`, `m_descrip`, `m_director`, `m_writer`, `stars`, `genres`, `main_category`, `action`, `sci_fi`, `animation`, `comady`, `thriller`, `horror`, `language`, `condi`, `relese_date`, `year`, `run_time`, `ratings`, `vid1_e_link`, `vid2_e_link`, `vid3_e_link`, `off_t_e_link`, `im_1`, `im_2`, `im_3`, `im_4`, `im_5`, `im_6`, `im_7`, `im_8`, `im_9`, `im_10`, `im_11`, `im_12`, `u_date`, `u_time`, `l_u_date_time`, `l_u_admin`, `is_deleted`) VALUES
('MOV001', 'ADM_001', 'Bloodshot', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '', 'Bloodshot is a 2020 American superhero film based on the Valiant Comics character of the same name. It is intended to be the first installment in a series of films set within a Valiant Comics shared cinematic universe.[3] Directed by David S. F. Wilson (in his feature directorial debut) from a screenplay by Jeff Wadlow and Eric Heisserer and a story by Wadlow,[4] the film stars Vin Diesel, Eiza González, Sam Heughan, Toby Kebbell, and Guy Pearce. It follows a Marine who was killed in action, only to be brought back to life with superpowers by an organization that wants to use him as a weapon.\r\n\r\nBloodshot was theatrically released in the United States on March 13, 2020, by Sony Pictures Releasing. The film grossed $37 million worldwide and received mixed reviews from critics. Due to the COVID-19 pandemic closing theaters across the globe, Sony made the film available digitally on-demand less than two weeks after it was released theatrically. A sequel is in development.', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', '', 'March 13, 2020', 0, '109min', 6, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV002', 'ADM_001', 'Bloodshot', 'hqdefault (1).jpg', '', 'Bloodshot is a 2020 American superhero film based on the Valiant Comics character of the same name. It is intended to be the first installment in a series of films set within a Valiant Comics shared cinematic universe.[3] Directed by David S. F. Wilson (in his feature directorial debut) from a screenplay by Jeff Wadlow and Eric Heisserer and a story by Wadlow,[4] the film stars Vin Diesel, Eiza González, Sam Heughan, Toby Kebbell, and Guy Pearce. It follows a Marine who was killed in action, only to be brought back to life with superpowers by an organization that wants to use him as a weapon.\r\n\r\nBloodshot was theatrically released in the United States on March 13, 2020, by Sony Pictures Releasing. The film grossed $37 million worldwide and received mixed reviews from critics. Due to the COVID-19 pandemic closing theaters across the globe, Sony made the film available digitally on-demand less than two weeks after it was released theatrically. A sequel is in development.', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 6, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', '0000-00-00', '00:00:00', '', '', 1),
('MOV003', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'Bloodshot is a 2020 American superhero film based on the Valiant Comics character of the same name. It is intended to be the first installment in a series of films set within a Valiant Comics shared cinematic universe.[3] Directed by David S. F. Wilson (in his feature directorial debut) from a screenplay by Jeff Wadlow and Eric Heisserer and a story by Wadlow,[4] the film stars Vin Diesel, Eiza González, Sam Heughan, Toby Kebbell, and Guy Pearce. It follows a Marine who was killed in action, only to be brought back to life with superpowers by an organization that wants to use him as a weapon.\r\n\r\nBloodshot was theatrically released in the United States on March 13, 2020, by Sony Pictures Releasing. The film grossed $37 million worldwide and received mixed reviews from critics. Due to the COVID-19 pandemic closing theaters across the globe, Sony made the film available digitally on-demand less than two weeks after it was released theatrically. A sequel is in development.', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 6, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV004', 'ADM_001', 'Bloodshot', 'hqdefault (1).jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 5, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV005', 'ADM_001', 'Bloodshot', '24958162-0-image-a-34_1582162206503.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV006', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 1),
('MOV007', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV008', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV009', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV010', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV011', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 0),
('MOV012', 'ADM_001', 'Bloodshot', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '', 'jln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfajln               fkjvfhbkjhbdkjhhjgvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvfa', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', '', 'March 13, 2020', 0, '109min', 4, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00', '00:00:00', '', '', 1),
('MOV013', 'ADM_001', 'Bloodshot', 'eiza_gonzalez-compressed.jpg', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'jhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghg', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 6, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', '0000-00-00', '00:00:00', '', '', 1),
('MOV014', 'ADM_001', 'Bloodshot', 'eiza_gonzalez-compressed.jpg', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'jhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghgjhgjhdggfgjhsgfsgfhsjhgfjhg gsjgfjhsgfg gjsgfjhgf gjsfgjhsgfhgsf ggsfjsgjfgs gjsfgghg', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 6, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', 'Premiere+Sony+Pictures+Bloodshot+Arrivals+8UyUeSXpUDmx.jpg', '0000-00-00', '00:00:00', '', '', 1),
('MOV015', 'ADM_001', 'Bloodshot', 'Screen-Shot-2020-03-24-at-10.59.26-AM.png', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf \r\nffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf\r\n\r\nffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfv', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 7, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2020-12-29', '00:00:00', '', '', 1),
('MOV016', 'ADM_001', 'Bloodshot', 'Screen-Shot-2020-03-24-at-10.59.26-AM.png', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf \r\nffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf\r\n\r\nffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfv', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 7, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2020-12-29', '00:00:00', '', '', 1);
INSERT INTO `movies` (`movie_id`, `admin_id`, `m_name`, `main_img`, `small_descrip`, `m_descrip`, `m_director`, `m_writer`, `stars`, `genres`, `main_category`, `action`, `sci_fi`, `animation`, `comady`, `thriller`, `horror`, `language`, `condi`, `relese_date`, `year`, `run_time`, `ratings`, `vid1_e_link`, `vid2_e_link`, `vid3_e_link`, `off_t_e_link`, `im_1`, `im_2`, `im_3`, `im_4`, `im_5`, `im_6`, `im_7`, `im_8`, `im_9`, `im_10`, `im_11`, `im_12`, `u_date`, `u_time`, `l_u_date_time`, `l_u_admin`, `is_deleted`) VALUES
('MOV017', 'ADM_001', 'Bloodshot- Updated', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf \r\nffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf\r\n\r\nffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfv', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 7, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'hqdefault (1).jpg', 'hqdefault (1).jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2020-12-29', '02:04:38', '2020-12-29 23:24:02pm', 'ADM_001', 1),
('MOV018', 'ADM_001', 'Bloodshot', 'Screen-Shot-2020-03-24-at-10.59.26-AM.png', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf \r\nffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf\r\n\r\nffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfv', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 7, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2020-12-29', '02:07:48', '', '', 0),
('MOV019', 'ADM_001', 'Bloodshot', 'Screen-Shot-2020-03-24-at-10.59.26-AM.png', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf \r\nffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf\r\n\r\nffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdf ffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfffdhgfdhftefhgdfv', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 7, 'src=\"https://www.youtube.com/embed/BzOl5DpWO8k\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/Nbn35yCrV3Y\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vQT0qBWQyzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/vOUVVDWdXbo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2020-12-29', '14:08:14', '', '', 1),
('MOV020', 'ADM_001', 'Bloodshot', '25651154-0-image-a-147_1583551989742.jpg', 'small descrio sgdfcvgfhgfgfgsffggsdad', 'fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd v fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd v fsghfhsfghdf  fdsfahghgfgha gcfsdfhgdhcgfsdgcfvc fdchagfchgsafccd', 'David S. F. Wilson', 'Jeff Wadlow', 'Vin Diesel Eiza González, Sam Heughan,<br>Toby Kebbell Guy Pearce', 'Action, Fantacy,<br> Sci-fi', 'Action', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Hollywood', 'Relesed', 'March 13, 2020', 2020, '109min', 2, 'https://www.youtube.com/embed/BzOl5DpWO8k', 'https://www.youtube.com/embed/BzOl5DpWO8k', 'https://www.youtube.com/embed/BzOl5DpWO8k', 'https://www.youtube.com/embed/BzOl5DpWO8k', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '24958162-0-image-a-34_1582162206503.jpg', '2020-12-29', '16:41:22', '', '', 1);

--
-- Triggers `movies`
--
DELIMITER $$
CREATE TRIGGER `tg_movies_insert` BEFORE INSERT ON `movies` FOR EACH ROW BEGIN
  INSERT INTO movies_seq VALUES (NULL);
  SET NEW.movie_id = CONCAT('MOV', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `movies_seq`
--

CREATE TABLE `movies_seq` (
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies_seq`
--

INSERT INTO `movies_seq` (`movie_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` varchar(7) NOT NULL,
  `post_id` varchar(7) NOT NULL,
  `user_id` varchar(7) NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `ratings` int(2) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `u_date_time` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `post_id`, `user_id`, `r_name`, `ratings`, `description`, `u_date_time`, `is_deleted`) VALUES
('REV001', 'MOV010', 'USR_001', 'This is the best movie that I ever watched', 9, 'This is the best movie that i ever watched. I would like to tell everyone please watch this movie. This is the best movie that i ever watched. I would like to tell everyone please watch this movie. This is the best movie that i ever watched. I would like to tell everyone please watch this movie. This is the best movie that i ever watched. I would like to tell everyone please watch this movie. This is the best movie that i ever watched. I would like to tell everyone please watch this movie. This is the best movie that i ever watched. I would like to tell everyone please watch this movie.', '2021-01-01 16:09:43', 1),
('REV002', 'MOV010', 'USR_001', 'liu;i;p\'\'o\'\'o\'o\'o\'', 5, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\n\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\nwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '2021-01-01 16:25:03', 1),
('REV003', 'MOV010', 'USR_001', 'This is the best movie that I ever watched', 9, 'This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie.', '2021-01-01 23:02:33', 1),
('REV004', 'MOV010', 'USR_001', 'This is the best movie that I ever watched', 3, 'This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie.', '2021-01-01 23:02:55', 0),
('REV005', 'MOV010', 'USR_001', 'This is the best movie that I ever watched', 6, 'This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie. This is the best movie that I ever watched. I would like to tell everybody to watch this movie.', '2021-01-01 23:03:20', 0),
('REV006', 'MOV010', 'USR_001', 'This is the best movie that I ever watched', 7, 'This is the best movie that I ever watched. I would like to tell everybody to watch this movie.This is the best movie that I ever watched. I would like to tell everybody to watch this movie.', '2021-01-01 23:03:45', 1);

--
-- Triggers `reviews`
--
DELIMITER $$
CREATE TRIGGER `tg_reviews_insert` BEFORE INSERT ON `reviews` FOR EACH ROW BEGIN
  INSERT INTO reviews_seq VALUES (NULL);
  SET NEW.review_id = CONCAT('REV', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_seq`
--

CREATE TABLE `reviews_seq` (
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews_seq`
--

INSERT INTO `reviews_seq` (`review_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `tsrreviews`
--

CREATE TABLE `tsrreviews` (
  `review_id` varchar(7) NOT NULL,
  `post_id` varchar(7) NOT NULL,
  `user_id` varchar(7) NOT NULL,
  `r_name` varchar(100) NOT NULL,
  `ratings` int(2) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `u_date_time` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tsrreviews`
--

INSERT INTO `tsrreviews` (`review_id`, `post_id`, `user_id`, `r_name`, `ratings`, `description`, `u_date_time`, `is_deleted`) VALUES
('REV001', 'TSR001', 'USR_001', 'This is the best tv seriesthat I ever watched', 8, 'This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched.This is the best tv seriesthat I ever watched', '2021-01-03 15:38:22', 1);

--
-- Triggers `tsrreviews`
--
DELIMITER $$
CREATE TRIGGER `tg_tsrreviews_insert` BEFORE INSERT ON `tsrreviews` FOR EACH ROW BEGIN
  INSERT INTO tsrreviews_seq VALUES (NULL);
  SET NEW.review_id = CONCAT('REV', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tsrreviews_seq`
--

CREATE TABLE `tsrreviews_seq` (
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tsrreviews_seq`
--

INSERT INTO `tsrreviews_seq` (`review_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `tvseries`
--

CREATE TABLE `tvseries` (
  `series_id` varchar(7) NOT NULL,
  `admin_id` varchar(7) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `main_img` varchar(200) NOT NULL,
  `small_descrip` varchar(150) NOT NULL,
  `s_descrip` varchar(5000) NOT NULL,
  `s_director` varchar(50) NOT NULL,
  `s_writer` varchar(50) NOT NULL,
  `stars` varchar(100) NOT NULL,
  `genres` varchar(100) NOT NULL,
  `seasons` varchar(10) NOT NULL,
  `main_category` varchar(20) NOT NULL,
  `action` varchar(4) NOT NULL,
  `sci_fi` varchar(4) NOT NULL,
  `animation` varchar(4) NOT NULL,
  `comady` varchar(4) NOT NULL,
  `thriller` varchar(4) NOT NULL,
  `horror` varchar(4) NOT NULL,
  `language` varchar(15) NOT NULL,
  `condi` varchar(30) NOT NULL,
  `relese_date` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `run_time` varchar(10) NOT NULL,
  `ratings` int(5) NOT NULL,
  `vid1_e_link` varchar(1000) NOT NULL,
  `vid2_e_link` varchar(1000) NOT NULL,
  `vid3_e_link` varchar(1000) NOT NULL,
  `off_t_e_link` varchar(1000) NOT NULL,
  `im_1` varchar(200) NOT NULL,
  `im_2` varchar(200) NOT NULL,
  `im_3` varchar(200) NOT NULL,
  `im_4` varchar(200) NOT NULL,
  `im_5` varchar(200) NOT NULL,
  `im_6` varchar(200) NOT NULL,
  `im_7` varchar(200) NOT NULL,
  `im_8` varchar(200) NOT NULL,
  `im_9` varchar(200) NOT NULL,
  `im_10` varchar(200) NOT NULL,
  `im_11` varchar(200) NOT NULL,
  `im_12` varchar(200) NOT NULL,
  `u_date` date NOT NULL,
  `u_time` time NOT NULL,
  `l_u_date_time` varchar(25) NOT NULL,
  `l_u_admin` varchar(7) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tvseries`
--

INSERT INTO `tvseries` (`series_id`, `admin_id`, `s_name`, `main_img`, `small_descrip`, `s_descrip`, `s_director`, `s_writer`, `stars`, `genres`, `seasons`, `main_category`, `action`, `sci_fi`, `animation`, `comady`, `thriller`, `horror`, `language`, `condi`, `relese_date`, `year`, `run_time`, `ratings`, `vid1_e_link`, `vid2_e_link`, `vid3_e_link`, `off_t_e_link`, `im_1`, `im_2`, `im_3`, `im_4`, `im_5`, `im_6`, `im_7`, `im_8`, `im_9`, `im_10`, `im_11`, `im_12`, `u_date`, `u_time`, `l_u_date_time`, `l_u_admin`, `is_deleted`) VALUES
('TSR001', 'ADM_001', 'GOT - Updated', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', 'ptation of A Song of Ice and Fire, a series of fantasy novels by George R. R. Martin, the first of which is A Game of Thrones.', 'Game of Thrones is an American fantasy drama television series created by David Benioff and D. B. Weiss for HBO. It is an adaptation of A Song of Ice and Fire, a series of fantasy novels by George R. R. Martin, the first of which is A Game of Thrones. The show was shot in the United Kingdom, Canada, Croatia, Iceland, Malta, Morocco, and Spain. It premiered on HBO in the United States on April 17, 2011, and concluded on May 19, 2019, with 73 episodes broadcast over eight seasons.\\r\\n\\r\\nSet on the fictional continents of Westeros and Essos, Game of Thrones has a large ensemble cast and follows several story arcs throughout the course of the show. A major arc concerns the Iron Throne of the Seven Kingdoms of Westeros and follows a web of alliances and conflicts among the noble dynasties, either vying to claim the throne or fighting for independence from it. Another focuses on the last descendant of the realm\\\'s deposed ruling dynasty, who has been exiled to Essos and is plotting a return to the throne. A third story arc follows the Night\\\'s Watch, a military order defending the realm against threats from the North.\\r\\n\\r\\nGame of Thrones attracted record viewership on HBO and has a broad, active, and international fan base. Critics have praised the series for its acting, complex characters, story, scope, and production values, although its frequent use of nudity and violence (including sexual violence) has been subject to criticism. The final season received significant critical backlash for its reduced length and creative decisions, with many considering it a disappointing conclusion. ', 'David Benioff', 'D. B. Weiss', 'Sean Bean-Eddard \\', 'Thriller,Fantacy<br>Action', '8 Seasons', 'Action', 'Yes', 'No', 'No', 'No', 'Yes', 'Yes', 'Hollywood', 'Relesed', 'April 17, 2011', 2011, '1hour', 7, 'src=\"https://www.youtube.com/embed/UuKqvE5Db2c\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/giYeaKsXnsI\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/gcTkNV5Vg1E\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', 'src=\"https://www.youtube.com/embed/rlR4PJn8b8I\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', '1539852982_latest-maisie-williamse280ac-new-images.jpg', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', 'maisie-williamsandroid-iphone-desktop-hd-backgrounds-wallpapers-1080p-4k-d2qg4-1280x1920.jpg', '2021-01-02', '16:07:06', '2021-01-03 0:26:35am', 'ADM_001', 0);

--
-- Triggers `tvseries`
--
DELIMITER $$
CREATE TRIGGER `tg_tvseries_insert` BEFORE INSERT ON `tvseries` FOR EACH ROW BEGIN
  INSERT INTO tvseries_seq VALUES (NULL);
  SET NEW.series_id = CONCAT('TSR', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tvseries_seq`
--

CREATE TABLE `tvseries_seq` (
  `series_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tvseries_seq`
--

INSERT INTO `tvseries_seq` (`series_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `p_photo` varchar(200) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `p_photo`, `last_login`, `is_deleted`) VALUES
('USR_001', 'Muditha', 'workmine70@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '2021-01-03 21:56:04', 0),
('USR_002', 'Muditha', 'adfly8079@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'hqdefault (1).jpg', '2020-12-31 13:07:25', 0),
('USR_003', 'Muditha', 'gothamalmed@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'd67dc1fd0cefd338d48b99df18a92401.jpg', '0000-00-00 00:00:00', 1),
('USR_004', 'Kevin', 'kevin@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'hqdefault (1).jpg', '0000-00-00 00:00:00', 0),
('USR_005', 'Kasun', 'asdf@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'hqdefault (1).jpg', '2021-01-03 21:54:32', 1),
('USR_006', 'Muditha', 'asdfghj@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Lamorne-Morris-cast-in-Bloodshot-starring-Vin-Diesel.jpg', '0000-00-00 00:00:00', 0);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `tg_users_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  INSERT INTO users_seq VALUES (NULL);
  SET NEW.user_id = CONCAT('USR_', LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_seq`
--

CREATE TABLE `users_seq` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_seq`
--

INSERT INTO `users_seq` (`user_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admins_seq`
--
ALTER TABLE `admins_seq`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`cbr_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `celebrities_seq`
--
ALTER TABLE `celebrities_seq`
  ADD PRIMARY KEY (`cbr_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `admin_id_f_m` (`admin_id`);

--
-- Indexes for table `movies_seq`
--
ALTER TABLE `movies_seq`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `reviews_seq`
--
ALTER TABLE `reviews_seq`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tsrreviews`
--
ALTER TABLE `tsrreviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tsrreviews_seq`
--
ALTER TABLE `tsrreviews_seq`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tvseries`
--
ALTER TABLE `tvseries`
  ADD PRIMARY KEY (`series_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tvseries_seq`
--
ALTER TABLE `tvseries_seq`
  ADD PRIMARY KEY (`series_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_seq`
--
ALTER TABLE `users_seq`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_seq`
--
ALTER TABLE `admins_seq`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `celebrities_seq`
--
ALTER TABLE `celebrities_seq`
  MODIFY `cbr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies_seq`
--
ALTER TABLE `movies_seq`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews_seq`
--
ALTER TABLE `reviews_seq`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tsrreviews_seq`
--
ALTER TABLE `tsrreviews_seq`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tvseries_seq`
--
ALTER TABLE `tvseries_seq`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_seq`
--
ALTER TABLE `users_seq`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD CONSTRAINT `celebrities_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `tsrreviews`
--
ALTER TABLE `tsrreviews`
  ADD CONSTRAINT `tsrreviews_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `tvseries` (`series_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tvseries`
--
ALTER TABLE `tvseries`
  ADD CONSTRAINT `tvseries_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
