/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : rdclite

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-07-01 11:15:41
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_albums
-- ----------------------------
INSERT INTO `gallery_albums` VALUES ('1', 'Природа', '1', null);
INSERT INTO `gallery_albums` VALUES ('2', 'Здания', '1', null);
INSERT INTO `gallery_albums` VALUES ('3', 'Животные', '1', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_images
-- ----------------------------
INSERT INTO `gallery_images` VALUES ('28', null, null, '1', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('29', null, null, '2', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('30', null, null, '1', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('31', null, null, '3', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('32', null, null, '3', '0', '5', 'jpg');
INSERT INTO `gallery_images` VALUES ('33', null, null, '2', '0', '6', 'jpg');
INSERT INTO `gallery_images` VALUES ('34', null, null, '3', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('35', null, null, '1', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('36', null, null, '0', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('37', null, null, '0', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('38', null, null, '0', '0', '3', 'jpg');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `content` longtext,
  `publish` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Страничка', null, '1');
INSERT INTO `pages` VALUES ('2', 'Информация о компании', null, '1');
INSERT INTO `pages` VALUES ('3', 'Документы', null, '1');
INSERT INTO `pages` VALUES ('4', 'Видео', null, '1');
INSERT INTO `pages` VALUES ('5', 'Контактная информация', null, '1');
INSERT INTO `pages` VALUES ('6', 'Открытие', null, '1');
INSERT INTO `pages` VALUES ('7', 'Природа', null, '1');
INSERT INTO `pages` VALUES ('8', 'Главная', null, '1');
INSERT INTO `pages` VALUES ('9', 'Авто', null, '1');
INSERT INTO `pages` VALUES ('10', 'Система', null, '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structure
-- ----------------------------
INSERT INTO `structure` VALUES ('1', '0');
INSERT INTO `structure` VALUES ('2', '1');
INSERT INTO `structure` VALUES ('3', '2');
INSERT INTO `structure` VALUES ('4', '3');
INSERT INTO `structure` VALUES ('5', '2');
INSERT INTO `structure` VALUES ('6', '3');
INSERT INTO `structure` VALUES ('7', '0');
INSERT INTO `structure` VALUES ('8', '7');
INSERT INTO `structure` VALUES ('9', '1');
INSERT INTO `structure` VALUES ('10', '3');
INSERT INTO `structure` VALUES ('11', '5');
INSERT INTO `structure` VALUES ('12', '10');
INSERT INTO `structure` VALUES ('13', '8');
INSERT INTO `structure` VALUES ('14', '12');
INSERT INTO `structure` VALUES ('15', '6');
INSERT INTO `structure` VALUES ('16', '12');
INSERT INTO `structure` VALUES ('17', '3');

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
INSERT INTO `structure_data` VALUES ('1', 'Корневой узел', '/', '1', '1', '0', '', '', '', '1', '1', '[]', '{\"id\":1,\"module\":1,\"module_mode\":1,\"content_id\":1,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('2', 'Новости', '/news/', 'news', '1', '0', '', '', '', '2', '1', '[{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null},{\"id\":2,\"module\":2,\"module_mode\":1,\"content_id\":null},{\"id\":3,\"module\":4,\"module_mode\":1,\"content_id\":null},{\"id\":4,\"module\":1,\"module_mode\":1,\"content_id\":null}]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null,\"mode_template\":\"news.list.tpl\"}');
INSERT INTO `structure_data` VALUES ('3', 'Новости компании', '/news/company/', 'company', '1', '0', '', '', '', '3', '1', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('4', 'Узел 4', '/news/company/sdf/', 'sdf', '0', '0', '', '', '', '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('5', 'Блог', '/news/blog/', 'blog', '1', '0', '', '', '', '2', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('6', 'Узел 6', '/news/company/huy56/', 'huy56', '0', '0', '', '', '', '3', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('7', 'Корневой узел', '/7/', '7', '0', '0', null, null, null, '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('8', 'Узел 8', '/7/8/', '8', '0', '0', null, null, null, '2', '1', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('9', 'Галерея', '/result9/', 'result9', '1', '0', '', '', '', '1', '2', '[]', '{\"id\":1,\"module\":4,\"module_mode\":1,\"content_id\":null,\"mode_template\":\"gallery.full.tpl\"}');
INSERT INTO `structure_data` VALUES ('10', 'ghgj', '/news/company/10/', '10', '1', '0', null, null, null, '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('11', 'Обзоры', '/news/blog/reviews/', 'reviews', '0', '0', '', '', '', '1', '3', '[]', '{\"id\":1,\"module\":1,\"module_mode\":1,\"content_id\":1,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('12', 'asdad', '/news/company/10/wsedqwe/', 'wsedqwe', '1', '0', null, null, null, '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('13', 'Узел 13', '/7/8/13/', '13', '0', '0', null, null, null, '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('14', 'фыв', '/news/company/10/wsedqwe/14/', '14', '1', '0', null, null, null, '2', '3', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('15', 'Узел 15', '/news/company/huy56/15/', '15', '1', '0', null, null, null, '1', '2', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('16', 'Узел 16', '/news/company/10/wsedqwe/16/', '16', '0', '0', null, null, null, '1', '1', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('17', 'Узел 17', '/news/company/17/', '17', '1', '0', '', '', '', '3', '1', '[]', '{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null}');

-- ----------------------------
-- Table structure for `structure_menus`
-- ----------------------------
DROP TABLE IF EXISTS `structure_menus`;
CREATE TABLE `structure_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structure_menus
-- ----------------------------
INSERT INTO `structure_menus` VALUES ('1', 'Главное');
INSERT INTO `structure_menus` VALUES ('2', 'Нижнее');
INSERT INTO `structure_menus` VALUES ('3', 'Левое');

-- ----------------------------
-- Table structure for `structure_zones`
-- ----------------------------
DROP TABLE IF EXISTS `structure_zones`;
CREATE TABLE `structure_zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure_id` int(11) DEFAULT NULL,
  `place` tinyint(2) DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structure_zones
-- ----------------------------

-- ----------------------------
-- Table structure for `templates`
-- ----------------------------
DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `file` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of templates
-- ----------------------------
INSERT INTO `templates` VALUES ('1', 'Главная', 'main.tpl');
INSERT INTO `templates` VALUES ('2', 'Новости', 'news.tpl');
INSERT INTO `templates` VALUES ('3', 'Страница', 'page.tpl');
INSERT INTO `templates` VALUES ('4', 'Галерея', 'gallery.tpl');
