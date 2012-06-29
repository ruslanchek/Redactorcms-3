/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : rdclite

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-06-29 19:02:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `gallery_albums`
-- ----------------------------
DROP TABLE IF EXISTS `gallery_albums`;
CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `publish` tinyint(1) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_albums
-- ----------------------------
INSERT INTO `gallery_albums` VALUES ('1', 'Альбом 1', null, '1');
INSERT INTO `gallery_albums` VALUES ('2', 'Альбом 2', null, '2');
INSERT INTO `gallery_albums` VALUES ('3', 'Альбом 3', null, '3');
INSERT INTO `gallery_albums` VALUES ('4', 'Альбом 4', null, '4');
INSERT INTO `gallery_albums` VALUES ('5', 'Альбом 5', null, '5');

-- ----------------------------
-- Table structure for `gallery_images`
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=652 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_images
-- ----------------------------
INSERT INTO `gallery_images` VALUES ('633', null, null, '1', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('634', null, null, '1', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('635', null, null, '1', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('636', null, null, '5', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('637', null, null, '5', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('638', null, null, '5', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('642', null, null, '5', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('643', null, null, '5', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('646', null, null, '1', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('647', null, null, '2', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('648', null, null, '4', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('649', null, null, '4', '0', '2', 'gif');
INSERT INTO `gallery_images` VALUES ('650', null, null, '4', '0', '3', 'png');
INSERT INTO `gallery_images` VALUES ('651', null, null, '3', '0', '1', 'jpg');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Главное');
INSERT INTO `menu` VALUES ('2', 'Нижнее');
INSERT INTO `menu` VALUES ('3', 'Левое');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `content` longtext,
  `publish` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('3', 'Страничка', 'Wow!!!', '1');
INSERT INTO `pages` VALUES ('4', 'О компании', '111', '0');
INSERT INTO `pages` VALUES ('5', 'Тест', '2вфы', '1');
INSERT INTO `pages` VALUES ('6', 'Яхууу!', 'выфвфыв', '1');

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `structure`
-- ----------------------------
DROP TABLE IF EXISTS `structure`;
CREATE TABLE `structure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structure
-- ----------------------------
INSERT INTO `structure` VALUES ('1', '0');
INSERT INTO `structure` VALUES ('2', '1');
INSERT INTO `structure` VALUES ('10', '2');
INSERT INTO `structure` VALUES ('22', '2');
INSERT INTO `structure` VALUES ('25', '1');
INSERT INTO `structure` VALUES ('16', '0');
INSERT INTO `structure` VALUES ('19', '1');

-- ----------------------------
-- Table structure for `structure_data`
-- ----------------------------
DROP TABLE IF EXISTS `structure_data`;
CREATE TABLE `structure_data` (
  `id` int(11) NOT NULL,
  `name` tinytext,
  `path` tinytext,
  `part` tinytext,
  `publish` tinyint(1) DEFAULT '0',
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

-- ----------------------------
-- Records of structure_data
-- ----------------------------
INSERT INTO `structure_data` VALUES ('1', 'Корневой узел', '/', '1', '1', '0', '', '', '', '1', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('2', 'Новости', '/news/', 'news', '1', '0', 'ghhg', 'asdasd', '', '1', '1', '[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"menu.one_level.tpl\",\"content_id\":1}]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('10', 'Новости компании', '/news/company/', 'company', '0', '0', '', '', '', '1', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('22', 'Новости партнеров', '/news/partners/', 'partners', '1', '0', '', '', '', '1', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('16', 'Корневой узел', '/', '16', '0', '0', null, null, null, null, null, '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('19', 'Статьи', '/articles/', 'articles', '1', '0', '', '', '', '1', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('25', 'Каталог', '/catalog/', 'catalog', '1', '0', '', '', '', '1', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');

-- ----------------------------
-- Table structure for `templates`
-- ----------------------------
DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `file` text,
  `blocks` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of templates
-- ----------------------------
INSERT INTO `templates` VALUES ('1', 'Главная', 'main.tpl', '1');
INSERT INTO `templates` VALUES ('2', 'Новости', 'news.tpl', '2');
INSERT INTO `templates` VALUES ('3', 'Страница', 'page.tpl', '3');
INSERT INTO `templates` VALUES ('4', 'Галерея', 'gallery.tpl', '4');
