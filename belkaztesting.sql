-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2016 г., 20:29
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `belkaztesting`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) DEFAULT NULL,
  `text` text,
  `type` enum('right','wrong') NOT NULL DEFAULT 'wrong',
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `id_question`, `text`, `type`) VALUES
(1, 1, '10', 'wrong'),
(2, 1, '5', 'right'),
(3, 1, '21', 'wrong'),
(4, 1, '20', 'wrong'),
(5, 2, '365', 'right'),
(6, 2, '355', 'wrong'),
(7, 2, '366', 'right'),
(8, 2, '360', 'wrong'),
(9, 3, 'Луна', 'wrong'),
(10, 3, 'Проксима', 'wrong'),
(11, 3, 'Полярная звезда', 'wrong'),
(12, 3, 'Солнце', 'right'),
(13, 6, 'много', 'wrong'),
(14, 6, 'немного', 'right');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1476878304),
('m161019_115236_create_tests_table', 1476888439);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `type` enum('one','multiple') NOT NULL DEFAULT 'one',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `title`, `type`) VALUES
(1, 'Сколько пальцев на руке?', 'one'),
(2, 'Сколько дней в году?', 'multiple'),
(3, 'Как называется ближайшая звезда к земле?', 'one'),
(4, 'тестовый вопрос', 'one'),
(6, 'Тестовый вопрос два', 'one');

-- --------------------------------------------------------

--
-- Структура таблицы `questions_tests`
--

CREATE TABLE IF NOT EXISTS `questions_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_test` (`id_test`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `questions_tests`
--

INSERT INTO `questions_tests` (`id`, `id_test`, `id_question`) VALUES
(2, 1, 2),
(3, 1, 3),
(32, 1, 1),
(34, 3, 6),
(35, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `name`, `description`) VALUES
(1, 'Пробный тест', 'Набор вопросов для проверки работы тестов.'),
(3, 'Test number 2', 'Тестирование удаления');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk-answers-id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions_tests`
--
ALTER TABLE `questions_tests`
  ADD CONSTRAINT `fk-questions_tests-id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-questions_tests-id_test` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
