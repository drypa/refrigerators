-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Ноя 29 2013 г., 12:08
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `fridges`
--
CREATE DATABASE IF NOT EXISTS `fridges` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci;
USE `fridges`;

-- --------------------------------------------------------

--
-- Структура таблицы `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fridge_id` varchar(255) NOT NULL,
  `feature_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fridge_id` (`fridge_id`,`feature_type`),
  KEY `feature_type` (`feature_type`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- Очистить таблицу перед добавлением данных `features`
--

TRUNCATE TABLE `features`;
-- --------------------------------------------------------

--
-- Структура таблицы `feature_types`
--

DROP TABLE IF EXISTS `feature_types`;
CREATE TABLE IF NOT EXISTS `feature_types` (
  `feature_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`feature_type_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- Очистить таблицу перед добавлением данных `feature_types`
--

TRUNCATE TABLE `feature_types`;
-- --------------------------------------------------------

--
-- Структура таблицы `fridges`
--

DROP TABLE IF EXISTS `fridges`;
CREATE TABLE IF NOT EXISTS `fridges` (
  `service_number` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `power` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`service_number`),
  KEY `model_id` (`model_id`,`type_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `fridges`
--

TRUNCATE TABLE `fridges`;
-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`model_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- Очистить таблицу перед добавлением данных `model`
--

TRUNCATE TABLE `model`;
-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `type`
--

TRUNCATE TABLE `type`;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_2` FOREIGN KEY (`feature_type`) REFERENCES `feature_types` (`feature_type_id`),
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`fridge_id`) REFERENCES `fridges` (`service_number`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
