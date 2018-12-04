-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 04 2018 г., 18:08
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `vk_accounts`
--

CREATE TABLE `vk_accounts` (
  `id` int(11) NOT NULL,
  `account_id` varchar(50) NOT NULL DEFAULT '0',
  `first_name` varchar(50) NOT NULL DEFAULT '0',
  `last_name` varchar(50) NOT NULL DEFAULT '0',
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `sex` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `maiden_name` varchar(50) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `bdate` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL,
  `photo_200` varchar(250) DEFAULT NULL,
  `photo_max` varchar(250) DEFAULT NULL,
  `photo_200_orig` varchar(250) DEFAULT NULL,
  `photo_400_orig` varchar(250) DEFAULT NULL,
  `photo_max_orig` varchar(250) DEFAULT NULL,
  `photo_id` varchar(50) DEFAULT NULL,
  `online` varchar(50) DEFAULT NULL,
  `can_post` varchar(50) DEFAULT NULL,
  `can_see_all_posts` varchar(50) DEFAULT NULL,
  `can_see_audio` varchar(50) DEFAULT NULL,
  `can_write_private_message` varchar(50) DEFAULT NULL,
  `can_send_friend_request` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `facebook_name` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `status` text,
  `last_seen_time` varchar(50) DEFAULT NULL,
  `last_seen_platform` varchar(50) DEFAULT NULL,
  `crop_photo_id` varchar(50) DEFAULT NULL,
  `crop_photo_text` varchar(50) DEFAULT NULL,
  `crop_photo_date` varchar(50) DEFAULT NULL,
  `crop_photo_post_id` varchar(50) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `occupation_type` varchar(50) DEFAULT NULL,
  `occupation_name` varchar(100) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vk_accounts_photo_sizes`
--

CREATE TABLE `vk_accounts_photo_sizes` (
  `id` int(11) NOT NULL,
  `account_id` varchar(50) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `url` varchar(250) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vk_groups`
--

CREATE TABLE `vk_groups` (
  `id` int(11) NOT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `is_closed` tinyint(4) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `description` text,
  `members_count` int(11) DEFAULT NULL,
  `counters_photos` int(11) DEFAULT NULL,
  `counters_albums` int(11) DEFAULT NULL,
  `counters_topics` int(11) DEFAULT NULL,
  `counters_videos` int(11) DEFAULT NULL,
  `counters_audios` int(11) DEFAULT NULL,
  `counters_market` int(11) DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `fixed_post` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `site` varchar(250) DEFAULT NULL,
  `cover_enabled` int(11) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL,
  `photo_200` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vk_groups`
--

INSERT INTO `vk_groups` (`id`, `group_id`, `name`, `screen_name`, `is_closed`, `type`, `city`, `country`, `description`, `members_count`, `counters_photos`, `counters_albums`, `counters_topics`, `counters_videos`, `counters_audios`, `counters_market`, `activity`, `status`, `fixed_post`, `verified`, `site`, `cover_enabled`, `photo_50`, `photo_100`, `photo_200`, `url`, `created`) VALUES
(61, '99725619', 'Возрождение Российской Державы', 'club99725619', 0, 'group', 'Симферополь', 'Украина', 'Русский народ создал могущественнейшее в мире государство, величайшую империю. С Ивана Калиты последовательно и упорно собиралась Россия и достигла размеров, потрясающих воображение всех народов мира.\nНиколай Бердяев', 9369, 500, 5, 0, 49, 33, NULL, 'Открытая группа', 'Только вместе мы - СИЛА!', 128161, 0, '', 0, 'https://pp.userapi.com/c636026/v636026862/41f54/10xIHBLgFME.jpg?ava=1', 'https://pp.userapi.com/c636026/v636026862/41f53/DM0qv5xYzc4.jpg?ava=1', 'https://pp.userapi.com/c636026/v636026862/41f52/-PXmTSVsFsI.jpg?ava=1', 'https://vk.com/club99725619', '2018-11-27 18:46:38'),
(62, '97180786', 'Хрустальный Сасут', 'belsasut', 0, 'page', NULL, NULL, 'Хрустальный Сасут беларуской стабильности.\n\nДержим руку на новостном пульсе Беларуси.\nПозитивные и не очень позитивные новости.\nБез прикрас, Беларусь - как она есть.\n\nБудь в курсе самых громких событий страны! Присоединяйся! \n\nДумай.\nАнализируй.\nДелай выводы.', 8219, 1539, 15, 0, 3574, 86, NULL, 'Общество', 'Открываем глаза на беларускую стабильность.', 180169, 0, '', 1, 'https://pp.userapi.com/c627120/v627120888/452b7/OzTwLvXaFa0.jpg?ava=1', 'https://pp.userapi.com/c627120/v627120888/452b6/q3WqkrR7Wpk.jpg?ava=1', 'https://pp.userapi.com/c627120/v627120888/452b5/hnGdkck5VMo.jpg?ava=1', 'https://vk.com/belsasut', '2018-11-27 18:46:51'),
(63, '30281638', 'UDF.BY', 'udfby', 0, 'page', NULL, NULL, 'Новости Беларуси', 4673, 149, 9, 0, 39, 6, NULL, 'Интернет-СМИ', 'Новости Беларуси', 14455, 0, 'udf.by', 0, 'https://pp.userapi.com/c323926/g30281638/e_b7952f70.jpg?ava=1', 'https://pp.userapi.com/c323926/g30281638/d_4a73764e.jpg?ava=1', 'https://pp.userapi.com/c323926/g30281638/d_4a73764e.jpg?ava=1', 'https://vk.com/udfby', '2018-11-27 18:47:02'),
(66, '76296871', 'САЛІDАРНАСЦЬ - gazetaby.com', 'gztby', 0, 'group', 'Минск', 'Беларусь', 'Свежий взгляд на каждый день от белорусского интернет-проекта \"Салідарнасць\". Мы публикуем материалы  сайта www.gazetaby.com (и не только) о жизни в Беларуси и ситуации в мире.\n\nЗдесь вы найдете актуальную и интересную информацию: новости политики, экономики, спорта и многое другое. Всегда есть над чем подумать и чему улыбнуться.\n\nПодписывайтесь, оставляйте свое мнение и приглашайте друзей.', 2083, 425, 7, 1, 467, NULL, NULL, 'Открытая группа', 'Официальная страница белорусской интернет-газеты \"Салідарнасць\"', 25342, 0, 'http://gazetaby.com', 1, 'https://pp.userapi.com/c627420/v627420383/4f403/sHlz3Txt3mA.jpg?ava=1', 'https://pp.userapi.com/c627420/v627420383/4f402/lVRxYw8JzAY.jpg?ava=1', 'https://pp.userapi.com/c627420/v627420383/4f401/-umi39iymHk.jpg?ava=1', 'https://vk.com/gztby', '2018-11-27 18:48:57'),
(67, '165278869', 'СерпомПо', 'serpompo', 0, 'group', 'Москва', 'Россия', 'Группа является официальным представителем телеграм-канала СерпомПо - самого безжалостного канала о политике и экономике в России.', 4933, 1, 1, NULL, 24, NULL, NULL, 'Открытая группа', 'Подписывайтесь на телеграм-канал СерпомПо https://t.me/SerpomPo', NULL, 0, 'https://tg.telepult.pro/SerpomPo', 1, 'https://pp.userapi.com/c846321/v846321615/2786d/ORKBfFMcBWU.jpg?ava=1', 'https://pp.userapi.com/c846321/v846321615/2786c/itjeqqezrP0.jpg?ava=1', 'https://pp.userapi.com/c846321/v846321615/2786b/lxYveOWYf8Q.jpg?ava=1', 'https://vk.com/serpompo', '2018-11-27 18:49:10'),
(69, '56765622', 'МАЯ КРАІНА БЕЛАРУСЬ', 'majakrainabelarus', 0, 'page', NULL, NULL, 'Збіраем усю Беларусь тут!\n\nКанал у Telegram: https://t.me/mkbelarus \nЧат у Telegram: https://t.me/majakrainablr \nInstagram: https://www.instagram.com/majakrainabelarus/ \nFacebook: https://www.facebook.com/majakrainabelarus \nTwitter: https://twitter.com/MajaKraina \nYouTube: https://www.youtube.com/channel/UC7LyBzFnGucnOWauPGFfRYg', 133186, 8758, 65, 8, 1613, 82, 2, 'Дискуссионный клуб', 'Не сілай, а розумам!', 1496018, 0, 'http://vk.com/majakrainabelarus', 1, 'https://pp.userapi.com/c845219/v845219888/f3ec4/2733XQmD7RA.jpg?ava=1', 'https://pp.userapi.com/c845219/v845219888/f3ec3/yBZ6daCSdbI.jpg?ava=1', 'https://pp.userapi.com/c845219/v845219888/f3ec2/1lTFOVC52Fg.jpg?ava=1', 'https://vk.com/majakrainabelarus', '2018-11-29 20:18:50'),
(70, '18364543', 'ОГП | Сторонники Объединённой гражданской партии', 'partyja', 0, 'group', NULL, 'Беларусь', 'Группа объединяет членов и сторонников Объединенной гражданской партии Беларуси а также сочувствующих и интересующихся.\n\nКаждый гражданин Беларуси мечтает быть богатым и счастливым, умным и здоровым, добрым и отзывчивым. Это идеал. У каждого он свой. Ни государство, ни парламент, ни политическая партия не имеют морального права приказывать человеку, как жить, сколько зарабатывать, на каких условиях сотрудничать с соседями. Каждый имеет право на свой выбор. Нет более точного описания морального поведения человека, чем библейское относись к другому так, как бы ты хотел, чтобы он относился к тебе. Это либерально-консервативный принцип.\n\nДобросовестный гражданин не стоит в стороне, когда избивают беззащитного и обижают слабого. Он не опускает руки перед нарушениями прав человека и беззаконием и признает естественные права каждого гражданина на жизнь, собственность и стремление к счастью. Это либерально-консервативный принцип.\n\nЛиберал-консерваторы уверены, что рыночная экономика гуманна и моральна, потому что она построена на добровольных, взаимовыгодных отношениях свободных людей. Она освящена Богом. В ней есть место для правительства. Оно должно быть открытым и одинаково относится к предприятиям, не взирая на их форму собственности, размер, страну регистрации. Парламент должен принимать законы, обязательные для всех без исключения, начиная с президента и заканчивая самым отъявленным негодяем. Суд обязан быть независимым, справедливым и неподкупным. Сила государства – в верховенстве закона, в разделении властей, в жестком общественном контроле за тем, как чиновники тратят деньги. Сила государства - в демократии, когда каждый имеет право голоса, когда любого избранного политика на честных открытых выборах можно переизбрать, если он обманул надежды и ожидания избирателя. Сильное государство – это не собственник заводов и ферм, магазинов и ресторанов. Сильное государство, которое защищает гражданина от преступника и хулигана, мафии и внешнего агрессора, вора и насильника – это либерально-консервативный принцип.\n\nГосударство должно защищать человека-инвестора, человека-предпринимателя, человека-налогоплательщика и человека-потребителя. Справедливый суд, быстрое рассмотрение претензий граждан, принятие простых, понятных законов, которые обязаны выполнять все, адресная социальная помощь человеку в беде – вот что в первую очередь нужно гражданину от местных и республиканских органов власти. Рыночные реформы – это не отказ от государственного регулирования. Это стремление сделать его понятным, открытым и дешевым. Это - либерально-консервативный подход.\n\nВажнейшая задача Объединенной гражданской партии - повернуть власть лицом к гражданину, создать условия, в которых источником благополучия будет труд, а не подпись чиновника или блат. ОГП концентрирует интеллектуальные, организационные, людские и материальные ресурсы, чтобы дать возможность человеку в беде успешно включиться в процесс общественного сотрудничества, чтобы создать эффективную, прозрачную и контролируемую обществом систему борьбы с преступностью, коррупцией и кумовством. Наша задача – представлять и защищать интересы граждан Беларуси в структурах власти, бизнесе и общественных институтах, чтобы обеспечить равенство каждого перед законом. Наша задача - вернуть гражданам чувство собственного достоинства и радость работы, отдыха и семейной гармонии, чувство гордости за свою страну. Это - либерально-консервативный подход.\n\nМы слушаем Беларусь и слышим ее. Мы видим проблемы предпринимательства - и знаем, как их решать. Мы понимаем озабоченность рабочего и крестьянина - и знаем, как создавать новые рабочие места. Мы разделяем тревогу родителей – и знаем, как укреплять белорусскую семью. Мы верны прогрессивным традициям прошлого и открыты к новым тенденциям настоящего. Мы знаем ценность информации, науки и применения новых технологий. Мы – будущее независимой, справедливой, богатой, духовно развитой и процветающей Беларуси. Ради достижения этой це', 7909, 98, 7, 3, 166, 32, NULL, 'Открытая группа', 'Построим новое, сохраним лучшее.', 12420, 0, 'ucpb.org - ОГП', 0, 'https://sun9-3.userapi.com/4xKvxsYubHQUXMx2fRQPKk-HwScjFzfVLQ9cPA/lXQYRAGSlG8.jpg?ava=1', 'https://sun9-1.userapi.com/NGmLxP1KKWswZ5_12IITdmdiAlVXFZo3m4dvKg/e0uh9aMK6KA.jpg?ava=1', 'https://sun9-1.userapi.com/yoaq-LUPr14kUaoKa7S7rbiW38yxF_e_Znp4lQ/7zlioDVEoto.jpg?ava=1', 'https://vk.com/partyja', '2018-11-29 20:19:05'),
(71, '270028', '★▀  ВЧК ОГПУ НКВД МГБ КГБ ФСК ФСБ [Новости]', 'governmentsecurity', 0, 'group', 'Москва', 'Россия', 'Эта группа посвящена деятельности спецслужб  России и стран бывшего СССР. \n\nТут можно обсуждать все вопросы, касающиеся работы советских и российских спецслужб, их истории и современной деятельности. \n\nСсылки на форумы с полезной информацией о спецслужбах (устройство на работу, обучение и т.п.):\nНеофициальный Форум ИКСИ и Академии ФСБ России - Клуб Выпускников -  http://www.afsb.msk.ru/\nВоенная разведка - http://www.vrazvedka.ru/forum/\n\n--------------\n\n20 декабря 1917 постановлением СНК РСФСР была образована Всероссийская чрезвычайная комиссия при СНК по борьбе с контрреволюцией и саботажем (ВЧК). После подавления явлений саботажа, с августа 1918 года ВЧК именуется Всероссийской чрезвычайной комиссией при СНК по борьбе с контрреволюцией, спекуляцией и преступлениями по должности. Первый председатель ВЧК — Феликс Эдмундович Дзержинский. \n6 февраля 1922 ВЦИК РСФСР принял постановление об упразднении ВЧК и образовании Государственного политического управления (ГПУ) при Народном комиссариате внутренних дел (НКВД) РСФСР. \n2 ноября 1923 Президиум ЦИК СССР создал Объединённое государственное политическое управление (ОГПУ) при СНК СССР.\n3 февраля1941 НКВД СССР был разделен на два самостоятельных органа: НКВД СССР и Народный комиссариат государственной безопасности (НКГБ) СССР. В июле 1941 НКГБ СССР и НКВД СССР вновь были объединены в единый наркомат — НКВД СССР. В апреле 1943 был вновь образован НКГБ СССР.\n15 марта 1946 НКГБ СССР был преобразован в Министерство государственной безопасности (МГБ) СССР.\n7 марта 1953 было принято решение об объединении Министерства внутренних дел (МВД) СССР и МГБ СССР в единое МВД СССР\n13 марта 1954 создан Комитет государственной безопасности (КГБ) при Совете Министров СССР (с 1978 — КГБ СССР).\n6 мая 1991 Председатель Верховного Совета РСФСР Б. Н. Ельцин и председатель КГБ СССР В. А. Крючков подписали протокол об образовании в соответствии с решением Съезда народных депутатов РСФСР Комитета государственной безопасности РСФСР (КГБ РСФСР), имеющего статус союзно-республиканского государственного комитета.\n21 декабря 1993 года Борис Ельцин подписал Указ об упразднении МБ и о создании Федеральной службы контрразведки (ФСК РФ). ФСК была создана на базе МБ РФ за исключением следственного аппарата министерства.\n3 апреля 1995 года Борис Ельцин подписал Закон «Об органах Федеральной службы безопасности в Российской Федерации», на основании которого ФСБ является правопреемником Федеральной службы контрразведки (ФСК РФ).', 10194, 509, 8, 189, 315, 208, NULL, 'Открытая группа', 'История и новости разведок и контрразведок стран мира', 3007, 0, 'http://www.fsb.ru', 0, 'https://sun9-3.userapi.com/Snp7uGNkKSdwSae9ZuhsW0b5gPlBMenm4qElDA/QvTU76CxyS0.jpg?ava=1', 'https://sun9-3.userapi.com/tRWdichD0wIlDVhOkDwXQ6OMoXWZRlNANGDTSA/a1lZUJUz_Yg.jpg?ava=1', 'https://sun9-3.userapi.com/Snp7uGNkKSdwSae9ZuhsW0b5gPlBMenm4qElDA/QvTU76CxyS0.jpg?ava=1', 'https://vk.com/governmentsecurity', '2018-11-29 20:19:18'),
(72, '22639447', '#ПЛОШЧА', 'ploshcha', 0, 'group', NULL, 'Беларусь', '', 52595, 6061, 25, NULL, 9999, 76, NULL, 'Открытая группа', '', 535899, 0, '', 0, 'https://pp.userapi.com/c624817/v624817473/518df/XGJfw3L4We0.jpg?ava=1', 'https://pp.userapi.com/c624817/v624817473/518de/_4lZmkWMW0I.jpg?ava=1', 'https://pp.userapi.com/c624817/v624817473/518dd/GFfnOYy1pcE.jpg?ava=1', 'https://vk.com/ploshcha', '2018-11-30 09:14:56');

-- --------------------------------------------------------

--
-- Структура таблицы `vk_group_contacts`
--

CREATE TABLE `vk_group_contacts` (
  `id` int(11) NOT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vk_group_contacts`
--

INSERT INTO `vk_group_contacts` (`id`, `group_id`, `user_id`, `desc`, `phone`, `email`) VALUES
(113, '99725619', '224633751', 'добрый админ', NULL, NULL),
(114, '97180786', NULL, 'По вопросам рекламы или сотрудничества пишите в ЛС', NULL, NULL),
(115, '30281638', '105246671', 'Письмо редактору', NULL, 'press@udf.by'),
(121, '165278869', '483872312', NULL, NULL, NULL),
(122, '56765622', '9469356', NULL, NULL, NULL),
(123, '56765622', '151222789', 'Наконт рэклямы', NULL, NULL),
(124, '56765622', NULL, NULL, NULL, 'MajaRadzimaBelarus@gmail.com'),
(125, '18364543', '2743931', NULL, NULL, NULL),
(126, '18364543', '100069555', NULL, NULL, NULL),
(127, '18364543', '309011666', 'Председатель ОГП', NULL, NULL),
(128, '18364543', '99975320', NULL, NULL, NULL),
(129, '22639447', '106344473', 'Па ўсіх пытаньнях', NULL, NULL),
(130, '22639447', '5983046', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `vk_group_cover_images`
--

CREATE TABLE `vk_group_cover_images` (
  `id` int(11) NOT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vk_group_cover_images`
--

INSERT INTO `vk_group_cover_images` (`id`, `group_id`, `url`, `width`, `height`) VALUES
(196, '97180786', 'https://sun9-6.userapi.com/c626316/v626316550/63db6/wXqHA4bIwY8.jpg', 200, 50),
(197, '97180786', 'https://sun9-5.userapi.com/c626316/v626316550/63db5/PBIfnhgR9Mg.jpg', 400, 101),
(198, '97180786', 'https://sun9-4.userapi.com/c626316/v626316550/63db2/tKS7B8YNI_4.jpg', 795, 200),
(199, '97180786', 'https://sun9-5.userapi.com/c626316/v626316550/63db4/rKXZG-yYV7o.jpg', 1080, 272),
(200, '97180786', 'https://sun9-6.userapi.com/c626316/v626316550/63db3/ycaVoM8kdUM.jpg', 1590, 400),
(206, '76296871', 'https://sun9-4.userapi.com/c840026/v840026620/536e2/JtE-JbQXhP4.jpg', 200, 50),
(207, '76296871', 'https://sun9-6.userapi.com/c840026/v840026620/536e1/WkTrkPLlf_Y.jpg', 400, 101),
(208, '76296871', 'https://sun9-4.userapi.com/c840026/v840026620/536de/QuDhJ6-V8GU.jpg', 795, 200),
(209, '76296871', 'https://sun9-4.userapi.com/c840026/v840026620/536e0/Q9qu6PbLDuM.jpg', 1080, 272),
(210, '76296871', 'https://sun9-1.userapi.com/c840026/v840026620/536df/omd06XH53yc.jpg', 1590, 400),
(211, '165278869', 'https://sun9-5.userapi.com/c846218/v846218876/2f117/EJsCMMhwj3g.jpg', 200, 50),
(212, '165278869', 'https://sun9-7.userapi.com/c846218/v846218876/2f116/_o3qYEJRdCo.jpg', 400, 101),
(213, '165278869', 'https://sun9-1.userapi.com/c846218/v846218876/2f113/6sBWXIgdmds.jpg', 795, 200),
(214, '165278869', 'https://sun9-1.userapi.com/c846218/v846218876/2f115/H8Xy2Dq3F5A.jpg', 1080, 272),
(215, '165278869', 'https://sun9-1.userapi.com/c846218/v846218876/2f114/5Dkouknnssk.jpg', 1590, 400),
(216, '56765622', 'https://sun9-5.userapi.com/c845219/v845219888/f3efb/7E2SjJd5K3o.jpg', 200, 50),
(217, '56765622', 'https://sun9-1.userapi.com/c845219/v845219888/f3efa/9PwULz0ZlyA.jpg', 400, 101),
(218, '56765622', 'https://sun9-8.userapi.com/c845219/v845219888/f3ef7/T2OX6XT5SYk.jpg', 795, 200),
(219, '56765622', 'https://sun9-7.userapi.com/c845219/v845219888/f3ef9/YVna-y7ZHyE.jpg', 1080, 272),
(220, '56765622', 'https://sun9-1.userapi.com/c845219/v845219888/f3ef8/cm-F2WzTSL4.jpg', 1590, 400);

-- --------------------------------------------------------

--
-- Структура таблицы `vk_group_links`
--

CREATE TABLE `vk_group_links` (
  `id` int(11) NOT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `edit_title` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vk_group_links`
--

INSERT INTO `vk_group_links` (`id`, `group_id`, `url`, `edit_title`, `name`, `desc`, `photo_50`, `photo_100`) VALUES
(467, '99725619', 'https://vk.com/club109789595', NULL, 'Ветер СВОБОДЫ', '330 участников', 'https://pp.userapi.com/c637728/v637728132/34521/ez2kYV6I4Dw.jpg?ava=1', 'https://pp.userapi.com/c637728/v637728132/34520/G9L3cELzQRA.jpg?ava=1'),
(468, '99725619', 'https://vk.com/rf_russian', NULL, 'Единая Русь', 'Организация', 'https://sun9-3.userapi.com/aFlbT5LexL59_9KNkxThWbP5r6q3wghKIAXatQ/H1wcNHDmlEg.jpg?ava=1', 'https://sun9-8.userapi.com/FJWeo2qOQ_JFrSscCScTHiYD5onKNnWS9h775Q/YpJJOR39raI.jpg?ava=1'),
(469, '99725619', 'https://vk.com/vognebrodanet', NULL, 'АнтиДеза - Гражданское Сопротивление', 'Творческое объединение', 'https://pp.userapi.com/c637921/v637921867/2a6f0/7tvrk1yrRpI.jpg?ava=1', 'https://pp.userapi.com/c637921/v637921867/2a6ef/wuQzB9GAdUk.jpg?ava=1'),
(470, '99725619', 'https://vk.com/rupod', NULL, 'Записки Патриота', NULL, 'https://sun9-1.userapi.com/c831308/v831308541/11cf83/yVqFYjaA9Xw.jpg?ava=1', 'https://sun9-8.userapi.com/c831308/v831308541/11cf82/UhjIyJFZ2Do.jpg?ava=1'),
(471, '99725619', 'https://vk.com/great_r_f', NULL, 'РОДИНА', 'СМИ', 'https://pp.userapi.com/c621621/v621621553/31832/YCReDN7ztSk.jpg?ava=1', 'https://pp.userapi.com/c621621/v621621553/31831/4tNgPhvIpBY.jpg?ava=1'),
(472, '99725619', 'https://vk.com/club109899607', NULL, 'Юго-Восток: возвращение домой', NULL, 'https://pp.userapi.com/c836230/v836230171/4cf87/SihNV9ZSydw.jpg?ava=1', 'https://pp.userapi.com/c836230/v836230171/4cf86/cqM15kzAsn0.jpg?ava=1'),
(473, '99725619', 'https://vk.com/sdelano_u_nass', NULL, 'СДЕЛАНО У НАС!!!!  ЕСТЬ ЧЕМ ГОРДИТЬСЯ.!!!', '1 148 участников', 'https://pp.userapi.com/c631221/v631221515/50014/-CYdN2jme5o.jpg?ava=1', 'https://pp.userapi.com/c631221/v631221515/50013/H-iFBhad8pI.jpg?ava=1'),
(474, '99725619', 'https://vk.com/operativnye_novosti_novorossii', NULL, 'Новости России, Донбасса, Сирии!', NULL, 'https://vk.com/images/community_50.png?ava=1', 'https://vk.com/images/community_100.png?ava=1'),
(475, '99725619', 'https://www.facebook.com/groups/VozrozgdenieRD/', 1, 'https://www.facebook.com/groups/VozrozgdenieRD/', 'www.facebook.com', NULL, NULL),
(476, '99725619', 'http://vozrozgdenie-rd.livejournal.com/', 1, 'Возрождение Российской Державы', 'vozrozgdenie-rd.livejournal.com', NULL, NULL),
(477, '99725619', 'http://twitter.com/VozrozgdenieRd', 1, 'Vozrozgdenie RD (@VozrozgdenieRd) | Твиттер', 'twitter.com', 'https://pp.userapi.com/c622222/v622222751/3f931/K8a7_QJCJAU.jpg', 'https://pp.userapi.com/c622222/v622222751/3f932/3qdc8gdgiXk.jpg'),
(478, '97180786', 'https://www.facebook.com/belsasut/', 1, 'Мы в Facebook. Контент может отличаться от паблика', 'www.facebook.com', 'https://pp.userapi.com/c840220/v840220770/6c069/diZPotm7qAo.jpg', 'https://pp.userapi.com/c840220/v840220770/6c06a/x7DjwZ3F2xw.jpg'),
(479, '97180786', 'https://t.me/belsasut', 1, 'Наш чат в Telegram. Общение и новости. Заходите!', 't.me', 'https://pp.userapi.com/c837534/v837534757/6c849/Vn_iFeWcZEQ.jpg', 'https://pp.userapi.com/c837534/v837534757/6c84a/pE6RXNHOECI.jpg'),
(480, '97180786', 'https://vk.com/pobirushki', NULL, 'СТОП Мошенники! Беларусь', 'Хватит спонсировать побирушек и других мошенников!', 'https://pp.userapi.com/c824500/v824500160/4c68c/-b5Jj6D976M.jpg?ava=1', 'https://pp.userapi.com/c824500/v824500160/4c68b/vhgVGsjPsyQ.jpg?ava=1'),
(481, '97180786', 'https://www.youtube.com/channel/UCl2dW2SblCJVAC3CZ', 1, 'Канал \"Общество Гомель\"', 'www.youtube.com', 'https://sun9-7.userapi.com/c840538/v840538619/61566/JmbsMbymjnk.jpg', 'https://sun9-6.userapi.com/c840538/v840538619/61567/uj77gKgGLeo.jpg'),
(482, '97180786', 'https://vk.com/dvizh_bel', NULL, 'ДВИЖ (#БНР100)', NULL, 'https://pp.userapi.com/c845120/v845120336/a3bf7/O_lH2Q8zWlw.jpg?ava=1', 'https://pp.userapi.com/c845120/v845120336/a3bf6/qfGfL8oNOmA.jpg?ava=1'),
(483, '30281638', 'https://www.facebook.com/udf.news/', 1, 'Читайте нас на Facebook', 'www.facebook.com', NULL, NULL),
(484, '30281638', 'https://twitter.com/_belarus', 1, 'Читайте нас в Twitter', 'twitter.com', NULL, NULL),
(485, '30281638', 'http://udf.by/apps.html', 1, 'Мобильное приложение UDF.BY', 'udf.by', 'https://pp.userapi.com/c6040/v6040671/18d/aD5V-h2Qb6c.jpg', 'https://pp.userapi.com/c6040/v6040671/18e/f9UT1QQ0fZc.jpg'),
(486, '30281638', 'http://udf.by/projects.html', 1, 'СпецПроекты UDF.BY', 'udf.by', 'https://pp.userapi.com/c6040/v6040671/190/A-0ss3nsnPc.jpg', 'https://pp.userapi.com/c6040/v6040671/191/3QYAltb22bI.jpg'),
(487, '30281638', 'http://udf.by/contacts.html', 1, 'Связаться с нами', 'udf.by', NULL, NULL),
(496, '76296871', 'http://gazetaby.com', 1, 'Салiдарнасць - свежий взгляд на каждый день', 'gazetaby.com', 'https://sun9-7.userapi.com/1xe1U5_ghHlGhk_yHVo53b0Fz1ET6UAVOaNzbg/yBuVS7GzI88.jpg', 'https://sun9-6.userapi.com/sJoX775wFQc1wYMoDPQs-n3aWn1hwe6X0pndeQ/TOCaV69ZwMY.jpg'),
(497, '165278869', 'https://tg.telepult.pro/SerpomPo', 1, 'Открыть Serpompo в Telegram через Telepult', 'tg.telepult.pro', 'https://pp.userapi.com/c852320/v852320680/22192/wbDwJp6o9os.jpg', 'https://pp.userapi.com/c852320/v852320680/22193/jhppTM5GN5c.jpg'),
(498, '165278869', 'https://t.me/SerpomPo', 1, 'СерпомПо в Telegram', 't.me', NULL, NULL),
(499, '165278869', 'https://www.facebook.com/groups/SerpomPo/', 1, 'СерпомПо в Facebook', 'www.facebook.com', NULL, NULL),
(500, '165278869', 'http://twitter.com/Serpompo2018', 1, 'СерпомПо в Twitter', 'twitter.com', 'https://pp.userapi.com/c846520/v846520102/2a9e8/Z1D0bIy84Zc.jpg', 'https://pp.userapi.com/c846520/v846520102/2a9ea/Al1pYrZ1qYk.jpg'),
(501, '165278869', 'https://ok.ru/serpom.po', 1, 'СерпомПо в \"Одноклассниках\"', 'ok.ru', 'https://sun9-8.userapi.com/c830408/v830408971/1e352b/3uCgaOvDylY.jpg', 'https://sun9-3.userapi.com/c830408/v830408971/1e352c/8zsVRU79eA8.jpg'),
(502, '165278869', 'https://serpompo2018.livejournal.com/', 1, 'СерпомПо в ЖЖ', 'serpompo2018.livejournal.com', NULL, NULL),
(503, '165278869', 'https://echo.msk.ru/blog/serpompo2018', 1, 'СерпомПо на сайте \"Эхо Москвы\"', 'echo.msk.ru', NULL, NULL),
(504, '165278869', 'http://www.site101.mir915bcf08b.comcb.info/search.', 1, 'СерпомПо на Kasparov.ru (\"зеркало\")', 'www.site101.mir915bcf08b.comcb.info', 'https://pp.userapi.com/c845522/v845522236/1163dc/g3spdfOgmOY.jpg', 'https://pp.userapi.com/c845522/v845522236/1163dd/YIkxvS4RvX8.jpg'),
(505, '165278869', 'https://zen.yandex.ru/id/5ac4f0eb610493d7df7a5848', 1, 'СерпомПо в Yandex Zen', 'zen.yandex.ru', 'https://pp.userapi.com/c840728/v840728102/72c52/MkEmQtKPrRc.jpg', 'https://pp.userapi.com/c840728/v840728102/72c54/E4hKO04Prik.jpg'),
(506, '56765622', 'https://t.me/mkbelarus', 1, 'Канал у Telegram', 't.me', 'https://pp.userapi.com/c840132/v840132187/473ba/N7ImCtszqpc.jpg', 'https://pp.userapi.com/c840132/v840132187/473bb/zTNquzuWhOY.jpg'),
(507, '56765622', 'https://instagram.com/majakrainabelarus/', 1, 'Мы ў Instagram', 'instagram.com', 'https://pp.userapi.com/c622416/v622416356/3937d/kjhugxR95Ys.jpg', 'https://pp.userapi.com/c622416/v622416356/3937e/X8a5bASkdFI.jpg'),
(508, '56765622', 'https://www.facebook.com/majakrainabelarus', 1, 'Мы ў Facebook', 'www.facebook.com', 'https://pp.userapi.com/c322431/v322431356/a084/xXWfSgSlP5E.jpg', 'https://pp.userapi.com/c322431/v322431356/a085/GjXwrfgq8_4.jpg'),
(509, '56765622', 'https://www.youtube.com/channel/UC7LyBzFnGucnOWauP', 1, 'Наш Youtube', 'www.youtube.com', 'https://pp.userapi.com/c836134/v836134356/f84a/A03fzxhlQwM.jpg', 'https://pp.userapi.com/c836134/v836134356/f84b/2upRWxCYx8E.jpg'),
(510, '56765622', 'https://twitter.com/MajaKraina', 1, 'Мы ў Twitter', 'twitter.com', 'https://pp.userapi.com/c625531/v625531356/20dc7/XW3-ZK08U3o.jpg', 'https://pp.userapi.com/c625531/v625531356/20dc8/qk-vu1UA7Cg.jpg'),
(511, '56765622', 'https://t.me/majakrainablr', 1, 'Чат у Telegram', 't.me', 'https://pp.userapi.com/c638124/v638124545/6cd9a/fEqT6CESJOk.jpg', 'https://pp.userapi.com/c638124/v638124545/6cd9b/uXHcOsAj5-w.jpg'),
(512, '18364543', 'https://vk.com/public55937650', NULL, '#noRussianBaseinBelarus', 'Public Movement', 'https://pp.userapi.com/c845122/v845122958/130d91/UdmUEopFMww.jpg?ava=1', 'https://pp.userapi.com/c845122/v845122958/130d90/uEtlVDUH2og.jpg?ava=1'),
(513, '18364543', 'https://vk.com/event68128926', NULL, 'Митинг Объединённой гражданской партии в Могилёв', NULL, 'https://pp.userapi.com/c314324/v314324931/c7d0/KP8f-D6CVLA.jpg?ava=1', 'https://pp.userapi.com/c314324/v314324931/c7cf/tWJNW5eWkZo.jpg?ava=1'),
(514, '18364543', 'https://vk.com/club1967802', NULL, 'Молодые демократы', 'Подрастающее поколение', 'https://pp.userapi.com/c631222/v631222692/b7d4/bJwm0SFtnGY.jpg?ava=1', 'https://pp.userapi.com/c631222/v631222692/b7d3/CRn4Da3aToY.jpg?ava=1'),
(515, '18364543', 'https://vk.com/club28076001', NULL, 'Аб\'яднаная грамадзянская партыя (АГП), Магілёў. ', 'Могилёвское отделение', 'https://sun9-4.userapi.com/gj_zVZBMpyycdSpOsZQ-GlqJ-MBMdyulg38ONQ/Y8UJ7eyJk9o.jpg?ava=1', 'https://sun9-7.userapi.com/62y5sEsgf48JdqEIfXqtIEoYdFJBRIxQQcIWWw/nNa4I_SzvGY.jpg?ava=1'),
(516, '18364543', 'https://vk.com/club25368139', NULL, 'Требуем обеспечения законного права на медицинскую', NULL, 'https://pp.userapi.com/c5160/g25368139/e_2edf11fc.jpg?ava=1', 'https://pp.userapi.com/c5160/g25368139/d_69756428.jpg?ava=1'),
(517, '270028', 'https://vk.com/club37718121', NULL, 'Фильмы про разведчиков и шпионов', NULL, 'https://pp.userapi.com/c10578/g37718121/e_9e089a18.jpg?ava=1', 'https://pp.userapi.com/c10578/g37718121/d_325ae054.jpg?ava=1'),
(518, '270028', 'https://vk.com/militarywar', 1, 'PolitJournal : Политика, Экономика, Война', '', 'https://pp.userapi.com/c316731/v316731479/796e/K_DvWJHF7N0.jpg?ava=1', 'https://pp.userapi.com/c316731/v316731479/796d/ZkzWYsNQBs8.jpg?ava=1'),
(519, '270028', 'https://vk.com/gru_rf', 1, 'Главное разведывательное управление (ГРУ ГШ)', 'друзья', 'https://pp.userapi.com/c631629/v631629494/2b425/kqk6VIBV2GM.jpg?ava=1', 'https://pp.userapi.com/c631629/v631629494/2b424/kFGnJVkjXkE.jpg?ava=1'),
(520, '270028', 'https://vk.com/polk1005', 1, 'Президентский (Кремлевский) полк ФСО России.', '', 'https://pp.userapi.com/c840128/v840128342/fc3a/ShBWvjXPSnk.jpg?ava=1', 'https://pp.userapi.com/c840128/v840128342/fc39/ebSBQKDMnTE.jpg?ava=1'),
(521, '270028', 'https://vk.com/lubyanka2', 1, 'ФСБ РФ', '', 'https://pp.userapi.com/c308817/v308817937/3d67/oTDz5AkjnRo.jpg?ava=1', 'https://pp.userapi.com/c308817/v308817937/3d66/FhVch17_sUw.jpg?ava=1'),
(522, '270028', 'https://vk.com/a_fsb', 1, 'Академия лесного хозяйства', 'Кузница чекистов , хочешь быть одним из них - тебе', 'https://pp.userapi.com/c5087/g17829497/c_97df024a.jpg?ava=1', 'https://pp.userapi.com/c5087/g17829497/b_d97dd919.jpg?ava=1'),
(523, '270028', 'https://vk.com/club32308008', NULL, 'Группа посвящена погибшим сотрудникам ЦСН ФСБ', NULL, 'https://vk.com/images/community_50.png?ava=1', 'https://vk.com/images/community_100.png?ava=1'),
(524, '270028', 'https://vk.com/club630194', 1, 'Чилдринята-Комитята', 'группа тех, чьи родители служили в спецслужбах', 'https://pp.userapi.com/c1240/g630194/c_25171606.jpg?ava=1', 'https://pp.userapi.com/c1240/g630194/b_4d9a7e47.jpg?ava=1'),
(525, '270028', 'https://vk.com/club4501256', NULL, 'Новая  Имперская  Идея .  Российский  Проект  Цент', '435 участников', 'https://sun9-6.userapi.com/mAiEFr-cIaVpuZ2b_IEU3M2LU4MJJUnPfOm_zg/93lJ7ByObjk.jpg?ava=1', 'https://sun9-2.userapi.com/fVwQnkHCC-NfL43JOE87eW8A7d8gRv0_bRyH0A/gLSP_p2D0P0.jpg?ava=1'),
(526, '270028', 'https://vk.com/club143981', 1, 'Мир и Мы', '', 'https://pp.userapi.com/c847016/v847016870/efbd6/PeDfVzu-2gY.jpg?ava=1', 'https://pp.userapi.com/c847016/v847016870/efbd5/9q6VNCdLC-w.jpg?ava=1'),
(527, '270028', 'https://vk.com/nasha_rodina_sssr', 1, '★ НАША РОДИНА - СССР ★ Историческая группа ★', '', 'https://pp.userapi.com/c629101/v629101632/1fbf2/ptAq6riY9Uc.jpg?ava=1', 'https://pp.userapi.com/c629101/v629101632/1fbf1/b8OJdfSCvh0.jpg?ava=1'),
(528, '270028', 'https://vk.com/club860718', 1, '☭★☭★☭ВИК \"Феникс\" (Реконструкция. Великая Отечес', '', 'https://pp.userapi.com/c144/g860718/c_127b2aa4.jpg?ava=1', 'https://pp.userapi.com/c144/g860718/b_998434cd.jpg?ava=1'),
(529, '270028', 'https://vk.com/club7633', 1, 'Разведка', '', 'https://pp.userapi.com/c39/g07633/c_b9f1777.jpg?ava=1', 'https://pp.userapi.com/c39/g07633/b_b9f1777.jpg?ava=1'),
(530, '270028', 'https://vk.com/specnaz001', 1, '★ Спецслужбы ★', '', 'https://pp.userapi.com/c841027/v841027648/27393/YBQ460_Jj24.jpg?ava=1', 'https://pp.userapi.com/c841027/v841027648/27392/DrTuDxWtti0.jpg?ava=1'),
(531, '270028', 'https://vk.com/club2243092', 1, 'Государственная и личная безопасность', '', 'https://pp.userapi.com/c1241/g2243092/c_f8eefe03.jpg?ava=1', 'https://pp.userapi.com/c1241/g2243092/b_f3d9908a.jpg?ava=1'),
(532, '270028', 'https://vk.com/club2654434', 1, 'Уголовное право России', '', 'https://pp.userapi.com/c628718/v628718835/3d6ac/w4u7IaTvQNw.jpg?ava=1', 'https://pp.userapi.com/c628718/v628718835/3d6ab/jdFR18GEl90.jpg?ava=1'),
(533, '270028', 'https://vk.com/club81837', 1, 'Мы любим РОДИНУ', '', 'https://sun9-8.userapi.com/wG9cleB6NeNwRCuarRoUrHux0Wm_cL_NoyF5jA/hzcVmczdNVg.jpg?ava=1', 'https://sun9-2.userapi.com/fcip2GSr92goWPVIKR9fG5NVrNWYRGAmx8dc4A/Gy-zI4skSAM.jpg?ava=1'),
(534, '270028', 'https://vk.com/camoshop', 1, 'Экипировочный Центр Специального Назначения', '', 'https://pp.userapi.com/c9639/g8399033/e_1d6d83b6.jpg?ava=1', 'https://pp.userapi.com/c9639/g8399033/d_fb8b8404.jpg?ava=1'),
(535, '270028', 'https://vk.com/club16779411', 1, '**ТЕРРОРИЗМ** должен знать каждый!!!(18+)', '', 'https://pp.userapi.com/c9545/g16779411/c_75406f3f.jpg?ava=1', 'https://pp.userapi.com/c9545/g16779411/b_bcb693d3.jpg?ava=1'),
(536, '22639447', 'https://vk.com/belpahonia', NULL, 'Атрад \"Пагоня\"/ Загін \"Погоня\"/ Отряд \"Погоня\"', NULL, 'https://pp.userapi.com/c836323/v836323664/36525/M0rdlO9MY7g.jpg?ava=1', 'https://pp.userapi.com/c836323/v836323664/36524/yLb_XNJj3do.jpg?ava=1'),
(537, '22639447', 'http://palitviazni.info/', 1, 'Свабоду палітвязьням!', 'palitviazni.info', 'https://pp.userapi.com/c623725/v623725473/41a8a/2RXp1zYY0UQ.jpg', 'https://pp.userapi.com/c623725/v623725473/41a8b/XldtJm3vHvU.jpg'),
(538, '22639447', 'http://moyby.com', 1, 'Мой BY — Новости Беларуси', 'moyby.com', NULL, NULL),
(539, '22639447', 'http://gruz200.net/', 1, 'Груз 200: База данных убитых, плененных, пропавших', 'gruz200.net', 'https://sun9-5.userapi.com/2znJ7ATQIjVyix4BOI0bIf2pDArKsXv6zJJ0OQ/bSWpF0L0ku8.jpg', 'https://sun9-4.userapi.com/zQ1raV4GbbsbJ03GFnfdsIMZeNt4HxbtJOGFdw/Cjyo6SEDJhA.jpg'),
(540, '22639447', 'https://vk.com/bitcoin_novosti', NULL, '#BITCOIN: БИТКОИН НОВОСТИ', NULL, 'https://sun9-2.userapi.com/-uDUil9rzcbCjZKUOhTSlvGOpvEDrV_Z8KA8kw/F2FwFmT9Ins.jpg?ava=1', 'https://sun9-7.userapi.com/H-s9fYa1LtPnT-dU-L8bbYLWIb2Wdh30upALYQ/jeP54DLpKVA.jpg?ava=1');

-- --------------------------------------------------------

--
-- Структура таблицы `vk_posts`
--

CREATE TABLE `vk_posts` (
  `id_post` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date_post` date NOT NULL,
  `time_post` time NOT NULL,
  `text_post` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vk_accounts`
--
ALTER TABLE `vk_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_accounts_photo_sizes`
--
ALTER TABLE `vk_accounts_photo_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_groups`
--
ALTER TABLE `vk_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_group_contacts`
--
ALTER TABLE `vk_group_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_group_cover_images`
--
ALTER TABLE `vk_group_cover_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_group_links`
--
ALTER TABLE `vk_group_links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vk_posts`
--
ALTER TABLE `vk_posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vk_accounts`
--
ALTER TABLE `vk_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `vk_accounts_photo_sizes`
--
ALTER TABLE `vk_accounts_photo_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `vk_groups`
--
ALTER TABLE `vk_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT для таблицы `vk_group_contacts`
--
ALTER TABLE `vk_group_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT для таблицы `vk_group_cover_images`
--
ALTER TABLE `vk_group_cover_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT для таблицы `vk_group_links`
--
ALTER TABLE `vk_group_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
