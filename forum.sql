-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 04:19 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(200) NOT NULL AUTO_INCREMENT,
  `reply_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `fk_like_reply` (`reply_id`),
  KEY `fk_like_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `reply_id`, `user_id`) VALUES
(47, 7, 15),
(49, 6, 15),
(50, 4, 15),
(53, 4, 14),
(54, 8, 16),
(55, 8, 15),
(56, 8, 14),
(58, 10, 14),
(60, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `reply_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `topic_id` int(200) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reply_id`),
  KEY `fk_replies_user` (`user_id`),
  KEY `fk_replies_topic` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`reply_id`, `user_id`, `topic_id`, `content`, `date`) VALUES
(2, 14, 5, 'nhÆ°ng trÃ´ng tháº¥y tÃ´i vÃ  cÃ¡i Ã´', '2018-05-31 17:58:52'),
(4, 14, 5, 'bá»™ dáº¡ng Æ°á»›t lÆ°á»›t thÆ°á»›t tá»« Ä‘áº§u tá»›i chÃ¢n cá»§a', '2018-05-31 17:58:52'),
(6, 16, 17, 'thÆ°Æ¡ng hiá»‡u Apple giÃºp Iphone cÃ³ doanh sá»‘ bÃ¡n hÃ ng vÃ  giá»¯ giÃ¡ lÃ¢u so vá»›i cÃ¡c sáº£n pháº©m cÃ¹ng loáº¡i nhÆ° Samsung, Nokia,... nhá» Ä‘Ã³ thÆ°Æ¡ng hiá»‡u thÃºc Ä‘áº©y viá»‡c má»Ÿ rá»™ng sáº£n xuáº¥t, Ä‘áº§u tÆ° tÄƒng thá»‹ pháº§n cá»§a cÃ´ng ty. => do Ä‘Ã³ cÃ¡c cÃ´ng ty cÃ³ cÃ¡c sáº£n pháº©m má»›i thÆ°á»ng hay ráº§m rá»™ quáº£ng cÃ¡o, khuyáº¿n máº¡i Ä‘á»ƒ kÃ­ch cáº§u tiÃªu dÃ¹ng.', '2018-06-05 22:34:25'),
(7, 16, 16, '-	quáº£ cam trÃ²n khÃ´ng phá»¥ thuá»™c vÃ o sá»± cáº£m nháº­n cá»§a con ngÆ°á»i. NÃ³ vá»‘n dÄ© váº«n trÃ²n. Do Ä‘Ã³ khi má»™t con ngÆ°á»i cÃ³ Ã½ thá»©c cáº£m giÃ¡c Ä‘Æ°á»£c quáº£ cáº£m hÃ¬nh trÃ²n vÃ  pháº£n Ã¡nh vÃ o nÃ£o. Váº­y hÃ¬nh áº£nh trÃ²n táº¡o ra trong nÃ£o sinh ra lÃ  do quáº£ cam quyáº¿t Ä‘á»‹nh ', '2018-06-05 22:43:32'),
(8, 16, 18, 'PhÃ¡t huy tÃ­nh nÄƒng Ä‘á»™ng chá»§ quan: tÃ¬m tÃ²i má»Ÿ rá»™ng tri thá»©c, tá»± giÃ¡c rÃ¨n luyá»‡n, tu dÆ°á»¡ng thÃªm báº£n thÃ¢n vÃ¬ tri thá»©c lÃ  vÃ´ háº¡n, náº¯m báº¯t Ä‘Æ°á»£c lÃ  quÃ¡ trÃ¬nh lÃ¢u dÃ i bá»n bá»‰, khÃ´ng tá»± Ä‘á»™ng tiáº¿p nháº­n thÃ¬ tri thá»©c khÃ³ cÃ³ thá»ƒ trá»Ÿ thÃ nh cá»§a ta vÃ  ta khÃ³ sá»­ dá»¥ng.', '2018-06-06 08:31:52'),
(9, 15, 18, 'Trong báº¥t cá»© váº¥n Ä‘á», lÄ©nh vá»±c gÃ¬ cÅ©ng cáº§n cÃ³ sá»± tÃ¬m hiá»ƒu ká»¹ thá»±c táº¿: vÄƒn há»c: nhÃ  vÄƒn pháº£i Ä‘i cÃ¹ng thá»±c táº¿ má»›i khiáº¿n tÃ¡c pháº©m cá»§a mÃ¬nh khÃ´ng xa báº¡n Ä‘á»c; ngÆ°á»i bÃ¡n hÃ ng pháº£i Ä‘i tÃ¬m hiá»ƒu thá»‹ trÆ°á»ng má»›i cÃ³ thá»ƒ tháº¥y Ä‘Æ°á»£c nhu cáº§u cá»§a nÄƒm nay má»‘t lÃ  gÃ¬, máº«u nÃ o dá»… bÃ¡n thÃ¬ má»›i cÃ³ lÃ£i nhiá»u,... Ä‘áº·c biá»‡t Ä‘á»‘i vá»›i quan chá»©c lÃ£nh Ä‘áº¡o lÃ  ngÆ°á»i Ä‘Æ°a ra cÃ¡c quyáº¿t Ä‘á»‹nh, Ä‘á» ra luáº­t cÃ ng cáº§n thiáº¿t viá»‡c tÃ¬m hiá»ƒu thá»±c táº¿ trong dÃ¢n', '2018-06-06 08:32:24'),
(10, 14, 16, 'PhÃ¡t huy tÃ­nh nÄƒng Ä‘á»™ng chá»§ quan: tÃ¬m tÃ²i má»Ÿ rá»™ng tri thá»©c, tá»± giÃ¡c rÃ¨n luyá»‡n, tu dÆ°á»¡ng thÃªm báº£n thÃ¢n vÃ¬ tri thá»©c lÃ  vÃ´ háº¡n, náº¯m báº¯t Ä‘Æ°á»£c lÃ  quÃ¡ trÃ¬nh lÃ¢u dÃ i bá»n bá»‰, khÃ´ng tá»± Ä‘á»™ng tiáº¿p nháº­n thÃ¬ tri thá»©c khÃ³ cÃ³ thá»ƒ trá»Ÿ thÃ nh cá»§a ta vÃ  ta khÃ³ sá»­ dá»¥ng.', '2018-06-06 08:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `topic_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `level` enum('2nd year students','3rd year students','4th year students') NOT NULL,
  `subject` text NOT NULL,
  `t_content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`),
  KEY `fk_topic1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_id`, `user_id`, `level`, `subject`, `t_content`, `date`) VALUES
