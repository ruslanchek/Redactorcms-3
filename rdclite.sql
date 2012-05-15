/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : rdclite

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-05-15 18:42:59
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
) ENGINE=MyISAM AUTO_INCREMENT=420 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gallery_images
-- ----------------------------
INSERT INTO `gallery_images` VALUES ('269', null, null, '5', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('270', 'asd', 'asd', '3', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('272', null, null, '1', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('273', null, null, '1', '0', '5', 'jpg');
INSERT INTO `gallery_images` VALUES ('274', '', '', '3', '0', '6', 'jpg');
INSERT INTO `gallery_images` VALUES ('276', null, null, '2', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('277', '', '', '3', '0', '9', 'jpg');
INSERT INTO `gallery_images` VALUES ('278', null, null, '3', '0', '10', 'jpg');
INSERT INTO `gallery_images` VALUES ('279', '', '', '4', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('280', null, null, '4', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('281', null, null, '4', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('282', null, null, '4', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('283', null, null, '4', '0', '5', 'jpg');
INSERT INTO `gallery_images` VALUES ('284', '', '', '4', '0', '6', 'jpg');
INSERT INTO `gallery_images` VALUES ('285', null, null, '4', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('286', null, null, '4', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('287', null, null, '4', '0', '9', 'jpg');
INSERT INTO `gallery_images` VALUES ('288', null, null, '4', '0', '10', 'jpg');
INSERT INTO `gallery_images` VALUES ('289', null, null, '4', '0', '11', 'jpg');
INSERT INTO `gallery_images` VALUES ('290', 'sadasd', 'asdasd', '4', '0', '12', 'jpg');
INSERT INTO `gallery_images` VALUES ('291', '', '', '4', '0', '13', 'jpg');
INSERT INTO `gallery_images` VALUES ('292', '', '', '4', '0', '14', 'jpg');
INSERT INTO `gallery_images` VALUES ('293', null, null, '4', '0', '15', 'jpg');
INSERT INTO `gallery_images` VALUES ('294', null, null, '4', '0', '16', 'jpg');
INSERT INTO `gallery_images` VALUES ('295', '', '', '4', '0', '17', 'jpg');
INSERT INTO `gallery_images` VALUES ('296', 'Хуй', 'фывфыв', '4', '0', '18', 'jpg');
INSERT INTO `gallery_images` VALUES ('297', null, null, '4', '0', '19', 'jpg');
INSERT INTO `gallery_images` VALUES ('298', null, null, '4', '0', '20', 'jpg');
INSERT INTO `gallery_images` VALUES ('299', null, null, '4', '0', '21', 'jpg');
INSERT INTO `gallery_images` VALUES ('300', null, null, '3', '0', '11', 'jpg');
INSERT INTO `gallery_images` VALUES ('301', null, null, '4', '0', '12', 'jpg');
INSERT INTO `gallery_images` VALUES ('302', '', '', '3', '0', '13', 'jpg');
INSERT INTO `gallery_images` VALUES ('303', null, null, '5', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('304', null, null, '4', '0', '22', 'jpg');
INSERT INTO `gallery_images` VALUES ('305', null, null, '4', '0', '23', 'gif');
INSERT INTO `gallery_images` VALUES ('306', null, null, '1', '0', '1', 'jpg');
INSERT INTO `gallery_images` VALUES ('307', null, null, '1', '0', '2', 'jpg');
INSERT INTO `gallery_images` VALUES ('308', null, null, '1', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('309', '', '', '1', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('310', null, null, '2', '0', '9', 'jpg');
INSERT INTO `gallery_images` VALUES ('311', null, null, '2', '0', '10', 'jpg');
INSERT INTO `gallery_images` VALUES ('312', null, null, '2', '0', '11', 'jpg');
INSERT INTO `gallery_images` VALUES ('313', null, null, '2', '0', '12', 'jpg');
INSERT INTO `gallery_images` VALUES ('314', null, null, '2', '0', '13', 'jpg');
INSERT INTO `gallery_images` VALUES ('315', null, null, '2', '0', '14', 'jpg');
INSERT INTO `gallery_images` VALUES ('316', null, null, '2', '0', '15', 'jpg');
INSERT INTO `gallery_images` VALUES ('317', null, null, '2', '0', '16', 'jpg');
INSERT INTO `gallery_images` VALUES ('318', null, null, '2', '0', '17', 'jpg');
INSERT INTO `gallery_images` VALUES ('319', null, null, '2', '0', '18', 'jpg');
INSERT INTO `gallery_images` VALUES ('320', null, null, '2', '0', '19', 'jpg');
INSERT INTO `gallery_images` VALUES ('321', null, null, '2', '0', '20', 'jpg');
INSERT INTO `gallery_images` VALUES ('322', null, null, '2', '0', '21', 'jpg');
INSERT INTO `gallery_images` VALUES ('323', null, null, '1', '0', '5', 'jpg');
INSERT INTO `gallery_images` VALUES ('324', '', '', '1', '0', '6', 'jpg');
INSERT INTO `gallery_images` VALUES ('325', null, null, '1', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('326', null, null, '1', '0', '8', 'jpg');
INSERT INTO `gallery_images` VALUES ('327', null, null, '4', '0', '13', 'png');
INSERT INTO `gallery_images` VALUES ('328', null, null, '4', '0', '14', 'png');
INSERT INTO `gallery_images` VALUES ('329', null, null, '4', '0', '15', 'png');
INSERT INTO `gallery_images` VALUES ('330', null, null, '4', '0', '16', 'png');
INSERT INTO `gallery_images` VALUES ('331', null, null, '4', '0', '17', 'png');
INSERT INTO `gallery_images` VALUES ('332', '', '', '1', '0', '18', 'png');
INSERT INTO `gallery_images` VALUES ('333', null, null, '5', '0', '1', 'png');
INSERT INTO `gallery_images` VALUES ('334', null, null, '5', '0', '2', 'png');
INSERT INTO `gallery_images` VALUES ('335', null, null, '5', '0', '3', 'png');
INSERT INTO `gallery_images` VALUES ('336', null, null, '2', '0', '22', 'png');
INSERT INTO `gallery_images` VALUES ('337', null, null, '2', '0', '23', 'jpg');
INSERT INTO `gallery_images` VALUES ('338', null, null, '2', '0', '24', 'jpg');
INSERT INTO `gallery_images` VALUES ('339', null, null, '2', '0', '25', 'jpg');
INSERT INTO `gallery_images` VALUES ('340', null, null, '2', '0', '26', 'jpg');
INSERT INTO `gallery_images` VALUES ('341', null, null, '2', '0', '27', 'jpg');
INSERT INTO `gallery_images` VALUES ('342', null, null, '2', '0', '28', 'jpg');
INSERT INTO `gallery_images` VALUES ('413', '', '', '0', '0', '3', 'jpg');
INSERT INTO `gallery_images` VALUES ('344', null, null, '1', '0', '19', 'jpg');
INSERT INTO `gallery_images` VALUES ('345', null, null, '1', '0', '20', 'png');
INSERT INTO `gallery_images` VALUES ('346', null, null, '1', '0', '21', 'png');
INSERT INTO `gallery_images` VALUES ('347', null, null, '1', '0', '22', 'png');
INSERT INTO `gallery_images` VALUES ('348', null, null, '1', '0', '23', 'jpg');
INSERT INTO `gallery_images` VALUES ('349', null, null, '1', '0', '24', 'jpg');
INSERT INTO `gallery_images` VALUES ('350', null, null, '1', '0', '25', 'png');
INSERT INTO `gallery_images` VALUES ('351', null, null, '1', '0', '26', 'jpg');
INSERT INTO `gallery_images` VALUES ('414', 'sadasdasd', 'asdasdsadasd', '0', '0', '4', 'jpg');
INSERT INTO `gallery_images` VALUES ('417', null, null, '0', '0', '7', 'jpg');
INSERT INTO `gallery_images` VALUES ('356', null, null, '1', '0', '27', 'jpg');
INSERT INTO `gallery_images` VALUES ('357', null, null, '1', '0', '28', 'jpg');
INSERT INTO `gallery_images` VALUES ('358', null, null, '1', '0', '29', 'jpg');
INSERT INTO `gallery_images` VALUES ('359', null, null, '1', '0', '30', 'jpg');
INSERT INTO `gallery_images` VALUES ('419', null, null, '0', '0', '8', 'jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('3', 'Страничка', 'Wow!!!', '1');
INSERT INTO `pages` VALUES ('4', 'О компании', '111', '0');
INSERT INTO `pages` VALUES ('5', 'Тест', '2вфы', '1');

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
INSERT INTO `structure_data` VALUES ('1', 'Корневой узел', '/', '1', '1', '0', '', '', '', '1', '1', '[{\"id\":1,\"module\":1,\"module_mode\":1,\"content_id\":5,\"mode_template\":\"page.simple.tpl\"},{\"id\":2,\"module\":4,\"module_mode\":2,\"content_id\":3,\"mode_template\":\"gallery.album.tpl\"}]', '{\"module\":1,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"page.simple.tpl\"}');
INSERT INTO `structure_data` VALUES ('2', 'Новости', '/result1/', 'result1', '1', '0', '', '', '', '1', '2', '[{\"id\":1,\"module\":1,\"module_mode\":1,\"content_id\":4,\"mode_template\":\"page.simple.tpl\"},{\"id\":2,\"module\":2,\"module_mode\":1,\"content_id\":null},{\"id\":3,\"module\":4,\"module_mode\":1,\"content_id\":null},{\"id\":4,\"module\":1,\"module_mode\":1,\"content_id\":null},{\"id\":5,\"module\":1,\"module_mode\":1,\"content_id\":null},{\"id\":6,\"module\":1,\"module_mode\":1,\"content_id\":null},{\"id\":7,\"module\":1,\"module_mode\":1,\"mode_template\":\"page.simple.tpl\",\"content_id\":3},{\"id\":8,\"module\":1,\"module_mode\":1,\"mode_template\":\"page.simple.tpl\",\"content_id\":3},{\"id\":9,\"module\":1,\"module_mode\":1,\"mode_template\":\"page.simple.tpl\",\"content_id\":3}]', '{\"module\":4,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"gallery.full.tpl\"}');
INSERT INTO `structure_data` VALUES ('3', 'Новости компании', '/result1/company/', 'company', '1', '0', '', '', '', '2', '4', '[]', '{\"module\":2,\"module_mode\":2,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('4', 'Узел 4', '/result1/company/sdf/', 'sdf', '1', '0', '', '', '', '1', '2', '[]', '{\"module\":2,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('5', 'Узел 5', '/result1/5/', '5', '0', '0', null, null, null, '2', '2', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('6', 'Хуй!', '/result1/company/huy5655/', 'huy5655', '1', '0', '', '', '', '3', '2', '[]', '{\"module\":3,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('7', 'Корневой узел', '/7/', '7', '0', '0', null, null, null, '1', '2', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('8', 'Узел 8', '/7/8/', '8', '0', '0', null, null, null, '2', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('9', 'Узел 9', '/result9/', 'result9', '0', '0', '', '', '', '1', '2', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('10', 'ghgj', '/result1/company/10/', '10', '1', '0', '', '', '', '2', '2', '[]', '{\"module\":2,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('11', 'Узел 11', '/result1/5/11/', '11', '0', '0', '', '', 'sdsd', '1', '3', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('12', 'asdad', '/result1/company/10/wsedqwe/', 'wsedqwe', '1', '0', null, null, null, '1', '2', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('13', 'Узел 13', '/7/8/13/', '13', '0', '0', null, null, null, '1', '2', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('14', 'фыв', '/result1/company/10/wsedqwe/14/', '14', '1', '0', null, null, null, '2', '3', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('15', 'Хуета', '/result1/company/huy5655/15/', '15', '1', '0', '', '', '', '1', '2', '[{\"id\":1,\"module\":2,\"module_mode\":1,\"mode_template\":\"menu.one_level.tpl\",\"content_id\":null}]', '{\"module\":3,\"module_mode\":1,\"content_id\":3,\"mode_template\":\"news.list.tpl\"}');
INSERT INTO `structure_data` VALUES ('16', 'Узел 16', '/result1/company/10/wsedqwe/16/', '16', '1', '0', '', '', '', '2', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');
INSERT INTO `structure_data` VALUES ('17', 'Узел 17', '/result1/company/17/', '17', '1', '0', '', '', '', '3', '1', '[]', '{\"module\":1,\"module_mode\":1,\"content_id\":null}');

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
