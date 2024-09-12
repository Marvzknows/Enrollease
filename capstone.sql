-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 02:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_log` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `teacher_id`, `description`, `date_log`, `time`) VALUES
(145, 'TCH-609986', 'Logged in', '2023-11-09', '02:38:00'),
(146, 'TCH-609986', 'Logged Out', '2023-11-09', '02:50:00'),
(147, 'TCH-609986', 'Logged in', '2023-11-12', '07:22:00'),
(148, 'TCH-609986', 'Logged Out', '2023-11-12', '07:22:00'),
(149, 'TCH-609986', 'Logged in', '2023-11-13', '11:17:00'),
(150, 'TCH-609986', 'Logged Out', '2023-11-13', '11:17:00'),
(151, 'TCH-609986', 'Logged in', '2023-11-13', '11:53:00'),
(152, 'TCH-609986', 'Logged Out', '2023-11-13', '11:54:00'),
(153, 'TCH-609986', 'Logged in', '2023-11-13', '11:55:00'),
(154, 'TCH-609986', 'Successfuly Enrolled Student: 000000006666', '2023-11-13', '11:58:00'),
(155, 'TCH-609986', 'Logged Out', '2023-11-13', '11:58:00'),
(156, 'TCH-609986', 'Logged in', '2023-11-14', '11:29:00'),
(157, 'TCH-609986', 'Logged Out', '2023-11-14', '11:29:00'),
(158, 'TCH-609986', 'Logged in', '2023-11-15', '12:07:00'),
(159, 'TCH-609986', 'Logged Out', '2023-11-15', '12:14:00'),
(160, 'TCH-609986', 'Logged in', '2023-11-15', '12:19:00'),
(161, 'TCH-609986', 'Logged Out', '2023-11-15', '12:24:00'),
(162, 'TCH-609986', 'Logged in', '2023-11-15', '12:27:00'),
(163, 'TCH-609986', 'Successfuly Enrolled Student: 874512369087', '2023-11-15', '12:36:00'),
(164, 'TCH-609986', 'Logged Out', '2023-11-15', '12:38:00'),
(165, 'TCH-609986', 'Logged in', '2023-11-15', '12:38:00'),
(166, 'TCH-609986', 'Successfuly Enrolled Student: 609823741256', '2023-11-15', '12:39:00'),
(167, 'TCH-609986', 'Successfuly Enrolled Student: 532198765432', '2023-11-15', '12:41:00'),
(168, 'TCH-609986', 'Logged Out', '2023-11-15', '12:41:00'),
(169, 'TCH-324299', 'Logged in', '2023-11-15', '01:51:00'),
(170, 'TCH-324299', 'Logged in', '2023-11-15', '01:53:00'),
(171, 'TCH-324299', 'Successfully Changed Password', '2023-11-15', '01:53:00'),
(172, 'TCH-324299', 'Logged in', '2023-11-15', '01:53:00'),
(173, 'TCH-324299', 'Logged Out', '2023-11-15', '01:54:00'),
(174, 'TCH-324299', 'Logged in', '2023-11-15', '01:54:00'),
(175, 'TCH-324299', 'Logged Out', '2023-11-15', '01:58:00'),
(176, 'TCH-324299', 'Logged in', '2023-11-15', '01:58:00'),
(177, 'TCH-324299', 'Successfuly Enrolled Student: 874512369087', '2023-11-15', '02:01:00'),
(178, 'TCH-324299', 'Successfuly Enrolled Student: 900512369087', '2023-11-15', '02:04:00'),
(179, 'TCH-324299', 'Logged Out', '2023-11-15', '02:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `password`) VALUES
(1, 'admin_una', 'admin123'),
(3, 'Admin', 'OneKapitanganNHS');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `balik_aral_status` varchar(255) NOT NULL DEFAULT 'Regular',
  `image` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_mname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `grade_section` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) NOT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) NOT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) NOT NULL,
  `guardian_lname` varchar(255) NOT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `last_school_data` varchar(255) DEFAULT NULL,
  `last_sy_completed_data` varchar(255) DEFAULT NULL,
  `last_level_completed_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `student_id`, `school_year`, `balik_aral_status`, `image`, `student_fname`, `student_mname`, `student_lname`, `grade_section`, `lrn`, `mother_tongue`, `birth_place`, `bday`, `gender`, `house_no`, `street_name`, `barangay`, `municipality`, `province`, `country`, `zip_code`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `last_school_data`, `last_sy_completed_data`, `last_level_completed_data`) VALUES
