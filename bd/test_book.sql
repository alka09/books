-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 19 2021 г., 11:37
-- Версия сервера: 5.7.29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_book`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(2, 'Алексей Пехов'),
(6, 'Анастасия Парфенова'),
(3, 'Лоис Макма́стер Бу́джолд'),
(4, 'Мария Семенова'),
(5, 'Ольга Громыко'),
(7, 'Соавтор 1'),
(8, 'Соавтор 2'),
(1, 'Терри Пратчет');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) UNSIGNED NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Танцующая с ауте', 'Чтобы не допустить войны, той, что носит титул Танцующей с Ауте, пришлось отправиться в миры врагов. Антею тор Дериул ждут губительная паутина чужой цивилизации и непримиримые столкновения с собственным народом. Сплелись в танце судьбы магия и технология, меч и память, ярость и любовь.', 1626470633, 1626470633),
(2, 'Барраяр', 'Лорд Эйрел Форкосиган назначен регентом четырехлетнего императора Грегора. Однако далеко не всем это по душе. Барраяр охвачен интригами и заговорами. И главному смутьяну - могущественному графу Вейдлу Фордариану - удается организовать дворцовый переворот, объявить маленького императора погибшим и обвинить в его смерти лорда Форкосигана...', 2021, 2021),
(3, 'Белый огонь', 'Магия, давно забытая, пробуждается. Все, что считалось истиной сотнями лет, покрывается трещинами. Время Шестерых давно прошло, но остались те, кто помнит ту эпоху. И теперь Шерон из Нимада, указывающей, ставшей некромантом, придется использовать белый огонь, чтобы противостоять тьме.', 2021, 2021),
(4, 'Волкодав', 'Мир был жесток к нему, и он платил миру той же монетой. Никому не верил и ничего не боялся. Он — человек, выжженный изнутри, последний воин из рода Серого Пса, воин по имени Волкодав. Затем он вернулся. И прошел сквозь Врата иного мира, чтобы продолжить свой поединок со злом. Холодная сталь берегла его днем, собачья шерсть — ночью. Он был последним в роду, но, пока он был жив, Серые Псы не потеряли свое право на поединок.', 2021, 2021),
(5, 'Профессия - ведьма', 'Неужели вампиры снова отважились творить свои злодеяния? Человеческие жертвы вопиют о справедливости! В Догеву отправляется неунывающая адептка Старминской Школы Магов, Пифий и Травниц', 2021, 2021);

-- --------------------------------------------------------

--
-- Структура таблицы `book_author`
--

CREATE TABLE `book_author` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book_author`
--

INSERT INTO `book_author` (`book_id`, `author_id`) VALUES
(1, 6),
(2, 3),
(3, 2),
(3, 7),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1626170050),
('m130524_201442_init', 1626170053),
('m190124_110200_add_verification_token_column_to_user_table', 1626170053),
('m210713_101933_create_books_table', 1626442123),
('m210713_102622_create_authors_table', 1626442210),
('m210716_133042_create_book_author_table', 1626442578);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '86QgP8i_mc59RN0JrwuVVg3yi4oUvjfv', '$2y$13$SBSXO9MA9jPobL2ZvaNOwOuawVDgm1RlZDi.OT8LxsVREUkWGg9xq', NULL, 'admin@test.com', 10, 1626194628, 1626244999, 'X3NaSZd_j74AG_WhS14ZB2WB9qHM3fy__1626194628'),
(2, 'alka', 'oyEbIoyyozGuvTJmOmD0FduM64v-byGN', '$2y$13$Zno.eaTheFVQxeineuzf6ubLC2SbVq1GthooxG3L1V1nEDUkDFAhy', NULL, 'a@aaa.com', 10, 1626244455, 1626244924, 'J9c32uJu16Ox_ZT0GcLEfqlOcxZNLxKD_1626244455');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-author-name` (`name`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `idx-book_author-book_id` (`book_id`),
  ADD KEY `idx-book_author-author_id` (`author_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `fk-book_author-author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-book_author-book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
