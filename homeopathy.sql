-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 07:37 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homeopathy`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `diseases` text,
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone_number`, `age`, `diseases`, `submission_date`) VALUES
(1, 'Vaishnavi S', 'vaishnavis82002@gmail.com', '09380990815', 25, 'abcd', '2025-04-24 07:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE IF NOT EXISTS `ebooks` (
`id` int(11) NOT NULL,
  `ebook_url` varchar(255) NOT NULL,
  `ebook_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `ebook_url`, `ebook_title`) VALUES
(1, 'https://online.fliphtml5.com/lsjbd/bybk/', 'Homeopathy: Principles and Practice'),
(2, 'https://online.fliphtml5.com/lsjbd/hdqv/', 'The Science of Healthcare Quality'),
(3, 'https://online.fliphtml5.com/lsjbd/poor/', 'Understanding Basic Medical Terminology'),
(4, 'https://online.fliphtml5.com/lsjbd/kodx/', 'Exploring Advanced Medical Concepts'),
(5, 'https://online.fliphtml5.com/ittah/hnnn/', 'The Future of Personalized Medicine'),
(6, 'https://online.fliphtml5.com/cvuiu/hhuu/', 'Innovations in Pharmaceutical Research');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `rating`, `comments`, `submission_date`) VALUES
(1, 'v', 'v@gmail.com', 5, 'ok', '2025-04-24 07:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `genmed`
--

CREATE TABLE IF NOT EXISTS `genmed` (
  `Disease` varchar(100) NOT NULL,
  `Medicine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genmed`
--

INSERT INTO `genmed` (`Disease`, `Medicine`) VALUES
('Cold', 'Cetirizine'),
('Wet Cough, Dry Cough', 'Guaifenesin, Chlorpheniramine'),
('Fever', 'Paracetamol'),
('Stomach Pain/Gastralgia', 'Pantoprazole'),
('Loose Motion/Diarrhea', 'Loperamide'),
('Periods Pain', 'Ibuprofen, Paracetamol'),
('Vomiting', 'Ondansetron, Palonosetron'),
('Gastritis', 'Pantoprazole '),
('Hair Loss ', 'Minoxidil(Men)\r\nFinasteride(women)'),
('Ear Pain', 'Acetaminophen, Ibuprofen'),
('Head Ache', 'Acetaminophen, Ibuprofen'),
('Allergy', 'Cetirizine, Fexofenadine\r\n'),
('Asthma', 'Budesonide, Montelukast'),
('Migraine', 'Sumatriptan''s'),
('Anxiety/ Panic Disorder', 'Alprazolam''s'),
('Muscle Pain', 'Ibuprofen, Diclofenac '),
('Arthritis/ Joint Pain', 'Ibuprofen, Methotrexate, Sulfasalazine, Cyclosporine'),
('Wounds', 'Silver Sulfadiazine'),
('Obesity', 'Liraglutide'),
('Sinus ', 'Fluticasone\r\n'),
('Sleeplessness/ Insomnia', 'Amitriptyline'),
('Insect Bite', 'Cetirizine, Fexofenadine'),
('Constipation', 'Lactulose Magnesium hydroxide');

-- --------------------------------------------------------

--
-- Table structure for table `health_data`
--

CREATE TABLE IF NOT EXISTS `health_data` (
`id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `drank_water` tinyint(1) DEFAULT NULL,
  `had_breakfast` tinyint(1) DEFAULT NULL,
  `took_exercise` tinyint(1) DEFAULT NULL,
  `went_offline` tinyint(1) DEFAULT NULL,
  `got_sleep` tinyint(1) DEFAULT NULL,
  `spent_time_loved_ones` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_data`
--

INSERT INTO `health_data` (`id`, `entry_date`, `drank_water`, `had_breakfast`, `took_exercise`, `went_offline`, `got_sleep`, `spent_time_loved_ones`) VALUES
(1, '2025-04-18', 1, 0, 0, 1, 0, 0),
(2, '2025-04-21', 1, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `health_videos`
--

CREATE TABLE IF NOT EXISTS `health_videos` (
`id` int(11) NOT NULL,
  `video_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_videos`
--

INSERT INTO `health_videos` (`id`, `video_url`) VALUES
(1, 'https://www.youtube.com/embed/Y8HIFRPU6pM?si=iilKfv4a4ISpfBVp'),
(2, 'https://www.youtube.com/embed/E3QpXj_QOqQ?si=z29kCY7fr8GYSrmg'),
(3, 'https://www.youtube.com/embed/c06dTj0v0sM?si=NstbgmIcq6NRogPk'),
(4, 'https://www.youtube.com/embed/MIc299Flibs?si=lFp3V8eUgAqUKum0'),
(5, 'https://www.youtube.com/embed/xNoanoQ5syY?si=akdS2-2uK4KGoD5E'),
(6, 'https://www.youtube.com/embed/n2CCReA6v4E?si=7xb4qBPUlh8V8u_r'),
(7, 'https://www.youtube.com/embed/AhdFpWBeJSQ?si=TeNz9NsFpaCoujgS'),
(8, 'https://www.youtube.com/embed/Dppq4d1ykOg?si=187ict0hB4HOaIel'),
(9, 'https://www.youtube.com/embed/gjYVS8m91UU?si=HrJOy1nbSicYLmdS');

-- --------------------------------------------------------

--
-- Table structure for table `homeo_sugg`
--

CREATE TABLE IF NOT EXISTS `homeo_sugg` (
  `Disease` varchar(100) NOT NULL,
  `Medicine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeo_sugg`
--

INSERT INTO `homeo_sugg` (`Disease`, `Medicine`) VALUES
('Cold', 'Arsenicum Album,Allium Cepa,Dulca Mara'),
('Cough', 'Dry Cough - Drosera,Rumen,Sticta\r\nProductive - Pulsatilla,Stannum Met,Kali Bich'),
('Common Fever ', 'Ferrum Phos,Belladonna,Arnica,Aconite'),
('Stomach Pain', 'Colocynth,Mag Phos'),
('Loose Motion', 'Arsenium Album,Podophyllum,Camphora'),
('Period Pain', 'May Phos,Chamomilla'),
('Vomiting', 'Tpecac,Nun Vomica'),
('Gastritis', 'Carbo Veg,Arseniumm Album,Nux Vonica'),
('Hair Loss', 'Rosemarinus,Lycopodium'),
('Ear Pain', 'Merc Sol, Belladonna'),
('Headache', 'Belladonna,Gelsemium,Nat Mug Bryonia'),
('Skin Allergy', 'Urticaria,Apis Mellifica,Rhus Ton'),
('Asthma', 'Kali Carb,Arsenium Album,Bromium'),
('Migrane', 'Glonine,Belladonna,Nat Mur'),
('Anxiety/Stress', 'Arsenium Album,Calcarea Carb,Ignatia Aconite'),
('Muscle Strain', 'Ruta,Rhustox,Rhododendron'),
('Arthritis/Joint Pain', 'Rhus Tox,Bryonia,Ruta'),
('Wounds', 'Calendula,Arnica,Hyperium'),
('Weight Management/Obesity', 'Phytolacca Berry Calcorea Carb'),
('Sinus', 'Dulca Mara,Gelsemium'),
('Sleeplessness', 'Opium,Gelsemium'),
('Insect Bites', 'Ledum Pal, Apis Nelifica'),
('Thyroid', 'Thyproidinum,Bromium,Iodium'),
('Diabetes/ Sugar', 'Syzigium,Gymnema S,Helonias'),
('BP', 'Glonine,Aconite,Spartein Sulph');

-- --------------------------------------------------------

--
-- Table structure for table `l_page`
--

CREATE TABLE IF NOT EXISTS `l_page` (
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`id` int(11) NOT NULL,
  `question` text,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `question_key` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `question_key`) VALUES
(1, 'What is the recommended daily intake of water for an average adult?', '1-2 litres', '2-3 litres', '3-4 litres', '4-5 litres', '2-3 litres', 'q1'),
(2, 'Which vitamin is primarily obtained through sunlight exposure?', 'Vitamin C', 'Vitamin A', 'Vitamin D', 'Vitamin K', 'Vitamin D', 'q2'),
(3, 'Which of these exercises is best for improving cardiovascular health?', 'Weightlifting', 'Yoga', 'Running', 'Pilates', 'Running', 'q3'),
(4, 'What is a common symptom of dehydration?', 'Sweating', 'Dizziness', 'Increased energy', 'Sneezing', 'Dizziness', 'q4'),
(5, 'Which macronutrient is the primary source of energy for the body?', 'Protein', 'Carbohydrates', 'Fats', 'Fiber', 'Carbohydrates', 'q5'),
(6, 'What is the normal range of blood pressure for a healthy adult?', '80/50 mmHg', '90/60 mmHg', '120/80 mmHg', '140/90 mmHg', '120/80 mmHg', 'q6'),
(7, 'Which of the following foods is rich in antioxidants?', 'Rice', 'Chicken', 'Blueberries', 'Potatoes', 'Blueberries', 'q7'),
(8, 'What is the role of probiotics in the digestive system?', 'Provide energy', 'Breakdown carbohydrates', 'Absorb minerals', 'Support gut health', 'Support gut health', 'q8'),
(9, 'Which mineral is essential for strong bones and teeth?', 'Iron', 'Sodium', 'Calcium', 'Potassium', 'Calcium', 'q9'),
(10, 'What is the function of dietary fiber in the body?', 'Build muscle', 'Improve digestion', 'Provide energy', 'Strengthen bones', 'Improve digestion', 'q10');

-- --------------------------------------------------------

--
-- Table structure for table `questions2`
--

CREATE TABLE IF NOT EXISTS `questions2` (
`id` int(11) NOT NULL,
  `question` text,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `question_key` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions2`
--

INSERT INTO `questions2` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `question_key`) VALUES
(1, 'What is the primary purpose of generic medicines?', 'To offer alternative brand-name products', 'To provide the same efficacy as brand-name drugs at lower costs', 'To introduce new drug formulations', 'To avoid FDA regulations', 'To provide the same efficacy as brand-name drugs at lower costs', 'q1'),
(2, 'What must generic drugs have in common with their brand-name counterparts?', 'Different active ingredients', 'Lower manufacturing standards', 'Same active ingredients, strength, dosage, and effectiveness', 'Higher prices', 'Same active ingredients, strength, dosage, and effectiveness', 'q2'),
(3, 'Which regulatory authority approves generic medicines in India?', 'US FDA', 'WHO', 'CDSCO (Central Drugs Standard Control Organization)', 'EMA', 'CDSCO (Central Drugs Standard Control Organization)', 'q3'),
(4, 'Which of the following is an example of a generic drug for paracetamol?', 'Crocin', 'Panadol', 'Tylenol', 'All of the above', 'All of the above', 'q4'),
(5, 'Why are generic medicines generally cheaper than brand-name drugs?', 'They use lower-quality materials', 'They do not require extensive marketing and R&D', 'They are not patented', 'They are less effective', 'They do not require extensive marketing and R&D', 'q5'),
(6, 'When can a generic version of a brand-name drug be produced legally?', 'Immediately after FDA approval of the original drug', 'After the patent on the brand-name drug expires', 'Once the brand-name drug''s patent protection ends', 'Generic versions are always prohibited', 'Once the brand-name drug''s patent protection ends', 'q6'),
(7, 'What is a characteristic of generic drugs according to the FDA?', 'Different side effects from brand-name drugs', 'Bioequivalence to brand-name drugs', 'Faster action than brand-name drugs', 'Completely new packaging', 'Bioequivalence to brand-name drugs', 'q7'),
(8, 'What does "bioequivalence" mean in the context of generic medicines?', 'The same packaging style', 'Similar blood concentration levels of the drug over time', 'Use of identical excipients', 'Equal manufacturing costs', 'Similar blood concentration levels of the drug over time', 'q8'),
(9, 'Which is a commonly used generic drug for treating bacterial infections?', 'Amoxicillin', 'Crocin', 'Ibuprofen', 'Losartan', 'Amoxicillin', 'q9'),
(10, 'What is the major benefit of generic medicines for patients?', 'Attractive packaging', 'Longer patent periods', 'Affordability and accessibility', 'Increased brand awareness', 'Affordability and accessibility', 'q10');

