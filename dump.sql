--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'First'),
(2, 'Second');

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'en'),
(2, 'ru'),
(3, 'fr'),
(4, 'de');

--
-- Дамп данных таблицы `vacancy`
--

INSERT INTO `vacancy` (`id`, `department_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(2, 2),
(5, 2);

--
-- Дамп данных таблицы `localization`
--

INSERT INTO `localization` (`id`, `lang_id`, `name`, `description`, `vacancy_id`) VALUES
(1, 1, 'Programmer php', 'Test description about programmer php', 1),
(2, 2, 'Программист php', 'Тестовое описание о программисте php', 1),
(3, 3, 'Programmeur php', 'Description de l''essai sur programmeur php', 1),
(4, 4, 'php-Programmierer', 'Testbeschreibung über php-Programmierer', 1),
(5, 1, 'Java programmer', 'Java test', 2),
(6, 4, 'Java-Programmierer', 'Java-Test', 2),
(7, 1, 'Waiter', 'Test description about waiter', 3),
(8, 2, 'Официант', 'Тестовое описание об официанте', 3),
(9, 3, 'Garçon', 'Description de l''essai sur serveur', 3),
(10, 4, 'Kellner', 'Testbeschreibung über Kellner', 3),
(11, 1, 'Loader', 'Test description about loader', 4),
(12, 2, 'Грузчик', 'Тестовое описание о грузчике', 4),
(13, 1, 'Manager', 'Test description about manager', 5),
(14, 2, 'Менеджер', 'Тестовое описание о менеджере', 5),
(15, 3, 'Directeur', 'Description de l''essai sur le Gestionnaire de', 5);