(33, 'SID-669574', '2020-2021', 'Regular', '', 'a', 'a', 'a', '9 Sunflower', '12412', 'a', 'q35rq', '2023-09-10', 'male', '1241', 'a', 'a', 'a', 'a', 'a', '1241', 'a', 'a', 'a', '124', 'a', 'a', 'a', '141', 'a', 'a', 'a', '523', '[object HTMLInputElement]', '[object HTMLInputElement]', '[object HTMLInputElement]'),
(35, 'SID-339808', '2020-2021', 'Transferee', '', 'hello', 'hello', 'hello', '9 Sunflower', '5235', 'hello', 'hello', '2023-09-02', 'male', '253', 'hello', 'hello', 'hello', 'hello', 'hello', '352', 'hello', 'hello', 'hello', '2532', 'hello', 'hello', 'hello', '12412', 'hello', 'hello', 'hello', '325252', 'hello', 'hello', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_status`
--

CREATE TABLE `enrollment_status` (
  `id` int(11) NOT NULL,
  `active_schoolyear` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_status`
--

INSERT INTO `enrollment_status` (`id`, `active_schoolyear`, `status`) VALUES
(1, '2019-2020', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `grade_eight`
--

CREATE TABLE `grade_eight` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_type` varchar(255) NOT NULL,
  `stud_fname` varchar(255) NOT NULL,
  `stud_mname` varchar(255) DEFAULT NULL,
  `stud_lname` varchar(255) NOT NULL,
  `enrollment_status` varchar(255) NOT NULL DEFAULT 'unset',
  `birth_date` date NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) DEFAULT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) DEFAULT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) DEFAULT NULL,
  `guardian_lname` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `date_enrolled` date NOT NULL,
  `last_grade_level` varchar(255) DEFAULT NULL,
  `last_School_year` varchar(255) DEFAULT NULL,
  `last_school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_eight`
--

INSERT INTO `grade_eight` (`id`, `school_year`, `lrn`, `grade_level`, `section`, `student_type`, `stud_fname`, `stud_mname`, `stud_lname`, `enrollment_status`, `birth_date`, `age`, `place_of_birth`, `mother_tongue`, `gender`, `region`, `province`, `city`, `barangay`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `date_enrolled`, `last_grade_level`, `last_School_year`, `last_school`) VALUES
(97, '2019-2020', '146617070719', '8', 'Sunflower', 'Transferee', 'Rudolph Red', 'Vermillion', 'Crimson', 'Enrolled', '2000-12-05', '22', 'Malabon City', 'English', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Marilao', 'Loma de Gato', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', 'Burgundy Maroon', 'Carmine', 'Crimson', '09054321250', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', '2023-11-15', '7', '2014-2015', 'Kalayaan National High School'),
(98, '2019-2020', '145167056497', '8', 'Sunflower', 'Regular', 'Althea', 'Farinas', 'Cerilo', 'Enrolled', '2002-09-10', '21', 'Bagumbayan Caloocan City', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Iloilo', 'Dingle', 'Ilajas', 'Everett Bello', 'Farinas', 'Cerilo', '09084265932', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', '2023-11-15', NULL, NULL, NULL),
(99, '2019-2020', '142971834843', '8', 'Sunflower', 'Regular', 'Jeli Ann', 'Odron', 'Oco', 'Enrolled', '2003-10-07', '20', 'Guiguinto Biliran', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Quezon', 'Atimonan', 'Barangay Zone 2 (Pob.)', 'Eli Ramone', 'Odron', 'Oco', '09581112800', 'Vicente Jacob', 'Pavia', 'Oco', '09131320570', 'Irvin Theodore', 'Saturnin', 'Carrasco', '09623460209', '2023-11-15', NULL, NULL, NULL),
(100, '2019-2020', '140050590175', '8', 'Sunflower', 'Regular', 'Gwen Xyren', 'Alabat', 'Amancio', 'Enrolled', '2001-02-07', '22', 'Zamboanga City Batanes', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Guimaras', 'Nueva Valencia', 'Canhawan', 'Kellen Jorge', 'Alabat', 'Amancio', '09353582656', 'Xylem', 'Trinidad', 'Amancio', '09509941400', 'Geoffrey', 'Quicho', 'Dungog', '09659748856', '2023-11-15', NULL, NULL, NULL),
(101, '2019-2020', '144472078198', '8', 'Sunflower', 'Regular', 'Jillian', 'Escalante', 'Denaque', 'Enrolled', '2002-08-04', '21', 'Cabuyao Laguna', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Laguna', 'Cabuyao City', 'San Isidro', 'Javen Taylor', 'Escalante', 'Denaque', '09541959511', 'Rayman Jude', 'Alonzo', 'Denaque', '09775943042', 'Malik', 'Elija', 'Cedro', '09594810088', '2023-11-15', NULL, NULL, NULL),
(102, '2019-2020', '140310222376', '8', 'Sunflower', 'Regular', 'Erica Mae', 'Quillo', 'Joson', 'Enrolled', '2002-03-23', '21', 'Nasipit Zambales', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Pampanga', 'City Of San Fernando (Capital)', 'Lourdes', 'Maribel', 'Quillo', 'Joson', '09947465791', 'Rogelio Romano', 'Lontok', 'Joson', '09553919871', 'Caden Aron', 'Naga', 'Marcelo', '09831267231', '2023-11-15', NULL, NULL, NULL),
(103, '2019-2020', '146190521858', '8', 'Sunflower', 'Regular', 'Ryla', 'Milante', 'Velarede', 'Enrolled', '2003-10-09', '20', 'Caloocan City', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Tabina', 'Manikaan', 'Rosalie', 'Milante', 'Velarede', '09699093140', 'Roman', 'Anotion', 'Velarede', '09674689069', 'Jadyn Jeremiah', 'Latif', 'Degayo', '09382988158', '2023-11-15', NULL, NULL, NULL),
(104, '2019-2020', '143041770359', '8', 'Sunflower', 'Regular', 'Recel Anne', 'San Juan', 'Boromeo', 'Enrolled', '2003-09-24', '20', 'Isabela Abra', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Batangas', 'Lipa City', 'Bolbok', 'Sia Zacarias', 'San Juan', 'Boromeo', '09298224617', 'Kurt Jaylon', 'Vinzon', 'Boromeo', '09273764933', 'Winston Dexter', 'Eron', 'Pilapil', '09097104367', '2023-11-15', NULL, NULL, NULL),
(105, '2019-2020', '143124798388', '8', 'Sunflower', 'Regular', 'Lyka Mae', 'Juele', 'Lopez', 'Enrolled', '2000-11-07', '23', 'Marilao Bulacan', 'Filipino', 'Female', 'Region I (Ilocos Region)', 'La Union', 'San Juan', 'Guinguinabang', 'Harley', 'Juele', 'Lopez', '09783096111', 'Gavyn Holden', 'Gonzalo', 'Lopez', '09529078511', 'Pascual', 'Saturnin', 'Asuncion', '09748959312', '2023-11-15', NULL, NULL, NULL),
(106, '2019-2020', '144936924356', '8', 'Sunflower', 'Transferee', 'Seth Patrick', 'Datangel', 'Ancheta', 'Enrolled', '2003-08-10', '20', 'Guimba Albay', 'English', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Laur', 'Nauzon', 'Vaughn Louis', 'Datangel', 'Ancheta', '09656968148', 'Dalton Grady', 'Luz', 'Ancheta', '09172554469', 'Hernandez Damario', 'Salapudin', 'Capillo', '09328925094', '2023-11-15', '7', '2016-2017', 'Childs Faith Foundation Academy'),
(107, '2019-2020', '144909681411', '8', 'Sampaguita', 'Regular', 'Carolina', 'Magpantay', 'Marin', 'Enrolled', '2004-09-24', '19', 'Davao del Norte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'Bulalacao (San Pedro)', 'Cabugao', 'Josie Paloma', 'Magpantay', 'Marin', '09105834678', 'Augustus Ernesto', 'Javion', 'Marin', '09085775213', 'Carmelita Maci', 'Tsukada', 'Bustamante', '09757600335', '2023-11-15', NULL, NULL, NULL),
(108, '2019-2020', '149377052375', '8', 'Sampaguita', 'Regular', 'Marcos', 'Carrasco', 'Romero', 'Enrolled', '2004-04-26', '19', 'Southern Leyte', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Tarlac', 'San Manuel', 'Mangandingay', 'Antonia Sydnie', 'Carrasco', 'Romero', '09760007859', 'Maricel Lazaro', 'Villegas', 'Romero', '09045037514', 'Precious Aracely', 'Suzuki', 'Malano', '09092902765', '2023-11-15', NULL, NULL, NULL),
(109, '2019-2020', '141666472864', '8', 'Sampaguita', 'Transferee', 'Rosario', 'Blanco', 'Fajardo', 'Enrolled', '2007-07-27', '16', 'Kidapawan Leyte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Romblon', 'San Fernando', 'Campalingo', 'Yoana Jazmyne', 'Blanco', 'Fajardo', '09658070306', 'Alexandrea Olan', 'Manalastas', 'Fajardo', '09806982583', 'Ayla Madelyn', 'Dinlayan', 'Liwanag', '09311289130', '2023-11-15', '7', '2015-2016', 'Hercules Secondary School'),
(110, '2019-2020', '141883269743', '8', 'Sampaguita', 'Transferee', 'Domingo', 'Carrasco', 'Cuevas', 'Pending', '2005-10-18', '18', 'Escalante City Quirino', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Quezon', 'Lucban', 'Kalyaat', 'Miya Estefany', 'Carrasco', 'Cuevas', '09706306420', 'Roy Gilberto', 'Royce', 'Cuevas', '09713151986', 'Neil', 'Idurre', 'Mori', '09294588887', '2023-11-15', '7', '2017-2018', 'Laguna Creek School for Boys'),
(111, '2019-2020', '145795227374', '8', 'Sampaguita', 'Regular', 'Maia Jose', 'Gomez', 'Monton', 'Enrolled', '2006-02-28', '17', 'Calbayog Apayao', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Pandacan', 'Barangay 848', 'Nikhil Gary', 'Gomez', 'Monton', '09552794616', 'Kobe', 'Honoratas', 'Monton', '09014019710', 'Jerrald Brendan', 'Naldo', 'Ello', '09971667398', '2023-11-15', NULL, NULL, NULL),
(112, '2019-2020', '144745485026', '8', 'Sampaguita', 'Regular', 'Francisco Santana', 'Mitchell', 'Macatangay', 'Enrolled', '2007-10-18', '16', 'Porac Romblon', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'Cotabato (North Cotabato)', 'Antipas', 'New Pontevedra', 'Brycen Syjuco', 'Mitchell', 'Macatangay', '09544121906', 'Owen Jovany', 'Walker', 'Macatangay', '09109212516', 'Deonte Braden', 'Alexandre', 'Galvez', '09763538272', '2023-11-15', NULL, NULL, NULL),
(113, '2019-2020', '141280408146', '8', 'Sampaguita', 'Regular', 'Maria Mercedes Gimenez', 'Balindong', 'Canlas', 'balikaral', '2004-07-20', '19', 'Caibiran Romblon', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Palawan', 'Agutaya', 'Maracanao', 'Domenic Isaak', 'Balindong', 'Canlas', '09718973791', 'Jack', 'Infanta', 'Canlas', '09894973881', 'Salvatore Braxton', 'Andong', 'Vicente', '09285409397', '2023-11-15', NULL, NULL, NULL),
(114, '2019-2020', '146588191597', '8', 'Sampaguita', 'Regular', 'Sergio Moya', 'Subrabas', 'Andal', 'Enrolled', '2001-10-10', '22', 'Titay Biliran', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Pamplona', 'Tabba', 'Carlee Teagan', 'Subrabas', 'Andal', '09596173844', 'Grady Austin', 'Palad', 'Andal', '09074366626', 'Caitlyn Emmeline', 'Suico', 'Magsakay', '09519160781', '2023-11-15', NULL, NULL, NULL),
(115, '2019-2020', '140801610383', '8', 'Sampaguita', 'Regular', 'Emilio Campos', 'Dy', 'Cachuela', 'Enrolled', '2010-01-13', '13', 'Zamboanga del Sur', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Hadji Muhtamad', 'Tausan', 'Jesenia Layla', 'Dy', 'Cachuela', '09683016576', 'Justin', 'Honorato', 'Cachuela', '09426027509', 'Kendrick Gabriel', 'Simpao', 'Estolas', '09371279050', '2023-11-15', NULL, NULL, NULL),
(116, '2019-2020', '143656107693', '8', 'Sampaguita', 'Regular', 'Rafael Muoz', 'Will', 'Cruz', 'Enrolled', '2010-02-25', '13', 'Palayan Dinagat Islands', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Paco', 'Barangay 685', 'Fraco Suelita', 'Will', 'Cruz', '09651705612', 'Adonis Josias', 'Romano', 'Cruz', '09978499810', 'Xavier Carl', 'Devyn', 'Malano', '09552119489', '2023-11-15', NULL, NULL, NULL),
(117, '2020-2021', '874512369087', '8', 'Sampaguita', 'Regular', 'Marvin', '', 'Lim', 'Enrolled', '2001-06-28', '22', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tibag', 'Myrna', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', '2023-11-15', NULL, NULL, NULL),
(118, '2020-2021', '160229389135', '8', 'Sampaguita', 'Regular', 'Ignacio Reuben', 'Farinas', 'Mora', 'Enrolled', '2002-08-24', '21', 'Southern Leyte', 'Filipino', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Matanao', 'La Suerte', 'Blanca Shaniya', 'Farinas', 'Mora', '09637522367', 'Mason Geraldo', 'Cerilo', 'Mora', '09587423649', 'Blanca Shaniya', 'Farinas', 'Mora', '09637522367', '2023-11-15', NULL, NULL, NULL),
(119, '2020-2021', '146584179112', '8', 'Sampaguita', 'Regular', 'Thalia Cyntia', 'Busran', 'Montano', 'Enrolled', '1999-10-04', '24', 'Mansalay Oriental Mindoro', 'Filipino', 'Male', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'Mansalay', 'Cabalwa', 'Nevada Zurina', 'Busran', 'Montano', '09934059107', 'Rickey Geoffrey', 'Lobo', 'Montano', '09190198710', 'Adelio Mekhi', 'Galeno', 'Acevedo', '09521225710', '2023-11-15', NULL, NULL, NULL),
(120, '2020-2021', '144107205401', '8', 'Sampaguita', 'Regular', 'Hayley Amanda', 'Pinagpala', 'Montecillo', 'Enrolled', '2004-10-04', '19', 'Mariveles Bataan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'Mariveles', 'Maligaya', 'Rosalia', 'Pinagpala', 'Montecillo', '09176832638', 'Valencia', 'Digamon', 'Montecillo', '09706583246', 'Laline Brisa', 'Joco', 'Micolob', '09513028777', '2023-11-15', NULL, NULL, NULL),
(121, '2020-2021', '142925181068', '8', 'Sampaguita', 'Regular', 'Sandra', 'Leyco', 'Montero', 'Pending', '2004-04-22', '19', 'Nueva Vizcaya', 'Filipino', 'Female', 'Region VIII (Eastern Visayas)', 'Leyte', 'Jaro', 'Kalinawan', 'Miranda Monita', 'Leyco', 'Montero', '09367527558', 'Jasper Gael', 'Cipriano', 'Montero', '09056206477', 'Rosalia Alex', 'Tiongson', 'Hinojosa', '09148060173', '2023-11-15', NULL, NULL, NULL),
(122, '2020-2021', '149654217177', '8', 'Sampaguita', 'Regular', 'Maria', 'Jose', 'Cruz', 'Enrolled', '2006-06-15', '17', 'Davao del Norte', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Dumingag', 'Guitran', 'Beatrice Alia', 'Jose', 'Cruz', '09935008701', 'Vicente Brody', 'Limuaco', 'Cruz', '09605080094', 'Vicente Brody', 'Limuaco', 'Cruz', '09605080094', '2023-11-15', NULL, NULL, NULL),
(123, '2020-2021', '140321849773', '8', 'Sampaguita', 'Regular', 'Cesar', 'Gandionco', 'Campos', 'Enrolled', '2010-09-25', '13', 'Cabuyao Catanduanes', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Laguna', 'Magdalena', 'Malinao', 'Rachael Mariam', 'Gandionco', 'Campos', '09979518997', 'Leonard', '', 'Campos', '09010951673', 'Cenobia', 'Iwatani', 'Macrohon', '09756050920', '2023-11-15', NULL, NULL, NULL),
(124, '2020-2021', '145117069296', '8', 'Sampaguita', 'Regular', 'Margarita', 'Villegas', 'Cabrera', 'Pending', '2009-01-14', '14', 'Malabon Leyte', 'Filipino', 'Female', 'Region V (Bicol Region)', 'Catanduanes', 'Pandan', 'Salvacion (Tariwara)', 'Suzelly Carilla', 'Villegas', 'Cabrera', '09521641271', 'Beau Elliott', 'Dwight', 'Cabrera', '09332205548', 'Suzelly Carilla', 'Villegas', 'Cabrera', '09521641271', '2023-11-15', NULL, NULL, NULL),
(125, '2020-2021', '145770539457', '8', 'Sampaguita', 'Regular', 'Margarita Emily', 'Cabrera', 'Belloso', 'Enrolled', '2009-01-14', '14', 'Malabon Leyte', 'Filipino', 'Female', 'Region I (Ilocos Region)', 'La Union', 'San Juan', 'Dasay', 'Anne Esther', 'Cabrera', 'Belloso', '09191675192', 'Lazaro Sandoval', 'Damaris', 'Belloso', '09319652371', 'Brisa Nikki', 'Tungol', 'Legaspi', '09620277360', '2023-11-15', NULL, NULL, NULL),
(126, '2020-2021', '148984764435', '8', 'Sampaguita', 'Regular', 'Rafael', 'Hassan', 'Vazquez', 'Enrolled', '2008-12-23', '14', 'Bogo Davao del Norte', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Quezon', 'Jomalig', 'Casuguran', 'Justyn', 'Hassan', 'Vazquez', '09908769379', 'Alberto', 'Pascual', 'Vazquez', '09983570006', 'Marc Brody', 'Curcio', 'Ferrer', '09660214402', '2023-11-15', NULL, NULL, NULL),
(127, '2020-2021', '146974019237', '8', 'Sunflower', 'Regular', 'Juan', 'Carlos', 'Moya', 'Enrolled', '2009-05-14', '14', 'Munyoz Siquijor', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Gattaran', 'Centro Sur (Pob.)', 'Dona Anaya', 'Carlos', 'Moya', '09933706016', 'Chad Cuarto', 'Navarro', 'Moya', '09118594762', 'Tavion Amado', 'Galeno', 'Manabat', '09733934590', '2023-11-15', NULL, NULL, NULL),
(128, '2020-2021', '202456218784', '8', 'Sampaguita', 'Regular', 'Paulo', 'Bernal', 'Agsunta', 'Enrolled', '2009-01-05', '14', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bataan', 'Mariveles', 'San Carlos', 'Melanie', '', 'Bernal', '09554012883', 'Apendro', 'Samon', 'Agsunta', '09665024481', 'Melanie', '', 'Bernal', '09554012883', '2023-11-15', NULL, NULL, NULL),
(129, '2020-2021', '201246872914', '8', 'Sampaguita', 'Regular', 'Calix', 'Ramon', 'Cruz', 'Enrolled', '2007-02-05', '16', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Hagonoy', 'Mercado', 'Elyn', '', 'Cruz', '09445823167', 'Karl', '', 'Cruz', '09458712364', 'Elyn', '', 'Cruz', '09445823167', '2023-11-15', NULL, NULL, NULL),
(130, '2020-2021', '204534781244', '8', 'Sampaguita', 'Regular', 'Lera', '', 'Gray', 'Enrolled', '2007-07-11', '16', 'Calumpit', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'Poblacion', 'Meggan', '', 'Gray', '09487521643', 'Jericko', '', 'Gray', '09428751364', 'Meggan', '', 'Gray', '09487521643', '2023-11-15', NULL, NULL, NULL),
(131, '2020-2021', '204578943516', '8', 'Sampaguita', 'Regular', 'Sky Sunshine', '', 'Cruz', 'Enrolled', '2007-05-17', '16', 'Calumpit', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Antipona', 'Alexandra', '', 'Cruz', '09452163575', 'Patrick', '', 'Cruz', '09458736154', 'Alexandra', '', 'Cruz', '09452163575', '2023-11-15', NULL, NULL, NULL),
(132, '2020-2021', '204568326521', '8', 'Sunflower', 'Regular', 'Kevin', '', 'De Luna', 'Enrolled', '2007-03-14', '16', 'Calumpit', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Balite', 'Laura', '', 'De Luna', '09542135786', 'Kevin', '', 'De Luna', '09326578451', 'Laura', '', 'De Luna', '09542135786', '2023-11-15', NULL, NULL, NULL),
(133, '2020-2021', '208754212365', '8', 'Sunflower', 'Regular', 'Junnel', '', 'Ramon', 'Enrolled', '2008-06-11', '15', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Hagonoy', 'San Pascual', 'Nicka', '', 'Ramon', '09325461842', 'Marvic', '', 'Ramon', '09326661234', 'Nicka', '', 'Ramon', '09325461842', '2023-11-15', NULL, NULL, NULL),
(134, '2020-2021', '209845123256', '8', 'Sunflower', 'Regular', 'Kristine', '', 'Vantaculo', 'Enrolled', '2007-07-27', '16', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'City Of Malolos (Capital)', 'Balite', 'Angel', '', 'Vantaculo', '09562132546', 'Paolito', '', 'Vantaculo', '09562132564', 'Angel', '', 'Vantaculo', '09562132546', '2023-11-15', NULL, NULL, NULL),
(135, '2020-2021', '203212654587', '8', 'Sunflower', 'Regular', 'Elyn Marie', '', 'Magsaysay', 'Enrolled', '2007-03-11', '16', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'Bangkal', 'Grace', '', 'Magsaysay', '09325416978', 'Joshua', '', 'Magsaysay', '09325416888', 'Grace', '', 'Magsaysay', '09325416978', '2023-11-15', NULL, NULL, NULL),
(136, '2020-2021', '238353838792', '8', 'Sampaguita', 'Transferee', 'Charmaine', 'Cabanatan', 'Santos', 'Enrolled', '2006-08-01', '17', 'Navotas', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, Fourth District', 'Pasay City', 'Barangay 17', 'Freira Kali', 'Cabanatan', 'Santos', '09145002374', 'Leones Marcelo', 'Manansala', 'Santos', '09855365911', 'Yoana Eliza', 'Quimson', 'Herrera', '09119402916', '2023-11-15', '7', '2019-2020', 'Sampaguita High School'),
(137, '2020-2021', '238500060527', '8', 'Sunflower', 'Transferee', 'Renzlyn Venice', 'Aprinal', 'Rebancos', 'Enrolled', '1996-06-22', '27', 'Muntinlupa City', 'Filipino', 'Female', 'Region XII (SOCCSKSARGEN)', 'Sultan Kudarat', 'Lambayong (Mariano Marcos)', 'Gansing (Bilumen)', 'Eden Alycia', 'Aprinal', 'Rebancos', '09557091033', 'Ariel', 'Canlas', 'Rebancos', '09951593088', 'Natasha Kailyn', 'Abyyappy', 'Eusebio', '09105700103', '2023-11-15', '7', '2012-2013', 'Muzon Harmony Hills High School'),
(138, '2020-2021', '900512369087', '8', 'Sunflower', 'Regular', 'Janus', '', 'Lopez', 'Enrolled', '2000-11-11', '23', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tinejero', 'Joseph', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', '2023-11-15', NULL, NULL, NULL),
(139, '2020-2021', '149008092093', '8', 'Sunflower', 'Regular', 'Mariano', 'Pelaez', 'Alvarez', 'Enrolled', '2008-11-23', '14', 'Quezon City Palawan', 'Filipino', 'Male', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Port Area', 'Barangay 650', 'Irene Susan', 'Pelaez', 'Alvarez', '09487722580', 'Mckenzie Nya', 'Balignasay', 'Alvarez', '09421596550', 'Brittney Bonita', 'Peria', 'Carrasco', '09691747953', '2023-11-15', NULL, NULL, NULL),
(140, '2020-2021', '148575065213', '8', 'Sunflower', 'Regular', 'Elena Kailyn', 'Reya', 'Parra', 'Enrolled', '2006-08-23', '17', 'El Salvador Laguna', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Quezon', 'Lucban', 'Kulapi', 'Karen Benigna', 'Reya', 'Parra', '09376897933', 'Kane Leonardo', 'Viray', 'Parra', '09008718881', 'Desmond Neal', 'Aureliano', 'Manlangit', '09700406278', '2023-11-15', NULL, NULL, NULL),
(142, '2020-2021', '148987314104', '8', 'Sunflower', 'Regular', 'Carlos', 'Yengko', 'Blanco', 'Enrolled', '2007-09-16', '16', 'Dasol Zamboanga del Sur', 'Filipino', 'Male', 'Region VIII (Eastern Visayas)', 'Eastern Samar', 'Oras', 'Camanga (Pob.)', 'Kayleigh Diane', 'Yengko', 'Blanco', '09180419865', 'Ariel Zaria', 'Matiyaga', 'Blanco', '09681353207', 'Delcine', 'Abrogar', 'Eleadora', '09214744969', '2023-11-15', NULL, NULL, NULL),
(143, '2020-2021', '140002182640', '8', 'Sunflower', 'Regular', 'Luisa Larissa', 'Vizcaya', 'Garcia', 'Enrolled', '2010-01-03', '13', 'Concepcion Kalinga', 'Filipino', 'Female', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Bokod', 'Daclan', 'Kenna Bianca', 'Vizcaya', 'Garcia', '09952555106', 'Batungbakal', 'Tayag', 'Garcia', '09379328313', 'Michelle', 'Singson', 'Maquiling', '09378268156', '2023-11-15', NULL, NULL, NULL),
(144, '2020-2021', '142711264310', '8', 'Sunflower', 'Regular', 'Carmen', 'Yambao', 'Serrano', 'Enrolled', '2009-11-24', '13', 'Pototan Cagayan', 'Filipino', 'Female', 'Region X (Northern Mindanao)', 'Camiguin', 'Guinsiliban', 'Cabuan', 'Lilly Alexia', 'Yambao', 'Serrano', '09225711205', 'Rohan William', 'Hidalgo', 'Serrano', '09055720180', 'Karson Adan', 'Locsin', 'Abaya', '09399664354', '2023-11-15', NULL, NULL, NULL),
(145, '2020-2021', '148263813012', '8', 'Sunflower', 'Regular', 'Julio Kristian', 'Manalili', 'Garrido', 'Enrolled', '2010-08-10', '13', 'Norzagaray Quirino', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Nueva Vizcaya', 'Bagabag', 'Careb', 'Rylee Austin', 'Manalili', 'Garrido', '09692569328', 'Tomas Rio', 'Gatus', 'Garrido', '09109768992', 'Rafael Micheal', 'Orion', 'Cabungcal', '09813710968', '2023-11-15', NULL, NULL, NULL),
(146, '2020-2021', '147491738514', '8', 'Sunflower', 'Regular', 'Marya', 'Carmen', 'Penya', 'Enrolled', '2007-03-26', '16', 'Caloocan Nueva Vizcaya', 'Filipino', 'Female', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Sablan', 'Banangan', 'Isaias Zakary', 'Carmen', 'Penya', '09035644547', 'Johnathon Hayden', 'Tejada', 'Penya', '09966731685', 'Edwardo Idurre', 'Martinez', 'Cervantes', '09498577322', '2023-11-15', NULL, NULL, NULL),
(147, '2020-2021', '143586851391', '8', 'Sunflower', 'Regular', 'Salvador', 'Javier', 'Gomez', 'Enrolled', '2006-09-15', '17', 'Valencia Leyte', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Hadji Muhtamad', 'Tausan', 'Ciceron Lamar', 'Javier', 'Gomez', '09907369051', 'Brycen Javiero', 'Borja', 'Gomez', '09358420346', 'Orlando', 'Avery', 'Sace', '09484739341', '2023-11-15', NULL, NULL, NULL),
(148, '2021-2022', '890876544410', '8', 'Sampaguita', 'Transferee', 'Andrea', '', 'Artadi', 'Pending', '2001-02-02', '22', 'Malolos Bulacan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'San Vicente', 'April', '', 'Artadi', '09182455347', 'Jasper', '', 'Artadi', '09182455347', 'April', '', 'Artadi', '09182455347', '2023-11-15', '7', '2012-2013', 'Malamig National High School'),
(149, '2021-2022', '890210987654', '8', 'Sampaguita', 'Transferee', 'Jose', '', 'Fernandez', 'Pending', '2001-02-02', '22', 'Malolos Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Biñang 2nd', 'Josephine', '', 'Fernandez', '09182455347', 'Patrick', '', 'Fernandez', '09182455347', 'Patrick', '', 'Fernandez', '09182455347', '2023-11-15', '8', '2012-2013', 'Langit State University'),
(150, '2021-2022', '890655551098', '8', 'Sunflower', 'Transferee', 'Angela', '', 'Aquino', 'Pending', '2000-04-01', '23', 'Malolos Bulacan', 'Filipino', 'Male', 'Region VI (Western Visayas)', 'Antique', 'San Remigio', 'Carawisan II', 'Angeline', '', 'Aquino', '09182455347', 'Joshua', '', 'Aquino', '09182455347', 'Joshua', '', 'Aquino', '09182455347', '2023-11-15', '8', '2012-2013', 'Secret National High School'),
(151, '2021-2022', '237584217507', '8', 'Sunflower', 'Regular', 'Melvin Dangelo', 'Diaz', 'Santiago', 'Pending', '2002-02-01', '21', 'Northern Samar', 'Filipino', 'Male', 'Region XIII (Caraga)', 'Agusan Del Sur', 'Talacogon', 'Zillovia', 'Riley', 'Diaz', 'Santiago', '09438424735', 'Roderigo Elliott', 'Ward', 'Santiago', '09790303709', 'Bradley Reagan', 'Arturo', 'Soler', '09804149240', '2023-11-15', NULL, NULL, NULL),
(152, '2021-2022', '238012570618', '8', 'Sunflower', 'Regular', 'Elena', 'Carrasco', 'Suarez', 'Pending', '2009-04-12', '14', 'Antipolo Rizal', 'Filipino', 'Female', 'Region II (Cagayan Valley)', 'Quirino', 'Aglipay', 'Cabugao', 'Elia Jaden', 'Carrasco', 'Suarez', '09332900781', 'Reece Jasper', 'Macalinao', 'Suarez', '09894268696', 'Brent Colten', 'Keller', 'Rillo', '09826722129', '2023-11-15', NULL, NULL, NULL),
(153, '2021-2022', '239109380399', '8', 'Sunflower', 'Regular', 'Raul', 'Gallardo', 'Ventura', 'Pending', '2009-02-17', '14', 'Bago Capiz', 'Flilipino', 'Male', 'Region XI (Davao Region)', 'Davao Oriental', 'San Isidro', 'Talisay', 'Dominique Quinn', 'Gallardo', 'Ventura', '09811381377', 'Randall Davon', 'Pinagdamutan', 'Ventura', '09844473841', 'Nigel Alarico', 'Abubakar', 'Ilagan', '09853482736', '2023-11-15', NULL, NULL, NULL),
(154, '2021-2022', '236063387785', '8', 'Sunflower', 'Regular', 'Miguel', 'Gallego', 'Lazaro', 'Pending', '2001-05-02', '22', 'San Pablo Bulacan', 'Filipino', 'Male', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Kapangan', 'Taba-ao', 'Zane Camden', 'Gallego', 'Lazaro', '09129265456', 'Keaton', 'Eliezer', 'Lazaro', '09875260572', 'Karson', 'Eliezer', 'Lazaro', '09604569698', '2023-11-15', NULL, NULL, NULL),
(155, '2021-2022', '236538683566', '8', 'Sunflower', 'Regular', 'Maria Josie', 'Garcia', 'Bituin', 'Pending', '2010-01-21', '13', 'Buenavista Eastern Samar', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'San Vicente', 'Davin Jace', 'Garcia', 'Bituin', '09873095023', 'Ezequiel Rodas', 'Cayabyab', 'Bituin', '09612127908', 'Arjun Emerson', 'Disomimba', 'Estrella', '09742105831', '2023-11-15', NULL, NULL, NULL),
(156, '2021-2022', '237768058464', '8', 'Sampaguita', 'Regular', 'Patricia', 'Sanchez', 'Ignacio', 'Pending', '2008-03-26', '15', 'Masbate City Oriental Mindoro', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, Second District', 'City Of Mandaluyong', 'New Zañiga', 'Jett Kayden', 'Sanchez', 'Ignacio', '09027837072', 'Taylor Davis', 'Arboleda', 'Ignacio', '09542325560', 'Preston Jacoby', 'Quinten', 'Hojas', '09370237376', '2023-11-15', NULL, NULL, NULL),
(157, '2021-2022', '233078905064', '8', 'Sampaguita', 'Regular', 'Robyn Bianca', 'Felipe', 'Esteban', 'Pending', '2004-08-26', '19', 'Agusan del Sur', 'Filipino', 'Female', 'Region XIII (Caraga)', 'Surigao Del Norte', 'Claver', 'Daywan', 'Diana Christy', 'Felipe', 'Esteban', '09332875727', 'Tierra Jovanni', 'Mallari', 'Esteban', '09542908456', 'Edenia Generosa', 'Joco', 'Bristol', '09846849306', '2023-11-15', NULL, NULL, NULL),
(158, '2021-2022', '237991800398', '8', 'Sampaguita', 'Regular', 'Maria Jess', 'Jimenez', 'Navidad', 'Pending', '2007-08-24', '16', 'Sorsogon City Nueva Ecija', 'Filipino', 'Female', 'Region X (Northern Mindanao)', 'Camiguin', 'Guinsiliban', 'Cantaan', 'Presencia Mikayla', 'Jimenez', 'Navidad', '09147829248', 'Jaylynn Bryant', 'Mangubat', 'Navidad', '09431402984', 'Theresa Carol', 'Joson', 'Sicat', '09838509557', '2023-11-15', NULL, NULL, NULL),
(159, '2021-2022', '235786669228', '8', 'Sampaguita', 'Regular', 'Ana Maria Parra', 'Choa', 'Torres', 'Pending', '2004-02-02', '19', 'Lumban Davao del Sur', 'Filipino', 'Female', 'Region XI (Davao Region)', 'Davao Oriental', 'Lupon', 'San Jose', 'Jerrely Madalyn', 'Choa', 'Torres', '09232548948', 'Jones Roces', 'Magbanua', 'Torres', '09921824414', 'Brandi Autumn', 'Calunod', 'Montederamos', '09619256641', '2023-11-15', NULL, NULL, NULL),
(160, '2021-2022', '239321631228', '8', 'Sampaguita', 'Regular', 'Joselle', 'San Esteban', 'Ancheta', 'Pending', '2001-10-17', '22', 'Marilao Bulacan', 'English', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'City Of Meycauayan', 'Camalig', 'Rinalyn', 'San Esteban', 'Ancheta', '09387225445', 'Zeugfred', 'Vinluan', 'Ancheta', '09375357536', 'Seth', 'Datangel', 'Gripon', '09036454497', '2023-11-15', NULL, NULL, NULL),
(161, '2021-2022', '146653185669', '8', 'Sampaguita', 'Regular', 'Juan', '', 'Pancho', 'Pending', '2001-02-02', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'San Mateo', 'Josephine', '', 'Pancho', '09182455347', 'Joshua', '', 'Pancho', '09182455347', 'Joshua', '', 'Pancho', '09182455347', '2023-11-15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade_nine`
--

CREATE TABLE `grade_nine` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_type` varchar(255) NOT NULL,
  `stud_fname` varchar(255) NOT NULL,
  `stud_mname` varchar(255) DEFAULT NULL,
  `stud_lname` varchar(255) NOT NULL,
  `enrollment_status` varchar(255) NOT NULL DEFAULT 'unset',
  `birth_date` date NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) DEFAULT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) DEFAULT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) DEFAULT NULL,
  `guardian_lname` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `date_enrolled` date NOT NULL,
  `last_grade_level` varchar(255) DEFAULT NULL,
  `last_School_year` varchar(255) DEFAULT NULL,
  `last_school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_nine`
--

INSERT INTO `grade_nine` (`id`, `school_year`, `lrn`, `grade_level`, `section`, `student_type`, `stud_fname`, `stud_mname`, `stud_lname`, `enrollment_status`, `birth_date`, `age`, `place_of_birth`, `mother_tongue`, `gender`, `region`, `province`, `city`, `barangay`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `date_enrolled`, `last_grade_level`, `last_School_year`, `last_school`) VALUES
(47, '2019-2020', '701934562828', '9', 'Apitong', 'Transferee', 'Patricia', '', 'Mendoza', 'Enrolled', '2001-02-02', '22', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'Orani', 'Sibul', 'Pauline', '', 'Mendoza', '09182455347', 'Paolo', '', 'Mendoza', '09182455347', 'Paolo', '', 'Mendoza', '09182455347', '2023-11-15', '8', '2006-2007', 'Langit State University'),
(48, '2019-2020', '701934562829', '9', 'Apitong', 'Transferee', 'Carlos', '', 'Reyes', 'Enrolled', '2000-02-02', '23', 'Caloocan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'Minalin', 'Santa Catalina', 'Carlene', '', 'Reyes', '09182455347', 'Cardo', '', 'Reyes', '09182455347', 'Cardo', '', 'Reyes', '09182455347', '2023-11-15', '8', '2015-2016', 'Langit State University'),
(49, '2019-2020', '701934562830', '9', 'Apitong', 'Regular', 'Angelica', '', 'Cruz', 'Enrolled', '2005-05-05', '18', 'Plaridel Bulacan', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Kabankalan', 'Barangay 7 (Pob.)', 'Angeline', '', 'Cruz', '09662455347', 'Angelo', '', 'Cruz', '09662455347', 'Angelo', '', 'Cruz', '09662455347', '2023-11-15', NULL, NULL, NULL),
(50, '2019-2020', '701934562831', '9', 'Apitong', 'Regular', 'Gabriel', '', 'Del Rosario', 'Enrolled', '2004-05-05', '19', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'Minalin', 'San Isidro', 'Gail', '', 'Del Rosario', '09182455347', 'Alex', '', 'Del Rosario', '09182455347', 'Alex', '', 'Del Rosario', '09182455347', '2023-11-15', NULL, NULL, NULL),
(51, '2019-2020', '701934562832', '9', 'Apitong', 'Regular', 'Marianne', '', 'Lim', 'Pending', '2004-06-06', '19', 'Marilao Bulacan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'Santa Cruz', 'Maria', '', 'Lim', '09182455347', 'Marco', '', 'Lim', '09182455347', 'Marco', '', 'Lim', '09182455347', '2023-11-15', NULL, NULL, NULL),
(52, '2019-2020', '701934562833', '9', 'Apitong', 'Regular', 'Andres', '', 'Panganiban', 'Enrolled', '2001-05-03', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'San Roque', 'Andrea', '', 'Panganiban', '09182455347', 'Andrei', '', 'Panganiban', '09182455347', 'Andrea', '', 'Panganiban', '09182455347', '2023-11-15', NULL, NULL, NULL),
(53, '2019-2020', '701934562834', '9', 'Apitong', 'Regular', 'Bianca', '', 'Rivera', 'Pending', '2001-05-05', '22', 'Baliuag', 'Bulacan', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Lupao', 'Poblacion South', 'Brenda', '', 'Rivera', '09182455347', 'Brando', '', 'Rivera', '09182455347', 'Brando', '', 'Rivera', '09182455347', '2023-11-15', NULL, NULL, NULL),
(54, '2019-2020', '701934562835', '9', 'Apitong', 'Regular', 'Emmanuel', '', 'Ong', 'Enrolled', '2001-11-01', '22', 'Marilao Bulacan', 'Filipino', 'Male', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Malate', 'Barangay 706', 'Erika', '', 'Ong', '09182455347', 'Erick', '', 'Ong', '09182455347', 'Erika', '', 'Ong', '09182455347', '2023-11-15', NULL, NULL, NULL),
(55, '2019-2020', '701934562836', '9', 'Apitong', 'Regular', 'Jose', '', 'Manalo', 'Enrolled', '2001-01-01', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'Bigte', 'Jennie', '', 'Manalo', '09182455347', 'Joshua', '', 'Manalo', '09182455347', 'Joshua', '', 'Manalo', '09182455347', '2023-11-15', NULL, NULL, NULL),
(56, '2019-2020', '701934562837', '9', 'Apitong', 'Regular', 'Eduardo', '', 'Velasco', 'Enrolled', '2000-02-02', '23', 'Malolos Bulacan', 'Filipino', 'Male', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Ramon Magsaysay (Liargo)', 'Malating', 'Edna', '', 'Velasco', '09182455347', 'Erick', '', 'Velasco', '09182455347', 'Erick', '', 'Velasco', '09182455347', '2023-11-15', NULL, NULL, NULL),
(57, '2019-2020', '701934562838', '9', 'Apitong', 'Regular', 'Luis', '', 'Castro', 'Enrolled', '2001-02-01', '22', 'Marilao Bulacan', 'Filipino', 'Male', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Batino', 'Leona', '', 'Castro', '09182455347', 'Lennard', '', 'Castro', '09182455347', 'Lennard', '', 'Castro', '09182455347', '2023-11-15', NULL, NULL, NULL),
(58, '2019-2020', '146190521859', '9', 'Acacia', 'Transferee', 'Kristopher', '', 'Santos', 'Enrolled', '2001-02-02', '22', 'Malolos', 'Bulacan', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Magsaysay', 'Tacul', 'Kirsten', '', 'Santos', '09182455347', 'Karlo', '', 'Santos', '09182455347', 'Kirsten', '', 'Santos', '09182455347', '2023-11-15', '7', '2006-2007', 'Secret National High School'),
(59, '2019-2020', '146190521860', '9', 'Acacia', 'Transferee', 'Camila', '', 'Rivera', 'Enrolled', '2001-01-02', '22', 'Malolos', 'Filipino', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Padada', 'Tulogan', 'Carla', '', 'Rivera', '09182455347', 'Carding', '', 'Rivera', '09182455347', 'Carding', '', 'Rivera', '09182455347', '2023-11-15', '8', '2006-2007', 'Secret National High School'),
(60, '2019-2020', '146190521861', '9', 'Acacia', 'Regular', 'Jose', '', 'Estrella', 'Enrolled', '2000-02-04', '23', 'Marilao Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Plaridel', 'Santa Ines', 'Josephine', '', 'Estrella', '09182455347', 'Joshua', '', 'Estrella', '09182455347', 'Josephine', '', 'Estrella', '09182455347', '2023-11-15', NULL, NULL, NULL),
(61, '2019-2020', '706190521862', '9', 'Acacia', 'Regular', 'Samantha', '', 'Encarnacion', 'Enrolled', '2001-02-03', '22', 'Malolos', 'Filipino', 'Male', 'Region X (Northern Mindanao)', 'Camiguin', 'Guinsiliban', 'Cantaan', 'Sally', '', 'Encarnacion', '09182455347', 'Sonny', '', 'Encarnacion', '09182455347', 'Sonny', '', 'Encarnacion', '09182455347', '2023-11-15', NULL, NULL, NULL),
(62, '2019-2020', '701934562900', '9', 'Acacia', 'Regular', 'Lorenzo', '', 'Gonzales', 'Enrolled', '2001-02-02', '22', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Cavite', 'Mendez (Mendez-nuñez)', 'Asis II', 'Leona', '', 'Gonzales', '09182455347', 'Luke', '', 'Gonzales', '09182455347', 'Luke', '', 'Gonzales', '09182455347', '2023-11-15', NULL, NULL, NULL),
(63, '2019-2020', '701934562901', '9', 'Acacia', 'Regular', 'Danielle', '', 'Tan', 'Enrolled', '2001-02-02', '22', 'Baliuag Bulacan', 'Filipino', 'Female', 'Region XII (SOCCSKSARGEN)', 'South Cotabato', 'Tantangan', 'Poblacion', 'Denise', '', 'Tan', '09182455347', 'Derick', '', 'Tan', '09182455347', 'Derick', '', 'Tan', '09182455347', '2023-11-15', NULL, NULL, NULL),
(64, '2019-2020', '701934562902', '9', 'Acacia', 'Regular', 'Felix', '', 'Cruz', 'Enrolled', '2000-02-02', '23', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'Sultan Kudarat', 'Palimbang', 'Libua', 'Felicity', '', 'Cruz', '09182455347', 'Fernando', '', 'Cruz', '09182455347', 'Fernando', '', 'Cruz', '09182455347', '2023-11-15', NULL, NULL, NULL),
(65, '2019-2020', '701934562903', '9', 'Acacia', 'Regular', 'Denise', '', 'Reyes', 'Enrolled', '2003-03-02', '20', 'Marilao Bulacan', 'Filipino', 'Male', 'Region X (Northern Mindanao)', 'Camiguin', 'Catarman', 'Manduao', 'Donna', '', 'Reyes', '09182455347', 'Denver', '', 'Reyes', '09182455347', 'Donna', '', 'Reyes', '09182455347', '2023-11-15', NULL, NULL, NULL),
(66, '2019-2020', '701934562904', '9', 'Acacia', 'Regular', 'Marco', '', 'Alonzo', 'Enrolled', '2000-03-02', '23', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'San Simon', 'San Agustin', 'Maria', '', 'Alonzo', '09182455347', 'Marlon', '', 'Alonzo', '09182455347', 'Maria', '', 'Alonzo', '09182455347', '2023-11-15', NULL, NULL, NULL),
(67, '2020-2021', '202132546589', '9', 'Acacia', 'Regular', 'Aira', '', 'Lapira', 'Enrolled', '2006-02-21', '17', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Calantipay', 'Dianne', '', 'Lapira', '09666678452', 'Christoper', '', 'Lapira', '09546578452', 'Dianne', '', 'Lapira', '09666678452', '2023-11-15', NULL, NULL, NULL),
(68, '2020-2021', '205412325697', '9', 'Acacia', 'Regular', 'Margaret', '', 'David', 'Enrolled', '2004-07-09', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'City Of Balanga (Capital)', 'Bagumbayan', 'Laura', '', 'David', '09125465784', 'Victorino', '', 'David', '09324556871', 'Victorino', '', 'David', '09324556871', '2023-11-15', NULL, NULL, NULL),
(69, '2020-2021', '206512458923', '9', 'Acacia', 'Regular', 'Joshua', '', 'Joson', 'Enrolled', '2005-10-11', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'San Pedro', 'Magenta', '', 'Joson', '09546589123', 'Jose', '', 'Joson', '09568745123', 'Jose', '', 'Joson', '09568745123', '2023-11-15', NULL, NULL, NULL),
(70, '2020-2021', '206587451298', '9', 'Acacia', 'Regular', 'Rudolpo', '', 'Limpo', 'Enrolled', '2006-07-03', '17', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Concepcion', 'Mylene', '', 'Limpo', '09988745651', 'Appol', '', 'Limpo', '09232165987', 'Appol', '', 'Limpo', '09232165987', '2023-11-15', NULL, NULL, NULL),
(71, '2020-2021', '201623498756', '9', 'Acacia', 'Regular', 'Joshia', '', 'Decera', 'Enrolled', '2005-07-20', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bulacan', 'Balubad', 'Margaret', '', 'Decera', '09356194872', 'Joshua', '', 'Decera', '09356194777', 'Joshua', '', 'Decera', '09356194777', '2023-11-15', NULL, NULL, NULL),
(72, '2020-2021', '206531649798', '9', 'Acacia', 'Regular', 'Angelica', '', 'Vetaloso', 'Enrolled', '2005-02-11', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Calumpang', 'Susan', '', 'Vetaloso', '09326512546', 'Karding', '', 'Vetaloso', '09333654982', 'Karding', '', 'Vetaloso', '09333654982', '2023-11-15', NULL, NULL, NULL),
(73, '2020-2021', '203549871649', '9', 'Apitong', 'Regular', 'Alice', '', 'Alusyon', 'Enrolled', '2004-08-17', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Angat', 'Banaban', 'Alice Marie', '', 'Alusyon', '09653164975', 'Bernard', '', 'Alusyon', '09322346975', 'Bernard', '', 'Alusyon', '09322346975', '2023-11-15', NULL, NULL, NULL),
(74, '2020-2021', '203890463197', '9', 'Apitong', 'Regular', 'Alyssa', '', 'Mora', 'Enrolled', '2004-11-01', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Bolacan', 'Alice', '', 'Mora', '09169487325', 'Kenneth', '', 'Mora', '09322346975', 'Kenneth', '', 'Mora', '09322346975', '2023-11-15', NULL, NULL, NULL),
(75, '2020-2021', '202023546598', '9', 'Apitong', 'Regular', 'Ceejay', '', 'Bulaong', 'Enrolled', '2007-06-06', '16', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Catacte', 'Jane', '', 'Bulaong', '09324694111', 'Domingo', '', 'Bulaong', '09324694648', 'Domingo', '', 'Bulaong', '09324694648', '2023-11-15', NULL, NULL, NULL),
(76, '2020-2021', '206549139755', '9', 'Apitong', 'Regular', 'Archie', '', 'Bulaong', 'Enrolled', '2003-06-10', '20', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Guiguinto', 'Pulong Gubat', 'Marissa', '', 'Bulaong', '09649713445', 'Ozzy', '', 'Bulaong', '09649713558', 'Ozzy', '', 'Bulaong', '09649713558', '2023-11-15', NULL, NULL, NULL),
(77, '2020-2021', '204697136497', '9', 'Apitong', 'Regular', 'Miguel', '', 'Geronimo', 'Enrolled', '2008-06-10', '15', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Catacte', 'Jeremie', '', 'Geronimo', '09651364975', 'Edward', '', 'Geronimo', '09551364975', 'Edward', '', 'Geronimo', '09551364975', '2023-11-15', NULL, NULL, NULL),
(78, '2020-2021', '206197463154', '9', 'Apitong', 'Regular', 'Ian', '', 'Carlos', 'Enrolled', '2007-10-10', '16', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Camachilihan', 'Ruby', '', 'Carlos', '09053694135', 'Mark', '', 'Carlos', '09053695798', 'Mark', '', 'Carlos', '09053695798', '2023-11-15', NULL, NULL, NULL),
(79, '2020-2021', '204697465933', '9', 'Acacia', 'Transferee', 'Marcos', '', 'Arroyo', 'Enrolled', '2008-09-17', '15', 'Plaridel', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Plaridel', 'Parulan', 'Janine', '', 'Arroyo', '09316497645', 'Jose', '', 'Arroyo', '09316497111', 'Jose', '', 'Arroyo', '09316497111', '2023-11-15', '8', '2019', 'Holy Infant High School'),
(80, '2020-2021', '144909681411', '9', 'Acacia', 'Regular', 'Carolina', 'Magpantay', 'Marin', 'Enrolled', '2004-09-24', '19', 'Davao del Norte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'Bulalacao (San Pedro)', 'Cabugao', 'Josie Paloma', 'Magpantay', 'Marin', '09105834678', 'Augustus Ernesto', 'Javion', 'Marin', '09085775213', 'Carmelita Maci', 'Tsukada', 'Bustamante', '09757600335', '2023-11-15', NULL, NULL, NULL),
(81, '2020-2021', '149377052375', '9', 'Acacia', 'Regular', 'Marcos', 'Carrasco', 'Romero', 'Enrolled', '2004-04-26', '19', 'Southern Leyte', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Tarlac', 'San Manuel', 'Mangandingay', 'Antonia Sydnie', 'Carrasco', 'Romero', '09760007859', 'Maricel Lazaro', 'Villegas', 'Romero', '09045037514', 'Precious Aracely', 'Suzuki', 'Malano', '09092902765', '2023-11-15', NULL, NULL, NULL),
(82, '2020-2021', '141666472864', '9', 'Acacia', 'Regular', 'Rosario', 'Blanco', 'Fajardo', 'Enrolled', '2007-07-27', '16', 'Kidapawan Leyte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Romblon', 'San Fernando', 'Campalingo', 'Yoana Jazmyne', 'Blanco', 'Fajardo', '09658070306', 'Alexandrea Olan', 'Manalastas', 'Fajardo', '09806982583', 'Ayla Madelyn', 'Dinlayan', 'Liwanag', '09311289130', '2023-11-15', NULL, NULL, NULL),
(83, '2020-2021', '145795227374', '9', 'Acacia', 'Regular', 'Maia Jose', 'Gomez', 'Monton', 'Enrolled', '2006-02-28', '17', 'Calbayog Apayao', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Pandacan', 'Barangay 848', 'Nikhil Gary', 'Gomez', 'Monton', '09552794616', 'Kobe', 'Honoratas', 'Monton', '09014019710', 'Jerrald Brendan', 'Naldo', 'Ello', '09971667398', '2023-11-15', NULL, NULL, NULL),
(84, '2020-2021', '144745485026', '9', 'Acacia', 'Regular', 'Francisco Santana', 'Mitchell', 'Macatangay', 'Enrolled', '2007-10-18', '16', 'Porac Romblon', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'Cotabato (North Cotabato)', 'Antipas', 'New Pontevedra', 'Brycen Syjuco', 'Mitchell', 'Macatangay', '09544121906', 'Owen Jovany', 'Walker', 'Macatangay', '09109212516', 'Deonte Braden', 'Alexandre', 'Galvez', '09763538272', '2023-11-15', NULL, NULL, NULL),
(85, '2020-2021', '146588191597', '9', 'Acacia', 'Regular', 'Sergio Moya', 'Subrabas', 'Andal', 'Enrolled', '2001-10-10', '22', 'Titay Biliran', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Pamplona', 'Tabba', 'Carlee Teagan', 'Subrabas', 'Andal', '09596173844', 'Grady Austin', 'Palad', 'Andal', '09074366626', 'Caitlyn Emmeline', 'Suico', 'Magsakay', '09519160781', '2023-11-15', NULL, NULL, NULL),
(86, '2020-2021', '140801610383', '9', 'Acacia', 'Regular', 'Emilio Campos', 'Dy', 'Cachuela', 'Enrolled', '2010-01-13', '13', 'Zamboanga del Sur', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Hadji Muhtamad', 'Tausan', 'Jesenia Layla', 'Dy', 'Cachuela', '09683016576', 'Justin', 'Honorato', 'Cachuela', '09426027509', 'Kendrick Gabriel', 'Simpao', 'Estolas', '09371279050', '2023-11-15', NULL, NULL, NULL),
(87, '2020-2021', '143656107693', '9', 'Acacia', 'Regular', 'Rafael Muoz', 'Will', 'Cruz', 'Enrolled', '2010-02-25', '13', 'Palayan Dinagat Islands', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Paco', 'Barangay 685', 'Fraco Suelita', 'Will', 'Cruz', '09651705612', 'Adonis Josias', 'Romano', 'Cruz', '09978499810', 'Xavier Carl', 'Devyn', 'Malano', '09552119489', '2023-11-15', NULL, NULL, NULL),
(88, '2020-2021', '146617070719', '9', 'Apitong', 'Regular', 'Rudolph Red', 'Vermillion', 'Crimson', 'Enrolled', '2000-12-05', '22', 'Malabon City', 'English', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Marilao', 'Loma de Gato', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', 'Burgundy Maroon', 'Carmine', 'Crimson', '09054321250', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', '2023-11-15', NULL, NULL, NULL),
(89, '2020-2021', '145167056497', '9', 'Apitong', 'Regular', 'Althea', 'Farinas', 'Cerilo', 'Enrolled', '2002-09-10', '21', 'Bagumbayan Caloocan City', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Iloilo', 'Dingle', 'Ilajas', 'Everett Bello', 'Farinas', 'Cerilo', '09084265932', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', '2023-11-15', NULL, NULL, NULL),
(90, '2020-2021', '142971834843', '9', 'Apitong', 'Regular', 'Jeli Ann', 'Odron', 'Oco', 'Enrolled', '2003-10-07', '20', 'Guiguinto Biliran', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Quezon', 'Atimonan', 'Barangay Zone 2 (Pob.)', 'Eli Ramone', 'Odron', 'Oco', '09581112800', 'Vicente Jacob', 'Pavia', 'Oco', '09131320570', 'Irvin Theodore', 'Saturnin', 'Carrasco', '09623460209', '2023-11-15', NULL, NULL, NULL),
(91, '2020-2021', '140050590175', '9', 'Apitong', 'Regular', 'Gwen Xyren', 'Alabat', 'Amancio', 'Enrolled', '2001-02-07', '22', 'Zamboanga City Batanes', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Guimaras', 'Nueva Valencia', 'Canhawan', 'Kellen Jorge', 'Alabat', 'Amancio', '09353582656', 'Xylem', 'Trinidad', 'Amancio', '09509941400', 'Geoffrey', 'Quicho', 'Dungog', '09659748856', '2023-11-15', NULL, NULL, NULL),
(92, '2020-2021', '144472078198', '9', 'Apitong', 'Regular', 'Jillian', 'Escalante', 'Denaque', 'Enrolled', '2002-08-04', '21', 'Cabuyao Laguna', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Laguna', 'Cabuyao City', 'San Isidro', 'Javen Taylor', 'Escalante', 'Denaque', '09541959511', 'Rayman Jude', 'Alonzo', 'Denaque', '09775943042', 'Malik', 'Elija', 'Cedro', '09594810088', '2023-11-15', NULL, NULL, NULL),
(93, '2020-2021', '140310222376', '9', 'Apitong', 'Regular', 'Erica Mae', 'Quillo', 'Joson', 'Enrolled', '2002-03-23', '21', 'Nasipit Zambales', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Pampanga', 'City Of San Fernando (Capital)', 'Lourdes', 'Maribel', 'Quillo', 'Joson', '09947465791', 'Rogelio Romano', 'Lontok', 'Joson', '09553919871', 'Caden Aron', 'Naga', 'Marcelo', '09831267231', '2023-11-15', NULL, NULL, NULL),
(94, '2020-2021', '146190521858', '9', 'Apitong', 'Regular', 'Ryla', 'Milante', 'Velarede', 'Enrolled', '2003-10-09', '20', 'Caloocan City', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Tabina', 'Manikaan', 'Rosalie', 'Milante', 'Velarede', '09699093140', 'Roman', 'Anotion', 'Velarede', '09674689069', 'Jadyn Jeremiah', 'Latif', 'Degayo', '09382988158', '2023-11-15', NULL, NULL, NULL),
(95, '2020-2021', '143041770359', '9', 'Apitong', 'Regular', 'Recel Anne', 'San Juan', 'Boromeo', 'Enrolled', '2003-09-24', '20', 'Isabela Abra', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Batangas', 'Lipa City', 'Bolbok', 'Sia Zacarias', 'San Juan', 'Boromeo', '09298224617', 'Kurt Jaylon', 'Vinzon', 'Boromeo', '09273764933', 'Winston Dexter', 'Eron', 'Pilapil', '09097104367', '2023-11-15', NULL, NULL, NULL),
(96, '2020-2021', '143124798388', '9', 'Apitong', 'Regular', 'Lyka Mae', 'Juele', 'Lopez', 'Enrolled', '2000-11-07', '23', 'Marilao Bulacan', 'Filipino', 'Female', 'Region I (Ilocos Region)', 'La Union', 'San Juan', 'Guinguinabang', 'Harley', 'Juele', 'Lopez', '09783096111', 'Gavyn Holden', 'Gonzalo', 'Lopez', '09529078511', 'Pascual', 'Saturnin', 'Asuncion', '09748959312', '2023-11-15', NULL, NULL, NULL),
(97, '2020-2021', '144936924356', '9', 'Apitong', 'Regular', 'Seth Patrick', 'Datangel', 'Ancheta', 'Enrolled', '2003-08-10', '20', 'Guimba Albay', 'English', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Laur', 'Nauzon', 'Vaughn Louis', 'Datangel', 'Ancheta', '09656968148', 'Dalton Grady', 'Luz', 'Ancheta', '09172554469', 'Hernandez Damario', 'Salapudin', 'Capillo', '09328925094', '2023-11-15', NULL, NULL, NULL),
(98, '2021-2022', '890123456789', '9', 'Acacia', 'Transferee', 'Maria', '', 'Santos', 'Pending', '2001-02-02', '22', 'Malolos', 'Filipino', 'Female', 'Region XII (SOCCSKSARGEN)', 'Sarangani', 'Glan', 'Laguimit', 'Marie', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', '2023-11-15', '8', '2011-2012', 'Secret National High School'),
(99, '2021-2022', '890987654321', '9', 'Acacia', 'Transferee', 'Juan', '', 'dela Cruz', 'Pending', '2000-02-02', '23', 'Malolos Bulacan', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Paco', 'Barangay 685', 'Josephine', '', 'dela Cruz', '09182455347', 'Joshua', '', 'dela Cruz', '09182455347', 'Joshua', '', 'dela Cruz', '09182455347', '2023-11-15', '7', '2011-2012', 'Secret National High School'),
(100, '2021-2022', '890567890123', '9', 'Apitong', 'Transferee', 'Angela', '', 'Reyes', 'Pending', '2004-04-01', '19', 'Malolos Bulacan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'Matictic', 'Angeline', '', 'Reyes', '09182455347', 'Alexis', '', 'Reyes', '09182455347', 'Alexis', '', 'Reyes', '09182455347', '2023-11-15', '8', '2011-2012', 'Maunlad National High School'),
(101, '2021-2022', '890876543210', '9', 'Apitong', 'Transferee', 'Miguel', '', 'Aquino', 'Pending', '2002-02-03', '21', 'Malolos Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tibag', 'Marie', '', 'Aquino', '09182455347', 'Joshua', '', 'Aquino', '09182455347', 'Joshua', '', 'Aquino', '09182455347', '2023-11-15', '7', '2012-2013', 'Langit State University'),
(103, '2021-2022', '141280408146', '9', 'Apitong', 'Returning', 'Maria', 'Balindong', 'Gimenez', 'Pending', '2004-07-20', '19', 'Caibiran Romblon', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Palawan', 'Agutaya', 'Maracanao', 'Domenic Isaak', 'Balindong', 'Canlas', '09718973791', 'Canlas', 'Canlas', 'Canlas', '09894973881', 'Vicente', 'Vicente', 'Vicente', '09285409397', '2023-11-15', '8', '2019-2020', 'Kapitangan National High School'),
(104, '2021-2022', '874512369087', '9', 'Apitong', 'Regular', 'Marvin', '', 'Lim', 'Pending', '2001-06-28', '22', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tibag', 'Myrna', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', '2023-11-15', NULL, NULL, NULL),
(105, '2021-2022', '160229389135', '9', 'Apitong', 'Regular', 'Ignacio Reuben', 'Farinas', 'Mora', 'Pending', '2002-08-24', '21', 'Southern Leyte', 'Filipino', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Matanao', 'La Suerte', 'Blanca Shaniya', 'Farinas', 'Mora', '09637522367', 'Mason Geraldo', 'Cerilo', 'Mora', '09587423649', 'Blanca Shaniya', 'Farinas', 'Mora', '09637522367', '2023-11-15', NULL, NULL, NULL),
(106, '2021-2022', '146584179112', '9', 'Apitong', 'Regular', 'Thalia Cyntia', 'Busran', 'Montano', 'Pending', '1999-10-04', '24', 'Mansalay Oriental Mindoro', 'Filipino', 'Male', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'Mansalay', 'Cabalwa', 'Nevada Zurina', 'Busran', 'Montano', '09934059107', 'Rickey Geoffrey', 'Lobo', 'Montano', '09190198710', 'Adelio Mekhi', 'Galeno', 'Acevedo', '09521225710', '2023-11-15', NULL, NULL, NULL),
(107, '2021-2022', '144107205401', '9', 'Apitong', 'Regular', 'Hayley Amanda', 'Pinagpala', 'Montecillo', 'Pending', '2004-10-04', '19', 'Mariveles Bataan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'Mariveles', 'Maligaya', 'Rosalia', 'Pinagpala', 'Montecillo', '09176832638', 'Valencia', 'Digamon', 'Montecillo', '09706583246', 'Laline Brisa', 'Joco', 'Micolob', '09513028777', '2023-11-15', NULL, NULL, NULL),
(108, '2021-2022', '149654217177', '9', 'Apitong', 'Regular', 'Maria', 'Jose', 'Cruz', 'Pending', '2006-06-15', '17', 'Davao del Norte', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Dumingag', 'Guitran', 'Beatrice Alia', 'Jose', 'Cruz', '09935008701', 'Vicente Brody', 'Limuaco', 'Cruz', '09605080094', 'Vicente Brody', 'Limuaco', 'Cruz', '09605080094', '2023-11-15', NULL, NULL, NULL),
(109, '2021-2022', '140321849773', '9', 'Apitong', 'Regular', 'Cesar', 'Gandionco', 'Campos', 'Pending', '2010-09-25', '13', 'Cabuyao Catanduanes', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Laguna', 'Magdalena', 'Malinao', 'Rachael Mariam', 'Gandionco', 'Campos', '09979518997', 'Leonard', '', 'Campos', '09010951673', 'Cenobia', 'Iwatani', 'Macrohon', '09756050920', '2023-11-15', NULL, NULL, NULL),
(110, '2021-2022', '145770539457', '9', 'Apitong', 'Regular', 'Margarita Emily', 'Cabrera', 'Belloso', 'Pending', '2009-01-14', '14', 'Malabon Leyte', 'Filipino', 'Female', 'Region I (Ilocos Region)', 'La Union', 'San Juan', 'Dasay', 'Anne Esther', 'Cabrera', 'Belloso', '09191675192', 'Lazaro Sandoval', 'Damaris', 'Belloso', '09319652371', 'Brisa Nikki', 'Tungol', 'Legaspi', '09620277360', '2023-11-15', NULL, NULL, NULL),
(111, '2021-2022', '148984764435', '9', 'Apitong', 'Regular', 'Rafael', 'Hassan', 'Vazquez', 'Pending', '2008-12-23', '14', 'Bogo Davao del Norte', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Quezon', 'Jomalig', 'Casuguran', 'Justyn', 'Hassan', 'Vazquez', '09908769379', 'Alberto', 'Pascual', 'Vazquez', '09983570006', 'Marc Brody', 'Curcio', 'Ferrer', '09660214402', '2023-11-15', NULL, NULL, NULL),
(112, '2021-2022', '202456218784', '9', 'Apitong', 'Regular', 'Paulo', 'Bernal', 'Agsunta', 'Pending', '2009-01-05', '14', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bataan', 'Mariveles', 'San Carlos', 'Melanie', '', 'Bernal', '09554012883', 'Apendro', 'Samon', 'Agsunta', '09665024481', 'Melanie', '', 'Bernal', '09554012883', '2023-11-15', NULL, NULL, NULL),
(113, '2021-2022', '201246872914', '9', 'Apitong', 'Regular', 'Calix', 'Ramon', 'Cruz', 'Pending', '2007-02-05', '16', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Hagonoy', 'Mercado', 'Elyn', '', 'Cruz', '09445823167', 'Karl', '', 'Cruz', '09458712364', 'Elyn', '', 'Cruz', '09445823167', '2023-11-15', NULL, NULL, NULL),
(114, '2021-2022', '204534781244', '9', 'Apitong', 'Regular', 'Lera', '', 'Gray', 'Pending', '2007-07-11', '16', 'Calumpit', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'Poblacion', 'Meggan', '', 'Gray', '09487521643', 'Jericko', '', 'Gray', '09428751364', 'Meggan', '', 'Gray', '09487521643', '2023-11-15', NULL, NULL, NULL),
(115, '2021-2022', '204578943516', '9', 'Apitong', 'Regular', 'Sky Sunshine', '', 'Cruz', 'Pending', '2007-05-17', '16', 'Calumpit', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Antipona', 'Alexandra', '', 'Cruz', '09452163575', 'Patrick', '', 'Cruz', '09458736154', 'Alexandra', '', 'Cruz', '09452163575', '2023-11-15', NULL, NULL, NULL),
(116, '2021-2022', '238353838792', '9', 'Apitong', 'Regular', 'Charmaine', 'Cabanatan', 'Santos', 'Pending', '2006-08-01', '17', 'Navotas', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, Fourth District', 'Pasay City', 'Barangay 17', 'Freira Kali', 'Cabanatan', 'Santos', '09145002374', 'Leones Marcelo', 'Manansala', 'Santos', '09855365911', 'Yoana Eliza', 'Quimson', 'Herrera', '09119402916', '2023-11-15', NULL, NULL, NULL),
(117, '2021-2022', '146974019237', '9', 'Acacia', 'Regular', 'Juan', 'Carlos', 'Moya', 'Pending', '2009-05-14', '14', 'Munyoz Siquijor', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Gattaran', 'Centro Sur (Pob.)', 'Dona Anaya', 'Carlos', 'Moya', '09933706016', 'Chad Cuarto', 'Navarro', 'Moya', '09118594762', 'Tavion Amado', 'Galeno', 'Manabat', '09733934590', '2023-11-15', NULL, NULL, NULL),
(118, '2021-2022', '204568326521', '9', 'Acacia', 'Regular', 'Kevin', '', 'De Luna', 'Pending', '2007-03-14', '16', 'Calumpit', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Balite', 'Laura', '', 'De Luna', '09542135786', 'Kevin', '', 'De Luna', '09326578451', 'Laura', '', 'De Luna', '09542135786', '2023-11-15', NULL, NULL, NULL),
(119, '2021-2022', '208754212365', '9', 'Acacia', 'Regular', 'Junnel', '', 'Ramon', 'Pending', '2008-06-11', '15', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Hagonoy', 'San Pascual', 'Nicka', '', 'Ramon', '09325461842', 'Marvic', '', 'Ramon', '09326661234', 'Nicka', '', 'Ramon', '09325461842', '2023-11-15', NULL, NULL, NULL),
(120, '2021-2022', '209845123256', '9', 'Acacia', 'Regular', 'Kristine', '', 'Vantaculo', 'Pending', '2007-07-27', '16', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'City Of Malolos (Capital)', 'Balite', 'Angel', '', 'Vantaculo', '09562132546', 'Paolito', '', 'Vantaculo', '09562132564', 'Angel', '', 'Vantaculo', '09562132546', '2023-11-15', NULL, NULL, NULL),
(121, '2021-2022', '203212654587', '9', 'Acacia', 'Regular', 'Elyn Marie', '', 'Magsaysay', 'Pending', '2007-03-11', '16', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'Bangkal', 'Grace', '', 'Magsaysay', '09325416978', 'Joshua', '', 'Magsaysay', '09325416888', 'Grace', '', 'Magsaysay', '09325416978', '2023-11-15', NULL, NULL, NULL),
(122, '2021-2022', '238500060527', '9', 'Acacia', 'Regular', 'Renzlyn Venice', 'Aprinal', 'Rebancos', 'Pending', '1996-06-22', '27', 'Muntinlupa City', 'Filipino', 'Female', 'Region XII (SOCCSKSARGEN)', 'Sultan Kudarat', 'Lambayong (Mariano Marcos)', 'Gansing (Bilumen)', 'Eden Alycia', 'Aprinal', 'Rebancos', '09557091033', 'Ariel', 'Canlas', 'Rebancos', '09951593088', 'Natasha Kailyn', 'Abyyappy', 'Eusebio', '09105700103', '2023-11-15', NULL, NULL, NULL),
(123, '2021-2022', '900512369087', '9', 'Acacia', 'Regular', 'Janus', '', 'Lopez', 'Pending', '2000-11-11', '23', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tinejero', 'Joseph', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', '2023-11-15', NULL, NULL, NULL),
(124, '2021-2022', '149008092093', '9', 'Acacia', 'Regular', 'Mariano', 'Pelaez', 'Alvarez', 'Pending', '2008-11-23', '14', 'Quezon City Palawan', 'Filipino', 'Male', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Port Area', 'Barangay 650', 'Irene Susan', 'Pelaez', 'Alvarez', '09487722580', 'Mckenzie Nya', 'Balignasay', 'Alvarez', '09421596550', 'Brittney Bonita', 'Peria', 'Carrasco', '09691747953', '2023-11-15', NULL, NULL, NULL),
(125, '2021-2022', '148575065213', '9', 'Acacia', 'Regular', 'Elena Kailyn', 'Reya', 'Parra', 'Pending', '2006-08-23', '17', 'El Salvador Laguna', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Quezon', 'Lucban', 'Kulapi', 'Karen Benigna', 'Reya', 'Parra', '09376897933', 'Kane Leonardo', 'Viray', 'Parra', '09008718881', 'Desmond Neal', 'Aureliano', 'Manlangit', '09700406278', '2023-11-15', NULL, NULL, NULL),
(126, '2021-2022', '148987314104', '9', 'Acacia', 'Regular', 'Carlos', 'Yengko', 'Blanco', 'Pending', '2007-09-16', '16', 'Dasol Zamboanga del Sur', 'Filipino', 'Male', 'Region VIII (Eastern Visayas)', 'Eastern Samar', 'Oras', 'Camanga (Pob.)', 'Kayleigh Diane', 'Yengko', 'Blanco', '09180419865', 'Ariel Zaria', 'Matiyaga', 'Blanco', '09681353207', 'Delcine', 'Abrogar', 'Eleadora', '09214744969', '2023-11-15', NULL, NULL, NULL),
(127, '2021-2022', '140002182640', '9', 'Acacia', 'Regular', 'Luisa Larissa', 'Vizcaya', 'Garcia', 'Pending', '2010-01-03', '13', 'Concepcion Kalinga', 'Filipino', 'Female', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Bokod', 'Daclan', 'Kenna Bianca', 'Vizcaya', 'Garcia', '09952555106', 'Batungbakal', 'Tayag', 'Garcia', '09379328313', 'Michelle', 'Singson', 'Maquiling', '09378268156', '2023-11-15', NULL, NULL, NULL),
(128, '2021-2022', '142711264310', '9', 'Acacia', 'Regular', 'Carmen', 'Yambao', 'Serrano', 'Pending', '2009-11-24', '13', 'Pototan Cagayan', 'Filipino', 'Female', 'Region X (Northern Mindanao)', 'Camiguin', 'Guinsiliban', 'Cabuan', 'Lilly Alexia', 'Yambao', 'Serrano', '09225711205', 'Rohan William', 'Hidalgo', 'Serrano', '09055720180', 'Karson Adan', 'Locsin', 'Abaya', '09399664354', '2023-11-15', NULL, NULL, NULL),
(129, '2021-2022', '148263813012', '9', 'Acacia', 'Regular', 'Julio Kristian', 'Manalili', 'Garrido', 'Pending', '2010-08-10', '13', 'Norzagaray Quirino', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Nueva Vizcaya', 'Bagabag', 'Careb', 'Rylee Austin', 'Manalili', 'Garrido', '09692569328', 'Tomas Rio', 'Gatus', 'Garrido', '09109768992', 'Rafael Micheal', 'Orion', 'Cabungcal', '09813710968', '2023-11-15', NULL, NULL, NULL),
(130, '2021-2022', '147491738514', '9', 'Acacia', 'Regular', 'Marya', 'Carmen', 'Penya', 'Pending', '2007-03-26', '16', 'Caloocan Nueva Vizcaya', 'Filipino', 'Female', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Sablan', 'Banangan', 'Isaias Zakary', 'Carmen', 'Penya', '09035644547', 'Johnathon Hayden', 'Tejada', 'Penya', '09966731685', 'Edwardo Idurre', 'Martinez', 'Cervantes', '09498577322', '2023-11-15', NULL, NULL, NULL),
(131, '2021-2022', '143586851391', '9', 'Acacia', 'Regular', 'Salvador', 'Javier', 'Gomez', 'Pending', '2006-09-15', '17', 'Valencia Leyte', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Hadji Muhtamad', 'Tausan', 'Ciceron Lamar', 'Javier', 'Gomez', '09907369051', 'Brycen Javiero', 'Borja', 'Gomez', '09358420346', 'Orlando', 'Avery', 'Sace', '09484739341', '2023-11-15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade_seven`
--

CREATE TABLE `grade_seven` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_type` varchar(255) NOT NULL,
  `stud_fname` varchar(255) NOT NULL,
  `stud_mname` varchar(255) DEFAULT NULL,
  `stud_lname` varchar(255) NOT NULL,
  `enrollment_status` varchar(255) NOT NULL DEFAULT 'unset',
  `birth_date` date NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) DEFAULT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) DEFAULT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) DEFAULT NULL,
  `guardian_lname` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `date_enrolled` date NOT NULL,
  `last_grade_level` varchar(255) DEFAULT NULL,
  `last_School_year` varchar(255) DEFAULT NULL,
  `last_school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_seven`
--

INSERT INTO `grade_seven` (`id`, `school_year`, `lrn`, `grade_level`, `section`, `student_type`, `stud_fname`, `stud_mname`, `stud_lname`, `enrollment_status`, `birth_date`, `age`, `place_of_birth`, `mother_tongue`, `gender`, `region`, `province`, `city`, `barangay`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `date_enrolled`, `last_grade_level`, `last_School_year`, `last_school`) VALUES
(95, '2019-2020', '874512369087', '7', 'Rizal', 'Regular', 'Marvin', '', 'Lim', 'unset', '2001-06-28', '22', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tibag', 'Myrna', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', 'Ivan', '', 'Lim', '09182455347', '2023-11-15', NULL, NULL, NULL),
(96, '2019-2020', '900512369087', '7', 'Rizal', 'Transferee', 'Janus', '', 'Lopez', 'unset', '2000-11-11', '23', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Pulilan', 'Tinejero', 'Joseph', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', 'Joephine', '', 'Lopez', '09182455347', '2023-11-15', '7', '2006-2007', 'Langit State University');

-- --------------------------------------------------------

--
-- Table structure for table `grade_ten`
--

CREATE TABLE `grade_ten` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_type` varchar(255) NOT NULL,
  `stud_fname` varchar(255) NOT NULL,
  `stud_mname` varchar(255) DEFAULT NULL,
  `stud_lname` varchar(255) NOT NULL,
  `enrollment_status` varchar(255) NOT NULL DEFAULT 'unset',
  `birth_date` date NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) DEFAULT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) DEFAULT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) DEFAULT NULL,
  `guardian_lname` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `date_enrolled` date NOT NULL,
  `last_grade_level` varchar(255) DEFAULT NULL,
  `last_School_year` varchar(255) DEFAULT NULL,
  `last_school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_ten`
