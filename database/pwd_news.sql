-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2023 at 05:09 PM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwd_news`
--
CREATE DATABASE IF NOT EXISTS `pwd_news` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pwd_news`;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(1, 'Supreme Court Dismisses Case on Title 42', 'The justices acted after the Biden administration announced that the health emergency used to justify the measure, Title 42, was ending.', '');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(2, 'Miley Cyrus wants you to know her album &#039;Endless Summer Vacation&#039; is not all about Liam Hemsworth', 'Miley Cyrusâ€™s 2023 single â€œFlowersâ€ â€“ a track off her latest album â€œEndless Summer Vacationâ€ â€“ became the fastest song to cross one billion streams on Spotify in May following its January release.', 'https://media.cnn.com/api/v1/images/stellar/prod/230518152731-miley-cyrus-0309.jpg?c=16x9&amp;q=w_800,c_fill');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(3, 'FDA advisers vote in support of new RSV vaccine to protect newborns', 'The US Food and Drug Administrationâ€™s independent vaccine advisers voted Thursday in favor of recommending approval of a new vaccine to protect infants from respiratory syncytial virus, known as RSV.', 'https://media.cnn.com/api/v1/images/stellar/prod/230517171742-03-pregnant-woman-stock.jpg?c=16x9&amp;q=w_800,c_fill');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(4, 'Indiana Jones 5 Stuns Cannes With Standing Ovation for Harrison Ford', 'Harrison Ford said goodbye to Indiana Jones at the Cannes Film Festival, where &quot;Dial of Destiny&quot; made its long-awaited world premiere.', 'https://variety.com/wp-content/uploads/2023/05/GettyImages-1491334970-e1684440060929.jpg?w=1000&amp;h=563&amp;crop=1');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(5, 'OpenAI launches a free ChatGPT app for iOS', 'OpenAI is making it even easier for many to access ChatGPT.', 'https://media.cnn.com/api/v1/images/stellar/prod/230518155631-chatgpt-phone-restricted.jpg?c=16x9&amp;q=w_800,c_fill');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(6, 'Komisi II DPR Setujui RPKPU soal Kampanye hingga Perbawaslu Pengawasan Caleg', 'Komisi II DPR RI menyetujui 3 Rancangan Peraturan Komisi Pemilihan Umum (PKPU) dan Rancangan Peraturan Bawaslu (Perbawaslu). Kesepakatan tersebut diambil saat rapat dengar pendapat dengan Kemendagri, KPU, Bawaslu hingga DKPP.', 'https://akcdn.detik.net.id/community/media/visual/2023/02/14/ilustrasi-surat-suara-pemilu_169.jpeg?w=700&amp;q=90');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(7, 'Istana Jelaskan Maksud Jokowi Akan Cawe-cawe demi Bangsa dan Negara ', 'Deputi Bidang Protokol, Pers, dan Media Sekretariat Presiden Bey Machmudin menjelaskan maksud pernyataan Presiden Jokowi yang bilang tetap ingin cawe-cawe demi bangsa dan negara. Salah satu maksudnya, Bey menilai Jokowi ingin memastikan pemilu serentak 2024 berjalan aman.', 'https://akcdn.detik.net.id/community/media/visual/2017/01/31/85d6b0ca-c154-414b-a198-62b91ce4debc_169.jpg?w=700&amp;q=90');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(8, 'Setelah Wuling dan Hyundai, Menko Luhut Harap BYD Segera Ramaikan Ekosistem Kendaraan Listrik RI ', 'Menteri Koordinator Bidang Kemaritiman dan Investasi Luhut Binsar Pandjaitan berharap investasi dari produsen mobil listrik asal China Build Your Dreams (BYD) bisa segera direalisasikan. Setelah, nota kesepahaman dengan pabrikan mobil listrik itu ditandatangani.\r\n', 'https://thumb.viva.co.id/media/frontend/thumbs3/2023/05/27/6471c008d2293-menko-marves-luhut-binsar-di-china_1265_711.jpg');
INSERT INTO `news` (`id`, `title`, `content`, `image`) VALUES(9, 'Anas Urbaningrum Jawab Cuitan SBY soal MK: Tidak Elok Bikin Kecemasan dan Kegaduhan', 'Cuitan Presiden RI ke-6 yang juga Ketua Majelis Tinggi Partai Demokrat, Susilo Bambang Yudhoyono, mendapat tanggapan dari eks Ketua Umum Demokrat, Anas Urbaningrum.\r\n', 'https://thumb.viva.co.id/media/frontend/thumbs3/2023/05/22/646ad868ad330-mantan-ketua-umum-partai-demokrat-anas-urbaningrum-berbicara-kepada-wartawan-usa_1265_711.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `publish`
--

DROP TABLE IF EXISTS `publish`;
CREATE TABLE IF NOT EXISTS `publish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`news_id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publish`
--

INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(1, 1, 1, '2025-05-23 01:16:07');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(2, 1, 2, '2025-05-23 01:16:27');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(3, 1, 3, '2025-05-23 01:17:19');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(4, 1, 4, '2025-05-23 01:17:40');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(5, 1, 5, '2025-05-23 01:17:59');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(6, 2, 6, '2029-05-23 10:32:42');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(7, 2, 7, '2029-05-23 10:57:13');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(8, 2, 8, '2029-05-23 10:59:09');
INSERT INTO `publish` (`id`, `user_id`, `news_id`, `date`) VALUES(9, 2, 9, '2029-05-23 11:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES(1, 'admin', 'admin', 'admin');
INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES(2, 'afif', '9271', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `publish`
--
ALTER TABLE `publish`
  ADD CONSTRAINT `publish_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publish_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
