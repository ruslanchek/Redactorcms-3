/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : rdclite

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-03-12 00:56:14
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_albums
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_images
-- ----------------------------
INSERT INTO `gallery_images` VALUES ('1', null, null, '0', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('2', null, null, '0', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('3', null, null, '0', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('4', null, null, '0', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('5', '', '', '0', '0', '5', 'jpg');
INSERT INTO `gallery_images` VALUES ('6', null, null, '0', '0', '6', 'jpg');
INSERT INTO `gallery_images` VALUES ('7', null, null, '0', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('8', null, null, '0', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('9', null, null, '0', '0', '9', 'jpg');
INSERT INTO `gallery_images` VALUES ('10', null, null, '0', '0', '10', 'jpg');
INSERT INTO `gallery_images` VALUES ('11', null, null, '0', '0', '11', 'jpg');
INSERT INTO `gallery_images` VALUES ('12', null, null, '0', '0', '12', 'jpg');
INSERT INTO `gallery_images` VALUES ('13', null, null, '0', '0', '13', 'jpg');
INSERT INTO `gallery_images` VALUES ('14', null, null, '0', '0', '14', 'jpg');
INSERT INTO `gallery_images` VALUES ('15', null, null, '0', '0', '15', 'jpg');
INSERT INTO `gallery_images` VALUES ('16', null, null, '0', '0', '16', 'jpg');
INSERT INTO `gallery_images` VALUES ('17', null, null, '0', '0', '17', 'jpg');
INSERT INTO `gallery_images` VALUES ('18', null, null, '0', '0', '18', 'jpg');
INSERT INTO `gallery_images` VALUES ('19', null, null, '0', '0', '19', 'jpg');
INSERT INTO `gallery_images` VALUES ('20', null, null, '0', '0', '20', 'jpg');
INSERT INTO `gallery_images` VALUES ('21', null, null, '0', '0', '21', 'jpg');
INSERT INTO `gallery_images` VALUES ('22', null, null, '0', '0', '22', 'jpg');
INSERT INTO `gallery_images` VALUES ('23', null, null, '0', '0', '23', 'jpg');
INSERT INTO `gallery_images` VALUES ('24', null, null, '0', '0', '24', 'jpg');
INSERT INTO `gallery_images` VALUES ('25', null, null, '0', '0', '25', 'jpg');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Страничка', null);
INSERT INTO `pages` VALUES ('2', 'Стран', null);

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
  PRIMARY KEY (`id`),
  KEY `path` (`path`(2))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structure_data
-- ----------------------------
INSERT INTO `structure_data` VALUES ('1', 'Корневой узел', '/', '', '0', '0', null, null, null, '1', '1', '[]');
INSERT INTO `structure_data` VALUES ('2', 'Новости', '/result/', 'result', '0', '0', '', '', '', '1', '1', '[{\"id\":1,\"module\":3,\"module_mode\":1,\"content_id\":null},{\"id\":2,\"module\":2,\"module_mode\":1,\"content_id\":null},{\"id\":3,\"module\":4,\"module_mode\":1,\"content_id\":null},{\"id\":4,\"module\":1,\"module_mode\":1,\"content_id\":null}]');
INSERT INTO `structure_data` VALUES ('3', 'Новости компании', '/result/company/', 'company', '1', '0', '', '', '', '3', '1', '[]');
INSERT INTO `structure_data` VALUES ('4', 'Узел 4', '/result/company/sdf/', 'sdf', '0', '0', '', '', '', '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('5', 'Узел 5', '/result/5/', '5', '0', '0', null, null, null, '2', '2', '[]');
INSERT INTO `structure_data` VALUES ('6', 'Узел 6', '/result/company/huy56/', 'huy56', '0', '0', null, null, null, '3', '2', '[]');
INSERT INTO `structure_data` VALUES ('7', 'Корневой узел', '/7/', '7', '0', '0', null, null, null, '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('8', 'Узел 8', '/7/8/', '8', '0', '0', null, null, null, '2', '1', '[]');
INSERT INTO `structure_data` VALUES ('9', 'Узел 9', '/result9/', 'result9', '1', '0', '', '', '', '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('10', 'ghgj', '/result/company/10/', '10', '1', '0', null, null, null, '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('11', 'Узел 11', '/result/5/11/', '11', '0', '0', '', '', 'sdsd', '1', '3', '[]');
INSERT INTO `structure_data` VALUES ('12', 'asdad', '/result/company/10/wsedqwe/', 'wsedqwe', '1', '0', null, null, null, '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('13', 'Узел 13', '/7/8/13/', '13', '0', '0', null, null, null, '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('14', 'фыв', '/result/company/10/wsedqwe/14/', '14', '1', '0', null, null, null, '2', '3', '[]');
INSERT INTO `structure_data` VALUES ('15', 'Узел 15', '/result/company/huy56/15/', '15', '1', '0', null, null, null, '1', '2', '[]');
INSERT INTO `structure_data` VALUES ('16', 'Узел 16', '/result/company/10/wsedqwe/16/', '16', '0', '0', null, null, null, '1', '1', '[]');
INSERT INTO `structure_data` VALUES ('17', 'Узел 17', '/result/company/17/', '17', '1', '0', '', '', '', '3', '1', '[]');

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
