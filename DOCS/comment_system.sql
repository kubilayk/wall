-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Mar 2013, 15:10:24
-- Sunucu sürümü: 5.5.27
-- PHP Sürümü: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `comment_system`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(5) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Tablo döküm verisi `comment`
--

INSERT INTO `comment` (`comment_id`, `entry_id`, `comment`, `comment_date`, `user_id`) VALUES
(134, 62, 'aaa', '2013-03-27 13:23:06', 40),
(135, 62, 'asd', '2013-03-27 13:44:42', 40);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(5) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `title_like` int(5) DEFAULT NULL,
  `question_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title_dislike` int(5) DEFAULT NULL,
  `total_comment` int(5) DEFAULT '0',
  `user_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Tablo döküm verisi `question`
--

INSERT INTO `question` (`question_id`, `title`, `description`, `title_like`, `question_date`, `title_dislike`, `total_comment`, `user_id`) VALUES
(62, 'Title', ' Description', 1, '2013-03-27 13:22:11', 0, 2, 40),
(63, 'Title2', ' Description2', NULL, '2013-03-27 14:35:04', NULL, 0, 41);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_votes` int(11) NOT NULL DEFAULT '0',
  `vote_like` int(11) NOT NULL DEFAULT '0',
  `entry_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Tablo döküm verisi `ratings`
--

INSERT INTO `ratings` (`id`, `total_votes`, `vote_like`, `entry_id`) VALUES
(57, 1, 1, 62);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(42, 'alice', '74b87337454200d4d33f80c4663dc5e5', 'ali@hotmail.com'),
(41, 'ahmet', 'aaaa', 'ahmet@gmail.com'),
(40, 'alimert', 'aaaa', 'alimert@hotmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_rate`
--

CREATE TABLE IF NOT EXISTS `user_rate` (
  `user_rate_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `entry_id` int(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

--
-- Tablo döküm verisi `user_rate`
--

INSERT INTO `user_rate` (`user_rate_id`, `user_id`, `entry_id`, `time`) VALUES
(230, 40, 62, '2013-03-27 13:22:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
