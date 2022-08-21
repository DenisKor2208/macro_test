-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 22 2022 г., 00:44
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `macro_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `title`, `text`) VALUES
(1, 'Заголовок первого поста', 'Текст первого поста'),
(2, 'Заголовок второго поста', 'Текст второго поста'),
(3, 'Заголовок третьего поста', 'Текст третьего поста'),
(4, 'Заголовок четвертого поста', 'Текст четвертого поста'),
(5, 'Заголовок пятого поста', 'Текст пятого поста');

-- --------------------------------------------------------

--
-- Структура таблицы `topics_messages`
--

CREATE TABLE `topics_messages` (
  `id` int(11) NOT NULL,
  `topics_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics_messages`
--

INSERT INTO `topics_messages` (`id`, `topics_id`, `users_id`, `comment`, `date_added`) VALUES
(1, 1, 1, 'Равным образом внедрение современных подходов выявляет срочную потребность нестандартных решений', '2022-08-16 17:18:55'),
(2, 1, 2, 'Задача организации, в особенности же реализация намеченных плановых заданий', '2022-08-17 17:19:10'),
(3, 1, 3, 'В целом, конечно, новая модель организационной деятельности не дает', '2022-08-18 17:19:20'),
(4, 2, 1, 'Стоит понимать, что перспективное планирование вынуждает нас объективно потребовать стандартных подходов', '2022-08-17 17:20:55'),
(5, 3, 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor', '2022-08-18 17:21:35'),
(6, 4, 3, 'Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc', '2022-08-18 17:21:55'),
(7, 2, 2, 'Повседневная практика показывает, что новая модель организационной деятельности позволяет выполнить важные задания', '2022-08-19 17:26:25'),
(8, 1, 4, 'Не следует, однако, забывать, что перспективное планирование играет определяющее значение для позиций', '2022-08-18 18:29:18'),
(9, 4, 1, 'Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem', '2022-08-19 07:38:08'),
(10, 2, 2, 'Таким образом, рамки, задачи и место обучения кадров не дает нам иного выбора', '2022-08-19 12:28:52'),
(11, 2, 3, 'Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis', '2022-08-20 12:28:59'),
(12, 3, 3, 'Maecenas nec odio et ante tincidunt tempus', '2022-08-21 00:55:25'),
(13, 3, 1, 'Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus', '2022-08-21 11:56:25');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`) VALUES
(1, 'user1'),
(2, 'user2'),
(3, 'user3'),
(4, 'user4');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics_messages`
--
ALTER TABLE `topics_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_id` (`topics_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `topics_messages`
--
ALTER TABLE `topics_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `topics_messages`
--
ALTER TABLE `topics_messages`
  ADD CONSTRAINT `topics_messages_ibfk_1` FOREIGN KEY (`topics_id`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `topics_messages_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
