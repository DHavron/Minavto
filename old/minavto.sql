-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 04 2015 г., 12:16
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `minavto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_right`
--

CREATE TABLE IF NOT EXISTS `admin_right` (
  `id` int(1) unsigned NOT NULL,
  `name_ru` varchar(30) NOT NULL,
  `name_de` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin_right`
--

INSERT INTO `admin_right` (`id`, `name_ru`, `name_de`) VALUES
(0, 'root', 'root'),
(1, 'Полный доступ', 'Полный доступ'),
(2, 'Просмотр и редактирование', 'Просмотр и редактирование'),
(3, 'Только просмотр', 'Только просмотр');

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` char(40) NOT NULL,
  `fio` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_right` int(1) unsigned NOT NULL DEFAULT '2',
  `prim` tinytext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `admin_right_id_fk` (`id_right`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `admin_users`
--

INSERT INTO `admin_users` (`id`, `login`, `password`, `fio`, `email`, `id_right`, `prim`) VALUES
(0, 'nvvby', '38c17287d4db9fc9e6a3fdcd7b7f998ffa99ccfe', 'nvv.by', NULL, 0, 'не удалять запись'),
(1, 'minavto', 'c546c51281a68e75f855a3523c4dce52801eab0e', 'Людмила', 'l.grushevskaya@minavto.by', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `show` char(2) DEFAULT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `img` (`img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `url`, `date`, `img`, `show`, `level`) VALUES
(3, 'metallbearbeitung', '2015-07-02 16:39:17', NULL, 'on', 0),
(4, 'spritzgieben', '2015-07-03 16:03:31', NULL, 'on', 0),
(5, 'dusenmontage', '2015-06-25 16:33:11', NULL, 'on', 0),
(6, 'qualitätssicherung', '2015-06-25 17:59:51', NULL, 'on', 0),
(7, 'kontakt', '2015-07-02 16:33:51', NULL, 'on', 0),
(8, 'uber_uns', '2015-07-02 16:21:47', NULL, 'on', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `visible_block` text,
  `hidden_block` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `counters`
--

INSERT INTO `counters` (`visible_block`, `hidden_block`) VALUES
(NULL, '(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter24677156 = new Ya.Metrika({id:24677156, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");');

-- --------------------------------------------------------

--
-- Структура таблицы `counters_block_links`
--

CREATE TABLE IF NOT EXISTS `counters_block_links` (
  `link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `description`
--

CREATE TABLE IF NOT EXISTS `description` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `description_ru` tinytext,
  `description_en` tinytext,
  `description_de` tinytext,
  `description_pl` tinytext,
  `description_by` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `description`
--

INSERT INTO `description` (`id_table`, `id_row`, `description_ru`, `description_en`, `description_de`, `description_pl`, `description_by`) VALUES
(1, 3, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(1, 4, 'Литье пластмасс', 'Injection molding', 'Spritzgießen', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(1, 5, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(1, 6, 'Качество', 'Quality assurance', 'Qualitätssicherung', 'Jakość', 'Гарантыя якасці'),
(1, 7, 'Контактная информация', 'Contact information', 'Kontaktinformation', 'Informacje Kontaktowe', 'Кантактная інфармацыя'),
(1, 8, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(10, 1, '«Минавто»', '«Minavto»', '«Minavto»', '«Minavto»', '«Мінаўта»'),
(7, 1, 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015'),
(10, 2, 'Новости компании «Minavto»', 'Сompany''s news', 'Nachrichten der Firma', 'Aktualności firmy', 'Навіны кампаніі'),
(10, 3, 'Поиск по сайту', 'Search', 'Site-Suche', 'Szukaj w serwisie', 'Пошук па сайце');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `name_file` varchar(150) NOT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `date` datetime NOT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name_file` (`name_file`),
  UNIQUE KEY `icon` (`icon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `filters_statistics`
--

CREATE TABLE IF NOT EXISTS `filters_statistics` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name_user_agent` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_user_agent` (`name_user_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `date` datetime NOT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `img` (`img`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `global_url`
--

CREATE TABLE IF NOT EXISTS `global_url` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `global_url`
--

INSERT INTO `global_url` (`id`, `url`, `date`) VALUES
(1, 'index', '2015-06-24 23:34:43'),
(2, 'nachrichten', '2015-07-02 17:02:21'),
(3, 'suche', '2015-07-02 17:04:41');

-- --------------------------------------------------------

--
-- Структура таблицы `h1`
--

CREATE TABLE IF NOT EXISTS `h1` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `h1_ru` tinytext,
  `h1_en` tinytext,
  `h1_de` tinytext NOT NULL,
  `h1_pl` tinytext,
  `h1_by` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h1`
--

INSERT INTO `h1` (`id_table`, `id_row`, `h1_ru`, `h1_en`, `h1_de`, `h1_pl`, `h1_by`) VALUES
(1, 3, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(1, 4, 'Литье пластмасс', 'Injection molding', 'Spritzgießen', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(1, 5, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(1, 6, 'Качество', 'Quality assurance', 'Qualitätssicherung', 'Jakość', 'Гарантыя якасці'),
(1, 7, 'Контактная информация', 'Contact information', 'Kontaktinformation', 'Informacje Kontaktowe', 'Кантактная інфармацыя'),
(1, 8, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(10, 1, '«Минавто»', '«Minavto»', '«Minavto»', '«Minavto»', '«Мінаўта»'),
(7, 1, 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015'),
(10, 2, 'Новости компании', 'Сompany''s news', 'Nachrichten der Firma', 'Aktualności firmy', 'Навіны кампаніі'),
(10, 3, 'Поиск по сайту', 'Search', 'Site-Suche', 'Szukaj w serwisie', 'Пошук па сайце');

-- --------------------------------------------------------

--
-- Структура таблицы `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `keywords_ru` tinytext,
  `keywords_en` tinytext,
  `keywords_de` tinytext,
  `keywords_pl` tinytext,
  `keywords_by` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `keywords`
--

INSERT INTO `keywords` (`id_table`, `id_row`, `keywords_ru`, `keywords_en`, `keywords_de`, `keywords_pl`, `keywords_by`) VALUES
(1, 3, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(1, 4, 'Литье пластмасс', 'Injection molding', 'Spritzgießen', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(1, 5, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(1, 6, 'Качество', 'Quality assurance', 'Qualitätssicherung', 'Jakość', 'Гарантыя якасці'),
(1, 7, 'Контактная информация', 'Contact information', 'Kontaktinformation', 'Informacje Kontaktowe', 'Кантактная інфармацыя'),
(1, 8, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(10, 1, '«Минавто»', '«Minavto»', '«Minavto»', '«Minavto»', '«Мінаўта»'),
(7, 1, NULL, NULL, NULL, NULL, NULL),
(10, 2, 'Новости компании', 'news', 'nachrichten', 'Aktualności firmy', 'Навіны кампаніі'),
(10, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(5) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(250) DEFAULT NULL,
  `click` char(2) DEFAULT NULL,
  `show` char(2) DEFAULT NULL,
  `link` varchar(600) NOT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `icon` (`icon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `parent`, `icon`, `click`, `show`, `link`, `level`) VALUES
(1, 0, NULL, 'on', 'on', '', 7),
(2, 0, NULL, 'on', 'on', '/metallbearbeitung/', 6),
(3, 0, NULL, 'on', 'on', '/spritzgieben/', 5),
(4, 0, NULL, 'on', 'on', '/dusenmontage/', 4),
(5, 0, NULL, 'on', 'on', '/qualitätssicherung/', 3),
(6, 0, NULL, 'on', 'on', '/kontakt/', 1),
(7, 0, NULL, 'on', 'on', '/uber_uns/', 0),
(8, 0, NULL, 'on', 'on', '/nachrichten/', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `moduls`
--

CREATE TABLE IF NOT EXISTS `moduls` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_position` int(2) unsigned NOT NULL,
  `allpage` char(2) DEFAULT 'of',
  `level` int(3) unsigned NOT NULL DEFAULT '0',
  `show` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `moduls`
--

INSERT INTO `moduls` (`id`, `id_position`, `allpage`, `level`, `show`) VALUES
(1, 3, 'of', 0, 'on');

-- --------------------------------------------------------

--
-- Структура таблицы `moduls_links`
--

CREATE TABLE IF NOT EXISTS `moduls_links` (
  `id_modul` int(5) unsigned NOT NULL,
  `link` varchar(250) NOT NULL,
  KEY `moduls_id_fk` (`id_modul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `name`
--

CREATE TABLE IF NOT EXISTS `name` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `name_ru` tinytext,
  `name_en` tinytext,
  `name_de` tinytext NOT NULL,
  `name_pl` tinytext,
  `name_by` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `name`
--

INSERT INTO `name` (`id_table`, `id_row`, `name_ru`, `name_en`, `name_de`, `name_pl`, `name_by`) VALUES
(1, 3, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(11, 1, 'Главная', 'Home', 'Startseite', 'Główna', 'Галоўная'),
(11, 2, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(1, 4, 'Литье пластмасс', 'Injection molding', 'Spritzgießen', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(11, 3, 'Литье пластмасс', 'Injection Molding', 'Spritzgießen', 'Przetwórstwo tw. sztucznych', 'Ліццё пластмас'),
(1, 5, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(1, 6, 'Качество', 'Quality assurance', 'Qualitätssicherung', 'Jakość', 'Гарантыя якасці'),
(1, 7, 'Контактная информация', 'Contact information', 'Kontaktinformation', 'Informacje Kontaktowe', 'Кантактная інфармацыя'),
(1, 8, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(11, 4, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка'),
(11, 5, 'Качество', 'Quality', 'Qualität', 'Jakość', 'Якасць'),
(11, 6, 'Контакты', 'Contacts', 'Kontakt', 'Kontakt', 'Кантакты'),
(11, 7, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(11, 8, 'Новости', 'News', 'Nachrichten', 'Aktualności', 'Навіны'),
(14, 1, 'Главная', 'Home', 'Startseite', 'Główna', 'Галоўная'),
(15, 1, 'Минавто', 'Minavto', 'Minavto', 'Minavto', 'Мінаўта'),
(15, 2, 'Сотрудница', 'Employee', 'Gesicht', 'Pracownik', 'Супрацоўніца'),
(15, 3, 'Логойск', 'Logoysk', 'Logoysk', 'Logoysk', 'Лагойск'),
(15, 4, 'Крыница', 'Krynica', 'Krynica', 'Krynica', 'Крыніца'),
(15, 5, 'Флаги', 'Flags', 'Fahnen', 'Flagi', 'Сцягі'),
(15, 6, 'Указатель', 'Pointer', 'Zeiger', 'Wskaźnik', 'Паказальнік'),
(15, 7, 'Церковь', 'Church', 'Kirche', 'Kościół', 'Царква'),
(15, 9, 'Магазин', 'Store', 'Geschaft', 'Sklep', 'Крама'),
(15, 10, 'Переговорная комната', 'Negotiations', 'Verhandlungen', 'Negocjacje', 'Перамоўны пакой'),
(15, 11, 'Главное здание', 'Construction Main', 'Bau-Haupt', 'Budowa główna', 'Галоўны будынак'),
(15, 12, NULL, NULL, 'Uberqueren', NULL, NULL),
(15, 13, 'Дом', 'House', 'Haus', 'Do domu', 'Дом'),
(15, 14, 'Главное здание', 'Main Building', 'Hauptgebaude', 'Budynek Główny', 'Галоўны будынак'),
(14, 2, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(15, 15, 'Металлообработка', 'Metalworking', 'Schlosserei', 'Obróbka metali', 'Металаапрацоўка'),
(15, 16, 'Металлообработка 1', 'Metalworking 1', 'Schlosserei 1', 'Obróbka metali 1', 'Металаапрацоўка 1'),
(15, 17, 'Материалы 2', 'Material 2', 'Material 2', 'Materialny 2', 'Матэрыялы 2'),
(15, 18, 'Материалы', 'Material', 'Material', 'Materialny', 'Матэрыялы'),
(15, 19, 'Металлообработка 3', 'Metalworking 3', 'Schlosserei 3', 'Obróbka metali 3', 'Металаапрацоўка 3'),
(15, 20, 'Металлообработка 2', 'Metalworking 2', 'Schlosserei 2', 'Obróbka metali 2', 'Металаапрацоўка 2'),
(15, 21, 'Металлообработка 4', 'Metalworking 4', 'Schlosserei 4', 'Obróbka metali 4', 'Металаапрацоўка 4'),
(15, 22, 'Продукция', 'Production', 'Produktion', 'Produkcja', 'Вытворчасць'),
(15, 23, 'CNC', 'CNC', 'CNC', 'CNC', 'CNC'),
(15, 24, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(15, 25, 'Mikron', 'Mikron', 'Mikron', 'Mikron', 'Mikron'),
(15, 26, 'ЧПУ', 'CNC', 'CNC-Maschine', 'CNC', 'ЧПУ'),
(15, 27, 'Валы', 'Shafts', 'Wellen', 'Wały', 'Валы'),
(15, 28, 'Машина', 'Machine', 'Maschine', 'Maszyna', 'Машына'),
(15, 29, 'Машина 2', 'Machine 2', 'Maschine 2', 'Maszyna 2', 'Машына 2'),
(10, 1, '«Минавто»', '«Minavto»', 'index', '«Minavto»', '«Мінаўта»'),
(14, 3, 'Литье пластмасс', 'Injection Molding', 'Spritzgieben', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(15, 30, 'Дворники', 'Windshield wiper', 'Scheibenwischer', 'Wycieraczka przedniej szyby', 'Дворнікі'),
(15, 31, 'Заготовительный материал', 'Cast material', 'Gussmaterial', 'Materiał odlewane', 'Нарыхтоўчы матэрыял'),
(15, 32, 'Вал-шестерня', 'Pinion shaft', 'Ritzelwelle', 'Wałku', 'Вал-шасцярня'),
(15, 33, 'Передача', 'Gears', 'Getriebe', 'Transmisja', 'Перадача'),
(15, 34, 'Контроль качества', 'Checkpoint', 'Kontrolle', 'Sprawdź', 'Кантроль якасці'),
(15, 35, 'Вал-шестерни', 'Gear', 'Gang', 'Bieg', 'Вал-шасцярнi'),
(15, 37, 'Литейный цех', 'Foundry', 'Gieberei', 'Odlewnia', 'Ліцейны цэх'),
(15, 38, 'Sumito-demag', 'Sumito-demag', 'Sumito-demag', 'Sumito-demag', 'Sumito-demag'),
(15, 39, 'Sumito-demag 2', 'Sumito-demag 2', 'Sumito-demag 2', 'Sumito-demag 2', 'Sumito-demag 2'),
(14, 4, 'Сборка', 'Nozzle assembly', 'Dusenmontage', 'Montaż', 'Зборка'),
(15, 40, 'Сборка 9', 'Mounting 9', 'Montage 9', 'Montowanie 9', 'Зборка 9'),
(15, 41, 'Сборка 8', 'Mounting 8', 'Montage 8', 'Montowanie 8', 'Зборка 8'),
(15, 42, 'Сборка 7', 'Mounting 7', 'Montage 7', 'Montowanie 7', 'Зборка 7'),
(15, 43, 'Сборка 6', 'Mounting 6', 'Montage 6', 'Montowanie 6', 'Зборка 6'),
(15, 44, 'Сборка 5', 'Mounting 5', 'Montage 5', 'Montowanie 5', 'Зборка 5'),
(15, 45, 'Сборка 4', 'Mounting 4', 'Montage 4', 'Montowanie 4', 'Зборка 4'),
(15, 46, 'Сборка 3', 'Mounting 3', 'Montage 3', 'Montowanie 3', 'Зборка 3'),
(15, 47, 'Сборка 2', 'Mounting 2', 'Montage 2', 'Montowanie 2', 'Зборка 2'),
(15, 48, 'Сборка', 'Mounting', 'Montage', 'Montowanie', 'Зборка'),
(14, 5, 'Качество', 'Quality assurance', 'Qualitatssicherung', 'Jakość', 'Гарантыя якасці'),
(15, 49, 'Инструмент контроля качества', 'Quality control instrument', 'Instrument der Qualitatskontrolle', 'Instrumentem kontroli jakości', 'Інструмент кантролю якасці'),
(15, 51, 'Контроль качества 4', 'Quality control 4', 'Qualitatskontrolle 4', 'Kontrola jakości 4', 'Кантроль якасці 4'),
(15, 52, 'Контроль качества 3', 'Quality control 3', 'Qualitatskontrolle 3', 'Kontrola jakości 3', 'Кантроль якасці 3'),
(15, 53, 'Контроль качества 2', 'Quality control 2', 'Qualitatskontrolle 2', 'Kontrola jakości 2', 'Кантроль якасці 2'),
(15, 54, 'Контроль качества', 'Quality control', 'Qualitatskontrolle', 'Kontrola jakości', 'Кантроль якасці'),
(15, 55, 'Калибровка', 'Meters', 'Messgerate', 'Metrów', 'Каліброўка'),
(15, 56, 'Frenko', 'Frenko', 'Frenko', 'Frenko', 'Frenko'),
(15, 57, 'Mitutoyo C-3000', 'Mitutoyo C-3000', 'Mitutoyo C-3000', 'Mitutoyo C-3000', 'Mitutoyo C-3000'),
(22, 2, 'Божков Олег', 'Bozhkov Oleg', 'Bozhkov Oleg', 'Bożkow Oleg', 'Бажкоў Алег'),
(22, 3, 'Татьяна Брисюк', 'Tatyana Brisyuk', 'Tatyana Brisyuk', 'Tatjana Brisiuk', 'Таццяна Брысюк'),
(22, 4, 'Сергей Дейнор', 'Sergey Deinor', 'Sergey Deinor', 'Sergiej Dejnor', 'Сяргей Дэйнар'),
(22, 5, 'Людмила Грушевская', 'Lyudmila Grushevskaya', 'Lyudmila Grushevskaya', 'Ludmila Gruszewska', 'Людміла Грушэўская'),
(22, 6, 'Клясевич дмитрий', 'Kljasivich Dmitrij', 'Kljasivich Dmitrij', 'Kljasivich Dmitrij', 'Клясевіч Дмітрый'),
(22, 7, 'Валентин Костюк', 'Valentine Kostyuk', 'Valentine Kostyuk', 'Valentin Kostiuk', 'Валянцін Касцюк'),
(22, 8, 'Лео Штыс', 'Leo Stys', 'Leo Stys', 'Leo Stys', 'Лео Штыс'),
(22, 9, 'Александр Навицкий', 'Alexander Navitski', 'Alexander Navitski', 'Aleksander Nawicki', 'Аляксандар Навіцкі'),
(22, 10, 'Новицкий Антон', 'Novickiy Anton', 'Novickiy Anton', 'Novickij Anton', 'Новіцкі Антон'),
(22, 11, 'Ольга Саврицкая', 'Olga Savritskaya', 'Olga Savritskaya', 'Olga Sawrycka', 'Вольга Саўрыцкая'),
(22, 12, 'Владимир Стригалёв', 'Vladimir Strigalev', 'Vladimir Strigalev', 'Wladimir Strygalow', 'Уладзімір Стрыгалёў'),
(22, 13, 'Михаил Яблонский', 'Michael Yablonski', 'Michael Yablonski', 'Michail Jabłonski', 'Міхаіл Яблонскі'),
(22, 14, 'Структура предприятия DE', 'Business structure DE', 'Geschaftsstruktur DE', 'Struktura działalności DE', 'Структура прадпрыемства DE'),
(22, 15, 'Структура предприятия RU', 'Business structure RU', 'Geschaftsstruktur RU', 'Struktura działalności RU', 'Структура прадпрыемства RU'),
(22, 16, 'Структура предприятия EN', 'Business structure EN', 'Geschaftsstruktur EN', 'Struktura działalności EN', 'Структура прадпрыемства EN'),
(22, 17, 'Структура предприятия PL', 'Business structure PL', 'Geschaftsstruktur PL', 'Struktura działalności PL', 'Структура прадпрыемства PL'),
(22, 18, 'Лозунг', 'Slogan', 'Slogan', 'Hasło', 'Лозунг'),
(13, 1, 'Footer', 'Footer', 'Footer', 'Footer', 'Footer'),
(7, 1, 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015', 'Туристический слет Логойского района 2015'),
(10, 2, 'Новости компании', 'Сompany''s news', 'nachrichten', 'Aktualności firmy', 'Навіны кампаніі'),
(10, 3, 'Поиск по сайту', 'Search', 'suche', 'Szukaj w serwisie', 'Пошук па сайце'),
(22, 19, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(22, 20, 'Металлообработка 2', 'Metalworking 2', 'Metallbearbeitung 2', 'Obróbka metali 2', 'Металаапрацоўка 2'),
(22, 21, 'Металлообработка 3', 'Metalworking 3', 'Metallbearbeitung 3', 'Obróbka metali 3', 'Металаапрацоўка 3'),
(22, 22, 'Металлообработка 4', 'Metalworking 4', 'Metallbearbeitung 4', 'Obróbka metali 4', 'Металаапрацоўка 4'),
(22, 23, 'Металлообработка 5', 'Metalworking 5', 'Metallbearbeitung 5', 'Obróbka metali 5', 'Металаапрацоўка 5'),
(22, 24, 'Металлообработка 6', 'Metalworking 6', 'Metallbearbeitung 6', 'Obróbka metali 6', 'Металаапрацоўка 6'),
(22, 25, 'Литье пластмасс', 'Injection Molding', 'Spritzgieben', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(22, 26, 'Литье пластмасс 2', 'Injection Molding 2', 'Spritzgieben 2', 'Przetwórstwo tworzyw sztucznych 2', 'Ліццё пластмасы 2'),
(22, 27, 'Литье пластмасс 3', 'Injection Molding 3', 'Spritzgieben 3', 'Przetwórstwo tworzyw sztucznych 3', 'Ліццё пластмасы 3'),
(22, 28, 'Литье пластмасс 4', 'Injection Molding 4', 'Spritzgieben 4', 'Przetwórstwo tworzyw sztucznych 4', 'Ліццё пластмасы 4'),
(22, 29, 'Сборка', 'Nozzle assembly', 'Dusenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(22, 30, 'Сборка 2', 'Nozzle assembly 2', 'Dusenmontage 2', 'Montaż 2', 'Зборка вырабаў з пластмасы 2'),
(22, 31, 'Сборка 3', 'Nozzle assembly 3', 'Dusenmontage 3', 'Montaż 3', 'Зборка вырабаў з пластмасы 3'),
(22, 32, 'Сборка 4', 'Nozzle assembly 4', 'Dusenmontage 4', 'Montaż 4', 'Зборка вырабаў з пластмасы 4'),
(22, 33, 'Сборка 5', 'Nozzle assembly 5', 'Dusenmontage 5', 'Montaż 5', 'Зборка вырабаў з пластмасы 5'),
(22, 34, 'Сборка 6', 'Nozzle assembly 6', 'Dusenmontage 6', 'Montaż 6', 'Зборка вырабаў з пластмасы 6'),
(22, 35, 'Сборка 7', 'Nozzle assembly 7', 'Dusenmontage 7', 'Montaż 7', 'Зборка вырабаў з пластмасы 7'),
(22, 36, 'Сборка 8', 'Nozzle assembly 8', 'Dusenmontage 8', 'Montaż 8', 'Зборка вырабаў з пластмасы 8'),
(22, 37, 'Сборка 9', 'Nozzle assembly 9', 'Dusenmontage 9', 'Montaż 9', 'Зборка вырабаў з пластмасы 9');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `show` char(2) DEFAULT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `img` (`img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `url`, `date`, `img`, `show`, `level`) VALUES
(1, 'turslet-2015', '2015-07-02 14:33:50', 'turisticheskij-slet-logojskogo-rajona-2015.jpeg', 'on', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `none`
--

CREATE TABLE IF NOT EXISTS `none` (
  `id` int(1) unsigned NOT NULL,
  `url` varchar(1) NOT NULL,
  `show` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `email` varchar(100) NOT NULL,
  `text_ru` text,
  `text_en` text,
  `text_de` text,
  `text_pl` text,
  `text_by` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`email`, `text_ru`, `text_en`, `text_de`, `text_pl`, `text_by`) VALUES
('nvv987@mail.ru', '<table id="center-3-mod">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка" src="http://minavto.by/img/upload/metallbearbeitung.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка 2" src="http://minavto.by/img/upload/metallbearbeitung-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка 3" src="http://minavto.by/img/upload/metallbearbeitung-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка 4" src="http://minavto.by/img/upload/metallbearbeitung-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка 5" src="http://minavto.by/img/upload/metallbearbeitung-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Металлообработка 6" src="http://minavto.by/img/upload/metallbearbeitung-6.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/ru/metallbearbeitung/" title="Металлообработка"><span class="text-3-mod">Металлообработка</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Литье пластмасс" src="http://minavto.by/img/upload/spritzgieben.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Литье пластмасс 2" src="http://minavto.by/img/upload/spritzgieben-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Литье пластмасс 3" src="http://minavto.by/img/upload/spritzgieben-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Литье пластмасс 4" src="http://minavto.by/img/upload/spritzgieben-4.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/ru/spritzgieben/" title="Мы производим: Элементы зубчатых передач электроприводов, дверных стеклоподъёмников и стеклоочистителей,жиклеры, электрические разъемы, штуцера и т.д."><span class="text-3-mod">Литье пластмасс</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка" src="http://minavto.by/img/upload/dusenmontage.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 2" src="http://minavto.by/img/upload/dusenmontage-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 3" src="http://minavto.by/img/upload/dusenmontage-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 4" src="http://minavto.by/img/upload/dusenmontage-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 5" src="http://minavto.by/img/upload/dusenmontage-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 6" src="http://minavto.by/img/upload/dusenmontage-6.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 7" src="http://minavto.by/img/upload/dusenmontage-7.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 8" src="http://minavto.by/img/upload/dusenmontage-8.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Сборка 9" src="http://minavto.by/img/upload/dusenmontage-9.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/ru/dusenmontage/" title="Сборка и настройка систем омывания лобового стекла легковых и грузовых автомобилей с подогревом и без подогрева."><span class="text-3-mod">Сборка</span></a></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<table id="center-3-mod">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking" src="http://minavto.by/img/upload/metallbearbeitung.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking 2" src="http://minavto.by/img/upload/metallbearbeitung-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking 3" src="http://minavto.by/img/upload/metallbearbeitung-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking 4" src="http://minavto.by/img/upload/metallbearbeitung-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking 5" src="http://minavto.by/img/upload/metallbearbeitung-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metalworking 6" src="http://minavto.by/img/upload/metallbearbeitung-6.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/en/metallbearbeitung/" title="Metalworking"><span class="text-3-mod">Metalworking</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Injection molding" src="http://minavto.by/img/upload/spritzgieben.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Injection molding 2" src="http://minavto.by/img/upload/spritzgieben-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Injection molding 3" src="http://minavto.by/img/upload/spritzgieben-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Injection molding 4" src="http://minavto.by/img/upload/spritzgieben-4.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/en/spritzgieben/" title="Injection Molding"><span class="text-3-mod">Injection molding</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly" src="http://minavto.by/img/upload/dusenmontage.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 2" src="http://minavto.by/img/upload/dusenmontage-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 3" src="http://minavto.by/img/upload/dusenmontage-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 4" src="http://minavto.by/img/upload/dusenmontage-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 5" src="http://minavto.by/img/upload/dusenmontage-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 6" src="http://minavto.by/img/upload/dusenmontage-6.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 7" src="http://minavto.by/img/upload/dusenmontage-7.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 8" src="http://minavto.by/img/upload/dusenmontage-8.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Nozzle assembly 9" src="http://minavto.by/img/upload/dusenmontage-9.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/en/dusenmontage/" title="Nozzle assembly"><span class="text-3-mod">Nozzle assembly</span></a></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<table id="center-3-mod">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung" src="http://minavto.by/img/upload/metallbearbeitung.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung 2" src="http://minavto.by/img/upload/metallbearbeitung-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung 3" src="http://minavto.by/img/upload/metallbearbeitung-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung 4" src="http://minavto.by/img/upload/metallbearbeitung-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung 5" src="http://minavto.by/img/upload/metallbearbeitung-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Metallbearbeitung 6" src="http://minavto.by/img/upload/metallbearbeitung-6.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/de/metallbearbeitung/" title="Metallbearbeitung"><span class="text-3-mod">Metallbearbeitung</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Spritzgießen" src="http://minavto.by/img/upload/spritzgieben.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Spritzgießen 2" src="http://minavto.by/img/upload/spritzgieben-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Spritzgießen 3" src="http://minavto.by/img/upload/spritzgieben-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Spritzgießen 4" src="http://minavto.by/img/upload/spritzgieben-4.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/de/spritzgieben/" title="Spritzgießen"><span class="text-3-mod">Spritzgießen</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage" src="http://minavto.by/img/upload/dusenmontage.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 2" src="http://minavto.by/img/upload/dusenmontage-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 3" src="http://minavto.by/img/upload/dusenmontage-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 4" src="http://minavto.by/img/upload/dusenmontage-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 5" src="http://minavto.by/img/upload/dusenmontage-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 6" src="http://minavto.by/img/upload/dusenmontage-6.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 7" src="http://minavto.by/img/upload/dusenmontage-7.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 8" src="http://minavto.by/img/upload/dusenmontage-8.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Düsenmontage 9" src="http://minavto.by/img/upload/dusenmontage-9.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/de/dusenmontage/" title="Düsenmontage"><span class="text-3-mod">Düsenmontage</span></a></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '<table id="center-3-mod">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali" src="http://minavto.by/img/upload/metallbearbeitung.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali 2" src="http://minavto.by/img/upload/metallbearbeitung-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali 3" src="http://minavto.by/img/upload/metallbearbeitung-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali 4" src="http://minavto.by/img/upload/metallbearbeitung-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali 5" src="http://minavto.by/img/upload/metallbearbeitung-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Obróbka metali 6" src="http://minavto.by/img/upload/metallbearbeitung-6.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/pl/metallbearbeitung/" title="Obr&oacute;bka metali"><span class="text-3-mod">Obr&oacute;bka metali</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Przetwórstwo tworzyw sztucznych" src="http://minavto.by/img/upload/spritzgieben.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Przetwórstwo tworzyw sztucznych 2" src="http://minavto.by/img/upload/spritzgieben-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Przetwórstwo tworzyw sztucznych 3" src="http://minavto.by/img/upload/spritzgieben-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Przetwórstwo tworzyw sztucznych 4" src="http://minavto.by/img/upload/spritzgieben-4.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/pl/spritzgieben/" title="Przetwórstwo tworzyw sztucznych"><span class="text-3-mod">Przetw&oacute;rstwo tw.sztucznych</span></a></div>\r\n			</td>\r\n			<td>\r\n			<div class="rect">\r\n			<div class="image-3-mod">\r\n			<ul>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż" src="http://minavto.by/img/upload/dusenmontage.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 2" src="http://minavto.by/img/upload/dusenmontage-2.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 3" src="http://minavto.by/img/upload/dusenmontage-3.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 4" src="http://minavto.by/img/upload/dusenmontage-4.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 5" src="http://minavto.by/img/upload/dusenmontage-5.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 6" src="http://minavto.by/img/upload/dusenmontage-6.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 7" src="http://minavto.by/img/upload/dusenmontage-7.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 8" src="http://minavto.by/img/upload/dusenmontage-8.jpg" /></div>\r\n				</li>\r\n				<li>\r\n				<div class="images-3-mod"><img alt="Montaż 9" src="http://minavto.by/img/upload/dusenmontage-9.jpg" /></div>\r\n				</li>\r\n			</ul>\r\n			</div>\r\n			<a href="http://minavto.by/pl/dusenmontage/" title="Montaż"><span class="text-3-mod">Montaż</span></a></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<table id="center-3-mod"><tbody><tr>\r\n<td><div class="rect"><div class="image-3-mod"><ul><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung.jpg" alt="Металаапрацоўка" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung-2.jpg" alt="Металаапрацоўка 2" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung-3.jpg" alt="Металаапрацоўка 3" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung-4.jpg" alt="Металаапрацоўка 4" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung-5.jpg" alt="Металаапрацоўка 5" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/metallbearbeitung-6.jpg" alt="Металаапрацоўка 6" /></div></li></ul></div><a title="Металаапрацоўка" href="http://minavto.by/by/metallbearbeitung/"><span class="text-3-mod">Металаапрацоўка</span></a></div></td>\r\n\r\n<td><div class="rect"><div class="image-3-mod"><ul><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/spritzgieben.jpg" alt="Ліццё пластмасы" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/spritzgieben-2.jpg" alt="Ліццё пластмасы 2" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/spritzgieben-3.jpg" alt="Ліццё пластмасы 3" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/spritzgieben-4.jpg" alt="Ліццё пластмасы 4" /></div></li></ul></div><a title="Ліццё пластмасы" href="http://minavto.by/by/spritzgieben/"><span class="text-3-mod">Ліццё пластмасы</span></a></div></td>\r\n\r\n<td><div class="rect"><div class="image-3-mod"><ul><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage.jpg" alt="Зборка вырабаў з пластмасы" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-2.jpg" alt="Зборка вырабаў з пластмасы 2" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-3.jpg" alt="Зборка вырабаў з пластмасы 3" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-4.jpg" alt="Зборка вырабаў з пластмасы 4" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-5.jpg" alt="Зборка вырабаў з пластмасы 5" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-6.jpg" alt="Зборка вырабаў з пластмасы 6" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-7.jpg" alt="Зборка вырабаў з пластмасы 7" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-8.jpg" alt="Зборка вырабаў з пластмасы 8" /></div></li><li><div class="images-3-mod"><img src="http://minavto.by/img/upload/dusenmontage-9.jpg" alt="Зборка вырабаў з пластмасы 9" /></div></li></ul></div><a title="Зборка вырабаў з пластмасы" href="http://minavto.by/by/dusenmontage/"><span class="text-3-mod">Зборка</span></a></div></td>\r\n</tr></tbody></table>');

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `folder` varchar(250) NOT NULL,
  `id_position` int(1) unsigned NOT NULL,
  `show` char(2) DEFAULT NULL,
  `date` datetime NOT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `folder` (`folder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `folder`, `id_position`, `show`, `date`, `level`) VALUES
(1, 'startseite', 1, 'on', '2015-06-25 00:40:07', 0),
(2, 'metallbearbeitung', 1, 'on', '2015-06-25 09:56:16', 0),
(3, 'spritzgieben', 1, 'on', '2015-06-25 10:01:52', 0),
(4, 'dusenmontage', 1, 'on', '2015-06-25 10:28:25', 0),
(5, 'qualitatssicherung', 1, 'on', '2015-06-25 17:54:07', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `slider_links`
--

CREATE TABLE IF NOT EXISTS `slider_links` (
  `id_slider` int(12) unsigned NOT NULL,
  `link` varchar(400) NOT NULL,
  KEY `slider_id_fk` (`id_slider`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `slider_links`
--

INSERT INTO `slider_links` (`id_slider`, `link`) VALUES
(1, 'index'),
(2, '/metallbearbeitung/'),
(3, '/spritzgieben/'),
(4, '/dusenmontage/'),
(5, '/qualitätssicherung/');

-- --------------------------------------------------------

--
-- Структура таблицы `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `id_slider` int(12) unsigned NOT NULL,
  `link` varchar(400) DEFAULT NULL,
  `img` varchar(250) NOT NULL,
  `level` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `img` (`img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `slides`
--

INSERT INTO `slides` (`id`, `id_slider`, `link`, `img`, `level`) VALUES
(1, 1, NULL, 'minavto.jpeg', 16),
(2, 1, NULL, 'gesicht.jpeg', 15),
(3, 1, NULL, 'logoysk.jpeg', 14),
(4, 1, NULL, 'krynica.jpeg', 13),
(5, 1, NULL, 'fahnen.jpeg', 12),
(6, 1, NULL, 'zeiger.jpeg', 11),
(7, 1, NULL, 'kirche.jpeg', 10),
(9, 1, NULL, 'geschaft.jpeg', 9),
(10, 1, NULL, 'verhandlungen.jpeg', 8),
(11, 1, NULL, 'bau-haupt.jpeg', 7),
(12, 1, NULL, 'uberqueren.jpeg', 6),
(13, 1, NULL, 'haus.jpeg', 5),
(14, 1, NULL, 'hauptgebaude.jpeg', 4),
(15, 2, NULL, 'schlosserei.jpeg', 20),
(16, 2, NULL, 'schlosserei-1.jpeg', 19),
(17, 2, NULL, 'material-2.jpeg', 18),
(18, 2, NULL, 'material.jpeg', 17),
(19, 2, NULL, 'schlosserei-3.jpeg', 16),
(20, 2, NULL, 'schlosserei-2.jpeg', 15),
(21, 2, NULL, 'schlosserei-4.jpeg', 14),
(22, 2, NULL, 'produktion.jpeg', 13),
(23, 2, NULL, 'cnc.jpeg', 12),
(24, 2, NULL, 'metallbearbeitung.jpeg', 11),
(25, 2, NULL, 'mikron.jpeg', 10),
(26, 2, NULL, 'cnc-maschine.jpeg', 9),
(27, 2, NULL, 'wellen.jpeg', 8),
(28, 2, NULL, 'maschine.jpeg', 7),
(29, 2, NULL, 'maschine-2.jpeg', 6),
(30, 3, NULL, 'scheibenwischer.jpeg', 10),
(31, 3, NULL, 'gussmaterial.jpeg', 8),
(32, 3, NULL, 'ritzelwelle.jpeg', 7),
(33, 3, NULL, 'getriebe.jpeg', 6),
(34, 3, NULL, 'kontrolle.jpeg', 5),
(35, 3, NULL, 'gang.jpeg', 4),
(37, 3, NULL, 'gieberei.jpeg', 3),
(38, 3, NULL, 'sumito-demag.jpeg', 2),
(39, 3, NULL, 'sumito-demag-2.jpeg', 1),
(40, 4, NULL, 'montage-9.jpeg', 9),
(41, 4, NULL, 'montage-8.jpeg', 8),
(42, 4, NULL, 'montage-7.jpeg', 7),
(43, 4, NULL, 'montage-6.jpeg', 6),
(44, 4, NULL, 'montage-5.jpeg', 5),
(45, 4, NULL, 'montage-4.jpeg', 4),
(46, 4, NULL, 'montage-3.jpeg', 3),
(47, 4, NULL, 'montage-2.jpeg', 2),
(48, 4, NULL, 'montage.jpeg', 1),
(49, 5, NULL, 'instrument-der-qualitatskontrolle.jpeg', 9),
(51, 5, NULL, 'qualitatskontrolle-4.jpeg', 8),
(52, 5, NULL, 'qualitatskontrolle-3.jpeg', 7),
(53, 5, NULL, 'qualitatskontrolle-2.jpeg', 6),
(54, 5, NULL, 'qualitatskontrolle.jpeg', 5),
(55, 5, NULL, 'messgerate.jpeg', 4),
(56, 5, NULL, 'frenko.jpeg', 3),
(57, 5, NULL, 'mitutoyo-c-3000.jpeg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `user_agent` varchar(400) NOT NULL,
  `ip` int(12) unsigned NOT NULL,
  `date-date` date NOT NULL,
  `date-time` time NOT NULL,
  `refer_domain` varchar(40) DEFAULT NULL,
  `refer` varchar(500) DEFAULT NULL,
  `refer_enc` varchar(500) DEFAULT NULL,
  `start_page` varchar(500) NOT NULL,
  `country` varchar(40) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`user_agent`, `ip`, `date-date`, `date-time`, `refer_domain`, `refer`, `refer_enc`, `start_page`, `country`, `city`) VALUES
('Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2427.7 Safari/537.36 OPR/32.0.1910.0 (Edition developer)', 2130706433, '2015-07-04', '11:29:59', NULL, NULL, '', 'http://minavto.by/de', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(3) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `name`) VALUES
(1, 'article'),
(8, 'files'),
(9, 'gallery'),
(10, 'global_url'),
(11, 'menu'),
(13, 'moduls'),
(7, 'news'),
(6, 'news_category'),
(14, 'slider'),
(15, 'slides'),
(22, 'upload'),
(20, 'video');

-- --------------------------------------------------------

--
-- Структура таблицы `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `text_ru` text,
  `text_en` text,
  `text_de` text,
  `text_pl` text,
  `text_by` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `text`
--

INSERT INTO `text` (`id_table`, `id_row`, `text_ru`, `text_en`, `text_de`, `text_pl`, `text_by`) VALUES
(1, 3, '<h4>НАШИ ПРЕИМУЩЕСТВА:</h4>\r\n\r\n<ol>\r\n	<li>Мощная производственная база, оснащенная современным и высокоточным оборудованием, позволяющим достичь прецизионной точности производимых нами изделий до 1 мкм (1/1000 мм);</li>\r\n	<li>Использование режущего инструмента ведущих мировых марок для обеспечения высокого качества производимой продукции;</li>\r\n	<li>Квалифицированный, прошедший обучение и стажировку на заводах в Германии, персонал;</li>\r\n	<li>Являясь частью крупного холдинга, наше предприятие способно расширить спектр предлагаемых услуг за&nbsp;счёт нового оборудования, реализации сложных проектов с&nbsp;участием немецких партнёров.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>МАТЕРИАЛЬНО-ТЕХНИЧЕСКАЯ БАЗА</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border="0" cellspacing="0" style="margin: 5px; height: 215px; width: 679px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Токарные станки с ЧПУ:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Gildemeister: GLD25,&nbsp; GD12, GD16, GLD12</li>\r\n				<li>Traub: TNL16</li>\r\n				<li>Mazak Super Quick Tum 18 MS</li>\r\n				<li>Citizen A32</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">6-шп. токарные автоматы:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Index MS25</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Фрезерные станки:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Mikron</li>\r\n				<li>Lambert 124, 248</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Шлифовальные станки:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Nomoco</li>\r\n				<li>SASL</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Накатные станки:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>PeeweeP24U</li>\r\n				<li>Jung P24</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Установка для индуктивной закалки</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Fiand</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Моечные машины</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Kia</li>\r\n				<li>Java</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>ЛОЗУНГ ПОЛИТИКИ ПРЕДПРИЯТИЯ</em></h3>\r\n\r\n<p align="center"><img align="center" alt="Лозунг политики предприятия" height="220" src="http://minavto.by/img/upload/slogan.jpg" width="250" /></p>', '<h4>OUR ADVANTAGES:</h4>\r\n<ol>\r\n<li>Powerful production facilities equipped with the most up-to-date and high-precision tools which ensure the precision accuracy of our products up to 1 &micro;m (1/1000 mm).;</li>\r\n<li>Cutting tools produced by world leading manufacturers to guarantee the high quality of manufactured products.;</li>\r\n<li>High skill personnel who received training and work experience at the plants in Germany;</li>\r\n<li>As a part of a large holding, our enterprise can expand its range of services by means of new equipment and implementation of large-scale projects with the participation of German partners.</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><strong><em>MATERIAL AND TECHNICAL RESOURCES:</em></strong></p>\r\n<p>&nbsp;</p>\r\n<table style="margin: 5px; height: 215px; width: 679px;" border="0" cellspacing="0">\r\n\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Numerical control lathes:</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>Gildemeister: GLD25,&nbsp; GD12, GD16, GLD12</li>\r\n<li>Traub: TNL16</li>\r\n<li>Mazak Super Quick Tum 18 MS</li>\r\n<li>Citizen A32</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">6-spindle automatic lathes:</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>Index MS25</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Milling machines:</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>Mikron</li>\r\n<li>Lambert 124, 248</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Grinding machines:</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>Nomoco</li>\r\n<li>SASL</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Deep rolling machines:</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>PeeweeP24U</li>\r\n<li>Jung P24</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Fiand Induction Hardening Unit</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>&nbsp;Fiand</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="padding: 0px 5px;" align="right" valign="top">Power washers</td>\r\n<td>\r\n<ul style="list-style-type: square;">\r\n<li>&nbsp;Kia</li>\r\n<li>Java</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n\r\n</table>', '<h4>UNSERE VORTEILE:</h4>\r\n\r\n<ol>\r\n	<li>Leistungsstarke Produktionsbasis, ausger&uuml;stet mit modernen und hochpr&auml;zisen Maschinen, erm&ouml;glicht Fertigungspr&auml;zision von bis zu 1&micro;m (1/1000mm);</li>\r\n	<li>Einsatz von Schneidewerkzeugen weltweitf&uuml;hrender Marken zur Sicherung der h&ouml;chsten Produktqualit&auml;t;</li>\r\n	<li>Qualifizierte, in deutschen Werken ausgebildete und geschulte Fachkr&auml;fte;</li>\r\n	<li>Als Mitglied einer gro&szlig;en Holding kann unser Unternehmen durch Investition neuer Maschinen, komplexe Projekte unter Beteiligung deutscher Partner umsetzen.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>TECHNIK</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border="0" cellspacing="0" style="margin: 5px; height: 215px; width: 679px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">CNC-Drehmaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Gildemeister: GLD25,&nbsp; GD12, GD16, GLD12</li>\r\n				<li>Traub: TNL16</li>\r\n				<li>Mazak Super Quick Tum 18 MS</li>\r\n				<li>Citizen A32</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">6-Spindeldrehautomaten:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Index MS25</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Fr&auml;smaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Mikron</li>\r\n				<li>Lambert 124, 248</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Schleifmaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Nomoco</li>\r\n				<li>SASL</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Gewinderollmaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>PeeweeP24U</li>\r\n				<li>Jung P24</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Induktionsh&auml;rtemaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Fiand</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Waschmaschinen:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Kia</li>\r\n				<li>Java</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>UNTERNEHMENSMOTTO</em></h3>\r\n\r\n<p align="center"><img align="center" alt="UNTERNEHMENSMOTTO" height="220" src="http://minavto.by/img/upload/slogan.jpg" width="250" /></p>', '<h4>NASZE ZALETY:</h4>\r\n\r\n<ol>\r\n	<li>Solidna baza produkcyjna, wyposażona w nowoczesne i precyzyjne urządzenia, pozwalająca na osiągnięcie precyzji produkowanych wyrob&oacute;w do 1 &micro;m (1/1000 mm);</li>\r\n	<li>Korzystanie z narzędzi skrawających wiodących światowych producent&oacute;w do zapewnienia wysokiej jakości produkt&oacute;w;</li>\r\n	<li>Wykwalifikowany personel, szkolenia i staże w fabrykach w Niemczech;</li>\r\n	<li>Jesteśmy częścią dużej sp&oacute;łki holdingowej, nasza firma jest w stanie rozszerzyć zakres oferowanych usług na bazie nowego sprzętu oraz realizacji skomplikowanych projekt&oacute;w z udziałem partner&oacute;w niemieckich.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>DANE TECHNICZNE PARKU MASZYNOWEGO:</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border="0" cellspacing="0" style="margin: 5px; height: 215px; width: 679px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Tokarki CNC:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Gildemeister: GLD25, GD12, GD16, GLD12</li>\r\n				<li>Traub: TNL16</li>\r\n				<li>Mazak Super Quick Tum 18 MS</li>\r\n				<li>Citizen A32</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">6-wrzecione automatyczne tokarki:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Index MS25</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Maszyny frezowe:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Mikron</li>\r\n				<li>Lambert 124, 248</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Maszyny do szlifowania:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Nomoco</li>\r\n				<li>SASL</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Maszyny zawijające:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>PeeweeP24U</li>\r\n				<li>Jung P24</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Urządzenie do hartowania indukcyjnego:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Fiand</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Maszyny do mycia:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Kia</li>\r\n				<li>Java</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h3><em>HASŁO POLITYKI GOSPODARCZEJ:</em></h3>\r\n\r\n<p align="center"><img align="center" alt="HASŁO POLITYKI GOSPODARCZEJ" height="220" src="http://minavto.by/img/upload/slogan.jpg" width="250" /></p>', '<h4>НАША ПЕРАВАГА:</h4>\r\n\r\n<ol>\r\n	<li>Магутная вытворчая база аснашчана сучасным і высокадакладным абсталяваннем, што дазваляе дасягнуць прэцызійнай дакладнасці вырабленай прадукцыі да 1 мкм (1/1000мм);</li>\r\n	<li>Выкарыстанне рэжучага інструмента вядучых сусветных марак для забеспячэння высокай якасці прадукцыі, якую мы вырабляем;</li>\r\n	<li>Кваліфікаваны персанал, які прайшоў навучанне і стажыроўку на заводах у Германіі;</li>\r\n	<li>З&rsquo;яўляючыся часткай буйнога холдынга, наша прадпрыемства мае магчымасць пашырыць спектр паслуг, якія прапануюцца, за кошт новага абсталявання, рэалізацыі складаных праектаў з удзелам нямецкіх партнёраў.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>МАТЭРЫЯЛЬНА-ТЭХНІЧНАЯ БАЗА</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border="0" cellspacing="0" style="margin: 5px; height: 215px; width: 679px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Такарныя станкі з ЛПК:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Gildemeister: GLD25,&nbsp; GD12, GD16, GLD12</li>\r\n				<li>Traub: TNL16</li>\r\n				<li>Mazak Super Quick Tum 18 MS</li>\r\n				<li>Citizen A32</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">6-шп. такарныя аўтаматы:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Index MS25</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Фрэзерныя станкі:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Mikron</li>\r\n				<li>Lambert 124, 248</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Шліфавальныя станкіи:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>Nomoco</li>\r\n				<li>SASL</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Накатныя станкі:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>PeeweeP24U</li>\r\n				<li>Jung P24</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Устаноўка для індукцыйнай загартоўкі:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Fiand</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="right" style="padding: 0px 5px;" valign="top">Моечныя машыны:</td>\r\n			<td>\r\n			<ul style="list-style-type: square;">\r\n				<li>&nbsp;Kia</li>\r\n				<li>Java</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>ЛОЗУНГ ПАЛІТЫКІ ПРАДПРЫЕМСТВА</em></h3>\r\n\r\n<p align="center"><img align="center" alt="ЛОЗУНГ ПАЛІТЫКІ ПРАДПРЫЕМСТВА" height="220" src="http://minavto.by/img/upload/slogan.jpg" width="250" /></p>'),
(1, 4, '<h2>Литьё пластмасс</h2>\r\n\r\n<p>Одним из направлений деятельности предприятия является литьё пластмасс под давлением.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Качественные, изготовленные в Германии&nbsp; пресс-формы и многолетний опыт в производстве изделий из пластмасс позволяют производить высококачественную продукцию в приемлемые сроки.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Наше изделие комбинированной группы металл-пластмасса &laquo;вал-шестерня&raquo; производят всего несколько фирм в Европе.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Литейный цех оснащен высокотехнологичными машинами немецкого и австрийского &nbsp;производства с усилием запирания от 15 до 175 т и объемом впрыска от 20 до 400 см3:</strong></p>\r\n\r\n<ul style="list-style-type: square;">\r\n	<li>Engel ES 700/175</li>\r\n	<li>Engel ES 330/80 HLST</li>\r\n	<li>Demag Extra 50-200</li>\r\n	<li>Demag Ergotech 60/420-310</li>\r\n	<li>Demag Ergotech System 100/420-430</li>\r\n	<li>Demag 150-452 NC</li>\r\n	<li>Demag 160/520-600 NCV</li>\r\n	<li>Sumitomo</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Мы производим комплектующие для таких ведущих мировых компаний как Bosch, Continental,&nbsp; Nidec, Valeo, что является еще одним подтверждением высочайшего качества производимой нами продукции.</p>\r\n', '<h2>MATERIAL AND TECHNICAL RESOURCES</h2>\r\n\r\n<p>The foundry is equipped with high technology machines of German and Austrian manufactures which provide locking pressure ranging from 15 to 175 tons and 3&ndash;400 cm3 volume molded per shop:</p>\r\n\r\n<ul style="list-style-type: square;">\r\n	<li>Engel ES 700/175</li>\r\n	<li>Engel ES 330/80 HLST</li>\r\n	<li>Demag Extra 50-200</li>\r\n	<li>Demag Ergotech 60/420-310</li>\r\n	<li>Demag Ergotech System 100/420-430</li>\r\n	<li>Demag 150-452 NC</li>\r\n	<li>Demag 160/520-600 NCV</li>\r\n	<li>Sumitomo</li>\r\n</ul>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>We manufacture components for such world leaders as Bosch, Continental, Nidec and Valeo what proves the highest quality of the products we produce.</p>\r\n', '<h2>TECHNIK</h2>\r\n\r\n<p><strong>Die Kunststoffabteilung ist mit deutschen und &ouml;sterreichischen High-Tech-Maschinen mit Schlie&szlig;kraft von15 to bis 175 to und Hubvolumen von 3 bis 400 cm3 ausgestattet:</strong></p>\r\n\r\n<ul style="list-style-type: square;">\r\n	<li>Engel ES 700/175</li>\r\n	<li>Engel ES 330/80 HLST</li>\r\n	<li>Demag Extra 50-200</li>\r\n	<li>Demag Ergotech 60/420-310</li>\r\n	<li>Demag Ergotech System 100/420-430</li>\r\n	<li>Demag 150-452 NC</li>\r\n	<li>Demag 160/520-600 NCV</li>\r\n	<li>Sumitomo</li>\r\n</ul>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>Wir beliefern weltweitf&uuml;hrende Unternehmen wie Bosch, Continental, Nidec, Valeo, was die h&ouml;chste Qualit&auml;t unserer Produkte ein weiteres Mal beweist.</p>\r\n', '<h2>DANE TECHNICZNE PARKU MASZYNOWEGO:</h2>\r\n<p>Wydział przetw&oacute;rstwa tworzyw sztucznych jest wyposażony w technologicznie zaawansowane maszyny produkcji niemieckiej i austriackiej z życiem blokowania od 15 do 175 ton i objętości wtrysku od 3 do 400 cm3:</p>\r\n<ul style="list-style-type: square;">\r\n<li>Engel ES 700/175</li>\r\n<li>Engel ES 330/80 HLST</li>\r\n<li>Demag Extra 50-200</li>\r\n<li>Demag Ergotech 60/420-310</li>\r\n<li>Demag Ergotech System 100/420-430</li>\r\n<li>Demag 150-452 NC</li>\r\n<li>Demag 160/520-600 NCV</li>\r\n<li>Sumitomo</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Produkujemy elementy dla wiodących światowych firm, takich jak Bosch, Continental, Valeo, Nidec, Hormann i jest to kolejnym potwierdzeniem wysokiej jakości naszych produkt&oacute;w.</p>', '<h2>МАТЭРЫЯЛЬНА-ТЭХНІЧНАЯ БАЗА</h2>\r\n<p>Ліцейны цэх аснашчаны высокатэхналагічнымі машынамі нямецкай і аўстрыйскай вытворчасці з намаганнем замыкання ад 15 да 175 т і аб&rsquo;ёмам упырсквання ад 3 да 400 см3:</p>\r\n<ul style="list-style-type: square;">\r\n<li>Engel ES 700/175</li>\r\n<li>Engel ES 330/80 HLST</li>\r\n<li>Demag Extra 50-200</li>\r\n<li>Demag Ergotech 60/420-310</li>\r\n<li>Demag Ergotech System 100/420-430</li>\r\n<li>Demag 150-452 NC</li>\r\n<li>Demag 160/520-600 NCV</li>\r\n<li>Sumitomo</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Мы вырабляем камплектуючыя для такіх вядучых сусветных кампаній як Bosch, Continental, Nidec, Valeo, што з&rsquo;яўляецца яшчэ адным пацверджаннем найвышэйшай якасці вырабленай намі прадукцыі.</p>'),
(1, 5, '<p>Даже в условиях автоматизации большинства современных технологических процессов, в автомобилестроении остались области, где не обойтись без человеческих рук. Прежде всего, это касается тех узлов, в которых присутствуют гибкие комплектующие, например, резиновые шланги.</p>', '<p>Even though most of the state-of-the-industry manufacturing methods are currently automated, there are still some areas in the motor vehicle industry which require manual work. Especially it’s true for units consisting of flexible components - for example, rubber hoses.</p>', '<p>Selbst bei der Automatisierung der meisten Fertigungsprozesse gibt es in der Automobilindustrie noch Bereiche, in denen auf Menschenhand nicht verzichtet kann. Dies betrifft vor allem Baugruppen mit Gummiteilen, zum Beispiel, mit Gummischl&auml;uchen.</p>', '<p>Nawet w obliczu automatyzacji nowoczesnych procesów technologicznych w branży motoryzacyjnej są jeszcze obszary gdzie nic nie można zrobić bez rąk ludzkich. Przede wszystkim odnosi się to do węzłów, zawierających elastyczne komponenty, takie jak węże gumowe.</p>', '<p>Нават ва ўмовах аўтаматызацыі большасці сучасных тэхналагічных працэсаў, у аўтамабілебудаванні засталіся вобласці, дзе не абысціся без чалавечых рук. Перш за ўсё, гэта датычыцца тых вузлоў, у якіх прысутнічаюць гнуткія камплектуючыя, напрыклад, гумавыя шлангі.</p>'),
(1, 6, '<h2><em>СИСТЕМА МЕНЕДЖЕМЕНТА КАЧЕСТВА</em></h2>\r\n\r\n<p>С 2004&nbsp;года система качества предприятия имеет международный сертификат качества ISO 9001:2008, который подтверждается ежегодными аудитами DQS.</p>\r\n\r\n<p>Сертификация по&nbsp;международным стандартам дает возможность производить и&nbsp;поставлять продукцию в&nbsp;соответствии с&nbsp;требованиями европейских производителей. Для этого на&nbsp;предприятии внедрены следующие специальные процедуры:</p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li>анализ видов и&nbsp;последствий потенциальных дефектов (FMEA),</li>\r\n	<li>перспективное планирование качества продукции и&nbsp;планы управления качеством (APQP/CP),</li>\r\n	<li>одобрение производства автомобильного компонента (PPAP),</li>\r\n	<li>статистическое управление процессами (SPC),</li>\r\n	<li>обработка рекламаций (PDCA) и&nbsp;введение предупредительных и&nbsp;корректирующих мер с&nbsp;целью непрерывного улучшения производственных и&nbsp;вспомогательных процессов.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>МАТЕРИАЛЬНО-ТЕХНИЧЕСКАЯ БАЗА</em></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>Предприятие оснащено лабораторией с современным&nbsp; и высокоточным измерительным оборудованием:</u></p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li style="margin: 5px 0px;">Универсальный зубоизмерительный центр Klingelnberg</li>\r\n	<li style="margin: 5px 0px;">Прибор для измерения циклической погрешности червячных передач Frenco</li>\r\n	<li style="margin: 5px 0px;">Контурограф Mitutoyo</li>\r\n	<li style="margin: 5px 0px;">Универсальный измерительный 3D-прибор Opticline и др.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Достижения в области качества &ndash; результат работы коллектива высококвалифицированных профессионалов. Каждый этап производственного процесса тщательно продуман и направлен на достижение максимального результата.</p>\r\n', '<h2><em>QUALITY MANAGEMENT SYSTEM</em></h2>\r\n\r\n<p>In 2004 the quality assurance system of the enterprise was certified according to ISO 9001:2008, and it is verified by DQS audits every year.</p>\r\n\r\n<p>Certification according to international standards ensures that our products are manufactured and supplied in compliance with the requirements of European manufacturers. For this effect, the following special procedures are implemented at the enterprise:</p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li>Failure Mode and Effects Analysis(FMEA);</li>\r\n	<li>Advanced Product Quality Planning and Control Planning (APQP/CP);</li>\r\n	<li>Production Part Approval Process (PPAP);</li>\r\n	<li>Statistical Process Control (SPC);</li>\r\n	<li>Plan, Develop, Control, Action (PDCA) and implementation of preventive and corrective measures to continuously improve manufacturing and off-line processes.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>MATERIAL AND TECHNICAL RESOURCES</em></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>The enterprise has a laboratory equipped with the most up-to-date and high-precision measuring equipment:</u></p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li style="margin: 5px 0px;">Klingelnberg measuring center for geometric testing of gears;</li>\r\n	<li style="margin: 5px 0px;">Frenco worm gear circumferential backlash measuring instrument;</li>\r\n	<li style="margin: 5px 0px;">Mitutoyo contour measuring instrument;</li>\r\n	<li style="margin: 5px 0px;">Opticline multipurpose 3D-tester, etc.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Our achievements in the area of quality assurance are the result of joint efforts of our expert team. Each production stage is carefully thought-out and focused on the best performance.</p>\r\n', '<h2><em>QUALIT&Auml;TSMANAGEMENTSYSTEM</em></h2>\r\n\r\n<p>Seit 2004 hat das Qualit&auml;tsmanagementsystem unseres Unternehmens die internationale Zertifizierung nach ISO 9001, welche j&auml;hrlich durch &Uuml;berwachungs-Audits der DQS nachgewiesen wird.</p>\r\n\r\n<p>Die Internationale Zertifizierung erm&ouml;glicht uns, Produkte nach den Anforderungen europ&auml;ischer Hersteller zu fertigen und zu liefern. Zu diesem Zweck wurden in unserem Unternehmen folgende Verfahren eingef&uuml;hrt:</p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li>Fehlerm&ouml;glichkeits- und -einflussanalyse (FMEA);</li>\r\n	<li>fortschrittliche Produktqualit&auml;tsplanung und Qualit&auml;tsmanagementpl&auml;ne (APQP/CP);</li>\r\n	<li>Produktionsteil-Abnahmeverfahren (PPAP);</li>\r\n	<li>statistische Prozesslenkung (SPC);</li>\r\n	<li>Bearbeitung von Reklamationen (PDCA) und Durchf&uuml;hrung von Vorsorge- und Anpassungsma&szlig;nahmen zur kontinuierlichen Verbesserung der Produktions- und Hilfsprozesse.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>TECHNIK</em></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><u>Das Unternehmen verf&uuml;gt &uuml;ber ein Labor mit moderner und hochpr&auml;ziser Messtechnik:</u></strong></p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li style="margin: 5px 0px;">Verzahnungsmesszentrum Klingelnberg;</li>\r\n	<li style="margin: 5px 0px;">Einflankenw&auml;lzpr&uuml;fger&auml;t f&uuml;r Schnecken Frenco;</li>\r\n	<li style="margin: 5px 0px;">Konturmessger&auml;t Mitutoyo;</li>\r\n	<li style="margin: 5px 0px;">3D-Universalmessger&auml;t Opticline usw.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ein Team von hochqualifizierten Fachleuten erm&ouml;glicht Erfolge bei der Qualit&auml;tssicherung. Jeder Produktionsschritt ist durchdacht und auf ein maximales Ergebnis ausgerichtet.</p>\r\n', '<h2><em>SYSTEM ZARZĄDZANIA JAKOŚCIĄ</em></h2>\r\n\r\n<p>Od 2004&nbsp;2004 roku system zarządzania jakością posiada Międzynarodowy Certyfikat Jakości ISO 9001:2008, co jest potwierdzone przez coroczne audyty DQS.</p>\r\n\r\n<p>Certyfikacja zgodnie z międzynarodowymi standardami oferuje możliwość produkcji i dostarczania produkt&oacute;w zgodnie z wymogami europejskich producent&oacute;w. Aby to osiągnąć, firma wprowadza następujące specjalne procedury:</p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li>Analiza typ&oacute;w i wynik&oacute;w potencjalnych wad (FMEA);</li>\r\n	<li>Planowanie jakości produktu i planu kontroli (APQP/CP);</li>\r\n	<li>Zatwierdzenie produkcji części samochodowych (PPAP);</li>\r\n	<li>Statystyczna kontrola procesu (SPC);</li>\r\n	<li>Przetwarzanie roszczeń (PDCA) i wprowadzenia środk&oacute;w zapobiegawczych i naprawczych w celu ciągłego doskonalenia proces&oacute;w produkcji i proces&oacute;w zależnych.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><em>DANE TECHNICZNE PARKU MASZYNOWEGO</em></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>Przedsiębiorstwo wyposażone jest w nowoczesne laboratorium i precyzyjne urządzenia pomiarowe:</u></p>\r\n\r\n<ul style="list-style-type: circle;">\r\n	<li style="margin: 5px 0px;">Centrum zębopomiarowe wszechstronne firmy Klingelnberg;</li>\r\n	<li style="margin: 5px 0px;">Urządzenie do pomiaru przekładni ślimakowych firmy Frenco;</li>\r\n	<li style="margin: 5px 0px;">Konturograf firmy Mitutoyo;</li>\r\n	<li style="margin: 5px 0px;">Optyczne pomiary geometrii element&oacute;w obrotowo symetrycznych mierzonych przy użyciu urządzenia pomiarowego 3D Opticline firmy Jenoptik i inne.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Osiągnięcia w dziedzinie jakości są wynikiem pracy wysoko wykwalifikowanych specjalist&oacute;w. Każdy etap procesu produkcyjnego jest dokładnie przemyślany i ma na celu osiągnąć maksymalne wyniki.</p>\r\n', '<h2><em>СІСТЭМА МЕНЕДЖМЕНТУ ЯКАСЦІ</em></h2>\r\n<p>З 2004 года сістэма якасці прадпрыемства мае міжнародны сертыфікат якасці ISO 9001:2008, які пацвярджаецца штогадовымі аўдытамі DQS.</p>\r\n<p>Сертыфікацыя па міжнародных стандартах дае магчымасць вырабляць і пастаўляць прадукцыю ў адпаведнасці з патрабаваннямі еўрапейскіх вытворцаў. Для гэтага на прадпрыемстве ўкаранёны наступныя спецыяльныя працэдуры:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>аналіз відаў і вынікаў патэнцыяльных дэфектаў (FMEA);</li>\r\n<li>перспектыўнае планаванне якасці прадукцыі і планы кіравання якасцю (APQP/CP);</li>\r\n<li>адабрэнне вытворчасці аўтамабільнага кампанента (PPAP);</li>\r\n<li>статыстычнае кіраванне працэсамі (SPC);</li>\r\n<li>апрацоўка рэкламацый (PDCA) і ўвядзенне папераджальных і карэкцыйных мер з мэтай непарыўнага паляпшэння вытворчых і дапаможных працэсаў.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><em>МАТЭРЫЯЛЬНА-ТЭХНІЧНАЯ БАЗА</em></h3>\r\n<p>&nbsp;</p>\r\n<p><u>Прадпрыемства аснашчана лабараторыяй з сучасным і высокадакладным вымяральным абсталяваннем:</u></p>\r\n<ul style="list-style-type: circle;">\r\n<li style="margin: 5px 0px;">Універсальны зубавымяральны цэнтр Klingelnberg</li>\r\n<li style="margin: 5px 0px;">Прыбор для вымярэння цыклічнай хібнасці чарвячных перадач Frenco</li>\r\n<li style="margin: 5px 0px;">Контураграф Mitutoyo</li>\r\n<li style="margin: 5px 0px;">Універсальны вымяральны 3D-прыбор Opticline і інш.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Дасягненні ў галіне якасці – вынік работы калектыву высокакваліфікаваных прафесіяналаў. Кожны этап вытворчага працэсу дасканала прадуманы і накіраваны на дасягненне максімальнага выніку.</p>');
INSERT INTO `text` (`id_table`, `id_row`, `text_ru`, `text_en`, `text_de`, `text_pl`, `text_by`) VALUES
(1, 7, '<h3 align="justify">ИП ООО &quot;Минавто&quot;</h3>\r\n\r\n<p align="justify">ул. Минская, 2-201, 223141Логойск, Минская область, РБ</p>\r\n\r\n<p align="justify">Телефон: &nbsp;&nbsp; +375 1774 44371 (помощник директора)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 43108 (технический &nbsp;отдел)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 55917 (бухгалтерия)</p>\r\n\r\n<p align="justify">Факс: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +375 1774 54739</p>\r\n\r\n<p align="justify">Эл. почта: &nbsp;<a href="mailto:info@minavto.by">info@minavto.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>&nbsp;\r\n<table border="0" style="margin-bottom: 10px; height: 386px; width: 983px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Лео Штыс</strong></u></p>\r\n\r\n			<p>Директор</p>\r\n\r\n			<p><span>+37544 772 74 59</span></p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aleo.stys@minavto.by" target="_blank">leo.stys@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">\r\n			<p><img alt="Директор" height="150" src="http://minavto.by/img/upload/leo-stys.png" title="Директор" width="150" /></p>\r\n			</td>\r\n			<td align="center" style="width: 100px;" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Сергей Дейнор</strong></u></p>\r\n\r\n			<p>Технический директор</p>\r\n\r\n			<p>+37544 585 50 98</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3as.deinor@minavto.by" target="_blank">s.deinor@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">&nbsp;<img alt="Технический директор" height="150" src="http://minavto.by/img/upload/sergey-deinor.png" title="Технический директор" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Валентин Костюк</strong></u></p>\r\n\r\n			<p>Заместитель директора</p>\r\n\r\n			<p>по экономике и финансам</p>\r\n\r\n			<p>+37529 161 28 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.kostiuk@minavto.by" target="_blank">v.kostiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Заместитель директора по экономике и финансам" src="http://minavto.by/img/upload/valentine-kostyuk.png" title="Заместитель директора по экономике и финансам" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Михаил Яблонский</strong></u></p>\r\n\r\n			<p>Заместитель директора</p>\r\n\r\n			<p>по качеству</p>\r\n\r\n			<p>+37529 333 45 32</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3am.jablonski@minavto.by" target="_blank">m.jablonski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Заместитель директора по качеству" height="150" src="http://minavto.by/img/upload/michael-yablonski.png" title="Заместитель директора по качеству" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Людмила Грушевская</strong></u></p>\r\n\r\n			<p>Менеджер отдела сбыта</p>\r\n\r\n			<p>+37529 696 37 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3al.grushevskaya@minavto.by" target="_blank">l.grushevskaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Помощник директора" height="150" src="http://minavto.by/img/upload/lyudmila-grushevskaya.png" title="Помощник директора" width="150" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Татьяна Брисюк</strong></u></p>\r\n\r\n			<p>Главный бухгалтер</p>\r\n\r\n			<p>+37529 376 13 79&nbsp;</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3at.brisiuk@minavto.by" target="_blank">t.brisiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Главный бухгалтер" height="150" src="http://minavto.by/img/upload/tatyana-brisyuk.png" title="Главный бухгалтер" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Владимир Стригалёв</strong></u></p>\r\n\r\n			<p>Начальник цеха сборки</p>\r\n\r\n			<p>+37529 625 56 05</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.strigalev@minavto.by" target="_blank">v.strigalev@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Начальник цеха термопластовавтоматов" height="150" src="http://minavto.by/img/upload/vladimir-strigalev.png" title="Начальник цеха термопластовавтоматов" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Александр Навицкий</strong></u></p>\r\n\r\n			<p>Начальник производства</p>\r\n\r\n			<p>+37529 155 39 87</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aa.navitski@minavto.by" target="_blank">a.navitski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Начальник производства" height="150" src="http://minavto.by/img/upload/alexander-navitski.png" title="Начальник производства" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Олег Божков</strong></u></p>\r\n\r\n			<p>Менеджер по</p>\r\n\r\n			<p>организации закупок</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.boschkow@minavto.by" target="_blank">o.boschkow@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Менеджер по организации закупок" height="150" src="http://minavto.by/img/upload/bozhkov-oleg.png" title="Менеджер по организации закупок" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Ольга Саврицкая</strong></u></p>\r\n\r\n			<p>Инспектор по кадрам</p>\r\n\r\n			<p>+37544 544 43 63</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.savrickaya@minavto.by" target="_blank">o.savrickaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Инспектор по кадрам" height="150" src="http://minavto.by/img/upload/olga-savritskaya.png" title="Инспектор по кадрам" width="150" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div id="map">&nbsp;</div>', '<h3 align="justify">IP OOO &quot;MINAVTO&quot;.</h3>\r\n\r\n<p align="justify">Minskaya Str. 2/201, 223141 Logoysk, Minsk Region, Belarus</p>\r\n\r\n<p align="justify">Phone: &nbsp; &nbsp; &nbsp;+375 1774 44371 (Director&acute;s Assistant)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 43108 (Technical Department)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 55917 (Accounts Department)</p>\r\n\r\n<p align="justify">Факс:&nbsp; &nbsp; &nbsp; &nbsp; +375 1774 54739</p>\r\n\r\n<p align="justify">Эл. почта: &nbsp;<a href="mailto:info@minavto.by">info@minavto.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>&nbsp;\r\n<table border="0" style="margin-bottom: 10px; height: 386px; width: 983px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Leo Stys</strong></u></p>\r\n\r\n			<p>Managing Director</p>\r\n\r\n			<p><span>+37544 772 74 59</span></p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aleo.stys@minavto.by" target="_blank">leo.stys@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">\r\n			<p><img alt="Managing Director" height="150" src="http://minavto.by/img/upload/leo-stys.png" title="Managing Director" width="150" /></p>\r\n			</td>\r\n			<td align="center" style="width: 100px;" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Sergey Deinor</strong></u></p>\r\n\r\n			<p>Technical director</p>\r\n\r\n			<p>+37544 585 50 98</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3as.deinor@minavto.by" target="_blank">s.deinor@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">&nbsp;<img alt="Technical director" height="150" src="http://minavto.by/img/upload/sergey-deinor.png" title="Technical director" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Valentine Kostyuk</strong></u></p>\r\n\r\n			<p>Finance director</p>\r\n\r\n			<p>+37529 161 28 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.kostiuk@minavto.by" target="_blank">v.kostiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Finance director" src="http://minavto.by/img/upload/valentine-kostyuk.png" title="Finance director" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Michael Yablonski</strong></u></p>\r\n\r\n			<p>Quality Management</p>\r\n\r\n			<p>Representative</p>\r\n\r\n			<p>+37529 333 45 32</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3am.jablonski@minavto.by" target="_blank">m.jablonski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Quality Management Representative" height="150" src="http://minavto.by/img/upload/michael-yablonski.png" title="Quality Management Representative" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Lyudmila Grushevskaya</strong></u></p>\r\n\r\n			<p>Key Account Manager</p>\r\n\r\n			<p>+37529 696 37 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3al.grushevskaya@minavto.by" target="_blank">l.grushevskaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Key Account Manager" height="150" src="http://minavto.by/img/upload/lyudmila-grushevskaya.png" title="Key Account Manager" width="150" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Tatyana Brisyuk</strong></u></p>\r\n\r\n			<p>Chief Accountant</p>\r\n\r\n			<p>+37529 376 13 79&nbsp;</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3at.brisiuk@minavto.by" target="_blank">t.brisiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Chief Accountant" height="150" src="http://minavto.by/img/upload/tatyana-brisyuk.png" title="Chief Accountant" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Vladimir Strigalev</strong></u></p>\r\n\r\n			<p>Assembly Shop Manager</p>\r\n\r\n			<p>+37529 625 56 05</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.strigalev@minavto.by" target="_blank">v.strigalev@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Assembly Shop Manager" height="150" src="http://minavto.by/img/upload/vladimir-strigalev.png" title="Assembly Shop Manager" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Alexander Navitski</strong></u></p>\r\n\r\n			<p>Production Manager</p>\r\n\r\n			<p>+37529 155 39 87</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aa.navitski@minavto.by" target="_blank">a.navitski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Production Manager" height="150" src="http://minavto.by/img/upload/alexander-navitski.png" title="Production Manager" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Oleg Bozhkov</strong></u></p>\r\n\r\n			<p>Purchasing Manager</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.boschkow@minavto.by" target="_blank">o.boschkow@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Purchasing Manager" height="150" src="http://minavto.by/img/upload/bozhkov-oleg.png" title="Purchasing Manager" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Olga Savritskaya</strong></u></p>\r\n\r\n			<p>Human Resources Manager</p>\r\n\r\n			<p>+37544 544 43 63</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.savrickaya@minavto.by" target="_blank">o.savrickaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Human Resources Manager" height="150" src="http://minavto.by/img/upload/olga-savritskaya.png" title="Human Resources Manager" width="150" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div id="map">&nbsp;</div>', '<h3 align="justify">IP OOO &quot;MINAVTO&quot;.</h3>\r\n\r\n<p align="justify">Minskaya Str. 2/201, 223141 Logoysk, Minsk Region, Belarus</p>\r\n\r\n<p align="justify">Telephone: &nbsp; &nbsp;+375 1774 44371 (Director&acute;s Assistant)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 43108 (Technical Department)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 55917 (Accounts Department)</p>\r\n\r\n<p align="justify">Fax: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 54739</p>\r\n\r\n<p align="justify">E-mail: &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<a href="mailto:info@minavto.by">info@minavto.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>&nbsp;\r\n<table border="0" style="margin-bottom: 10px; height: 386px; width: 983px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Leo Stys</strong></u></p>\r\n\r\n			<p>Managing Director</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aleo.stys@minavto.by" target="_blank">leo.stys@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">\r\n			<p><img alt="Managing Director" height="150" src="http://minavto.by/img/upload/leo-stys.png" title="Managing Director" width="150" /></p>\r\n			</td>\r\n			<td align="center" style="width: 100px;" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><strong>Sergey Deinor</strong></p>\r\n\r\n			<p>Technical Director</p>\r\n\r\n			<p>+37544 585 50 98</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3as.deinor@minavto.by" target="_blank">s.deinor@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">&nbsp;<img alt="Technical Director" height="150" src="http://minavto.by/img/upload/sergey-deinor.png" title="Technical Director" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong><strong>Valentine Kostyuk</strong></strong></u></p>\r\n\r\n			<p>Finance Director</p>\r\n\r\n			<p>+37529 161 28 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.kostiuk@minavto.by" target="_blank">v.kostiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Finance Director" src="http://minavto.by/img/upload/valentine-kostyuk.png" title="Finance Director" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Michael Yablonski</strong></u></p>\r\n\r\n			<p>Quality Management</p>\r\n\r\n			<p>Representative</p>\r\n\r\n			<p>+37529 333 45 32</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3am.jablonski@minavto.by" target="_blank">m.jablonski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Quality Management Representative" height="150" src="http://minavto.by/img/upload/michael-yablonski.png" title="Quality Management Representative" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Lyudmila Grushevskaya</strong></u></p>\r\n\r\n			<p>Key Account Manager</p>\r\n\r\n			<p>+37529 696 37 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3al.grushevskaya@minavto.by" target="_blank">l.grushevskaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Key Account Manager" height="150" src="http://minavto.by/img/upload/lyudmila-grushevskaya.png" title="Key Account Manager" width="150" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Tatyana Brisyuk</strong></u></p>\r\n\r\n			<p>Chief Accountant</p>\r\n\r\n			<p>+37529 376 13 79&nbsp;</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3at.brisiuk@minavto.by" target="_blank">t.brisiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Chief Accountant" height="150" src="http://minavto.by/img/upload/tatyana-brisyuk.png" title="Chief Accountant" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Vladimir Strigalev</strong></u></p>\r\n\r\n			<p>Assembly Shop Manager</p>\r\n\r\n			<p>+37529 625 56 05</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.strigalev@minavto.by" target="_blank">v.strigalev@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Assembly Shop Manager" height="150" src="http://minavto.by/img/upload/vladimir-strigalev.png" title="Assembly Shop Manager" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Alexander Navitski</strong></u></p>\r\n\r\n			<p>Production Manager</p>\r\n\r\n			<p>+37529 155 39 87</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aa.navitski@minavto.by" target="_blank">a.navitski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Production Manager" height="150" src="http://minavto.by/img/upload/alexander-navitski.png" title="Production Manager" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Oleg Bozhkov</strong></u></p>\r\n\r\n			<p>Purchasing Manager</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.boschkow@minavto.by" target="_blank">o.boschkow@minavto.by</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td align="center"><img alt="Purchasing Manager" height="150" src="http://minavto.by/img/upload/bozhkov-oleg.png" title="Purchasing Manager" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Olga Savritskaya</strong></u></p>\r\n\r\n			<p>Human Resources Manager</p>\r\n\r\n			<p>+37544 544 43 63</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.savrickaya@minavto.by" target="_blank">o.savrickaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Human Resources Manager" height="150" src="http://minavto.by/img/upload/olga-savritskaya.png" title="Human Resources Manager" width="150" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div id="map">&nbsp;</div>', '<h3 align="justify">Sp. z o.o. &quot;Minavto&quot;</h3>\r\n\r\n<p align="justify">ul. Mińska 2- 201, 223141, m. Logojsk, Wojew&oacute;dztwo Mińskie, Białoruś</p>\r\n\r\n<p align="justify">Telefon: &nbsp;&nbsp; +375 1774 44371 (Asystent dyrektora)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 43108 (Wydział&nbsp;techniczny)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 55917 (Wydział księgowości)</p>\r\n\r\n<p align="justify">Fax:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +375 1774 54739</p>\r\n\r\n<p align="justify">E-mail: &nbsp;<a href="mailto:info@minavto.by">info@minavto.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>&nbsp;\r\n<table border="0" style="margin-bottom: 10px; height: 386px; width: 983px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Leo Stys</strong></u></p>\r\n\r\n			<p>Dyrektor</p>\r\n\r\n			<p><span>+37544 772 74 59</span></p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aleo.stys@minavto.by" target="_blank">leo.stys@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">\r\n			<p><img alt="Dyrektor" height="150" src="http://minavto.by/img/upload/leo-stys.png" title="Dyrektor" width="150" /></p>\r\n			</td>\r\n			<td align="center" style="width: 100px;" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Sergiej Dejnor</strong></u></p>\r\n\r\n			<p>Dyrektor techniczny</p>\r\n\r\n			<p>+37544 585 50 98</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3as.deinor@minavto.by" target="_blank">s.deinor@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">&nbsp;<img alt="Dyrektor techniczny" height="150" src="http://minavto.by/img/upload/sergey-deinor.png" title="Dyrektor techniczny" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Valentin Kostiuk</strong></u></p>\r\n\r\n			<p>Zastępca dyrektora</p>\r\n\r\n			<p>na ekonomii i finans&oacute;w</p>\r\n\r\n			<p>+37529 161 28 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.kostiuk@minavto.by" target="_blank">v.kostiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Zastępca dyrektora na ekonomii i finansów" src="http://minavto.by/img/upload/valentine-kostyuk.png" title="Zastępca dyrektora na ekonomii i finansów" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Michail Jabłonski</strong></u></p>\r\n\r\n			<p>Zastępca dyrektora</p>\r\n\r\n			<p>na jakość</p>\r\n\r\n			<p>+37529 333 45 32</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3am.jablonski@minavto.by" target="_blank">m.jablonski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Заместитель директора по качеству" height="150" src="http://minavto.by/img/upload/michael-yablonski.png" title="Zastępca dyrektora na jakość" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Ludmila Gruszewska</strong></u></p>\r\n\r\n			<p>Kierownik wydziału sprzedaży</p>\r\n\r\n			<p>+37529 696 37 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3al.grushevskaya@minavto.by" target="_blank">l.grushevskaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Kierownik wydziału sprzedaży" height="150" src="http://minavto.by/img/upload/lyudmila-grushevskaya.png" title="Kierownik wydziału sprzedaży" width="150" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Tatjana Brisiuk</strong></u></p>\r\n\r\n			<p>Gł&oacute;wny księgowy</p>\r\n\r\n			<p>+37529 376 13 79&nbsp;</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3at.brisiuk@minavto.by" target="_blank">t.brisiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Główny księgowy" height="150" src="http://minavto.by/img/upload/tatyana-brisyuk.png" title="Główny księgowy" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Wladimir Strygalow</strong></u></p>\r\n\r\n			<p>Kierownik wydziału montażu</p>\r\n\r\n			<p>wyrob&oacute;w z tworzyw sztucznych</p>\r\n\r\n			<p>+37529 625 56 05</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.strigalev@minavto.by" target="_blank">v.strigalev@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Kierownik wydziału montażu wyrobów z tworzyw sztucznyc" height="150" src="http://minavto.by/img/upload/vladimir-strigalev.png" title="Kierownik wydziału montażu wyrobów z tworzyw sztucznych" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Aleksander Nawicki</strong></u></p>\r\n\r\n			<p>Kierownik produkcji</p>\r\n\r\n			<p>+37529 155 39 87</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aa.navitski@minavto.by" target="_blank">a.navitski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Kierownik produkcji" height="150" src="http://minavto.by/img/upload/alexander-navitski.png" title="Kierownik produkcji" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Oleg Bożkow</strong></u></p>\r\n\r\n			<p>Kierownik wydziału</p>\r\n\r\n			<p>zam&oacute;wień publicznych</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.boschkow@minavto.by" target="_blank">o.boschkow@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Kierownik wydziału zamówień publicznychк" height="150" src="http://minavto.by/img/upload/bozhkov-oleg.png" title="Kierownik wydziału zamówień publicznych" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Olga Sawrycka</strong></u></p>\r\n\r\n			<p>Inspektor wydziału</p>\r\n\r\n			<p>zasob&oacute;w ludzkich</p>\r\n\r\n			<p>+37544 544 43 63</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.savrickaya@minavto.by" target="_blank">o.savrickaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Inspektor wydziału zasobów ludzkich" height="150" src="http://minavto.by/img/upload/olga-savritskaya.png" title="Inspektor wydziału zasobów ludzkich" width="150" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div id="map">&nbsp;</div>', '<h3 align="justify">ЗП ТАА &ldquo;Мінаўта&rdquo;</h3>\r\n\r\n<p align="justify">223141, Рэспубліка Беларусь, Мінская вобласць, горад Лагойск, вуліца Мінская, 2-201</p>\r\n\r\n<p align="justify">Тэлефон: &nbsp;&nbsp; +375 1774 44371 (памочнік дырэктара)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 43108 (тэхнічны аддзел)</p>\r\n\r\n<p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;+375 1774 55917 (бухгалтэрыя)</p>\r\n\r\n<p align="justify">Факс: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +375 1774 54739</p>\r\n\r\n<p align="justify">Эл. почта: &nbsp;<a href="mailto:info@minavto.by">info@minavto.by</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>&nbsp;\r\n<table border="0" style="margin-bottom: 10px; height: 386px; width: 983px;">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Лео Штыс</strong></u></p>\r\n\r\n			<p>Дырэктар</p>\r\n\r\n			<p><span>+37544 772 74 59</span></p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aleo.stys@minavto.by" target="_blank">leo.stys@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">\r\n			<p><img alt="Дырэктар" height="150" src="http://minavto.by/img/upload/leo-stys.png" title="Дырэктар" width="150" /></p>\r\n			</td>\r\n			<td align="center" style="width: 100px;" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Сяргей Дэйнар</strong></u></p>\r\n\r\n			<p>Тэхнічны дырэктар</p>\r\n\r\n			<p>+37544 585 50 98</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3as.deinor@minavto.by" target="_blank">s.deinor@minavto.by</a></p>\r\n			</td>\r\n			<td align="center">&nbsp;<img alt="Тэхнічны дырэктар" height="150" src="http://minavto.by/img/upload/sergey-deinor.png" title="Тэхнічны дырэктар" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Валянцін Касцюк</strong></u></p>\r\n\r\n			<p>Намеснік дырэктара па</p>\r\n\r\n			<p>эканоміцы і фінансам</p>\r\n\r\n			<p>+37529 161 28 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.kostiuk@minavto.by" target="_blank">v.kostiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Намеснік дырэктара па эканоміцы і фінансам" src="http://minavto.by/img/upload/valentine-kostyuk.png" title="Намеснік дырэктара па эканоміцы і фінансам" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Міхаіл Яблонскі</strong></u></p>\r\n\r\n			<p>Намеснік дырэктара</p>\r\n\r\n			<p>па якасці</p>\r\n\r\n			<p>+37529 333 45 32</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3am.jablonski@minavto.by" target="_blank">m.jablonski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Намеснік дырэктара па якасці" height="150" src="http://minavto.by/img/upload/michael-yablonski.png" title="Намеснік дырэктара па якасці" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Людміла Грушэўская</strong></u></p>\r\n\r\n			<p>Менеджэр аддзела збыту</p>\r\n\r\n			<p>+37529 696 37 03</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3al.grushevskaya@minavto.by" target="_blank">l.grushevskaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Менеджэр аддзела збыту" height="150" src="http://minavto.by/img/upload/lyudmila-grushevskaya.png" title="Менеджэр аддзела збыту" width="150" /></td>\r\n			<td align="center">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Таццяна Брысюк</strong></u></p>\r\n\r\n			<p>Галоўны бухгалтар</p>\r\n\r\n			<p>+37529 376 13 79&nbsp;</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3at.brisiuk@minavto.by" target="_blank">t.brisiuk@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Галоўны бухгалтар" height="150" src="http://minavto.by/img/upload/tatyana-brisyuk.png" title="Галоўны бухгалтар" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Уладзімір Стрыгалёў</strong></u></p>\r\n\r\n			<p>Начальнік цэха зборкі</p>\r\n\r\n			<p>+37529 625 56 05</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3av.strigalev@minavto.by" target="_blank">v.strigalev@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Начальнік цэха зборкі" height="150" src="http://minavto.by/img/upload/vladimir-strigalev.png" title="Начальнік цэха зборкі" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Аляксандар Навіцкі</strong></u></p>\r\n\r\n			<p>Начальнік вытворчасці</p>\r\n\r\n			<p>+37529 155 39 87</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3aa.navitski@minavto.by" target="_blank">a.navitski@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Начальнік вытворчасці" height="150" src="http://minavto.by/img/upload/alexander-navitski.png" title="Начальнік вытворчасці" width="150" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center">\r\n			<p><u><strong>Алег Бажкоў</strong></u></p>\r\n\r\n			<p>Менеджэр па</p>\r\n\r\n			<p>арганізацыі закупак</p>\r\n\r\n			<p>+37544 772 74 59</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.boschkow@minavto.by" target="_blank">o.boschkow@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Менеджэр па арганізацыі закупак" height="150" src="http://minavto.by/img/upload/bozhkov-oleg.png" title="Менеджэр па арганізацыі закупак" width="150" /></td>\r\n			<td align="center" valign="middle">&nbsp;</td>\r\n			<td align="center">\r\n			<p><u><strong>Вольга Саўрыцкая</strong></u></p>\r\n\r\n			<p>Інспектар па кадрах</p>\r\n\r\n			<p>+37544 544 43 63</p>\r\n\r\n			<p><a href="https://e.mail.ru/compose/?mailto=mailto%3ao.savrickaya@minavto.by" target="_blank">o.savrickaya@minavto.by</a></p>\r\n			</td>\r\n			<td align="center"><img alt="Інспектар па кадрах" height="150" src="http://minavto.by/img/upload/olga-savritskaya.png" title="Інспектар па кадрах" width="150" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div id="map">&nbsp;</div>'),
(1, 8, '<p>Начиная с 2000 года иностранное предприятие общество с ограниченной ответственностью &laquo;МИНАВТО&raquo; немецкого холдинга &laquo;GM-Tec&raquo; производит комплектующие для автомобильной промышленности стран Западной Европы и Таможенного Союза.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>С 2014 года предприятие реализует программу по расширению действующего производства. Являясь частью крупного холдинга, наше предприятие способно расширить спектр предлагаемых услуг за&nbsp;счёт нового оборудования, реализации сложных проектов с&nbsp;участием немецких партнёров. Мы расширяем ассортимент выпускаемой продукции.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Мы уверенно смотрим в будущее и продолжаем успешно развиваться. Основа стабильности предприятия &ndash; современный коллектив единомышленников, способный внедрить в производство самые сложные проекты. Наши специалисты готовы к конструктивному диалогу с потенциальными партнерами.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3 align="center"><strong><em>ИСТОРИЯ РАЗВИТИЯ ПРЕДПРИЯТИЯ</em></strong></h3>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<table align="center" border="0" cellspacing="3">\r\n	<tbody>\r\n		<tr>\r\n			<td>Основана</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2000</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Начало производственной&nbsp; деятельности</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2001</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Первая сертификация</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2004</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Предприятие стало частью KAP AG</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2008</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Ввод в эксплуатацию нового&nbsp;производственного здания</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2011</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Новый менеджмент во главе с немецким директором</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2013</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<h2 align="center"><strong><em>ОРГАНИЗАЦИОННАЯ СТРУКТУРА ПРЕДПРИЯТИЯ</em></strong></h2>\r\n\r\n<p align="center"><img alt="Структура предприятия" height="450" src="http://minavto.by/img/upload/geschaftsstruktur-ru.png" title="Структура предприятия" width="806" /></p>', '<p>Since 2000, the foreign enterprise of MINAVTO, limited liability Company owned by GM Tec Industries Holding GmbH, has been manufacturing components for the automotive industry of European and Customs Union countries.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In 2014 the company has started a program of the existing production extension. As a part of a large holding, our enterprise can expand its range of services by means of new equipment and implementation of large-scale projects with the participation of German partners. We expand the range of our products.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We look into the future with confidence and continue our successful development. The basis of the company reliability is the innovative team of like-minded professionals able to implement the most complex projects. Our experts are ready for constructive dialog with potential partners.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3 align="center"><strong><em>COMPANY HISTORY</em></strong></h3>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<table align="center" border="0" cellspacing="3">\r\n	<tbody>\r\n		<tr>\r\n			<td>Established in</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2000</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Production activities commenced in</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2001</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>First certification in</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2004</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Acquired by KAP AG in</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2008</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>New production building commissioned in</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2011</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>New management headed by German Director in</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2013</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<h2 align="center"><strong><em>COMPANY ORGANIZATIONAL CHART</em></strong></h2>\r\n\r\n<p align="center"><img alt="COMPANY ORGANIZATIONAL CHART" height="450" src="http://minavto.by/img/upload/geschaftsstruktur-en.png" title="COMPANY ORGANIZATIONAL CHART" width="806" /></p>', '<p>Seit 2000 produziert das ausl&auml;ndisches Unternehmen IP OOO MINAVTO der deutschen GM Tec Industries Holding GmbH Zulieferteile f&uuml;r Automobilindustrie in Westeuropa und in L&auml;ndern der Zollunion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Seit 2014 wird vom Unternehmen das Programm zur Produktionserweiterung umgesetzt. Als Mitglied einer gro&szlig;en Holding kann unser Unternehmen durch Investition neuer Maschinen, komplexe Projekte unter Beteiligung deutscher Partner umsetzen. Wir erweitern auch unser Produktprogramm.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Wir blicken mit Zuversicht in die Zukunft und entwickeln uns weiter. Die Grundlage f&uuml;r die Stabilit&auml;t unseres Unternehmens wird von einem modernen Team von Gleichgesinnten gebildet, welches die kompliziertesten Produktionsprojekte umsetzen kann. Unsere Fachleute sind gerne bereit, verschiedene Aspekte mit potentiellen Kunden konstruktiv zu besprechen.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3 align="center"><strong><em>ENTWICKLUNGSGESCHICHTE</em></strong></h3>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<table align="center" border="0" cellspacing="3">\r\n	<tbody>\r\n		<tr>\r\n			<td>Gr&uuml;ndung</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2000</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aufnahme der Produktion</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2001</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Erste Zertifizierung</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2004</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aufnahme in die KAP AG</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2008</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Einweihung eines neuen Betriebsgeb&auml;udes</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2011</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Neue Gesch&auml;ftsf&uuml;hrung mit einem deutschen Direktor an der Spitze</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2013</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<h2 align="center"><strong><em>UNTERNEHMENSAUFBAU</em></strong></h2>\r\n\r\n<p align="center"><img alt="UNTERNEHMENSAUFBAU" height="450" src="http://minavto.by/img/upload/geschaftsstruktur-de.png" title="UNTERNEHMENSAUFBAU" width="806" /></p>\r\n', '<p>Przedsiębiorstwo zagraniczne Sp. z o.o. &laquo;Minavto&raquo; (Niemiecka sp&oacute;łka holdingowa &laquo;GM Тес&raquo;) od 2000 roku jest producentem precyzyjnych części dla przemysłu motoryzacyjnego zachodniej Europy i Unii Celnej.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Od 2014 roku firma rozpoczęła program zwiększenia bieżącej produkcji. Jesteśmy częścią dużej sp&oacute;łki holdingowej, nasza firma jest w stanie rozszerzyć zakres oferowanych usług z użyciem nowego sprzętu oraz realizacji z niemieckimi partnerami złożonych projekt&oacute;w. Zwiększamy także stale asortyment produkt&oacute;w przetworzonych.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Możemy śmiało patrzeć w przyszłość i w dalszym ciągu pomyślnie się rozwijać. Podstawą stabilności gospodarczej jest nowoczesny zesp&oacute;ł ludzi o podobnych poglądach oraz możliwość realizacji najbardziej skomplikowanych projekt&oacute;w. Nasi specjaliści są gotowi do zaangażowania się w konstruktywny dialog z potencjalnymi partnerami.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3 align="center"><strong><em>HISTORIA ROZWOJU PRZEDSIĘBIORSTWA:</em></strong></h3>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<table align="center" border="0" cellspacing="3">\r\n	<tbody>\r\n		<tr>\r\n			<td>Firma została założona</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2000&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Działalność przemysłową rozpoczęła się</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2001&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pierwszy certyfikat jakości został uzyskany</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2004&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Firma stała się częścią KAP AG</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2008&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Budowa nowej hali produkcyjnej</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2011&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Nowy zarząd firmy pod kierunkiem niemieckiego dyrektora od</p>\r\n			</td>\r\n			<td align="center" style="padding: 0px 5px;">-</td>\r\n			<td><strong>2013&nbsp;</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2 align="center">&nbsp;</h2>\r\n\r\n<h2 align="center"><strong><em>ORGANIZACYJNĄ STRUKTURĘ PRZEDSIĘBIORSTWA</em></strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p align="center"><img alt="STRUKTURĘ PRZEDSIĘBIORSTWA" height="450" src="http://minavto.by/img/upload/geschaftsstruktur-pl.jpg" title="STRUKTURĘ PRZEDSIĘBIORSTWA" width="806" /></p>', '<p>Пачынаючы з 2000 года замежнае прадпрыемства з абмежаванай адказнасцю &ldquo;МІНАЎТА&rdquo; нямецкага холдынга &ldquo;GM-Tec&rdquo; вырабляе камплектуючыя для аўтамабільнай прамысловасці краін Заходняй Еўропы і Мытнага саюза.</p>\r\n<p>&nbsp;</p>\r\n<p>З 2014 года прадпрыемства рэалізуе праграму па пашырэнні дзеючай вытворчасці. З&rsquo;яўляючыся часткай буйнога холдынга, наша прадпрыемства здольна вырашыць спектр прапанаваных паслуг за кошт новага абсталявання, рэалізацыі складаных праектаў з удзелам нямецкіх партнёраў. Мы пашыраем асартымент выпускаемай прадукцыі.</p>\r\n<p>&nbsp;</p>\r\n<p>Мы ўпэўнена глядзім у будучыню і працягваем паспяхова развівацца. Аснова стабільнасці прадпрыемства &ndash; сучасны калектыў аднадумцаў, здольны ўкараніць у вытворчасць самыя складаныя праекты. Нашы спецыялісты гатовы да канструктыўнага дыялога з патэнцыяльнымі партнёрамі.</p>\r\n<p>&nbsp;</p>\r\n<h3 align="center"><strong><em>ГІСТОРЫЯ РАЗВІЦЦЯ ПРАДПРЫЕМСТВА</em></strong></h3>\r\n<p align="center">&nbsp;</p>\r\n<table border="0" cellspacing="3" align="center">\r\n\r\n<tr>\r\n<td>Заснавана</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2000</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Пачатак вытворчай дзейнасці</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2001</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Першая сертыфікацыя</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2004</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Прадпрыемства стала часткай KAP AG</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2008</strong></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p>Увод у эксплуатацыю новага вытворчага будынка</p>\r\n</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2011</strong></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p>Новы менеджмент на чале з нямецкім дырэктарам</p>\r\n</td>\r\n<td style="padding: 0px 5px;" align="center">-</td>\r\n<td><strong>2013</strong></td>\r\n</tr>\r\n\r\n</table>');
INSERT INTO `text` (`id_table`, `id_row`, `text_ru`, `text_en`, `text_de`, `text_pl`, `text_by`) VALUES
(14, 1, '<h2>ИП ООО «Минавто»</h2>\r\n<p style="font-size: 13px;">ИП ООО «Минавто», производственное предприятие немецкого холдинга «GM-Тес», является производителем высокоточных деталей для автомобильной промышленности стран Западной Европы и Таможенного союза с 2000 года. Продукция ИП ООО «Минавто» соответствует международным стандартам ISO 9001:2008.</p>\r\n<p>&nbsp;</p>\r\n<h4>Производственная деятельность</h4>\r\n<h4>осуществляется по 3 направлениям:</h4>\r\n<p style="font-size: 13px;">- металлообработка</p>\r\n<p style="font-size: 13px;">- литьё пластмасс под давлением</p>\r\n<p style="font-size: 13px;">- сборка изделий из пластмасс</p>\r\n<p>&nbsp;</p>\r\n<p>Штат предприятия насчитывает 250 человек.</p>\r\n<p>Производственные площади составляют 4000 м2.</p>', '<h2>IP OOO &quot;MINAVTO&quot;</h2>\r\n\r\n<p style="font-size: 13px;">IP OOO &quot;MINAVTO&quot;, a production plant of GM Tec Industries Holding GmbH, has been manufacturing high-precision parts for the automotive industry of European and Customs Union countries since 2000. Products manufactured by IP OOO &quot;MINAVTO&quot;. comply with the requirements of ISO 9001:2008.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>Production activities include:</h4>\r\n\r\n<p style="font-size: 13px;">- Metalworking</p>\r\n\r\n<p style="font-size: 13px;">- Injection molding</p>\r\n\r\n<p style="font-size: 13px;">- Nozzle assembly</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The number of employees is 250 people.</p>\r\n\r\n<p>The area of production facilities is 4,000 sq.m.</p>\r\n', '<h2>OOO Minavto</h2>\r\n\r\n<p style="font-size: 13px;">IP OOO Minavto ist ein Unternehmen der GM Tec Industries Holding GmbH und produziert seit 2000 hochpr&auml;zise Zulieferteile f&uuml;r die Automobilindustrie in Westeuropa und in L&auml;ndern der Zollunion. Produkte von Minavto entsprechen der internationalen Norm ISO 9001:2008.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>Die Herstellung umfasst 3 Bereiche:</h4>\r\n\r\n<p style="font-size: 13px;">- Metallbearbeitung</p>\r\n\r\n<p style="font-size: 13px;">- Spritzgie&szlig;en</p>\r\n\r\n<p style="font-size: 13px;">- D&uuml;senmontage</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Das Unternehmen besch&auml;ftigt 250 Mitarbeiter.</p>\r\n\r\n<p>Die Produktionsfl&auml;che umfasst 4000 m2.</p>\r\n', '<h2>Przedsiębiorstwo zagraniczne &nbsp; &nbsp; &nbsp;Sp. z o.o.«Minavto»</h2>\r\n<p style="font-size: 13px;">Przedsiębiorstwo zagraniczne Sp. z o.o.«Minavto», (Niemiecka spółka holdingowa «GM Тес») od 2000 roku jest producentem precyzyjnych części dla przemysłu motoryzacyjnego zachodniej Europy i Unii Celnej. Produkty Sp. z o.o. "Minavto" odnosi się do normy międzynarodowej ISO 9001:2008.</p>\r\n<h4>Działalność produkcyjna odbywa się na trzech obszarach:</h4>\r\n<p style="font-size: 13px;">- obróbka metali</p>\r\n<p style="font-size: 13px;">- obróbka tworzyw sztucznych,</p>\r\n<p style="font-size: 13px;">- montaż wyrobów z tworzyw sztucznych</p>\r\n<p>&nbsp;</p>\r\n<p>Firma zatrudnia 250 osób.</p>\r\n<p>Powierzchnia produkcji wynosi 4000 m2.</p>', '<h2>ЗП ТАА «Мінаўта»</h2>\r\n<p style="font-size: 13px;">ЗП ТАА «Мінаўта», вытворчае прадпрыемства нямецкага холдынга «GM-Тес», з’яўляецца вытворцам высокадакладных дэталяў для аўтамабільнай прамысловасці краін Заходняй Еўропы і Мытнага саюза з 2000 года. Прадукцыя ЗП ТАА «Мінаўта» адпавядае міжнародным стандартам ISO 9001:2008..</p>\r\n<p>&nbsp;</p>\r\n<h4>Вытворчая дзейнасць ажыццяўляецца па 3 накірунках:</h4>\r\n<p style="font-size: 13px;">- Металаапрацоўка</p>\r\n<p style="font-size: 13px;">- Ліццё пластмасы пад ціскам</p>\r\n<p style="font-size: 13px;">- Зборка вырабаў з пластмасы</p>\r\n<p>&nbsp;</p>\r\n<p>Штат прадпрыемства налічвае 250 чалавек</p>\r\n<p>Вытворчыя плошчы складаюць 4000 м2.</p>'),
(15, 1, NULL, NULL, NULL, NULL, NULL),
(15, 2, NULL, NULL, NULL, NULL, NULL),
(15, 3, NULL, NULL, NULL, NULL, NULL),
(15, 4, NULL, NULL, NULL, NULL, NULL),
(15, 5, NULL, NULL, NULL, NULL, NULL),
(15, 6, NULL, NULL, NULL, NULL, NULL),
(15, 7, NULL, NULL, NULL, NULL, NULL),
(15, 9, NULL, NULL, NULL, NULL, NULL),
(15, 10, NULL, NULL, NULL, NULL, NULL),
(15, 11, NULL, NULL, NULL, NULL, NULL),
(15, 12, NULL, NULL, NULL, NULL, NULL),
(15, 13, NULL, NULL, NULL, NULL, NULL),
(15, 14, NULL, NULL, NULL, NULL, NULL),
(14, 2, '<p>Основным направлением деятельности предприятия является <u>металлообработка</u>. Наша продукция – это высочайшее качество готовых изделий и неукоснительное соблюдение сроков поставки.</p>\r\n<p>&nbsp;</p>\r\n<p>Мы предлагаем следующие виды обработки металлов:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Точение</li>\r\n<li>Фрезерование</li>\r\n<li>Шлифование</li>\r\n<li>Насечка</li>\r\n<li>Резьбонакатывание</li>\r\n<li>Термообработка</li>\r\n<li>Мойка</li>\r\n</ul>', '<p><u>Metalworking</u> is the main production activity of the enterprise. We guarantee extra-high quality of finished products and strict adherence to the delivery schedule.</p>\r\n<p>&nbsp;</p>\r\n<p>The following types of metalworking are available at the enterprise:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Lathe turning</li>\r\n<li>Milling</li>\r\n<li>Grinding</li>\r\n<li>Notching</li>\r\n<li>Knurling</li>\r\n<li>Hardening</li>\r\n<li>Washing</li>\r\n</ul>', '<p><u>Die Metallbearbeitung</u> bildet den Schwerpunkt des Unternehmens. Unsere Produktion verk&ouml;rpert h&ouml;chste Qualit&auml;t und strenge Einhaltung der Liefertermine.</p>\r\n<p>&nbsp;</p>\r\n<p>Wir bieten folgende Fertigungsprozesse an:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Drehen</li>\r\n<li>Fr&auml;sen</li>\r\n<li>Schleifen</li>\r\n<li>Kerben</li>\r\n<li>Gewinderollen</li>\r\n<li>H&auml;rten</li>\r\n<li>Waschen</li>\r\n</ul>', '<p>Główną działalnością przedsiębiorstwa jest obróbkа metali. Nasze produkty - to najwyższa jakość wyrobów gotowych i ścisłe przestrzeganie terminów dostaw.</p>\r\n<p>Oferujemy następujące rodzaje obróbki metali:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Frezowanie</li>\r\n<li>Toczenie</li>\r\n<li>Szlifowanie</li>\r\n<li>Nacięcie</li>\r\n<li>Radełkowanie gwintu</li>\r\n<li>Obróbka cieplna</li>\r\n<li>Mycie</li>\r\n</ul>', '<p>Асноўным накірункам дзейнасці прадпрыемства з’яўляецца <u>металаапрацоўка</u>. Наша прадукцыя – гэта найвышэйшая якасць гатовых вырабаў і няўхільнае выкананне тэрмінаў пастаўкі.</p>\r\n<p>&nbsp;</p>\r\n<p>Мы прапануем наступныя віды апрацоўкі металаў:</p>\r\n<ul style="list-style-type: circle;">\r\n<li>Тачэнне</li>\r\n<li>Фрэзераванне</li>\r\n<li>Шліфаванне</li>\r\n<li>Насечка</li>\r\n<li>Разьбанакатванне</li>\r\n<li>Тэрмаапрацоўка</li>\r\n<li>Мойка</li>\r\n</ul>'),
(15, 15, NULL, NULL, NULL, NULL, NULL),
(15, 16, NULL, NULL, NULL, NULL, NULL),
(15, 17, NULL, NULL, NULL, NULL, NULL),
(15, 18, NULL, NULL, NULL, NULL, NULL),
(15, 19, NULL, NULL, NULL, NULL, NULL),
(15, 20, NULL, NULL, NULL, NULL, NULL),
(15, 21, NULL, NULL, NULL, NULL, NULL),
(15, 22, NULL, NULL, NULL, NULL, NULL),
(15, 23, NULL, NULL, NULL, NULL, NULL),
(15, 24, NULL, NULL, NULL, NULL, NULL),
(15, 25, NULL, NULL, NULL, NULL, NULL),
(15, 26, NULL, NULL, NULL, NULL, NULL),
(15, 27, NULL, NULL, NULL, NULL, NULL),
(15, 28, NULL, NULL, NULL, NULL, NULL),
(15, 29, NULL, NULL, NULL, NULL, NULL),
(14, 3, '<h2><strong>Литьё пластмасс</strong></h2>\r\n<p>Одним из направлений деятельности предприятия является литьё пластмасс под давлением.</p>\r\n<p>&nbsp;</p>\r\n<p>Качественные, изготовленные в Германии&nbsp; пресс-формы и многолетний опыт в производстве изделий из пластмасс позволяют производить высококачественную продукцию в приемлемые сроки.</p>\r\n<p>&nbsp;</p>\r\n<p>Наше изделие комбинированной группы металл-пластмасса «вал-шестерня» производят всего несколько фирм в Европе.</p>', '<h2><strong>Injection Molding</strong></h2>\r\n<p>One of the enterprise''s production activities is injection molding.</p>\r\n<p>&nbsp;</p>\r\n<p>High-quality molding tools produced in Germany and extensive experience in the area of plastic products manufacturing ensure high-quality production within reasonable terms.</p>\r\n<p>&nbsp;</p>\r\n<p>Our combined metal-plastic "gear shaft" product is manufactured by only a few companies in Europe.</p>', '<h2><strong>Spritzgießen</strong></h2>\r\n<p>Einer der Schwerpunkte unserer Produktionstätigkeit ist Spritzgießen.</p>\r\n<p>&nbsp;</p>\r\n<p>Hochwertige, in Deutschland hergestellte Spritzgußwerkzeuge und langjährige Erfahrung in der Kunststoffproduktion ermöglichen uns, hochwertige Produkte in angemessener Zeit herzustellen.</p>\r\n<p>&nbsp;</p>\r\n<p>Unser Teil „Zahnrad mit Welle“ als Kunststoff/Metall-Verbindung wird sonst nur von einigen wenigen Firmen in Europa hergestellt.</p>', '<h2><strong>Przetwórstwo tworzyw sztucznych</strong></h2>\r\n<p>Jedną z form działalności przedsiębiorstwa jest przetwórstwo tworzyw sztucznych.</p>\r\n<p>&nbsp;</p>\r\n<p>Wykonane w Niemczech formy i wieloletnie doświadczenie w produkcji wyrobów z tworzyw sztucznych pozwalają produkować elementy wysokiej jakości w rozsądnym terminie.</p>\r\n<p>&nbsp;</p>\r\n<p>Nasz produkt jest połączeniem grupy metal – tworzywo sztuczne, «wał – koło zębate» produkowany jest zaledwie w kilku firmach w Europie.</p>', '<h2><strong>Ліццё пластмасы</strong></h2>\r\n<p>Адным з накірункаў дзейнасці прадпрыемства з’яўляецца ліццё пластмасы пад ціскам..</p>\r\n<p>&nbsp;</p>\r\n<p>КЯкасныя, вырабленыя ў Германіі прэс-формы і шматгадовы вопыт у вытворчасці вырабаў з пластмасы дазваляюць выпускаць высакаякасную прадукцыю ў дапушчальныя тэрміны.</p>\r\n<p>&nbsp;</p>\r\n<p>Наш выраб камбінаванай групы метал-пластмаса “вал-шасцярня” вырабляюць толькі некалькі фірмаў у Еўропе.</p>'),
(15, 30, NULL, NULL, NULL, NULL, NULL),
(15, 31, NULL, NULL, NULL, NULL, NULL),
(15, 32, NULL, NULL, NULL, NULL, NULL),
(15, 33, NULL, NULL, NULL, NULL, NULL),
(15, 34, NULL, NULL, NULL, NULL, NULL),
(15, 35, NULL, NULL, NULL, NULL, NULL),
(15, 37, NULL, NULL, NULL, NULL, NULL),
(15, 38, NULL, NULL, NULL, NULL, NULL),
(15, 39, NULL, NULL, NULL, NULL, NULL),
(14, 4, '<h2><strong>Сборка изделий из пластмасс</strong></h2>\r\n<p>В сборочном цеху предприятия собираются системы и элементы систем для омывания лобовых стекол легковых и грузовых автомобилей с подогревом и без подогрева для ведущих мировых производителей автомобильной промышленности.</p>', '<h2><strong>Nozzle assembly</strong></h2>\r\n<p>Car and truck windscreen washing systems, both with heating and without it, and their components are fabricated at the assembly shop of the enterprise for leading global manufacturers of the automotive industry.</p>', '<h2><strong>Düsenmontage</strong></h2>\r\n<p>In der Montagehalle werden beheizte und unbeheizte Scheibenwischsysteme für PKW- und LKW führende Autohersteller zusammengebaut.</p>', '<h2><strong>Montaż wyrobów z tworzyw sztucznych</strong></h2>\r\n<p>Wydział montażu naszej firmy kompletuje systemy i elementy do mycia szyby samochodów i ciężarówek z podgrzewaniem i bez podgrzewania dla wiodących na świecie producentów samochodów.</p>', '<h2><strong>Зборка вырабаў з пластмасы</strong></h2>\r\n<p>У зборачным цэху збіраюцца сістэмы і элементы сістэм для амывання лабавога шкла легкавых і грузавых аўтамабіляў з падагрэвам і без падагрэву для вядучых сусветных вытворцаў аўтамабільнай прамысловасці.</p>'),
(15, 40, NULL, NULL, NULL, NULL, NULL),
(15, 41, NULL, NULL, NULL, NULL, NULL),
(15, 42, NULL, NULL, NULL, NULL, NULL),
(15, 43, NULL, NULL, NULL, NULL, NULL),
(15, 44, NULL, NULL, NULL, NULL, NULL),
(15, 45, NULL, NULL, NULL, NULL, NULL),
(15, 46, NULL, NULL, NULL, NULL, NULL),
(15, 47, NULL, NULL, NULL, NULL, NULL),
(15, 48, NULL, NULL, NULL, NULL, NULL),
(14, 5, '<h1>Гарантия качества</h1>\r\n<p style="margin-bottom: 5px;">С 2004 года система качества предприятия имеет международный сертификат качества ISO 9001:2008 , который подтверждается ежегодными аудитами DQS.</p>\r\n<p style="margin-bottom: 5px;">На предприятии внедрена система 100% контроля производимой продукции. Это значит, что каждый из миллионов производимых нами элементов измеряется и подвергается визуальному контролю. Сегодня штат отдела качества насчитывает 25 человек.</p>\r\n<p style="margin-bottom: 5px;">Целью политики предприятия в&nbsp;области качества является:</p>\r\n<p><font size="2"><strong><em>ОБЕСПЕЧЕНИЕ ОЖИДАНИЙ ЗАКАЗЧИКА И КОНКУРЕНТНОСПОСОБНОСТЬ</em></strong></font></p>', '<h1>Quality Assurance</h1>\r\n<p style="margin-bottom: 5px;">In 2004 the quality assurance system of the enterprise was certified according to ISO 9001:2008, and it is verified by DQS audits every year.</p>\r\n<p style="margin-bottom: 5px;">The system of 100 % control and verification of finished products has been invented at the enterprise. Literally, this means that each of million components manufactured by our company is subject to measurement and visual inspection. At the moment, the quality department employs 25 persons.</p>', '<h1>Qualitätssicherung</h1>\r\n<p style="margin-bottom: 5px;">Seit 2004 hat das Qualitätsmanagementsystem unseres Unternehmens die internationale Zertifizierung nach ISO 9001, welche jährlich durch Prüfungsberichte von DQS nachgewiesen wird.</p>\r\n<p style="margin-bottom: 5px;">In unserem Unternehmen wurde die 100%-Kontrolle eingeführt. Dies bedeutet, dass wir jedes, von vielen Millionen hergestellten Teilen messen und visuell überprüfen. Heute beschäftigen wir in unserem Bereich Qualitätssicherung 25 Mitarbeiter.</p>\r\n<p style="margin-bottom: 5px;">Unser Ziel im Bereich Qualitätssicherung ist:</p>\r\n<p><font size="2"><strong><em>ERFÜLLUNG VON KUNDENERWARTUNGEN SOWIE WETTBEWERBSFÄHIGKEIT</em></strong></font></p>', '<h1>Gwarancja jakości</h1>\r\n\r\n<p style="margin-bottom: 5px;">Od 2004 roku system zarządzania jakością posiada Międzynarodowy Certyfikat Jakości ISO 9001:2008, co jest potwierdzone przez coroczne audyty DQS.</p>\r\n\r\n<p style="margin-bottom: 5px;">Firma posiada system 100% kontroli naszych wyrob&oacute;w. Oznacza to, że każdy z milion&oacute;w naszych elemet&oacute;w jest manualnie mierzony i poddany kontroli wzrokowej. Dział jakości zatrudnia dziś 25 os&oacute;b.</p>\r\n\r\n<p style="margin-bottom: 5px;">Polityka gospodarcza w dziedzinie jakości to:</p>\r\n\r\n<p><font size="2"><strong><em>SPEŁNIENIE OCZEKIWAŃ KLIENT&Oacute;W I KONKURENCYJNOŚĆ</em></strong></font></p>', '<h1>Гарантыя якасці</h1>\r\n<p style="margin-bottom: 5px;">З 2004 года сістэма якасці прадпрыемства мае міжнародны сертыфікат якасці ISO 9001:2008, які пацвярджаецца штогадовымі аўдытамі DQS.</p>\r\n<p style="margin-bottom: 5px;">На прадпрыемстве ўкаранёна сістэма 100% кантролю вырабленай прадукцыі. Гэта значыць, што кожны з мільёнаў зробленых намі элементаў вымяраецца і падпадае пад візуальны кантроль. Сёння штат аддзела якасці налічвае 25 чалавек..</p>\r\n<p style="margin-bottom: 5px;">Мэтай палітыкі прадпрыемства ў галіне якасці з’яўляецца:</p>\r\n<p><font size="2"><strong><em>ЗАБЕСПЯЧЭННЕ СПАДЗЯВАННЯЎ ЗАКАЗЧЫКА І КАНКУРЭНТНАЗДОЛЬНАСЦЬ</em></strong></font></p>'),
(15, 49, NULL, NULL, NULL, NULL, NULL),
(15, 51, NULL, NULL, NULL, NULL, NULL),
(15, 52, NULL, NULL, NULL, NULL, NULL),
(15, 53, NULL, NULL, NULL, NULL, NULL),
(15, 54, NULL, NULL, NULL, NULL, NULL),
(15, 55, NULL, NULL, NULL, NULL, NULL),
(15, 56, NULL, NULL, NULL, NULL, NULL),
(15, 57, NULL, NULL, NULL, NULL, NULL),
(13, 1, '<p>«Minavto»</p>', '<p>«Minavto»</p>', '<p>&laquo;Minavto&raquo;</p>', '<p>«Minavto»</p>', '<p>«Minavto»</p>'),
(7, 1, '<p>В &nbsp; урочище &laquo;Горбатый мост&raquo; в &nbsp;районе &nbsp;г.п. Плещеницы 5-7 июня прошел туристический слет Логойского района. В &nbsp;туристическом слете &nbsp;приняли участие шесть команд: &laquo;Минавто&raquo;, &laquo;Амкодор-Логойск&raquo;, &laquo;Беларусбанк&raquo;, &laquo;Комхоз&raquo;, &laquo;ЦРБ&raquo;, &laquo;Профсоюзы&raquo;.</p>\r\n<p>Состязание команд началось с фигурного вождения велосипеда, в котором &nbsp;третье место заняла команда &nbsp;&laquo;Минавто&raquo;. В &nbsp;&laquo;Шуточной &nbsp;эстафете&raquo; второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;. В конкурсе &laquo;Дартс&raquo; победили представители команды &nbsp;&laquo;Минавто&raquo;.</p>\r\n<p>В конкурсе &laquo;Бивуак&raquo; победила команда &nbsp;&laquo;Минавто&raquo;, &nbsp;второе место у команды &laquo;Комхоз&raquo;, а третье место у команды &laquo;ЦРБ&raquo;. &nbsp;Командам также была предоставлена возможность попробовать свои силы в игре &laquo;Пейнтбол&raquo;, где все команды проявили себя победителями. Завершали программу состязаний туристического слета команды участием в пляжном волейболе. Победа была одержана командой &nbsp;&laquo;Амкодор-Логойск&raquo;, второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;, &nbsp;а третье место &nbsp;команда &nbsp; &laquo;Комхоз&raquo;. &nbsp;</p>\r\n<p>По итогам &nbsp;общего зачета &nbsp;выступлений команд в конкурсах, &nbsp;победителями туристического слета &nbsp;стала команда &nbsp;&laquo;Комхоз&raquo;, второе место заняла команда &laquo;Минавто&raquo;, &nbsp;а третье место &laquo;Профсоюзы&raquo;.</p>', '<p>В &nbsp; урочище &laquo;Горбатый мост&raquo; в &nbsp;районе &nbsp;г.п. Плещеницы 5-7 июня прошел туристический слет Логойского района. В &nbsp;туристическом слете &nbsp;приняли участие шесть команд: &laquo;Минавто&raquo;, &laquo;Амкодор-Логойск&raquo;, &laquo;Беларусбанк&raquo;, &laquo;Комхоз&raquo;, &laquo;ЦРБ&raquo;, &laquo;Профсоюзы&raquo;.</p>\r\n<p>Состязание команд началось с фигурного вождения велосипеда, в котором &nbsp;третье место заняла команда &nbsp;&laquo;Минавто&raquo;. В &nbsp;&laquo;Шуточной &nbsp;эстафете&raquo; второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;. В конкурсе &laquo;Дартс&raquo; победили представители команды &nbsp;&laquo;Минавто&raquo;.</p>\r\n<p>В конкурсе &laquo;Бивуак&raquo; победила команда &nbsp;&laquo;Минавто&raquo;, &nbsp;второе место у команды &laquo;Комхоз&raquo;, а третье место у команды &laquo;ЦРБ&raquo;. &nbsp;Командам также была предоставлена возможность попробовать свои силы в игре &laquo;Пейнтбол&raquo;, где все команды проявили себя победителями. Завершали программу состязаний туристического слета команды участием в пляжном волейболе. Победа была одержана командой &nbsp;&laquo;Амкодор-Логойск&raquo;, второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;, &nbsp;а третье место &nbsp;команда &nbsp; &laquo;Комхоз&raquo;. &nbsp;</p>\r\n<p>По итогам &nbsp;общего зачета &nbsp;выступлений команд в конкурсах, &nbsp;победителями туристического слета &nbsp;стала команда &nbsp;&laquo;Комхоз&raquo;, второе место заняла команда &laquo;Минавто&raquo;, &nbsp;а третье место &laquo;Профсоюзы&raquo;.</p>', '<p>В &nbsp; урочище &laquo;Горбатый мост&raquo; в &nbsp;районе &nbsp;г.п. Плещеницы 5-7 июня прошел туристический слет Логойского района. В &nbsp;туристическом слете &nbsp;приняли участие шесть команд: &laquo;Минавто&raquo;, &laquo;Амкодор-Логойск&raquo;, &laquo;Беларусбанк&raquo;, &laquo;Комхоз&raquo;, &laquo;ЦРБ&raquo;, &laquo;Профсоюзы&raquo;.</p>\r\n<p>Состязание команд началось с фигурного вождения велосипеда, в котором &nbsp;третье место заняла команда &nbsp;&laquo;Минавто&raquo;. В &nbsp;&laquo;Шуточной &nbsp;эстафете&raquo; второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;. В конкурсе &laquo;Дартс&raquo; победили представители команды &nbsp;&laquo;Минавто&raquo;.</p>\r\n<p>В конкурсе &laquo;Бивуак&raquo; победила команда &nbsp;&laquo;Минавто&raquo;, &nbsp;второе место у команды &laquo;Комхоз&raquo;, а третье место у команды &laquo;ЦРБ&raquo;. &nbsp;Командам также была предоставлена возможность попробовать свои силы в игре &laquo;Пейнтбол&raquo;, где все команды проявили себя победителями. Завершали программу состязаний туристического слета команды участием в пляжном волейболе. Победа была одержана командой &nbsp;&laquo;Амкодор-Логойск&raquo;, второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;, &nbsp;а третье место &nbsp;команда &nbsp; &laquo;Комхоз&raquo;. &nbsp;</p>\r\n<p>По итогам &nbsp;общего зачета &nbsp;выступлений команд в конкурсах, &nbsp;победителями туристического слета &nbsp;стала команда &nbsp;&laquo;Комхоз&raquo;, второе место заняла команда &laquo;Минавто&raquo;, &nbsp;а третье место &laquo;Профсоюзы&raquo;.</p>\r\n', '<p>В &nbsp; урочище &laquo;Горбатый мост&raquo; в &nbsp;районе &nbsp;г.п. Плещеницы 5-7 июня прошел туристический слет Логойского района. В &nbsp;туристическом слете &nbsp;приняли участие шесть команд: &laquo;Минавто&raquo;, &laquo;Амкодор-Логойск&raquo;, &laquo;Беларусбанк&raquo;, &laquo;Комхоз&raquo;, &laquo;ЦРБ&raquo;, &laquo;Профсоюзы&raquo;.</p>\r\n<p>Состязание команд началось с фигурного вождения велосипеда, в котором &nbsp;третье место заняла команда &nbsp;&laquo;Минавто&raquo;. В &nbsp;&laquo;Шуточной &nbsp;эстафете&raquo; второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;. В конкурсе &laquo;Дартс&raquo; победили представители команды &nbsp;&laquo;Минавто&raquo;.</p>\r\n<p>В конкурсе &laquo;Бивуак&raquo; победила команда &nbsp;&laquo;Минавто&raquo;, &nbsp;второе место у команды &laquo;Комхоз&raquo;, а третье место у команды &laquo;ЦРБ&raquo;. &nbsp;Командам также была предоставлена возможность попробовать свои силы в игре &laquo;Пейнтбол&raquo;, где все команды проявили себя победителями. Завершали программу состязаний туристического слета команды участием в пляжном волейболе. Победа была одержана командой &nbsp;&laquo;Амкодор-Логойск&raquo;, второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;, &nbsp;а третье место &nbsp;команда &nbsp; &laquo;Комхоз&raquo;. &nbsp;</p>\r\n<p>По итогам &nbsp;общего зачета &nbsp;выступлений команд в конкурсах, &nbsp;победителями туристического слета &nbsp;стала команда &nbsp;&laquo;Комхоз&raquo;, второе место заняла команда &laquo;Минавто&raquo;, &nbsp;а третье место &laquo;Профсоюзы&raquo;.</p>', '<p>В &nbsp; урочище &laquo;Горбатый мост&raquo; в &nbsp;районе &nbsp;г.п. Плещеницы 5-7 июня прошел туристический слет Логойского района. В &nbsp;туристическом слете &nbsp;приняли участие шесть команд: &laquo;Минавто&raquo;, &laquo;Амкодор-Логойск&raquo;, &laquo;Беларусбанк&raquo;, &laquo;Комхоз&raquo;, &laquo;ЦРБ&raquo;, &laquo;Профсоюзы&raquo;.</p>\r\n<p>Состязание команд началось с фигурного вождения велосипеда, в котором &nbsp;третье место заняла команда &nbsp;&laquo;Минавто&raquo;. В &nbsp;&laquo;Шуточной &nbsp;эстафете&raquo; второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;. В конкурсе &laquo;Дартс&raquo; победили представители команды &nbsp;&laquo;Минавто&raquo;.</p>\r\n<p>В конкурсе &laquo;Бивуак&raquo; победила команда &nbsp;&laquo;Минавто&raquo;, &nbsp;второе место у команды &laquo;Комхоз&raquo;, а третье место у команды &laquo;ЦРБ&raquo;. &nbsp;Командам также была предоставлена возможность попробовать свои силы в игре &laquo;Пейнтбол&raquo;, где все команды проявили себя победителями. Завершали программу состязаний туристического слета команды участием в пляжном волейболе. Победа была одержана командой &nbsp;&laquo;Амкодор-Логойск&raquo;, второе &nbsp;место заняла команда &nbsp; &laquo;Минавто&raquo;, &nbsp;а третье место &nbsp;команда &nbsp; &laquo;Комхоз&raquo;. &nbsp;</p>\r\n<p>По итогам &nbsp;общего зачета &nbsp;выступлений команд в конкурсах, &nbsp;победителями туристического слета &nbsp;стала команда &nbsp;&laquo;Комхоз&raquo;, второе место заняла команда &laquo;Минавто&raquo;, &nbsp;а третье место &laquo;Профсоюзы&raquo;.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id_table` int(3) unsigned NOT NULL,
  `id_row` int(12) unsigned NOT NULL,
  `title_ru` varchar(70) DEFAULT NULL,
  `title_en` varchar(70) DEFAULT NULL,
  `title_de` varchar(70) DEFAULT NULL,
  `title_pl` varchar(70) DEFAULT NULL,
  `title_by` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `title`
--

INSERT INTO `title` (`id_table`, `id_row`, `title_ru`, `title_en`, `title_de`, `title_pl`, `title_by`) VALUES
(1, 3, 'Металлообработка', 'Metalworking', 'Metallbearbeitung', 'Obróbka metali', 'Металаапрацоўка'),
(1, 4, 'Литье пластмасс', 'Injection molding', 'Spritzgießen', 'Przetwórstwo tworzyw sztucznych', 'Ліццё пластмасы'),
(1, 5, 'Сборка', 'Nozzle assembly', 'Düsenmontage', 'Montaż', 'Зборка вырабаў з пластмасы'),
(1, 6, 'Качество', 'Quality assurance', 'Qualitätssicherung', 'Jakość', 'Гарантыя якасці'),
(1, 7, 'Контактная информация', 'Contact information', 'Kontaktinformation', 'Informacje Kontaktowe', 'Кантактная інфармацыя'),
(1, 8, 'О нас', 'About Us', 'Über uns', 'O firmie', 'Пра нас'),
(10, 1, '«Минавто»', '«Minavto»', '«Minavto»', '«Minavto»', '«Мінаўта»'),
(7, 1, 'ТуристическийслетЛогойского', 'ТуристическийслетЛогойского', 'ТуристическийслетЛогойского', 'ТуристическийслетЛогойского', 'ТуристическийслетЛогойского'),
(10, 2, 'Новости компании', 'Сompany''s news', 'Nachrichten der Firma', 'Aktualności firmy', 'Навіны кампаніі'),
(10, 3, 'Поиск по сайту', 'Search', 'Site-Suche', 'Szukaj w serwisie', 'Пошук па сайце');

-- --------------------------------------------------------

--
-- Структура таблицы `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `name_file` varchar(150) NOT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name_file` (`name_file`),
  UNIQUE KEY `icon` (`icon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `upload`
--

INSERT INTO `upload` (`id`, `name_file`, `icon`, `date`) VALUES
(2, 'bozhkov-oleg.png', 'bozhkov-oleg.png', '2015-06-25 11:23:00'),
(3, 'tatyana-brisyuk.png', 'tatyana-brisyuk.png', '2015-06-25 11:25:14'),
(4, 'sergey-deinor.png', 'sergey-deinor.png', '2015-06-25 11:32:40'),
(5, 'lyudmila-grushevskaya.png', 'lyudmila-grushevskaya.png', '2015-06-25 11:35:08'),
(6, 'kljasivich-dmitrij.png', 'kljasivich-dmitrij.png', '2015-06-25 11:38:22'),
(7, 'valentine-kostyuk.png', 'valentine-kostyuk.png', '2015-06-25 11:39:53'),
(8, 'leo-stys.png', 'leo-stys.png', '2015-06-25 11:41:31'),
(9, 'alexander-navitski.png', 'alexander-navitski.png', '2015-06-25 11:44:28'),
(10, 'novickiy-anton.png', 'novickiy-anton.png', '2015-06-25 11:46:20'),
(11, 'olga-savritskaya.png', 'olga-savritskaya.png', '2015-06-25 11:49:25'),
(12, 'vladimir-strigalev.png', 'vladimir-strigalev.png', '2015-06-25 11:53:23'),
(13, 'michael-yablonski.png', 'michael-yablonski.png', '2015-06-25 11:55:15'),
(14, 'geschaftsstruktur-de.png', 'geschaftsstruktur-de.png', '2015-06-25 13:34:47'),
(15, 'geschaftsstruktur-ru.png', 'geschaftsstruktur-ru.png', '2015-06-25 13:43:27'),
(16, 'geschaftsstruktur-en.png', 'geschaftsstruktur-en.png', '2015-06-25 13:46:38'),
(17, 'geschaftsstruktur-pl.jpg', 'geschaftsstruktur-pl.jpeg', '2015-06-25 13:50:57'),
(18, 'slogan.jpg', 'slogan.jpeg', '2015-06-25 14:00:07'),
(19, 'metallbearbeitung.jpg', 'metallbearbeitung.jpeg', '2015-07-03 15:22:13'),
(20, 'metallbearbeitung-2.jpg', 'metallbearbeitung-2.jpeg', '2015-07-03 15:22:57'),
(21, 'metallbearbeitung-3.jpg', 'metallbearbeitung-3.jpeg', '2015-07-03 15:23:36'),
(22, 'metallbearbeitung-4.jpg', 'metallbearbeitung-4.jpeg', '2015-07-03 15:24:12'),
(23, 'metallbearbeitung-5.jpg', 'metallbearbeitung-5.jpeg', '2015-07-03 15:25:02'),
(24, 'metallbearbeitung-6.jpg', 'metallbearbeitung-6.jpeg', '2015-07-03 15:25:46'),
(25, 'spritzgieben.jpg', 'spritzgieben.jpeg', '2015-07-03 15:29:33'),
(26, 'spritzgieben-2.jpg', 'spritzgieben-2.jpeg', '2015-07-03 15:30:02'),
(27, 'spritzgieben-3.jpg', 'spritzgieben-3.jpeg', '2015-07-03 15:30:29'),
(28, 'spritzgieben-4.jpg', 'spritzgieben-4.jpeg', '2015-07-03 15:30:58'),
(29, 'dusenmontage.jpg', 'dusenmontage.jpeg', '2015-07-03 15:33:18'),
(30, 'dusenmontage-2.jpg', 'dusenmontage-2.jpeg', '2015-07-03 15:33:41'),
(31, 'dusenmontage-3.jpg', 'dusenmontage-3.jpeg', '2015-07-03 15:34:47'),
(32, 'dusenmontage-4.jpg', 'dusenmontage-4.jpeg', '2015-07-03 15:35:16'),
(33, 'dusenmontage-5.jpg', 'dusenmontage-5.jpeg', '2015-07-03 15:35:51'),
(34, 'dusenmontage-6.jpg', 'dusenmontage-6.jpeg', '2015-07-03 15:36:22'),
(35, 'dusenmontage-7.jpg', 'dusenmontage-7.jpeg', '2015-07-03 15:37:38'),
(36, 'dusenmontage-8.jpg', 'dusenmontage-8.jpeg', '2015-07-03 15:38:06'),
(37, 'dusenmontage-9.jpg', 'dusenmontage-9.jpeg', '2015-07-03 15:39:10');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admin_users`
--
ALTER TABLE `admin_users`
  ADD CONSTRAINT `admin_right_id_fk` FOREIGN KEY (`id_right`) REFERENCES `admin_right` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `moduls_links`
--
ALTER TABLE `moduls_links`
  ADD CONSTRAINT `moduls_id_fk` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `slider_links`
--
ALTER TABLE `slider_links`
  ADD CONSTRAINT `slider_id_fk` FOREIGN KEY (`id_slider`) REFERENCES `slider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
