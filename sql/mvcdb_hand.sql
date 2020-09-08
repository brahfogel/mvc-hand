-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 17 2018 г., 19:53
-- Версия сервера: 5.7.16
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvcdb_hand`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE `tovar` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `about` text NOT NULL,
  `type` text NOT NULL,
  `email` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`id`, `name`, `img`, `about`, `type`, `email`, `price`) VALUES
(315, 'Пример рукоделия', '1493316641.jpg', 'Товар не продается!', 'needlework', 'i@ua', 1),
(316, 'Пример рукоделия', '1493316660.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(312, 'Пример рукоделия', '1493316415.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(313, 'Пример рукоделия', '1493316449.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(314, 'Пример рукоделия', '1493316499.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(317, 'Пример рукоделия', '1493316843.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(318, 'Пример рукоделия', '1493316920.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(319, 'Пример рукоделия', '1493316956.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(320, 'Пример рукоделия', '1493317028.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(321, 'Пример рукоделия', '1493317045.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(322, 'Пример рукоделия', '1493317068.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(323, 'Пример рукоделия', '1493317082.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(324, 'Пример рукоделия', '1493317137.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(325, 'Пример рукоделия', '1493317160.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(326, 'Пример рукоделия', '1493317180.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(327, 'Пример рукоделия', '1493317200.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(328, 'Пример рукоделия', '1493317221.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(329, 'Пример рукоделия', '1493317238.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(330, 'Пример рукоделия', '1493317264.jpg', 'Товар не продается!', 'needlework', 'i@ua', 0),
(331, 'Пример картины', '1493317792.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(332, 'Пример картины', '1493317769.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(333, 'Пример картины', '1493317829.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(334, 'Пример картины', '1493317877.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(335, 'Пример картины', '1493317899.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(336, 'Пример картины', '1493317919.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(337, 'Пример картины', '1493317939.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(338, 'Пример картины', '1493317969.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(339, 'Пример картины', '1493317997.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(340, 'Пример картины', '1493318013.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(341, 'Пример картины', '1493318029.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(342, 'Пример картины', '1493318042.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(343, 'Пример картины', '1493318057.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(344, 'Пример картины', '1493318071.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(345, 'Пример', '1493318797.jpg', 'Товар не продается!', 'others', 'i@ua', 0),
(346, 'Пример', '1493318831.jpg', 'Товар не продается!', 'others', 'i@ua', 0),
(347, 'Пример картины', '1493325267.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(348, 'Пример картины', '1493325356.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0),
(349, 'Пример картины', '1493325409.jpg', 'Товар не продается!', 'paintings', 'i@ua', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'admin',
  `password` char(32) NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `role`, `password`, `is_active`) VALUES
(1, 'admin', 'i@ua', 'admin', '64a8dd8ca444f70c22c2ebbfa926ea5f', 1),
(2, 'ww', 'ww@w', 'user', 'fa9f075be96bdf75fcb1613eb655aeef', 1),
(3, 'sadf', 'asf@asdf', 'user', '1005a965c8ca6adeb3494bb2aba835df', 1),
(4, 'i@ua', 'skfj@kdlf', 'user', 'c716f1fa2854a0d8037ebde0132f6fba', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tovar`
--
ALTER TABLE `tovar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