(1, 14, '3rd year students', 'fit', 'in fit we retake', '0000-00-00 00:00:00'),
(2, 14, '3rd year students', 'Hai vá»‹ khÃ¡ch cuá»‘i cÃ¹ng rá»i quÃ¡n lÃ ', 'Hai vá»‹ khÃ¡ch cuá»‘i cÃ¹ng rá»i quÃ¡n lÃ  lÃºc trá»i váº«n cÃ²n mÆ°a náº·ng háº¡t. Khi tÃ´i Ä‘Æ°a máº¯t ngÃ³ chiáº¿c Ä‘á»“ng há»“ nhá» treo trÃªn tÆ°á»ng, Ä‘á»“ng há»“ Ä‘Ã£ chá»‰ 10h20', '0000-00-00 00:00:00'),
(5, 14, '2nd year students', 'TÃ´i khÃ´ng máº¥y báº¥t ngá» trÆ°á»›c bá»™ dáº¡ng', 'TÃ´i khÃ´ng máº¥y báº¥t ngá» trÆ°á»›c bá»™ dáº¡ng Æ°á»›t lÆ°á»›t thÆ°á»›t tá»« Ä‘áº§u tá»›i chÃ¢n cá»§a cáº­u ta khi phá»‘ xÃ¡ ngoÃ i kia váº«n Ä‘ang tráº¯ng xÃ³a vÃ¬ cÆ¡n mÆ°a rÃ o báº¥t ngá» vÃ i phÃºt trÆ°á»›c, nhÆ°ng trÃ´ng tháº¥y tÃ´i vÃ  cÃ¡i Ã´ trÃªn tay, cáº­u ta dá»«ng láº¡i, thoÃ¡ng bá»‘i rá»‘i.', '2018-05-26 23:16:31'),
(6, 15, '4th year students', 'Má»i thá»© gáº§n nhÆ° Ä‘á»u Ä‘Ã£ xong xuÃ´i', 'Má»i thá»© gáº§n nhÆ° Ä‘á»u Ä‘Ã£ xong xuÃ´i, chá»‰ cÃ²n láº¡i duy nháº¥t bÆ°á»›c táº¯t Ä‘iá»‡n vÃ  Ä‘Ã³ng cá»­a quÃ¡n, trÆ°á»›c khi cá»­a chÃ­nh báº¥t ngá» Ä‘Æ°á»£c Ä‘áº©y ra', '2018-06-02 12:12:04'),
(9, 15, '2nd year students', 'TÃ´i Ä‘á»ƒ cÃ¡i Ã´ vá» vá»‹ trÃ­ cÅ©', 'TÃ´i khÃ´ng biáº¿t cáº­u ta lÃ m gÃ¬ trong suá»‘t khoáº£ng thá»i gian ngá»“i Ä‘á»£i, nháº¥t lÃ  khi láº¡i cÃ³ má»™t mÃ¬nh nhÆ° váº­y. Chá»‰ biáº¿t sau khi tÃ´i Ä‘Ã£ lÃ m xong Capuchino vÃ  báº¯t Ä‘áº§u bÃª ra, cáº­u ta Ä‘ang chÄƒm chÃº nhÃ¬n ra ngoÃ i cá»­a kÃ­nh, nÆ¡i nhá»¯ng háº¡t mÆ°a Ä‘ang hÃ² nhau trÆ°á»£t dÃ i tá»« trÃªn xuá»‘ng dÆ°á»›i, Ä‘á»§ Ä‘á»ƒ lÃ m nhÃ²e hÃ¬nh áº£nh phá»‘ xÃ¡ ngoÃ i kia.', '2018-06-02 16:29:25'),
(10, 15, '3rd year students', 'NgÃ³ cÃ¡i tháº£m vá»›i chá»¯ â€œWelcomeâ€', 'NgÃ³ cÃ¡i tháº£m vá»›i chá»¯ â€œWelcomeâ€ to bá»± cháº£ng dang mÃ¬nh há»©ng chá»‹u má»i dÃ²ng nÆ°á»›c tá»« káº» Ä‘á»©ng trÃªn nÃ³ Ä‘ang thi nhau tong tá»ng nhá» xuá»‘ng, tÃ´i nhoáº»n cÆ°á»i, vá»™i Ä‘Ã¡p', '2018-06-02 17:56:34'),
(12, 15, '4th year students', 'TÃ´i váº«n thÆ°á»ng nghÄ© vá» DÆ°Æ¡ng', 'TÃ´i váº«n thÆ°á»ng nghÄ© vá» DÆ°Æ¡ng má»—i khi ngá»“i má»™t mÃ¬nh, Ä‘áº·c biá»‡t lÃ  vÃ o nhá»¯ng ngÃ y mÆ°a nhÆ° tháº¿ nÃ y.', '2018-06-02 23:23:35'),
(16, 15, '2nd year students', 'DÆ°Æ¡ng Ä‘Ã£ tá»«ng quan tÃ¢m tÃ´i nhiá»u nhÆ° váº­y', 'DÆ°Æ¡ng Ä‘Ã£ tá»«ng quan tÃ¢m tÃ´i nhiá»u nhÆ° váº­y, tháº­m chÃ­ Ä‘áº¿n hÃ´m nay, DÆ°Æ¡ng váº«n lÃ  chÃ ng trai áº¥m Ã¡p cá»§a ngÃ y áº¥y. LÃºc ra vá», tháº¥y xe tÃ´i Ä‘á»ƒ bÃªn trong khÃ³ láº¥y ra, cháº³ng Ä‘á»£i tÃ´i há»i, cáº­u áº¥y Ä‘Ã£ láº¡i Ä‘á» nghá»‹ giÃºp Ä‘á»¡.', '2018-06-03 15:57:23'),
(17, 16, '2nd year students', 'How to pass IST course? Please help me bros :((', 'quáº£ cam trÃ²n khÃ´ng phá»¥ thuá»™c vÃ o sá»± cáº£m nháº­n cá»§a con ngÆ°á»i. NÃ³ vá»‘n dÄ© váº«n trÃ²n. Do Ä‘Ã³ khi má»™t con ngÆ°á»i cÃ³ Ã½ thá»©c cáº£m giÃ¡c Ä‘Æ°á»£c quáº£ cáº£m hÃ¬nh trÃ²n vÃ  pháº£n Ã¡nh vÃ o nÃ£o. Váº­y hÃ¬nh áº£nh trÃ²n táº¡o ra trong nÃ£o sinh ra lÃ  do quáº£ cam quyáº¿t Ä‘á»‹nh â€¢	Xuáº¥t phÃ¡t tá»« thá»±c táº¿ khÃ¡ch quan, tÃ´n trá»ng khÃ¡ch quan: khÃ´ng Ä‘Æ°á»£c xa rá»i thá»±c táº¿, pháº£i Ä‘i sÃ¢u sÃ¡t vÃ o thá»±c táº¿ má»›i giáº£i quyáº¿t Ä‘Æ°á»£c váº¥n Ä‘á» má»™t cÃ¡ch cá»¥ thá»ƒ. Trong báº¥t cá»© váº¥n Ä‘á», lÄ©nh vá»±c gÃ¬ cÅ©ng cáº§n cÃ³ sá»± tÃ¬m hiá»ƒu ká»¹ thá»±c táº¿: vÄƒn há»c: nhÃ  vÄƒn pháº£i Ä‘i cÃ¹ng thá»±c táº¿ má»›i khiáº¿n tÃ¡c pháº©m cá»§a mÃ¬nh khÃ´ng xa báº¡n Ä‘á»c; ngÆ°á»i bÃ¡n hÃ ng pháº£i Ä‘i tÃ¬m hiá»ƒu thá»‹ trÆ°á»ng má»›i cÃ³ thá»ƒ tháº¥y Ä‘Æ°á»£c nhu cáº§u cá»§a nÄƒm nay má»‘t lÃ  gÃ¬, máº«u nÃ o dá»… bÃ¡n thÃ¬ má»›i cÃ³ lÃ£i nhiá»u,... Ä‘áº·c biá»‡t Ä‘á»‘i vá»›i quan chá»©c lÃ£nh Ä‘áº¡o lÃ  ngÆ°á»i Ä‘Æ°a ra cÃ¡c quyáº¿t Ä‘á»‹nh, Ä‘á» ra luáº­t cÃ ng cáº§n thiáº¿t viá»‡c tÃ¬m hiá»ƒu thá»±c táº¿ trong dÃ¢n.â€¢	vá»›i thÃ nh tá»±u khoa há»c ká»¹ thuáº­t, con ngÆ°á»i cÃ³ thá»ƒ biáº¿n hÃ¬nh dáº¡ng trÃ¡i cam trÃ²n thÃ nh hÃ¬nh dáº¡ng theo Ã½ muá»‘n nhÆ° hÃ¬nh láº­p phÆ°Æ¡ng cháº³ng háº¡n hoáº·c trÃ¡i cam tá»« cÃ³ háº¡t thÃ nh khÃ´ng háº¡t => YT tÃ¡c Ä‘á»™ng trá»Ÿ láº¡i VC thÃ´ng qua hoáº¡t Ä‘á»™ng thá»±c tiá»…n-	PhÃ©p biá»‡n chá»©ng: há»c thuyáº¿t nghiÃªn cá»©u, khÃ¡i quÃ¡t biá»‡n chá»©ng thÃ nh há»‡ thá»‘ng nguyÃªn lÃ½, quy luáº­t => xÃ¢y dá»±ng há»‡ thá»‘ng nguyÃªn táº¯c PPL cá»§a nháº­n thá»©c vÃ  thá»±c tiá»…n. => thuá»™c biá»‡n chá»©ng chá»§ quan, Ä‘á»‘i tÆ°á»£ng lÃ  BC khÃ¡ch quan.', '2018-06-05 21:53:47'),
(18, 14, '2nd year students', 'Xuáº¥t phÃ¡t tá»« thá»±c táº¿ khÃ¡ch quan', 'Xuáº¥t phÃ¡t tá»« thá»±c táº¿ khÃ¡ch quan, tÃ´n trá»ng khÃ¡ch quan: khÃ´ng Ä‘Æ°á»£c xa rá»i thá»±c táº¿, pháº£i Ä‘i sÃ¢u sÃ¡t vÃ o thá»±c táº¿ má»›i giáº£i quyáº¿t Ä‘Æ°á»£c váº¥n Ä‘á» má»™t cÃ¡ch cá»¥ thá»ƒ. Trong báº¥t cá»© váº¥n Ä‘á», lÄ©nh vá»±c gÃ¬ cÅ©ng cáº§n cÃ³ sá»± tÃ¬m hiá»ƒu ká»¹ thá»±c táº¿: vÄƒn há»c: ', '2018-06-06 08:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(200) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`) VALUES
(14, 'bichloan', '61d7f3f52ca43bf9e6b218e4fba0f484'),
(15, 'kobinhthuong', 'a1e495bb972f8549e6a8de4116ececa1'),
(16, 'fiternoretake', 'e6123c04213bd5d89dac6c4c5479cfd1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_like_reply` FOREIGN KEY (`reply_id`) REFERENCES `replies` (`reply_id`),
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `fk_replies_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`),
  ADD CONSTRAINT `fk_replies_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fk_topic1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
