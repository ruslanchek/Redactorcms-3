# ************************************************************
# Sequel Pro SQL dump
# Версия 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Адрес: 127.0.0.1 (MySQL 5.5.29)
# Схема: rdc3
# Время создания: 2013-09-30 00:03:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы gallery_albums
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_albums`;

CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `publish` tinyint(1) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `gallery_albums` WRITE;
/*!40000 ALTER TABLE `gallery_albums` DISABLE KEYS */;

INSERT INTO `gallery_albums` (`id`, `name`, `publish`, `sort`)
VALUES
	(1,'Альбом 1',NULL,1),
	(2,'Альбом 2',NULL,2),
	(3,'Альбом 3',NULL,3),
	(4,'Альбом 4',NULL,4),
	(5,'Альбом 5',NULL,5);

/*!40000 ALTER TABLE `gallery_albums` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы gallery_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_images`;

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `album_id` int(11) DEFAULT '0',
  `publish` tinyint(1) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `extension` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;

INSERT INTO `gallery_images` (`id`, `name`, `description`, `album_id`, `publish`, `sort`, `extension`)
VALUES
	(633,NULL,NULL,1,0,1,'jpg'),
	(634,NULL,NULL,1,0,2,'jpg'),
	(635,NULL,NULL,1,0,3,'jpg'),
	(636,NULL,NULL,5,0,1,'jpg'),
	(637,NULL,NULL,5,0,2,'jpg'),
	(638,NULL,NULL,5,0,3,'jpg'),
	(642,NULL,NULL,5,0,7,'jpg'),
	(643,NULL,NULL,5,0,8,'jpg'),
	(646,NULL,NULL,1,0,1,'jpg'),
	(647,NULL,NULL,2,0,2,'jpg'),
	(648,NULL,NULL,4,0,1,'jpg'),
	(649,NULL,NULL,4,0,2,'gif'),
	(650,NULL,NULL,4,0,3,'png'),
	(651,NULL,NULL,3,0,1,'jpg');

/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `name`)
VALUES
	(1,'Главное'),
	(2,'Нижнее'),
	(3,'Левое');

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `name` mediumtext NOT NULL,
  `announce` longtext,
  `content` longtext,
  `path` text,
  `news_lines` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `publish`, `name`, `announce`, `content`, `path`, `news_lines`)
VALUES
	(1,1,'Российские железные дороги','<p>\n	            asdasd\n</p>','<p>\n	            asdasd\n</p>','rossiyskie_jeleznyie_dorogiыывф',1),
	(2,1,'asdsad','<p>\n	asdasdasd\n</p>','<p>\n	sadasd\n</p>','test1',2),
	(3,1,'asdasd','<p>\n	asd\n</p>','<p>\n	asdasdasd\n</p>','test2',1),
	(4,1,'asdasd','<p>\n	asdasd\n</p>','<p>\n	asdasdasd\n</p>','test3',2),
	(5,1,'123123','<p>\n	123123\n</p>','<p>\n	123\n</p>','test4',1),
	(6,1,'asdasd','<p>\n	123\n</p>','<p>\n	123\n</p>','test5',2),
	(7,1,'qwe','<p>\n	qwewqe\n</p>','<p>\n	111\n</p>','test6',1),
	(8,1,'cccc','','','testsfdsdf',1);

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы news_lines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news_lines`;

CREATE TABLE `news_lines` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news_lines` WRITE;
/*!40000 ALTER TABLE `news_lines` DISABLE KEYS */;

INSERT INTO `news_lines` (`id`, `publish`, `name`)
VALUES
	(1,1,'Новости компании'),
	(2,1,'Новости рынка');

/*!40000 ALTER TABLE `news_lines` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `publish`, `name`, `content`)
VALUES
	(3,0,'Тест таггетов','<h2>Таггеты</h2>\n<p>\n	                Дата: {DATE}\n</p>\n<p>\n	                Время: {TIME}\n</p>\n<p>\n	               Seo title: {SEO_TITLE}\n</p>\n<p>\n	               Имя узла: {NODE_TITLE}\n</p>\n<p>\n	               Путь узла: {NODE_PATH}\n</p>'),
	(7,0,'Главная','<p>\n	Привет!\n</p>');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Дамп таблицы structure
# ------------------------------------------------------------

DROP TABLE IF EXISTS `structure`;

CREATE TABLE `structure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `structure` WRITE;
/*!40000 ALTER TABLE `structure` DISABLE KEYS */;