--

INSERT INTO `grade_ten` (`id`, `school_year`, `lrn`, `grade_level`, `section`, `student_type`, `stud_fname`, `stud_mname`, `stud_lname`, `enrollment_status`, `birth_date`, `age`, `place_of_birth`, `mother_tongue`, `gender`, `region`, `province`, `city`, `barangay`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `date_enrolled`, `last_grade_level`, `last_School_year`, `last_school`) VALUES
(71, '2019-2020', '701934562794', '10', 'Diamond', 'Completer', 'Mark', '', 'Hernandez', 'Finished', '2003-11-15', '20', 'Baliuag', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'San Roque', 'Mary', '', 'Hernandez', '09182455349', 'Mario', '', 'Hernandez', '09182455362', 'Mario', '', 'Hernandez', '09182455362', '2023-11-15', NULL, NULL, NULL),
(72, '2019-2020', '701934562804', '10', 'Diamond', 'Completer', 'Carl', '', 'Lim', 'Finished', '2001-11-04', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Frances', 'Carla', '', 'Lim', '09182453412', 'Carlo', '', 'Lim', '09182453412', 'Carlo', '', 'Lim', '09182453412', '2023-11-15', NULL, NULL, NULL),
(73, '2019-2020', '701934562805', '10', 'Diamond', 'Completer', 'Mandy', '', 'Santos', 'Finished', '2001-11-04', '22', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Frances', 'Marie', '', 'Santos', '09182453412', 'Marlon', '', 'Santos', '09182453412', 'Marie', '', 'Santos', '09182453412', '2023-11-15', NULL, NULL, NULL),
(74, '2019-2020', '701934562806', '10', 'Diamond', 'Completer', 'Eren', '', 'Lopez', 'Finished', '2002-08-14', '21', 'Plaridel', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Guiguinto', 'Pritil', 'Mary', '', 'Lopez', '01183466792', 'Erick', '', 'Lopez', '09183466792', 'Erick', '', 'Lopez', '09183466792', '2023-11-15', NULL, NULL, NULL),
(75, '2019-2020', '701934562807', '10', 'Diamond', 'Completer', 'Marvin', '', 'Torno', 'Finished', '2001-07-16', '22', 'Pulilan', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Negros Occidental', 'Cauayan', 'Guiljungan', 'Myrna', '', 'Torno', '09182455347', 'Ivan', '', 'Torno', '09182455347', 'Ivan', '', 'Torno', '09182455347', '2023-11-15', NULL, NULL, NULL),
(76, '2019-2020', '701934562808', '10', 'Diamond', 'Completer', 'Anne', '', 'Ocampo', 'Finished', '2001-11-15', '22', 'Malolos', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Guimaras', 'Nueva Valencia', 'Lanipe', 'Annie', '', 'Ocampo', '09346288694', 'Orlando', '', 'Ocampo', '09346288694', 'Orlando', '', 'Ocampo', '09346288694', '2023-11-15', '8', '2001-2002', 'Bulacan state university'),
(77, '2019-2020', '701934562809', '10', 'Diamond', 'Completer', 'Mikasa', '', 'Ackerman', 'Finished', '2000-11-26', '22', 'Paombong', 'Filipino', 'Female', 'Region XIII (Caraga)', 'Dinagat Islands', 'Tubajon', 'Santa Cruz (Pob.)', 'Minerva', '', 'Ackerman', '09146322542', 'Miranda', '', 'Ackerman', '09146322542', 'Miranda', '', 'Ackerman', '09146322542', '2023-11-15', '9', '2001-2002', 'Baliuag university'),
(78, '2019-2020', '701934562810', '10', 'Diamond', 'Completer', 'Maria', '', 'Santos', 'Finished', '2000-01-02', '23', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bataan', 'Orani', 'Silahis', 'Marian', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', '2023-11-15', NULL, NULL, NULL),
(79, '2019-2020', '701934562811', '10', 'Diamond', 'Completer', 'Roberto', '', 'Reyes', 'Finished', '2001-05-05', '22', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Pandi', 'Bagbaguin', 'Remy', '', 'Reyes', '09182455348', 'Rolando', '', 'Reyes', '09182455348', 'Rolando', '', 'Reyes', '09182455348', '2023-11-15', NULL, NULL, NULL),
(80, '2019-2020', '701934562812', '10', 'Diamond', 'Completer', 'Angela', '', 'Dela Cruz', 'Finished', '2001-02-02', '22', 'Malolos', 'Filipino', 'Female', 'Region XI (Davao Region)', 'Davao Del Sur', 'Malalag', 'Tagansule', 'Angeline', '', 'Dela Cruz', '09182455347', 'Angelo', '', 'Dela Cruz', '09182455347', 'Angelo', '', 'Dela Cruz', '09182455347', '2023-11-15', NULL, NULL, NULL),
(81, '2019-2020', '701934562813', '10', 'Diamond', 'Completer', 'Jose', '', 'Villanueva', 'Finished', '2002-04-04', '21', 'Baliuag', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'South Cotabato', 'Tantangan', 'New Lambunao', 'Josie', '', 'Villanueva', '09182455347', 'Joseph', '', 'Villanueva', '09182455347', 'Joseph', 'Antonio', 'Villanueva', '09182455347', '2023-11-15', '9', '2006-2007', 'Maliwanag National High School'),
(82, '2019-2020', '701934562814', '10', 'Diamond', 'Completer', 'Sofia', '', 'Gomez', 'Finished', '2001-05-05', '22', 'Quezon City', 'Filipino', 'Female', 'National Capital Region (NCR)', 'City Of Manila', 'Pandacan', 'Barangay 852', 'Sonya', '', 'Gomez', '09182455347', 'Sonny', '', 'Gomez', '09182455347', 'Sonny', '', 'Gomez', '09182455347', '2023-11-15', NULL, NULL, NULL),
(83, '2019-2020', '701934562815', '10', 'Diamond', 'Completer', 'Emmanuel', 'Carlos', 'Ramos', 'Finished', '2001-03-01', '22', 'Malolos', 'Filipino', 'Male', 'Region VIII (Eastern Visayas)', 'Leyte', 'Isabel', 'Santa Cruz', 'Erika', 'Carlos', 'Ramos', '09182444347', 'Endo', 'Carlos', 'Ramos', '09182444347', 'Erika', 'Carlos', 'Ramos', '09182444347', '2023-11-15', NULL, NULL, NULL),
(84, '2019-2020', '701934562816', '10', 'Diamond', 'Completer', 'Daniel', '', 'Tan', 'Finished', '2000-05-05', '23', 'Malolos', 'Filipino', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Padada', 'Tulogan', 'Denise', '', 'Tan', '09182455388', 'Derick', '', 'Tan', '09182455388', 'Derick', '', 'Tan', '09182455388', '2023-11-15', NULL, NULL, NULL),
(85, '2019-2020', '701934562817', '10', 'Ruby', 'Completer', 'Juanito', '', 'Hernandez', 'Finished', '2001-07-10', '22', 'Malolos', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Malate', 'Barangay 705', 'Jina', '', 'Hernandez', '09182455311', 'Joshua', '', 'Hernandez', '09182455311', 'Joshua', '', 'Hernandez', '09182455311', '2023-11-15', NULL, NULL, NULL),
(86, '2019-2020', '701934562818', '10', 'Ruby', 'Completer', 'Katrina', 'Bianca', 'Espinoza', 'Finished', '2003-11-11', '20', 'Cavite', 'Filipino', 'Female', 'National Capital Region (NCR)', 'City Of Manila', 'Intramuros', 'Barangay 655', 'Kathleen', 'Bianca', 'Espinoza', '09182665347', 'Karding', 'Bianca', 'Espinoza', '09182665347', 'Karding', 'Bianca', 'Espinoza', '09182665347', '2023-11-15', NULL, NULL, NULL),
(87, '2019-2020', '701934562819', '10', 'Ruby', 'Completer', 'Alejandro', '', 'Abad', 'Finished', '2005-05-05', '18', 'Cavite', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'South Cotabato', 'Tampakan', 'Pula-bato', 'Aileen', '', 'Abad', '09222455347', 'Alex', '', 'Abad', '09222455347', 'Alex', '', 'Abad', '09222455347', '2023-11-15', NULL, NULL, NULL),
(88, '2019-2020', '701934562820', '10', 'Ruby', 'Completer', 'Vanessa', '', 'Cruz', 'Finished', '2001-02-02', '22', 'Malolos Bulacan', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Batia', 'Valerie', '', 'Cruz', '09682455347', 'Victor', '', 'Cruz', '09682455347', 'Victor', '', 'Cruz', '09682455347', '2023-11-15', NULL, NULL, NULL),
(89, '2019-2020', '701934562821', '10', 'Ruby', 'Completer', 'Francis', '', 'Pascual', 'Finished', '2000-04-04', '23', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Balagtas (Bigaa)', 'Dalig', 'Franz', '', 'Pascual', '09182455347', 'Frank', '', 'Pascual', '09182455347', 'Frank', '', 'Pascual', '09182455347', '2023-11-15', '9', '2006-2007', 'Bulacan State University'),
(90, '2019-2020', '701934562822', '10', 'Ruby', 'Completer', 'Bernadette', '', 'Alonzo', 'Finished', '2001-02-22', '22', 'Malolos', 'Filipino', 'Male', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Ermita', 'Barangay 659', 'Brenda', '', 'Alonzo', '09182455347', 'Brian', '', 'Alonzo', '09182455347', 'Brian', '', 'Alonzo', '09182455347', '2023-11-15', '9', '2006-2007', 'Secret National High School'),
(91, '2019-2020', '701934562823', '10', 'Ruby', 'Completer', 'Marco', '', 'Santos', 'Finished', '2001-05-05', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'Binakod', 'Maria', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', 'Mario', '', 'Santos', '09182455347', '2023-11-15', NULL, NULL, NULL),
(92, '2019-2020', '701934562824', '10', 'Ruby', 'Completer', 'Jessica', '', 'Castro', 'Finished', '2001-04-04', '22', 'Cavite', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Zambales', 'San Marcelino', 'San Isidro (Pob.)', 'Jewel', '', 'Castro', '09182455347', 'Jordan', '', 'Castro', '09182455347', 'Jordan', '', 'Castro', '09182455347', '2023-11-15', NULL, NULL, NULL),
(93, '2019-2020', '701934562825', '10', 'Ruby', 'Completer', 'Luis', '', 'Villareal', 'Finished', '2000-11-01', '23', 'Pulilan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Nampicuan', 'Southeast Poblacion', 'Lenna', '', 'Villareal', '09182455348', 'Lorenz', '', 'Villareal', '09182455348', 'Lorenz', '', 'Villareal', '09182455348', '2023-11-15', NULL, NULL, NULL),
(94, '2019-2020', '701934562826', '10', 'Ruby', 'Completer', 'Isabel', '', 'Sarmiento', 'Finished', '2000-05-04', '23', 'Cubao', 'Filipino', 'Male', 'Region X (Northern Mindanao)', 'Bukidnon', 'San Fernando', 'Matupe', 'Irene', '', 'Sarmiento', '09992455347', 'Ireneo', '', 'Sarmiento', '09992455347', 'Ireneo', '', 'Sarmiento', '09992455347', '2023-11-15', NULL, NULL, NULL),
(95, '2019-2020', '701934562827', '10', 'Ruby', 'Completer', 'Camille', '', 'Lim', 'Finished', '2002-02-02', '21', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Science City Of Muñoz', 'Maligaya', 'Carla', '', 'Lim', '09182455347', 'Carlo', '', 'Lim', '09182455347', 'Carlo', '', 'Lim', '09182455347', '2023-11-15', NULL, NULL, NULL),
(96, '2020-2021', '206423619487', '10', 'Diamond', 'Completer', 'Emman', '', 'Lim', 'Finished', '2007-06-12', '16', 'Baliuag', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Paitan', 'Denise', '', 'Lim', '09554012993', 'Emman', '', 'Lim', '09664017734', 'Emman', '', 'Lim', '09664017734', '2023-11-15', '9', '2019', 'Holy Infant National High School'),
(97, '2020-2021', '202046132959', '10', 'Diamond', 'Regular', 'Clarence', '', 'Sy', 'Pending', '2005-11-16', '17', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Barangca', 'Jasmine', '', 'Sy', '09643164978', 'Kim', '', 'Sy', '09646249873', 'Kim', '', 'Sy', '09646249873', '2023-11-15', NULL, NULL, NULL),
(98, '2020-2021', '202046935494', '10', 'Diamond', 'Completer', 'Jasmine', '', 'Ocampo', 'Finished', '2005-07-13', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Guiguinto', 'Santa Cruz', 'Celestina', '', 'Ocampo', '09653164978', 'Alexis', '', 'Ocampo', '09653165558', 'Celestina', '', 'Ocampo', '09653164978', '2023-11-15', NULL, NULL, NULL),
(99, '2020-2021', '206531649785', '10', 'Diamond', 'Completer', 'Mark', '', 'Santos', 'Finished', '2005-05-17', '18', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Angat', 'Banaban', 'Angel', '', 'Santos', '09646249877', 'Gabriel', '', 'Santos', '09646249997', 'Gabriel', '', 'Santos', '09646249997', '2023-11-15', NULL, NULL, NULL),
(100, '2020-2021', '200964624999', '10', 'Diamond', 'Regular', 'Katrine', '', 'Noda', 'Pending', '2005-05-17', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Angat', 'Banaban', 'Denise', '', 'Noda', '09096413975', 'Tommy', '', 'Noda', '09666497321', 'Tommy', '', 'Noda', '09666497321', '2023-11-15', NULL, NULL, NULL),
(101, '2020-2021', '200966649732', '10', 'Ruby', 'Completer', 'Kylie', '', 'Samson', 'Finished', '2007-02-06', '16', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Catulinan', 'Lanie', '', 'Samson', '09465654213', 'Jose', '', 'Samson', '09465654445', 'Lanie', '', 'Samson', '09465654213', '2023-11-15', '9', '2019', 'Holy Infant High School'),
(103, '2020-2021', '204916322644', '10', 'Ruby', 'Completer', 'Julia', '', 'Otiz', 'Finished', '2005-07-06', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Lolomboy', 'Julia', '', 'Otiz', '09949163226', 'Karding', '', 'Otiz', '09948163226', 'Julia', '', 'Otiz', '09949163226', '2023-11-15', '8', '2006-2007', 'Secret National High School'),
(104, '2020-2021', '701934562828', '10', 'Diamond', 'Regular', 'Patricia', '', 'Mendoza', 'Pending', '2001-02-02', '22', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'Orani', 'Sibul', 'Pauline', '', 'Mendoza', '09182455347', 'Paolo', '', 'Mendoza', '09182455347', 'Paolo', '', 'Mendoza', '09182455347', '2023-11-15', NULL, NULL, NULL),
(105, '2020-2021', '701934562829', '10', 'Diamond', 'Completer', 'Carlos', '', 'Reyes', 'Finished', '2000-02-02', '23', 'Caloocan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'Minalin', 'Santa Catalina', 'Carlene', '', 'Reyes', '09182455347', 'Cardo', '', 'Reyes', '09182455347', 'Cardo', '', 'Reyes', '09182455347', '2023-11-15', NULL, NULL, NULL),
(106, '2020-2021', '701934562830', '10', 'Diamond', 'Completer', 'Angelica', '', 'Cruz', 'Finished', '2005-05-05', '18', 'Plaridel Bulacan', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Negros Occidental', 'City Of Kabankalan', 'Barangay 7 (Pob.)', 'Angeline', '', 'Cruz', '09662455347', 'Angelo', '', 'Cruz', '09662455347', 'Angelo', '', 'Cruz', '09662455347', '2023-11-15', NULL, NULL, NULL),
(107, '2020-2021', '701934562831', '10', 'Diamond', 'Completer', 'Gabriel', '', 'Del Rosario', 'Finished', '2004-05-05', '19', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'Minalin', 'San Isidro', 'Gail', '', 'Del Rosario', '09182455347', 'Alex', '', 'Del Rosario', '09182455347', 'Alex', '', 'Del Rosario', '09182455347', '2023-11-15', NULL, NULL, NULL),
(108, '2020-2021', '701934562833', '10', 'Diamond', 'Completer', 'Andres', '', 'Panganiban', 'Finished', '2001-05-03', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Paombong', 'San Roque', 'Andrea', '', 'Panganiban', '09182455347', 'Andrei', '', 'Panganiban', '09182455347', 'Andrea', '', 'Panganiban', '09182455347', '2023-11-15', NULL, NULL, NULL),
(109, '2020-2021', '701934562835', '10', 'Diamond', 'Completer', 'Emmanuel', '', 'Ong', 'Finished', '2001-11-01', '22', 'Marilao Bulacan', 'Filipino', 'Male', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Malate', 'Barangay 706', 'Erika', '', 'Ong', '09182455347', 'Erick', '', 'Ong', '09182455347', 'Erika', '', 'Ong', '09182455347', '2023-11-15', NULL, NULL, NULL),
(110, '2020-2021', '701934562836', '10', 'Diamond', 'Completer', 'Jose', '', 'Manalo', 'Finished', '2001-01-01', '22', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Norzagaray', 'Bigte', 'Jennie', '', 'Manalo', '09182455347', 'Joshua', '', 'Manalo', '09182455347', 'Joshua', '', 'Manalo', '09182455347', '2023-11-15', NULL, NULL, NULL),
(111, '2020-2021', '701934562837', '10', 'Diamond', 'Completer', 'Eduardo', '', 'Velasco', 'Finished', '2000-02-02', '23', 'Malolos Bulacan', 'Filipino', 'Male', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Ramon Magsaysay (Liargo)', 'Malating', 'Edna', '', 'Velasco', '09182455347', 'Erick', '', 'Velasco', '09182455347', 'Erick', '', 'Velasco', '09182455347', '2023-11-15', NULL, NULL, NULL),
(112, '2020-2021', '701934562838', '10', 'Diamond', 'Completer', 'Luis', '', 'Castro', 'Finished', '2001-02-01', '22', 'Marilao Bulacan', 'Filipino', 'Male', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'City Of Calapan (Capital)', 'Batino', 'Leona', '', 'Castro', '09182455347', 'Lennard', '', 'Castro', '09182455347', 'Lennard', '', 'Castro', '09182455347', '2023-11-15', NULL, NULL, NULL),
(113, '2020-2021', '146190521859', '10', 'Ruby', 'Completer', 'Kristopher', '', 'Santos', 'Finished', '2001-02-02', '22', 'Malolos', 'Bulacan', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Magsaysay', 'Tacul', 'Kirsten', '', 'Santos', '09182455347', 'Karlo', '', 'Santos', '09182455347', 'Kirsten', '', 'Santos', '09182455347', '2023-11-15', NULL, NULL, NULL),
(114, '2020-2021', '146190521860', '10', 'Ruby', 'Completer', 'Camila', '', 'Rivera', 'Finished', '2001-01-02', '22', 'Malolos', 'Filipino', 'Male', 'Region XI (Davao Region)', 'Davao Del Sur', 'Padada', 'Tulogan', 'Carla', '', 'Rivera', '09182455347', 'Carding', '', 'Rivera', '09182455347', 'Carding', '', 'Rivera', '09182455347', '2023-11-15', NULL, NULL, NULL),
(115, '2020-2021', '146190521861', '10', 'Ruby', 'Regular', 'Jose', '', 'Estrella', 'Pending', '2000-02-04', '23', 'Marilao Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Plaridel', 'Santa Ines', 'Josephine', '', 'Estrella', '09182455347', 'Joshua', '', 'Estrella', '09182455347', 'Josephine', '', 'Estrella', '09182455347', '2023-11-15', NULL, NULL, NULL),
(116, '2020-2021', '706190521862', '10', 'Ruby', 'Completer', 'Samantha', '', 'Encarnacion', 'Finished', '2001-02-03', '22', 'Malolos', 'Filipino', 'Male', 'Region X (Northern Mindanao)', 'Camiguin', 'Guinsiliban', 'Cantaan', 'Sally', '', 'Encarnacion', '09182455347', 'Sonny', '', 'Encarnacion', '09182455347', 'Sonny', '', 'Encarnacion', '09182455347', '2023-11-15', NULL, NULL, NULL),
(117, '2020-2021', '701934562900', '10', 'Ruby', 'Regular', 'Lorenzo', '', 'Gonzales', 'Pending', '2001-02-02', '22', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region IV-A (CALABARZON)', 'Cavite', 'Mendez (Mendez-nuñez)', 'Asis II', 'Leona', '', 'Gonzales', '09182455347', 'Luke', '', 'Gonzales', '09182455347', 'Luke', '', 'Gonzales', '09182455347', '2023-11-15', NULL, NULL, NULL),
(118, '2020-2021', '701934562901', '10', 'Ruby', 'Regular', 'Danielle', '', 'Tan', 'Pending', '2001-02-02', '22', 'Baliuag Bulacan', 'Filipino', 'Female', 'Region XII (SOCCSKSARGEN)', 'South Cotabato', 'Tantangan', 'Poblacion', 'Denise', '', 'Tan', '09182455347', 'Derick', '', 'Tan', '09182455347', 'Derick', '', 'Tan', '09182455347', '2023-11-15', NULL, NULL, NULL),
(119, '2020-2021', '701934562902', '10', 'Ruby', 'Regular', 'Felix', '', 'Cruz', 'Pending', '2000-02-02', '23', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'Sultan Kudarat', 'Palimbang', 'Libua', 'Felicity', '', 'Cruz', '09182455347', 'Fernando', '', 'Cruz', '09182455347', 'Fernando', '', 'Cruz', '09182455347', '2023-11-15', NULL, NULL, NULL),
(120, '2020-2021', '701934562903', '10', 'Ruby', 'Completer', 'Denise', '', 'Reyes', 'Finished', '2003-03-02', '20', 'Marilao Bulacan', 'Filipino', 'Male', 'Region X (Northern Mindanao)', 'Camiguin', 'Catarman', 'Manduao', 'Donna', '', 'Reyes', '09182455347', 'Denver', '', 'Reyes', '09182455347', 'Donna', '', 'Reyes', '09182455347', '2023-11-15', NULL, NULL, NULL),
(121, '2020-2021', '701934562904', '10', 'Ruby', 'Completer', 'Marco', '', 'Alonzo', 'Finished', '2000-03-02', '23', 'Baliuag Bulacan', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Pampanga', 'San Simon', 'San Agustin', 'Maria', '', 'Alonzo', '09182455347', 'Marlon', '', 'Alonzo', '09182455347', 'Maria', '', 'Alonzo', '09182455347', '2023-11-15', NULL, NULL, NULL),
(122, '2021-2022', '337871329097', '10', 'Diamond', 'Transferee', 'Rafael', '', 'Gomez', 'Pending', '2005-10-02', '18', 'Baao Apayao', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Santa Ana', 'Barangay 818-A', 'Lindsay Anita', '', 'Gomez', '09585049310', 'Yaneisy Jamya', '', 'Gomez', '09342678355', 'Desirae Faustina', '', 'Cabrales', '09403113566', '2023-11-15', '9', '2013-2014', 'Garden Grove High School'),
(123, '2021-2022', '336349770822', '10', 'Ruby', 'Transferee', 'Arvie', '', 'Pabilona', 'Pending', '2001-09-10', '22', 'Poblacion Manila', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Science City Of Muñoz', 'Maragol', 'Aubrie Eldora', '', 'Pabilona', '09135721150', 'Juan Fabian Jaquan', '', 'Pabilona', '09393443913', 'Mikayla', '', 'Pabilona', '09742091427', '2023-11-15', '9', '2014-2015', 'Cornerstone Academy'),
(124, '2021-2022', '337919230267', '10', 'Ruby', 'Transferee', 'Rhomar', '', 'Anguac', 'Pending', '1999-09-04', '24', 'Montevista Isabela', 'Filipino', 'Male', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Tublay', 'Ambongdolan', 'Bonifaco Kellen', '', 'Anguac', '09378630090', 'Jerico', '', 'Anguac', '09637425255', 'Mohammad Jovan Julian', '', 'Agbayani', '09774103553', '2023-11-15', '9', '2012-2013', 'Coral Springs Middle School'),
(126, '2021-2022', '336630705002', '10', 'Diamond', 'Transferee', 'April Micah', '', 'Dilag', 'Pending', '2005-09-02', '18', 'Poblacion Antipolo Rizal', 'Filipino', 'Female', 'Region X (Northern Mindanao)', 'Bukidnon', 'Sumilao', 'Culasi', 'Arcelia Ivette', '', 'Dilag', '09878149488', 'Darion Dion', '', 'Dilag', '09378440835', 'Aleah Ayana', '', 'Opulencia', '09721716083', '2023-11-15', '9', '2016-2017', 'Evergreen School for Girls'),
(127, '2021-2022', '335134890051', '10', 'Ruby', 'Transferee', 'Sterling Donovan', '', 'Sullano', 'Pending', '2006-09-20', '17', 'Bago Capiz', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Ungkaya Pukan', 'Ulitan', 'Curtis Cosalan', '', 'Sullano', '09518818610', 'Chase Chris', '', 'Sullano', '09691861147', 'Gorane Jeff Sean', '', 'Panaligan', '09045539306', '2023-11-15', '9', '2017-2018', 'Angelwood Middle School'),
(131, '2021-2022', '331439605923', '10', 'Diamond', 'Transferee', 'Braxton Harrison', '', 'Dimson', 'Pending', '2009-02-06', '14', 'Jones Agusan del Sur', 'Filipino', 'Male', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Norte', 'Sibutad', 'Delapa', 'Alex', '', 'Dimson', '09588082675', 'Donovan Dane', '', 'Dimson', '09769767551', 'Donovan Dane', '', 'Dimson', '09769767551', '2023-11-15', '9', '2011-2012', 'Central Valley Charter School'),
(132, '2021-2022', '330453370944', '10', 'Ruby', 'Transferee', 'Hallie', '', 'Capili', 'Pending', '2004-08-17', '19', 'Poblacion Sorsogon City Nueva Ecija', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Occidental Mindoro', 'Looc', 'Bonbon (Pob.)', 'Paige', '', 'Capili', '09576728918', 'Sinclair', '', 'Capili', '09618686798', 'Dianna', '', 'Abdul', '09399242976', '2023-11-15', '9', '2010-2011', 'Spring Gardens Institute'),
(133, '2021-2022', '335829532170', '10', 'Ruby', 'Transferee', 'Leira', '', 'Bristol', 'Pending', '2005-04-07', '18', 'Lumban Davao del Sur', 'Filipino', 'Female', 'Region X (Northern Mindanao)', 'Bukidnon', 'Quezon', 'Minsamongan', 'Piper', '', 'Bristol', '09332317585', 'Salem', '', 'Bristol', '09292556045', 'Izazkun', '', 'Filipa', '09246706222', '2023-11-15', '9', '2012-2013', 'Bulacan College Of Commerce And Trade'),
(134, '2021-2022', '330012141275', '10', 'Diamond', 'Transferee', 'Tristen', '', 'Acosta', 'Pending', '2007-01-23', '16', 'San Pablo Bulacan', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Abulug', 'Banguian', 'Peyton', '', 'Acosta', '09540176527', 'Ian Silas', '', 'Acosta', '09519338514', 'Layne Joe', '', 'Mallari', '09131801886', '2023-11-15', '9', '2018-2019', 'Canyon View High'),
(135, '2021-2022', '334666862902', '10', 'Ruby', 'Transferee', 'Erika', '', 'Abad', 'Pending', '2004-09-03', '19', 'Buenavista Eastern Samar', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Sibugay', 'Titay', 'Poblacion (Titay)', 'Natalia Margaret', '', 'Abad', '09224955613', 'Devera Raven', '', 'Abad', '09691220119', 'Arielle Anabel', '', 'Macodi', '09701996143', '2023-11-15', '9', '2019-2020', 'Vista Middle School'),
(136, '2021-2022', '333873557024', '10', 'Diamond', 'Transferee', 'Esperanza', '', 'Pichicoy', 'Pending', '2001-01-15', '22', 'Masbate City Oriental Mindoro', 'Filipino', 'Female', 'Region XIII (Caraga)', 'Agusan Del Norte', 'Tubay', 'Victory', 'Ashley Brenna', '', 'Pichicoy', '09351145610', 'Jacey Joaquin', '', 'Pichicoy', '09815746710', 'Hanna Garabine', '', 'Calaguas', '09636768228', '2023-11-15', '9', '2020-2021', 'Bilgewater Secondary School'),
(137, '2021-2022', '337445632421', '10', 'Diamond', 'Transferee', 'Nestor', '', 'Sarmiento', 'Pending', '2005-01-02', '18', 'Bani Northern Samar', 'Filipino', 'Male', 'Cordillera Administrative Region (CAR)', 'Benguet', 'Tuba', 'Twin Peaks', 'Montes Felician', '', 'Sarmiento', '09487120388', 'Estefan Victoro Miles', '', 'Sarmiento', '09182828080', 'Barto Mauro', '', 'Dimayuga', '09749731686', '2023-11-15', '9', '2015-2016', 'Spring Gardens Technical School'),
(138, '2021-2022', '202132546589', '10', 'Diamond', 'Regular', 'Aira', '', 'Lapira', 'Pending', '2006-02-21', '17', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Calantipay', 'Dianne', '', 'Lapira', '09666678452', 'Christoper', '', 'Lapira', '09546578452', 'Dianne', '', 'Lapira', '09666678452', '2023-11-15', NULL, NULL, NULL),
(139, '2021-2022', '205412325697', '10', 'Diamond', 'Regular', 'Margaret', '', 'David', 'Pending', '2004-07-09', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bataan', 'City Of Balanga (Capital)', 'Bagumbayan', 'Laura', '', 'David', '09125465784', 'Victorino', '', 'David', '09324556871', 'Victorino', '', 'David', '09324556871', '2023-11-15', NULL, NULL, NULL),
(140, '2021-2022', '206512458923', '10', 'Diamond', 'Regular', 'Joshua', '', 'Joson', 'Pending', '2005-10-11', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'San Pedro', 'Magenta', '', 'Joson', '09546589123', 'Jose', '', 'Joson', '09568745123', 'Jose', '', 'Joson', '09568745123', '2023-11-15', NULL, NULL, NULL),
(141, '2021-2022', '206587451298', '10', 'Diamond', 'Regular', 'Rudolpo', '', 'Limpo', 'Pending', '2006-07-03', '17', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Baliuag', 'Concepcion', 'Mylene', '', 'Limpo', '09988745651', 'Appol', '', 'Limpo', '09232165987', 'Appol', '', 'Limpo', '09232165987', '2023-11-15', NULL, NULL, NULL),
(142, '2021-2022', '201623498756', '10', 'Diamond', 'Regular', 'Joshia', '', 'Decera', 'Pending', '2005-07-20', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bulacan', 'Balubad', 'Margaret', '', 'Decera', '09356194872', 'Joshua', '', 'Decera', '09356194777', 'Joshua', '', 'Decera', '09356194777', '2023-11-15', NULL, NULL, NULL),
(143, '2021-2022', '206531649798', '10', 'Diamond', 'Regular', 'Angelica', '', 'Vetaloso', 'Pending', '2005-02-11', '18', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Calumpit', 'Calumpang', 'Susan', '', 'Vetaloso', '09326512546', 'Karding', '', 'Vetaloso', '09333654982', 'Karding', '', 'Vetaloso', '09333654982', '2023-11-15', NULL, NULL, NULL),
(144, '2021-2022', '204697465933', '10', 'Diamond', 'Regular', 'Marcos', '', 'Arroyo', 'Pending', '2008-09-17', '15', 'Plaridel', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Plaridel', 'Parulan', 'Janine', '', 'Arroyo', '09316497645', 'Jose', '', 'Arroyo', '09316497111', 'Jose', '', 'Arroyo', '09316497111', '2023-11-15', NULL, NULL, NULL),
(145, '2021-2022', '144909681411', '10', 'Diamond', 'Regular', 'Carolina', 'Magpantay', 'Marin', 'Pending', '2004-09-24', '19', 'Davao del Norte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Oriental Mindoro', 'Bulalacao (San Pedro)', 'Cabugao', 'Josie Paloma', 'Magpantay', 'Marin', '09105834678', 'Augustus Ernesto', 'Javion', 'Marin', '09085775213', 'Carmelita Maci', 'Tsukada', 'Bustamante', '09757600335', '2023-11-15', NULL, NULL, NULL),
(146, '2021-2022', '149377052375', '10', 'Diamond', 'Regular', 'Marcos', 'Carrasco', 'Romero', 'Pending', '2004-04-26', '19', 'Southern Leyte', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Tarlac', 'San Manuel', 'Mangandingay', 'Antonia Sydnie', 'Carrasco', 'Romero', '09760007859', 'Maricel Lazaro', 'Villegas', 'Romero', '09045037514', 'Precious Aracely', 'Suzuki', 'Malano', '09092902765', '2023-11-15', NULL, NULL, NULL),
(147, '2021-2022', '141666472864', '10', 'Diamond', 'Regular', 'Rosario', 'Blanco', 'Fajardo', 'Pending', '2007-07-27', '16', 'Kidapawan Leyte', 'Filipino', 'Female', 'Region IV-B (MIMAROPA)', 'Romblon', 'San Fernando', 'Campalingo', 'Yoana Jazmyne', 'Blanco', 'Fajardo', '09658070306', 'Alexandrea Olan', 'Manalastas', 'Fajardo', '09806982583', 'Ayla Madelyn', 'Dinlayan', 'Liwanag', '09311289130', '2023-11-15', NULL, NULL, NULL),
(148, '2021-2022', '203549871649', '10', 'Diamond', 'Regular', 'Alice', '', 'Alusyon', 'Pending', '2004-08-17', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Angat', 'Banaban', 'Alice Marie', '', 'Alusyon', '09653164975', 'Bernard', '', 'Alusyon', '09322346975', 'Bernard', '', 'Alusyon', '09322346975', '2023-11-15', NULL, NULL, NULL),
(149, '2021-2022', '203890463197', '10', 'Diamond', 'Regular', 'Alyssa', '', 'Mora', 'Pending', '2004-11-01', '19', 'Malolos', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Bulacan', 'Bocaue', 'Bolacan', 'Alice', '', 'Mora', '09169487325', 'Kenneth', '', 'Mora', '09322346975', 'Kenneth', '', 'Mora', '09322346975', '2023-11-15', NULL, NULL, NULL),
(150, '2021-2022', '202023546598', '10', 'Diamond', 'Regular', 'Ceejay', '', 'Bulaong', 'Pending', '2007-06-06', '16', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Catacte', 'Jane', '', 'Bulaong', '09324694111', 'Domingo', '', 'Bulaong', '09324694648', 'Domingo', '', 'Bulaong', '09324694648', '2023-11-15', NULL, NULL, NULL),
(151, '2021-2022', '206549139755', '10', 'Diamond', 'Regular', 'Archie', '', 'Bulaong', 'Pending', '2003-06-10', '20', 'Malolos City', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Guiguinto', 'Pulong Gubat', 'Marissa', '', 'Bulaong', '09649713445', 'Ozzy', '', 'Bulaong', '09649713558', 'Ozzy', '', 'Bulaong', '09649713558', '2023-11-15', NULL, NULL, NULL),
(152, '2021-2022', '204697136497', '10', 'Diamond', 'Regular', 'Miguel', '', 'Geronimo', 'Pending', '2008-06-10', '15', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Catacte', 'Jeremie', '', 'Geronimo', '09651364975', 'Edward', '', 'Geronimo', '09551364975', 'Edward', '', 'Geronimo', '09551364975', '2023-11-15', NULL, NULL, NULL),
(153, '2021-2022', '206197463154', '10', 'Diamond', 'Regular', 'Ian', '', 'Carlos', 'Pending', '2007-10-10', '16', 'Malolos', 'Filipino', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Bustos', 'Camachilihan', 'Ruby', '', 'Carlos', '09053694135', 'Mark', '', 'Carlos', '09053695798', 'Mark', '', 'Carlos', '09053695798', '2023-11-15', NULL, NULL, NULL),
(154, '2021-2022', '146617070719', '10', 'Diamond', 'Regular', 'Rudolph Red', 'Vermillion', 'Crimson', 'Pending', '2000-12-05', '22', 'Malabon City', 'English', 'Male', 'Region III (Central Luzon)', 'Bulacan', 'Marilao', 'Loma de Gato', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', 'Burgundy Maroon', 'Carmine', 'Crimson', '09054321250', 'Scarlet Magenta', 'Vermillion', 'Crimson', '09757413645', '2023-11-15', NULL, NULL, NULL),
(155, '2021-2022', '145167056497', '10', 'Diamond', 'Regular', 'Althea', 'Farinas', 'Cerilo', 'Pending', '2002-09-10', '21', 'Bagumbayan Caloocan City', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Iloilo', 'Dingle', 'Ilajas', 'Everett Bello', 'Farinas', 'Cerilo', '09084265932', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', 'Alexandre', 'Baldonado', 'Cerilo', '09889131906', '2023-11-15', NULL, NULL, NULL),
(156, '2021-2022', '142971834843', '10', 'Diamond', 'Regular', 'Jeli Ann', 'Odron', 'Oco', 'Pending', '2003-10-07', '20', 'Guiguinto Biliran', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Quezon', 'Atimonan', 'Barangay Zone 2 (Pob.)', 'Eli Ramone', 'Odron', 'Oco', '09581112800', 'Vicente Jacob', 'Pavia', 'Oco', '09131320570', 'Irvin Theodore', 'Saturnin', 'Carrasco', '09623460209', '2023-11-15', NULL, NULL, NULL),
(157, '2021-2022', '140050590175', '10', 'Diamond', 'Regular', 'Gwen Xyren', 'Alabat', 'Amancio', 'Pending', '2001-02-07', '22', 'Zamboanga City Batanes', 'Filipino', 'Female', 'Region VI (Western Visayas)', 'Guimaras', 'Nueva Valencia', 'Canhawan', 'Kellen Jorge', 'Alabat', 'Amancio', '09353582656', 'Xylem', 'Trinidad', 'Amancio', '09509941400', 'Geoffrey', 'Quicho', 'Dungog', '09659748856', '2023-11-15', NULL, NULL, NULL),
(158, '2021-2022', '144472078198', '10', 'Ruby', 'Regular', 'Jillian', 'Escalante', 'Denaque', 'Pending', '2002-08-04', '21', 'Cabuyao Laguna', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Laguna', 'Cabuyao City', 'San Isidro', 'Javen Taylor', 'Escalante', 'Denaque', '09541959511', 'Rayman Jude', 'Alonzo', 'Denaque', '09775943042', 'Malik', 'Elija', 'Cedro', '09594810088', '2023-11-15', NULL, NULL, NULL),
(159, '2021-2022', '140310222376', '10', 'Ruby', 'Regular', 'Erica Mae', 'Quillo', 'Joson', 'Pending', '2002-03-23', '21', 'Nasipit Zambales', 'Filipino', 'Female', 'Region III (Central Luzon)', 'Pampanga', 'City Of San Fernando (Capital)', 'Lourdes', 'Maribel', 'Quillo', 'Joson', '09947465791', 'Rogelio Romano', 'Lontok', 'Joson', '09553919871', 'Caden Aron', 'Naga', 'Marcelo', '09831267231', '2023-11-15', NULL, NULL, NULL),
(160, '2021-2022', '146190521858', '10', 'Ruby', 'Regular', 'Ryla', 'Milante', 'Velarede', 'Pending', '2003-10-09', '20', 'Caloocan City', 'Filipino', 'Female', 'Region IX (Zamboanga Peninzula)', 'Zamboanga Del Sur', 'Tabina', 'Manikaan', 'Rosalie', 'Milante', 'Velarede', '09699093140', 'Roman', 'Anotion', 'Velarede', '09674689069', 'Jadyn Jeremiah', 'Latif', 'Degayo', '09382988158', '2023-11-15', NULL, NULL, NULL),
(161, '2021-2022', '143041770359', '10', 'Ruby', 'Regular', 'Recel Anne', 'San Juan', 'Boromeo', 'Pending', '2003-09-24', '20', 'Isabela Abra', 'Filipino', 'Female', 'Region IV-A (CALABARZON)', 'Batangas', 'Lipa City', 'Bolbok', 'Sia Zacarias', 'San Juan', 'Boromeo', '09298224617', 'Kurt Jaylon', 'Vinzon', 'Boromeo', '09273764933', 'Winston Dexter', 'Eron', 'Pilapil', '09097104367', '2023-11-15', NULL, NULL, NULL),
(162, '2021-2022', '143124798388', '10', 'Ruby', 'Regular', 'Lyka Mae', 'Juele', 'Lopez', 'Pending', '2000-11-07', '23', 'Marilao Bulacan', 'Filipino', 'Female', 'Region I (Ilocos Region)', 'La Union', 'San Juan', 'Guinguinabang', 'Harley', 'Juele', 'Lopez', '09783096111', 'Gavyn Holden', 'Gonzalo', 'Lopez', '09529078511', 'Pascual', 'Saturnin', 'Asuncion', '09748959312', '2023-11-15', NULL, NULL, NULL),
(163, '2021-2022', '144936924356', '10', 'Ruby', 'Regular', 'Seth Patrick', 'Datangel', 'Ancheta', 'Pending', '2003-08-10', '20', 'Guimba Albay', 'English', 'Male', 'Region III (Central Luzon)', 'Nueva Ecija', 'Laur', 'Nauzon', 'Vaughn Louis', 'Datangel', 'Ancheta', '09656968148', 'Dalton Grady', 'Luz', 'Ancheta', '09172554469', 'Hernandez Damario', 'Salapudin', 'Capillo', '09328925094', '2023-11-15', NULL, NULL, NULL),
(164, '2021-2022', '145795227374', '10', 'Ruby', 'Regular', 'Maia Jose', 'Gomez', 'Monton', 'Pending', '2006-02-28', '17', 'Calbayog Apayao', 'Filipino', 'Female', 'National Capital Region (NCR)', 'Ncr, City Of Manila, First District', 'Pandacan', 'Barangay 848', 'Nikhil Gary', 'Gomez', 'Monton', '09552794616', 'Kobe', 'Honoratas', 'Monton', '09014019710', 'Jerrald Brendan', 'Naldo', 'Ello', '09971667398', '2023-11-15', NULL, NULL, NULL),
(165, '2021-2022', '144745485026', '10', 'Ruby', 'Regular', 'Francisco Santana', 'Mitchell', 'Macatangay', 'Pending', '2007-10-18', '16', 'Porac Romblon', 'Filipino', 'Male', 'Region XII (SOCCSKSARGEN)', 'Cotabato (North Cotabato)', 'Antipas', 'New Pontevedra', 'Brycen Syjuco', 'Mitchell', 'Macatangay', '09544121906', 'Owen Jovany', 'Walker', 'Macatangay', '09109212516', 'Deonte Braden', 'Alexandre', 'Galvez', '09763538272', '2023-11-15', NULL, NULL, NULL),
(166, '2021-2022', '146588191597', '10', 'Ruby', 'Regular', 'Sergio Moya', 'Subrabas', 'Andal', 'Pending', '2001-10-10', '22', 'Titay Biliran', 'Filipino', 'Male', 'Region II (Cagayan Valley)', 'Cagayan', 'Pamplona', 'Tabba', 'Carlee Teagan', 'Subrabas', 'Andal', '09596173844', 'Grady Austin', 'Palad', 'Andal', '09074366626', 'Caitlyn Emmeline', 'Suico', 'Magsakay', '09519160781', '2023-11-15', NULL, NULL, NULL),
(167, '2021-2022', '140801610383', '10', 'Ruby', 'Regular', 'Emilio Campos', 'Dy', 'Cachuela', 'Pending', '2010-01-13', '13', 'Zamboanga del Sur', 'Filipino', 'Male', 'Autonomous Region in Muslim Mindanao (ARMM)', 'Basilan', 'Hadji Muhtamad', 'Tausan', 'Jesenia Layla', 'Dy', 'Cachuela', '09683016576', 'Justin', 'Honorato', 'Cachuela', '09426027509', 'Kendrick Gabriel', 'Simpao', 'Estolas', '09371279050', '2023-11-15', NULL, NULL, NULL),
(168, '2021-2022', '143656107693', '10', 'Ruby', 'Regular', 'Rafael Muoz', 'Will', 'Cruz', 'Pending', '2010-02-25', '13', 'Palayan Dinagat Islands', 'Filipino', 'Male', 'National Capital Region (NCR)', 'City Of Manila', 'Paco', 'Barangay 685', 'Fraco Suelita', 'Will', 'Cruz', '09651705612', 'Adonis Josias', 'Romano', 'Cruz', '09978499810', 'Xavier Carl', 'Devyn', 'Malano', '09552119489', '2023-11-15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year`) VALUES
(127, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `grade_level` int(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `school_year`, `grade_level`, `section`) VALUES
(384, '2019-2020', 7, 'Rizal'),
(385, '2019-2020', 7, 'Mabini'),
(386, '2019-2020', 8, 'Sampaguita'),
(387, '2019-2020', 8, 'Sunflower'),
(388, '2019-2020', 9, 'Apitong'),
(389, '2019-2020', 9, 'Acacia'),
(390, '2019-2020', 10, 'Diamond'),
(391, '2019-2020', 10, 'Ruby');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `balik_aral_status` varchar(255) NOT NULL DEFAULT 'Regular',
  `student_fname` varchar(255) NOT NULL,
  `student_mname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `grade_section` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `mother_tongue` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `father_fname` varchar(255) NOT NULL,
  `father_mname` varchar(255) NOT NULL,
  `father_lname` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `mother_fname` varchar(255) NOT NULL,
  `mother_mname` varchar(255) NOT NULL,
  `mother_lname` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `guardian_fname` varchar(255) NOT NULL,
  `guardian_mname` varchar(255) NOT NULL,
  `guardian_lname` varchar(255) NOT NULL,
  `guardian_number` varchar(255) NOT NULL,
  `last_school_data` varchar(255) DEFAULT NULL,
  `last_sy_completed_data` varchar(255) DEFAULT NULL,
  `last_level_completed_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `school_year`, `balik_aral_status`, `student_fname`, `student_mname`, `student_lname`, `grade_section`, `lrn`, `mother_tongue`, `birth_place`, `bday`, `gender`, `house_no`, `street_name`, `barangay`, `municipality`, `province`, `country`, `zip_code`, `father_fname`, `father_mname`, `father_lname`, `father_number`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_number`, `guardian_fname`, `guardian_mname`, `guardian_lname`, `guardian_number`, `last_school_data`, `last_sy_completed_data`, `last_level_completed_data`) VALUES
(90, 'SID-338840', '2020-2021', 'Transferee', 'Chester', 'P', 'Bennington', '8 Mabait', '1241', 'test', 'test', '2023-08-05', 'female', '124', '124', 'test', 'test', 'test', 'test', '51235', 'test', 'test', 'test', '151', 'test', 'test', 'test', '15135', 'test', 'test', 'test', '5135', 'test', 'test', 'test'),
(95, 'SID-900043', '2019-2020', 'Regular', 'Kobe', 'B', 'Bryant', '10 Papaya', '1241241', 'English', 'Looban', '2020-01-27', 'male', '12', '12', 'Mamba', 'Los Angeles', 'Los Angeles', 'Ewan', '1001', 'Kong', 'B', 'Bryant', '124124142', 'Vanessa', 'B', 'Bryant', '1531351', 'Pau', 'S', 'Gasol', '151352151', 'NO DATA', 'NO DATA', 'NO DATA'),
(96, 'SID-832638', '2020-2021', 'Regular', 'Corey', 'K', 'Taylor', '8 Mabait', '52362', 'English', 'United States', '2023-08-05', 'male', '123', '123', 'looban', 'test', 'test', 'test', '123', 'test', 'test', 'test', '123', 'test', 'test', 'test', '124', 'test', 'test', 'test', '15331', 'NO DATA', 'NO DATA', 'NO DATA'),
(101, 'SID-790413', '2020-2021', 'Transferee', 'TESTING', 'TESTINGS', 'TESTING', '8 Mabait', '52352', 'test', 'test', '2023-08-08', 'female', '12', '12', 'test', 'test', 'test', 'test', '124', 'test', 'test', 'test', '124', 'test', 'test', 'test', '124', 'test', 'test', 'test', '54135', 'test', 'test', 'test'),
(109, 'SID-335591', '2019-2020', 'Regular', 'Marvin', 'T', 'Lim', '10 Papaya', '1235', 'Filipino', 'Bulacan', '2001-06-28', 'male', '13', '13', 'Tibag', 'Pulilan', 'Bulacan', 'Philippines', '3005', 'Ivan', 'S', 'Lim', '09182455347', 'Myrna', 'T', 'Lim', '09182455347', 'Jesus', 'T', 'Christ', '09182455347', 'NO DATA', 'NO DATA', 'NO DATA'),
(118, 'SID-649729', '2019-2020', 'Regular', 'Justin', '', 'Brownlee', '10 Papaya', '52352', 'fawfa', 'awfwafa', '2023-08-31', 'male', '1241', '1241', 'asfas', 'asfa', 'afsa', 'fasfa', '2134', 'afa', 'f', 'afa', '2141', 'asfa', 'asfa', 'afsa', '1241', 'afawf', 'asf', 'asf', '2412', 'NO DATA', 'NO DATA', 'NO DATA'),
(119, 'SID-695637', '2020-2021', 'Regular', 'Fname', 'M', 'Lname', '9 Sunflower', '241', 'qwe', 'qwe', '2023-09-02', 'female', '1241', '1241', 'aqfw', 'af', 'saf', 'wrqr', '124', 'asf', 'wfa', 'wfasf', '321', 'asf', 'wf', 'wafasf', '123', 'fwafas', '', 'asfa', '24124', 'NO DATA', 'NO DATA', 'NO DATA'),
(120, 'SID-959294', '2019-2020', 'Transferee', 'a', 'a', 'a', '10 Papaya', '124', 'zxc', 'zxc', '2023-09-02', 'male', '2', '2', 'zxc', 'zxc', 'zxc', 'zxc', '45254', 'zxc', 'zxc', 'zxc', '2462', 'zxc', 'zxc', 'zxc', '35253', 'zxc', 'zxc', 'zxc', '322', 'AFW', 'AF', 'ASFAW'),
(122, 'SID-797889', '2019-2020', 'Regular', 'Enrl', 'Enrl', 'Enrl', '10 Papaya', '123', 'teacherEnrll', 'teacherEnrll', '2023-09-29', 'female', '235', '235', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '12341', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '124', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '2413451', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '5135', 'NO DATA', 'NO DATA', 'NO DATA'),
(123, 'SID-990613', '2020-2021', 'Transferee', 'wqreqwr', '', 'wqreqwr', '9 Sunflower', '123', 'teacherEnrll', 'teacherEnrll', '2023-09-29', 'female', '235', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '12341', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '124', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '2413451', 'teacherEnrll', 'teacherEnrll', 'teacherEnrll', '5135', 'wqreqwr', 'wqreqwr', 'wqreqwr'),
(125, 'SID-917684', '2020-2021', 'Transferee', 'MARVZ', 'SAMPLE', 'ASD', '8 Mabait', '241', 'SAMPLE', 'SAMPLE', '2023-08-09', 'male', '124', '124', 'SAMPLE', 'SAMPLE', 'SAMPLE', 'SAMPLE', '5235', 'SAMPLE', 'SAMPLE', 'SAMPLE', '2352', 'SAMPLE', 'SAMPLE', 'SAMPLE', '1531', 'SAMPLE', 'SAMPLE', 'SAMPLE', '4234', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `school_year`, `subject_name`) VALUES
(60, '2019-2020', 'Filipino'),
(61, '2019-2020', 'English'),
(62, '2019-2020', 'Mathematics'),
(63, '2019-2020', 'Science'),
(64, '2019-2020', 'Araling Panlipunan'),
(65, '2019-2020', 'Edukasyon sa Pagpapakatao'),
(66, '2019-2020', 'MAPEH'),
(67, '2019-2020', 'Technology and Livelihood Education');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `school_year`, `teacher_id`, `first_name`, `last_name`, `contact_number`) VALUES
(39, '2019-2020', 'TCH-196935', 'Jose ', 'Manalo', '0912345678'),
(40, '2020-2021', 'TCH-530150', 'Juan', 'Tamad', '9123456780'),
(42, '2019-2020', 'TCH-154745', 'Jordan', 'Maykel', '1241242342'),
(44, '', 'TCH-565319', 'adaw', 'dwadqw', ''),
(45, '', 'TCH-472584', 'adaw', 'dwadqw', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_acc`
--

CREATE TABLE `teacher_acc` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` varchar(255) NOT NULL DEFAULT 'new',
  `teacher_status` varchar(255) NOT NULL DEFAULT 'Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_acc`
--

INSERT INTO `teacher_acc` (`id`, `emp_id`, `teacher_id`, `first_name`, `last_name`, `middle_name`, `password`, `account_status`, `teacher_status`) VALUES
(69, 'EmployeeID-69', 'TCH-111887', 'Rudolph', 'Torno', '', 'teacher123', 'new', 'Enable'),
(70, 'EmployeeID-70', 'TCH-886493', 'Angela', 'Ocampo', '', 'teacher123', 'new', 'Enable'),
(71, 'EmployeeID-71', 'TCH-665774', 'Miko', 'Tagarino', '', 'teacher123', 'new', 'Enable'),
(72, 'EmployeeID-72', 'TCH-324299', 'Marvin', 'Lim', '', 'Marvin123lim', 'old', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_schedule`
--

CREATE TABLE `teacher_schedule` (
  `id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `day` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_schedule`
--

INSERT INTO `teacher_schedule` (`id`, `school_year`, `teacher_id`, `teacher_name`, `day`, `subject`, `section`, `start_time`, `end_time`) VALUES
(439, '2019-2020', 'TCH-111887', NULL, 'Monday', 'Filipino', '7 Rizal', '07:00:00', '08:00:00'),
(440, '2019-2020', 'TCH-111887', NULL, 'Monday', 'English', '7 Rizal', '11:00:00', '12:00:00'),
(441, '2019-2020', 'TCH-111887', NULL, 'Monday', 'Science', '7 Rizal', '13:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `test_table`
--

CREATE TABLE `test_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_table`
--

INSERT INTO `test_table` (`id`, `name`, `gender`, `image`, `product`, `sales`) VALUES
(64, '', '', '', 'noodles', '100'),
(66, '', '', '', 'pancit', '300'),
(67, '', '', '', 'delata', '600');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment_status`
--
ALTER TABLE `enrollment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_eight`
--
ALTER TABLE `grade_eight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_nine`
--
ALTER TABLE `grade_nine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_seven`
--
ALTER TABLE `grade_seven`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_ten`
--
ALTER TABLE `grade_ten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_table`
--
ALTER TABLE `test_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `enrollment_status`
--
ALTER TABLE `enrollment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade_eight`
--
ALTER TABLE `grade_eight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `grade_nine`
--
ALTER TABLE `grade_nine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `grade_seven`
--
ALTER TABLE `grade_seven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `grade_ten`
--
ALTER TABLE `grade_ten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `test_table`
--
ALTER TABLE `test_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