-- --------------------------------------------------------

--
-- Table structure for table `research_papers`
--

CREATE TABLE IF NOT EXISTS `research_papers` (
`id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `research_papers`
--

INSERT INTO `research_papers` (`id`, `file_name`, `file_path`) VALUES
(1, 'Scientific Evidence for Homeopathy', '“Scientific Evidence for Homeopathy” _ Clinics.pdf'),
(2, 'Assessment of Quality care in Healthcare', '3_Assessment_of_Quality_care_in_the_healthcare_sector_A_Systematic_Review.pdf'),
(3, 'bcp0054-0577', 'bcp0054-0577.pdf'),
(4, 'DI303-370-375-eng', 'DI303-370-375-eng.pdf'),
(5, 'Generic Medicine Manufacturers 2023', 'generic-medicine-manufacturers-2023-analytical-framework_access-to-medicine-foundation-1677661006.pdf'),
(6, 'IQVIA True Value of Generic Medicines', 'iqvia-true-value-of-generic-medicines-04-24-forweb.pdf'),
(7, 'AI for Health and Healthcare', 'jsr-17-task-002_aiforhealthandhealthcare12122017.pdf'),
(8, 'Right to Health and Medicines', 'RP35_Right-to-health-and-medicines_EN.pdf'),
(9, 'sps-homeopathy', 'sps-homeopathy.pdf'),
(10, 'Use of Generic Medicines JHM', 'UseofGenericMedicinesJHM.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `r_page`
--

CREATE TABLE IF NOT EXISTS `r_page` (
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_page`
--

INSERT INTO `r_page` (`Name`, `Email`, `Password`) VALUES
('abcd', 'a@gmail.com', '123456Ul'),
('v', 'v@gmail.com', '123456UL');

-- --------------------------------------------------------

--
-- Table structure for table `sleep_data`
--

CREATE TABLE IF NOT EXISTS `sleep_data` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sleep_time` time NOT NULL,
  `wake_time` time NOT NULL,
  `duration` decimal(4,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sleep_data`
--

INSERT INTO `sleep_data` (`id`, `date`, `sleep_time`, `wake_time`, `duration`) VALUES
(1, '2025-04-08', '22:46:00', '10:46:00', '12.00'),
(2, '2025-04-01', '22:00:00', '11:55:00', '10.08'),
(3, '2025-04-07', '02:58:00', '10:58:00', '8.00'),
(4, '2025-04-06', '01:02:00', '04:02:00', '3.00'),
(5, '2025-04-07', '02:04:00', '09:04:00', '7.00'),
(6, '2025-04-21', '23:18:00', '07:19:00', '15.98');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_data`
--
ALTER TABLE `health_data`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_entry_date` (`entry_date`);

--
-- Indexes for table `health_videos`
--
ALTER TABLE `health_videos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions2`
--
ALTER TABLE `questions2`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `question_key` (`question_key`);

--
-- Indexes for table `research_papers`
--
ALTER TABLE `research_papers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `file_path` (`file_path`);

--
-- Indexes for table `sleep_data`
--
ALTER TABLE `sleep_data`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_data`
--
ALTER TABLE `health_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_videos`
--
ALTER TABLE `health_videos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `questions2`
--
ALTER TABLE `questions2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `research_papers`
--
ALTER TABLE `research_papers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sleep_data`
--
ALTER TABLE `sleep_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