INSERT INTO `structure` (`id`, `pid`)
VALUES
	(1,0),
	(39,1),
	(41,27),
	(40,1),
	(27,1),
	(42,27);

/*!40000 ALTER TABLE `structure` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы structure_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `structure_data`;

CREATE TABLE `structure_data` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `path` tinytext NOT NULL,
  `part` tinytext,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `sort` tinyint(4) DEFAULT '0',
  `seo_description` text,
  `seo_keywords` text,
  `seo_title` text,
  `menu_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `blocks` text,
  `main_block` text,
  PRIMARY KEY (`id`),
  KEY `path` (`path`(2))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `structure_data` WRITE;
/*!40000 ALTER TABLE `structure_data` DISABLE KEYS */;

INSERT INTO `structure_data` (`id`, `name`, `path`, `part`, `publish`, `sort`, `seo_description`, `seo_keywords`, `seo_title`, `menu_id`, `template_id`, `blocks`, `main_block`)
VALUES
	(1,'Корневой узел','/','1',1,1,'Test 3','Test 2','Test 1',1,1,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]}]','{\"module\":1,\"module_mode\":1,\"content_id\":7,\"mode_template\":\"page.simple.tpl\",\"menu_parent_id\":null,\"options\":[]}'),
	(27,'Новости','/news/','news',1,1,'','','',1,2,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":4,\"mode_template\":\"navigation.breadcrumbs.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":3,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":4,\"module\":2,\"module_mode\":3,\"mode_template\":\"navigation.menu.sub_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"carrier_id\":null,\"options\":[]}]','{\"module\":3,\"module_mode\":1,\"content_id\":null,\"mode_template\":\"news.news_list.tpl\",\"menu_parent_id\":null,\"options\":[{\"name\":\"limit\",\"value\":\"3\"}]}'),
	(39,'Таггеты','/taggets/','taggets',1,2,'','','',1,2,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":4,\"mode_template\":\"navigation.breadcrumbs.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":3,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]}]','{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}'),
	(40,'Карта сайта','/sitemap/','sitemap',1,3,'','','',1,2,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":4,\"mode_template\":\"navigation.breadcrumbs.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":3,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]}]','{\"module\":2,\"module_mode\":5,\"content_id\":1,\"mode_template\":\"navigation.sitemap.tpl\",\"menu_parent_id\":1,\"options\":[]}'),
	(41,'Новости компании','/news/company/','company',1,1,'','','',1,2,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":4,\"mode_template\":\"navigation.breadcrumbs.tpl\",\"content_id\":1,\"menu_parent_id\":27,\"options\":[]},{\"id\":3,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":4,\"module\":2,\"module_mode\":3,\"mode_template\":\"navigation.menu.sub_level.tpl\",\"content_id\":1,\"menu_parent_id\":27,\"carrier_id\":null,\"options\":[]}]','{\"module\":3,\"module_mode\":3,\"content_id\":1,\"mode_template\":\"news.news_list.tpl\",\"menu_parent_id\":null,\"options\":[{\"name\":\"limit\",\"value\":\"4\"}]}'),
	(42,'Новости рынка','/news/market/','market',1,2,'','','',1,2,'[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"navigation.menu.one_level.top.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":2,\"module\":2,\"module_mode\":4,\"mode_template\":\"navigation.breadcrumbs.tpl\",\"content_id\":1,\"menu_parent_id\":27,\"options\":[]},{\"id\":3,\"module\":2,\"module_mode\":2,\"mode_template\":\"navigation.menu.multi_level.tpl\",\"content_id\":1,\"menu_parent_id\":1,\"options\":[]},{\"id\":4,\"module\":2,\"module_mode\":3,\"mode_template\":\"navigation.menu.sub_level.tpl\",\"content_id\":1,\"menu_parent_id\":27,\"carrier_id\":null,\"options\":[]}]','{\"module\":3,\"module_mode\":3,\"content_id\":2,\"mode_template\":\"news.news_list.tpl\",\"menu_parent_id\":null,\"options\":[{\"name\":\"limit\",\"value\":\"10\"}]}');

/*!40000 ALTER TABLE `structure_data` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates`;

CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `file` text NOT NULL,
  `blocks` tinyint(2) NOT NULL DEFAULT '1',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;

INSERT INTO `templates` (`id`, `name`, `file`, `blocks`, `default`)
VALUES
	(1,'Главная','main.tpl',7,0),
	(2,'Внутренняя','inner.tpl',7,1);

/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
