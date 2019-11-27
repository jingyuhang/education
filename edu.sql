/*
Navicat MySQL Data Transfer

Source Server         : 荆宇航
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : edu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-11-26 16:22:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activity
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_title` varchar(50) NOT NULL COMMENT '精彩活动标题',
  `activity_content` varchar(255) NOT NULL COMMENT '精彩活动内容',
  `activity_time` int(11) NOT NULL COMMENT '添加时间',
  `activity_num` int(11) NOT NULL COMMENT '浏览次数',
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否删除',
  PRIMARY KEY (`activity_id`),
  KEY `activity_title` (`activity_title`) USING BTREE,
  KEY `activity_time` (`activity_time`) USING BTREE,
  KEY `activity_num` (`activity_num`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity
-- ----------------------------
INSERT INTO `activity` VALUES ('1', '112', '22', '1574035100', '33', '1');
INSERT INTO `activity` VALUES ('4', '2', '3', '1574035738', '4', '1');
INSERT INTO `activity` VALUES ('5', '3', '4', '1574035742', '5', '2');
INSERT INTO `activity` VALUES ('6', '3', '4', '1574035744', '5', '1');
INSERT INTO `activity` VALUES ('7', 'we', 'eqq哈哈大大是', '1574035813', '2', '1');
INSERT INTO `activity` VALUES ('8', 'gtb1', 'wdc2', '1574035897', '22', '2');
INSERT INTO `activity` VALUES ('9', '听课赠送养乐多', '好东西重在分享。', '1574490760', '100', '1');
INSERT INTO `activity` VALUES ('10', '有奖竞猜', '猜对有奖。', '1574491017', '200', '1');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `mobile` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `admin_name` (`admin_name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', '荆宇航', '123', '1340111412', 'jyh102.mail@qq.com', '1573648135', '1');
INSERT INTO `admin` VALUES ('6', 'admin', '123', '18830734307', 'jyh102.mail@qq.com', '1573808037', '1');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `admin_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`admin_role_id`),
  UNIQUE KEY `admin_role_id` (`admin_role_id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(100) DEFAULT NULL COMMENT '分类的名称',
  `is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除',
  `level` int(11) unsigned DEFAULT NULL COMMENT '层级',
  `pid` int(11) unsigned DEFAULT NULL COMMENT '父级id',
  PRIMARY KEY (`cate_id`),
  KEY `cate_id` (`cate_id`) USING BTREE,
  KEY `level` (`level`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'php', '1', '2', '0');
INSERT INTO `category` VALUES ('2', 'java', '1', '2', '0');
INSERT INTO `category` VALUES ('3', 'go', '1', '2', '0');
INSERT INTO `category` VALUES ('4', 'python', '1', '2', '0');
INSERT INTO `category` VALUES ('5', 'c++', '1', '2', '0');
INSERT INTO `category` VALUES ('6', '面向对象', '1', '4', '1');
INSERT INTO `category` VALUES ('8', 'js', '1', '4', '2');
INSERT INTO `category` VALUES ('9', '人工智能', '1', '4', '4');
INSERT INTO `category` VALUES ('10', 'redis缓存', '1', null, '1');

-- ----------------------------
-- Table structure for collect
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `collect_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `u_id` int(11) NOT NULL,
  `favorite_id` int(10) unsigned NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tinyint(1)默认为1【1（未删除）2（已删除、无符号）】',
  PRIMARY KEY (`collect_id`),
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `u_id` (`u_id`) USING BTREE,
  KEY `favorite_id` (`favorite_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collect
-- ----------------------------
INSERT INTO `collect` VALUES ('22', '3', '1', '33', '1574319697', '1');
INSERT INTO `collect` VALUES ('23', '3', '1', '34', '1574319746', '1');
INSERT INTO `collect` VALUES ('24', '2', '1', '36', '1574320189', '2');
INSERT INTO `collect` VALUES ('25', '3', '1', '35', '1574320200', '1');
INSERT INTO `collect` VALUES ('26', '3', '1', '36', '1574320203', '1');
INSERT INTO `collect` VALUES ('27', '3', '1', '38', '1574323012', '1');
INSERT INTO `collect` VALUES ('49', '3', '1', '38', '1574323792', '1');
INSERT INTO `collect` VALUES ('50', '3', '1', '38', '1574323801', '1');
INSERT INTO `collect` VALUES ('51', '3', '1', '38', '1574323806', '1');
INSERT INTO `collect` VALUES ('52', '3', '1', '38', '1574323810', '1');
INSERT INTO `collect` VALUES ('53', '3', '1', '38', '1574323825', '1');
INSERT INTO `collect` VALUES ('54', '3', '1', '38', '1574324012', '1');
INSERT INTO `collect` VALUES ('55', '3', '1', '39', '1574324021', '1');
INSERT INTO `collect` VALUES ('56', '3', '1', '39', '1574324370', '1');
INSERT INTO `collect` VALUES ('57', '7', '1', '37', '1574494572', '1');

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lect_id` int(11) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `is_del` int(11) DEFAULT '1',
  `create_time` int(11) unsigned DEFAULT NULL,
  `course_total` int(11) DEFAULT NULL,
  `already_study_num` int(11) DEFAULT NULL,
  `title_picture` varchar(255) DEFAULT '1',
  `intro` varchar(255) DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT '1' COMMENT '是否免费',
  `course_price` int(11) unsigned DEFAULT NULL,
  `cate_id` varchar(11) DEFAULT NULL,
  `course_status` int(11) DEFAULT '1',
  PRIMARY KEY (`course_id`),
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `lecturer_id` (`lect_id`) USING BTREE,
  KEY `course_name` (`course_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '24', 'java', '1', '1574669295', '3', '1', 'educationImages/T2GmCtvpOqqZjGvT11GyiBOBkUrKhJ7BrmQBTXTy.jpeg', '很棒简单易懂', '1', '200', '2', '1');
INSERT INTO `course` VALUES ('2', '24', 'python', '1', '1574669315', '5', '2', 'educationImages/G1n6B3NBA0RLpbFaz4qQ9pVhohL5bso5oseKSEXI.jpeg', '很棒简单易懂', '1', '11', '4', '1');
INSERT INTO `course` VALUES ('3', '26', 'php', '1', '1573816724', '9', '5', 'educationImages/G1n6B3NBA0RLpbFaz4qQ9pVhohL5bso5oseKSEXI.jpeg', '很棒简单易懂', '2', '300', '1', '1');

-- ----------------------------
-- Table structure for detail
-- ----------------------------
DROP TABLE IF EXISTS `detail`;
CREATE TABLE `detail` (
  `detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) unsigned NOT NULL,
  `lect_id` int(11) unsigned NOT NULL,
  `is_free` tinyint(1) NOT NULL,
  `course_price` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未删除 2已删除',
  `order_id` int(11) unsigned NOT NULL,
  `u_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`detail_id`),
  UNIQUE KEY `detail_id` (`detail_id`) USING BTREE,
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `lecturer_id` (`lect_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of detail
-- ----------------------------
INSERT INTO `detail` VALUES ('75', '3', '24', '1', '300', '1574751989', '1', '55', '1');
INSERT INTO `detail` VALUES ('74', '2', '24', '1', '11', '1574751989', '1', '55', '1');
INSERT INTO `detail` VALUES ('73', '3', '24', '1', '300', '1574751882', '1', '54', '1');
INSERT INTO `detail` VALUES ('72', '2', '24', '1', '11', '1574751882', '1', '54', '1');
INSERT INTO `detail` VALUES ('71', '3', '24', '1', '300', '1574751803', '1', '53', '1');
INSERT INTO `detail` VALUES ('70', '2', '24', '1', '11', '1574751803', '1', '53', '1');
INSERT INTO `detail` VALUES ('69', '3', '24', '1', '300', '1574751797', '1', '52', '1');
INSERT INTO `detail` VALUES ('68', '2', '24', '1', '11', '1574751797', '1', '52', '1');
INSERT INTO `detail` VALUES ('67', '3', '24', '1', '300', '1574751352', '1', '51', '1');
INSERT INTO `detail` VALUES ('66', '2', '24', '1', '11', '1574751352', '1', '51', '1');
INSERT INTO `detail` VALUES ('65', '1', '24', '1', '200', '1574751352', '1', '51', '1');

-- ----------------------------
-- Table structure for evaluate
-- ----------------------------
DROP TABLE IF EXISTS `evaluate`;
CREATE TABLE `evaluate` (
  `evaluate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) unsigned NOT NULL,
  `u_id` int(11) unsigned NOT NULL,
  `evaluate_desc` varchar(100) NOT NULL COMMENT '评价内容',
  `evaluate_num` int(11) unsigned NOT NULL COMMENT '点赞个数',
  `create_time` int(11) unsigned NOT NULL,
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tinyint(1)默认为1【1（未删除）2（已删除、无符号）】',
  PRIMARY KEY (`evaluate_id`),
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `u_id` (`u_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluate
-- ----------------------------
INSERT INTO `evaluate` VALUES ('1', '2', '1', '不错不错不错哈哈哈哈哈', '9999', '1574236749', '1');
INSERT INTO `evaluate` VALUES ('2', '2', '1', '这是一条测试数据', '1111', '1554236749', '2');

-- ----------------------------
-- Table structure for exam
-- ----------------------------
DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_title` varchar(50) NOT NULL COMMENT '考试指导标题',
  `exam_content` varchar(255) DEFAULT NULL COMMENT '考试指导内容',
  `exam_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `exam_num` int(11) DEFAULT NULL COMMENT '浏览次数',
  `is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除',
  PRIMARY KEY (`exam_id`),
  KEY `exam_title` (`exam_title`) USING BTREE,
  KEY `exam_time` (`exam_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam
-- ----------------------------
INSERT INTO `exam` VALUES ('1', '英语', '听力测试、语境填空、阅读理解、作文', '1573893103', '3', '1');
INSERT INTO `exam` VALUES ('2', '语文1', '听力测试、语境填空、阅读理解、作文1', '1573893353', '33', '2');
INSERT INTO `exam` VALUES ('4', '数学', '聚合函数、三角函数、算法', '158262625', '2', '1');
INSERT INTO `exam` VALUES ('5', '体育', '俯卧撑、仰卧起坐、跳绳', '1525454151', '3', '1');

-- ----------------------------
-- Table structure for favorite
-- ----------------------------
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `favorite_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned NOT NULL,
  `favorite_name` varchar(100) NOT NULL COMMENT '收藏夹名称',
  `favorite_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `is_del` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1未删除2已删除',
  PRIMARY KEY (`favorite_id`),
  KEY `u_id` (`u_id`) USING BTREE,
  KEY `favorite_name` (`favorite_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of favorite
-- ----------------------------
INSERT INTO `favorite` VALUES ('33', '1', '5139-1', '1', '1');
INSERT INTO `favorite` VALUES ('34', '1', '5139-2', '0', '2');
INSERT INTO `favorite` VALUES ('35', '1', '8024-1', '0', '2');
INSERT INTO `favorite` VALUES ('36', '1', '8024-2', '0', '2');
INSERT INTO `favorite` VALUES ('37', '1', '8024-3', '1', '1');
INSERT INTO `favorite` VALUES ('38', '1', '8024-4', '711', '1');
INSERT INTO `favorite` VALUES ('39', '1', '8024-5', '2', '1');
INSERT INTO `favorite` VALUES ('40', '1', '哈哈哈', '0', '1');
INSERT INTO `favorite` VALUES ('41', '1', '嘻嘻', '0', '1');
INSERT INTO `favorite` VALUES ('42', '1', '你好', '0', '1');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `images` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `img_time` int(11) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES ('10', '/images/2019-11-24/c5920f56cf65439b71d66d3ca45ed18b.jpeg', '0', '1574582883');

-- ----------------------------
-- Table structure for informations
-- ----------------------------
DROP TABLE IF EXISTS `informations`;
CREATE TABLE `informations` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `information_title` varchar(50) DEFAULT NULL COMMENT '资讯标题',
  `information_content` varchar(255) DEFAULT NULL COMMENT '资讯内容',
  `information_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `information_num` int(11) DEFAULT NULL COMMENT '浏览次数',
  `is_del` tinyint(1) DEFAULT '1' COMMENT '是否删除',
  `information_photo` varchar(255) DEFAULT NULL COMMENT '咨询图片',
  PRIMARY KEY (`information_id`),
  KEY `infor_title` (`information_title`) USING BTREE,
  KEY `infor_time` (`information_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of informations
-- ----------------------------
INSERT INTO `informations` VALUES ('1', 'hello ketty', '<p>我最帅。</p>', '1574421380', '200', '1', 'image\\2019-11-22\\/SLc00EGfAg9fhCmOhi48HzSTPdg2XdhJhnzoGQNG.jpeg');

-- ----------------------------
-- Table structure for job
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `job_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `part_id` int(10) unsigned NOT NULL,
  `job_name` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tinyint(1)默认为1【1（未删除）2（已删除、无符号）】',
  PRIMARY KEY (`job_id`),
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `part_id` (`part_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job
-- ----------------------------
INSERT INTO `job` VALUES ('1', '2', '1', '111', '1574235085', '1');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `route` varchar(50) DEFAULT NULL COMMENT '路由',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COMMENT='菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('2', '角色管理', '0', null, '2019-11-18 11:44:53', '2019-11-18 11:44:53');
INSERT INTO `menu` VALUES ('3', '角色列表', '2', '角色列表展示', '2019-11-18 11:55:18', '2019-11-18 11:55:18');
INSERT INTO `menu` VALUES ('4', '权限管理', '0', null, '2019-11-18 11:55:47', '2019-11-18 11:55:47');
INSERT INTO `menu` VALUES ('5', '权限列表', '4', '权限列表展示', '2019-11-18 12:00:04', '2019-11-18 12:00:04');
INSERT INTO `menu` VALUES ('6', '管理员管理', '0', null, '2019-11-18 12:00:35', '2019-11-18 12:00:35');
INSERT INTO `menu` VALUES ('7', '管理员列表', '6', '管理员列表展示', '2019-11-18 12:00:59', '2019-11-18 12:00:59');
INSERT INTO `menu` VALUES ('8', '菜单管理', '0', null, '2019-11-18 12:01:15', '2019-11-18 12:01:15');
INSERT INTO `menu` VALUES ('9', '菜单列表', '8', '菜单列表展示', '2019-11-18 12:01:49', '2019-11-18 12:01:49');
INSERT INTO `menu` VALUES ('10', '课程管理', '0', null, '2019-11-19 08:26:25', '2019-11-19 08:26:25');
INSERT INTO `menu` VALUES ('12', '课程分类', '10', '课程分类列表展示', '2019-11-20 06:53:56', '2019-11-20 06:53:56');
INSERT INTO `menu` VALUES ('13', '课程列表', '10', '课程列表展示', '2019-11-20 07:02:20', '2019-11-20 07:02:20');
INSERT INTO `menu` VALUES ('16', '问答管理', '0', null, '2019-11-21 03:22:04', '2019-11-21 03:22:04');
INSERT INTO `menu` VALUES ('17', '问题列表', '16', '问题列表展示', '2019-11-21 03:23:14', '2019-11-21 03:23:14');
INSERT INTO `menu` VALUES ('18', '答复列表', '16', '问题答复列表展示', '2019-11-21 03:23:34', '2019-11-21 03:23:34');
INSERT INTO `menu` VALUES ('19', '讲师管理', '0', null, '2019-11-21 03:28:52', '2019-11-21 03:28:52');
INSERT INTO `menu` VALUES ('20', '讲师列表', '19', '讲师列表展示', '2019-11-21 03:29:23', '2019-11-21 03:29:23');
INSERT INTO `menu` VALUES ('22', '资讯管理', '0', null, '2019-11-22 06:51:46', '2019-11-22 06:51:46');
INSERT INTO `menu` VALUES ('23', '资讯展示', '22', '资讯列表展示', '2019-11-22 06:53:33', '2019-11-22 06:53:33');
INSERT INTO `menu` VALUES ('24', '考试展示', '22', '考试列表展示', '2019-11-22 06:54:24', '2019-11-22 06:54:24');
INSERT INTO `menu` VALUES ('25', '活动展示', '22', '活动列表展示', '2019-11-22 06:54:57', '2019-11-22 06:54:57');
INSERT INTO `menu` VALUES ('26', '用户中心', '0', null, '2019-11-22 06:55:23', '2019-11-22 06:55:23');
INSERT INTO `menu` VALUES ('27', '我的收藏', '26', '收藏列表展示', '2019-11-22 06:59:13', '2019-11-22 06:59:13');
INSERT INTO `menu` VALUES ('30', '题库管理', '0', null, '2019-11-24 06:05:49', '2019-11-24 06:05:49');
INSERT INTO `menu` VALUES ('31', '题库列表', '30', '题库列表展示', '2019-11-24 06:06:16', '2019-11-24 06:06:16');
INSERT INTO `menu` VALUES ('32', '轮播图管理', '0', null, '2019-11-24 07:30:00', '2019-11-24 07:30:00');
INSERT INTO `menu` VALUES ('33', '轮播图列表', '32', '轮播图列表展示', '2019-11-24 07:30:25', '2019-11-24 07:30:25');
INSERT INTO `menu` VALUES ('34', '会员信息', '26', '用户列表展示', '2019-11-24 13:19:58', '2019-11-24 13:19:58');
INSERT INTO `menu` VALUES ('35', '导航管理', '0', null, '2019-11-24 13:44:06', '2019-11-24 13:44:06');
INSERT INTO `menu` VALUES ('36', '导航列表', '35', '导航列表展示', '2019-11-24 13:44:30', '2019-11-24 13:44:30');
INSERT INTO `menu` VALUES ('37', '订单管理', '0', null, '2019-11-25 03:05:50', '2019-11-25 03:05:50');
INSERT INTO `menu` VALUES ('38', '订单列表', '37', '订单列表展示', '2019-11-25 03:06:12', '2019-11-25 03:06:12');

-- ----------------------------
-- Table structure for menu_roles
-- ----------------------------
DROP TABLE IF EXISTS `menu_roles`;
CREATE TABLE `menu_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COMMENT='菜单-角色关系表';

-- ----------------------------
-- Records of menu_roles
-- ----------------------------
INSERT INTO `menu_roles` VALUES ('3', '1', '1', '2019-11-18 11:40:20', '2019-11-18 11:40:20');
INSERT INTO `menu_roles` VALUES ('4', '1', '1', '2019-11-18 11:44:39', '2019-11-18 11:44:39');
INSERT INTO `menu_roles` VALUES ('5', '2', '2', '2019-11-18 11:44:53', '2019-11-18 11:44:53');
INSERT INTO `menu_roles` VALUES ('6', '3', '1', '2019-11-18 11:55:18', '2019-11-18 11:55:18');
INSERT INTO `menu_roles` VALUES ('7', '4', '1', '2019-11-18 11:55:47', '2019-11-18 11:55:47');
INSERT INTO `menu_roles` VALUES ('8', '5', '1', '2019-11-18 12:00:04', '2019-11-18 12:00:04');
INSERT INTO `menu_roles` VALUES ('9', '6', '1', '2019-11-18 12:00:35', '2019-11-18 12:00:35');
INSERT INTO `menu_roles` VALUES ('10', '7', '1', '2019-11-18 12:00:59', '2019-11-18 12:00:59');
INSERT INTO `menu_roles` VALUES ('11', '8', '1', '2019-11-18 12:01:15', '2019-11-18 12:01:15');
INSERT INTO `menu_roles` VALUES ('12', '9', '1', '2019-11-18 12:01:49', '2019-11-18 12:01:49');
INSERT INTO `menu_roles` VALUES ('13', '10', '3', '2019-11-19 08:26:25', '2019-11-19 08:26:25');
INSERT INTO `menu_roles` VALUES ('14', '11', '3', '2019-11-19 08:46:10', '2019-11-19 08:46:10');
INSERT INTO `menu_roles` VALUES ('15', '12', '3', '2019-11-20 06:53:56', '2019-11-20 06:53:56');
INSERT INTO `menu_roles` VALUES ('16', '13', '3', '2019-11-20 07:02:20', '2019-11-20 07:02:20');
INSERT INTO `menu_roles` VALUES ('17', '14', '3', '2019-11-20 07:02:54', '2019-11-20 07:02:54');
INSERT INTO `menu_roles` VALUES ('18', '15', '3', '2019-11-21 03:12:31', '2019-11-21 03:12:31');
INSERT INTO `menu_roles` VALUES ('19', '16', '3', '2019-11-21 03:22:04', '2019-11-21 03:22:04');
INSERT INTO `menu_roles` VALUES ('20', '17', '3', '2019-11-21 03:23:14', '2019-11-21 03:23:14');
INSERT INTO `menu_roles` VALUES ('21', '18', '3', '2019-11-21 03:23:34', '2019-11-21 03:23:34');
INSERT INTO `menu_roles` VALUES ('22', '19', '3', '2019-11-21 03:28:52', '2019-11-21 03:28:52');
INSERT INTO `menu_roles` VALUES ('23', '20', '3', '2019-11-21 03:29:23', '2019-11-21 03:29:23');
INSERT INTO `menu_roles` VALUES ('24', '21', '3', '2019-11-21 11:28:43', '2019-11-21 11:28:43');
INSERT INTO `menu_roles` VALUES ('25', '22', '3', '2019-11-22 06:51:46', '2019-11-22 06:51:46');
INSERT INTO `menu_roles` VALUES ('26', '23', '3', '2019-11-22 06:53:33', '2019-11-22 06:53:33');
INSERT INTO `menu_roles` VALUES ('27', '24', '3', '2019-11-22 06:54:24', '2019-11-22 06:54:24');
INSERT INTO `menu_roles` VALUES ('28', '25', '3', '2019-11-22 06:54:57', '2019-11-22 06:54:57');
INSERT INTO `menu_roles` VALUES ('29', '26', '3', '2019-11-22 06:55:23', '2019-11-22 06:55:23');
INSERT INTO `menu_roles` VALUES ('30', '27', '3', '2019-11-22 06:59:13', '2019-11-22 06:59:13');
INSERT INTO `menu_roles` VALUES ('31', '28', '3', '2019-11-22 07:02:24', '2019-11-22 07:02:24');
INSERT INTO `menu_roles` VALUES ('32', '29', '3', '2019-11-22 07:03:44', '2019-11-22 07:03:44');
INSERT INTO `menu_roles` VALUES ('33', '30', '3', '2019-11-24 06:05:49', '2019-11-24 06:05:49');
INSERT INTO `menu_roles` VALUES ('34', '31', '3', '2019-11-24 06:06:16', '2019-11-24 06:06:16');
INSERT INTO `menu_roles` VALUES ('35', '32', '3', '2019-11-24 07:30:00', '2019-11-24 07:30:00');
INSERT INTO `menu_roles` VALUES ('36', '33', '3', '2019-11-24 07:30:25', '2019-11-24 07:30:25');
INSERT INTO `menu_roles` VALUES ('37', '34', '3', '2019-11-24 13:19:58', '2019-11-24 13:19:58');
INSERT INTO `menu_roles` VALUES ('38', '35', '3', '2019-11-24 13:44:06', '2019-11-24 13:44:06');
INSERT INTO `menu_roles` VALUES ('39', '36', '3', '2019-11-24 13:44:30', '2019-11-24 13:44:30');
INSERT INTO `menu_roles` VALUES ('40', '37', '3', '2019-11-25 03:05:50', '2019-11-25 03:05:50');
INSERT INTO `menu_roles` VALUES ('41', '38', '3', '2019-11-25 03:06:12', '2019-11-25 03:06:12');

-- ----------------------------
-- Table structure for navigation
-- ----------------------------
DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `navigation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_name` varchar(50) NOT NULL,
  `navigation_url` varchar(100) NOT NULL,
  PRIMARY KEY (`navigation_id`),
  UNIQUE KEY `navigation_id` (`navigation_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of navigation
-- ----------------------------
INSERT INTO `navigation` VALUES ('1', '课程', 'www.edublog.com/course/course');

-- ----------------------------
-- Table structure for note
-- ----------------------------
DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `note_desc` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tinyint(1)默认为1【1（未删除）2（已删除、无符号）】',
  `u_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`note_id`),
  KEY `course_id` (`course_id`) USING BTREE,
  KEY `u_id` (`u_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of note
-- ----------------------------
INSERT INTO `note` VALUES ('1', '3', '<p>php是世界上最好的语言。</p>', '1574149647', '2', '1');
INSERT INTO `note` VALUES ('2', '2', '<p>java是世界上最简单扼语言。没有之一。</p>', '1574150549', '2', '1');
INSERT INTO `note` VALUES ('3', '4', '<p>黑客都是学过Python的。</p>', '1574150613', '1', '1');
INSERT INTO `note` VALUES ('4', '2', '<p>c++是世界上最友好的语言，没有之一。</p>', '1574150674', '1', '1');
INSERT INTO `note` VALUES ('5', '3', '<p>我喜欢学php。</p>', '1574150741', '1', '1');
INSERT INTO `note` VALUES ('6', '2', '<p>我真心喜欢学php。</p>', '1574150895', '1', '1');
INSERT INTO `note` VALUES ('7', '4', '<p>我是python我最牛。</p>', '1574151313', '1', '1');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `notice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `notice` varchar(100) NOT NULL COMMENT '公告内容',
  `create_time` int(10) unsigned NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tinyint(1)默认为1【1（未删除）2（已删除、无符号）】',
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('1', '2', '本周末期末考试', '1574254356', '1');
INSERT INTO `notice` VALUES ('2', '3', '下周一php工作原理默写11', '1574254544', '1');
INSERT INTO `notice` VALUES ('3', '2', '本周三刘星同学—java与javascript渊源讲述', '1574254600', '1');
INSERT INTO `notice` VALUES ('4', '4', '本周三刘星同学—java与javascript渊源讲述', '1574254606', '1');
INSERT INTO `notice` VALUES ('5', '3', '下周一php工作原理默写1', '1574306517', '2');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_mark` varchar(30) NOT NULL,
  `u_id` int(11) NOT NULL,
  `pay_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1微信2支付宝',
  `pay_price` int(11) NOT NULL,
  `pay_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:未支付2：已支付',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_id` (`order_id`) USING BTREE,
  KEY `u_id` (`u_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('55', '1499799540', '1', '1', '311', '1');
INSERT INTO `order` VALUES ('54', '848093762', '1', '1', '311', '1');
INSERT INTO `order` VALUES ('53', '443419222', '1', '2', '311', '1');
INSERT INTO `order` VALUES ('51', '80600749', '1', '1', '511', '1');
INSERT INTO `order` VALUES ('52', '734477140', '1', '2', '311', '1');

-- ----------------------------
-- Table structure for part
-- ----------------------------
DROP TABLE IF EXISTS `part`;
CREATE TABLE `part` (
  `part_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) unsigned DEFAULT NULL,
  `part_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `part_head` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `part_describe` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_del` tinyint(1) DEFAULT '1',
  `is_free` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`part_id`),
  KEY `part_id` (`part_id`) USING BTREE,
  KEY `course_id` (`course_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of part
-- ----------------------------
INSERT INTO `part` VALUES ('1', '2', '面向对象', '面向对象是如何实现的', '通过创造一个一个方法，分步实现', '1', '1');

-- ----------------------------
-- Table structure for pay_method
-- ----------------------------
DROP TABLE IF EXISTS `pay_method`;
CREATE TABLE `pay_method` (
  `method_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_id` int(11) NOT NULL,
  `pay_name` varchar(30) NOT NULL,
  PRIMARY KEY (`method_id`),
  UNIQUE KEY `method_id` (`method_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_method
-- ----------------------------
INSERT INTO `pay_method` VALUES ('1', '1', '支付宝');
INSERT INTO `pay_method` VALUES ('2', '2', '微信');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `routes` text COMMENT '路由别名，逗号分隔',
  `name` varchar(50) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COMMENT='permission权限组';

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('2', '权限列表展示,权限添加视图,权限添加执行,权限修改视图,权限修改执行,权限删除', '权限管理');
INSERT INTO `permission` VALUES ('3', '角色列表展示,角色添加视图,角色添加执行,角色修改视图,角色修改执行,角色删除', '角色管理');
INSERT INTO `permission` VALUES ('4', '管理员列表展示,管理员添加视图,管理员添加执行,管理员状态,管理员修改视图,管理员修改执行,管理员重置密码', '管理员管理');
INSERT INTO `permission` VALUES ('5', '菜单列表展示,菜单添加视图,菜单添加执行,菜单修改视图,菜单修改执行,菜单删除', '菜单管理');
INSERT INTO `permission` VALUES ('6', '笔记列表展示,笔记添加视图,笔记添加执行,笔记删除,课程分类列表展示,课程分类添加,课程分类添加渲染视图,课程分类删除,课程分类修改,课程分类执行修改,课程列表展示,课程添加,课程添加渲染视图,课程删除,课程修改,课程修改,章节列表展示,章节添加渲染视图,章节添加,章节删除,章节修改,章节修改,作业列表展示,作业添加视图,作业添加执行,作业删除,作业下拉框更改,作业修改视图,作业修改执行,创建公告视图,公告修改页面,创建公告,公告修改接口,公告删除接口', '课程管理');
INSERT INTO `permission` VALUES ('7', '讲师列表展示,添加讲师视图,添加讲师执行,讲师删除,讲师修改视图,讲师修改执行,讲师收益展示,讲师审核展示,讲师审核通过,讲师审核拒绝', '讲师管理');
INSERT INTO `permission` VALUES ('8', '课程评价列表展示,课程评价添加接口,课程评价删除', '课程评价');
INSERT INTO `permission` VALUES ('9', '问题添加视图,问题列表展示,问题添加接口,删除问题,问题答复列表展示,问题答复视图,问题答复执行,答复问题删除,答复问题修改视图,答复问题修改执行', '问答管理');
INSERT INTO `permission` VALUES ('10', '已有收藏夹新建收藏夹,生成收藏夹的视图,生成收藏夹,收藏夹列表展示,收藏夹修改视图,执行修改收藏夹,收藏夹删除,生成收藏,生成收藏的视图,收藏列表展示,收藏表修改页面,收藏执行修改,收藏执行删除', '收藏管理');
INSERT INTO `permission` VALUES ('11', '资讯添加,资讯列表展示,资讯修改视图,资讯修改执行,资讯删除,咨询添加视图,考试添加页面,考试列表展示,考试修改页面,考试添加接口,考试修改接口,考试删除接口,活动添加页面,活动列表展示,活动修改页面,活动添加接口,活动修改接口,活动删除接口', '资讯管理');
INSERT INTO `permission` VALUES ('12', '题库题型视图,题库题型添加执行,题库判断执行,题库单选视图,题库判断,题库多选视图,题库多选添加执行,题库列表展示,题库删除,题库修改', '题库管理');
INSERT INTO `permission` VALUES ('13', '导航图添加视图,导航添加执行,检测图片类型,导航图列表展示,导航图删除,导航图修改视图,导航图修改执行', '导航栏管理');
INSERT INTO `permission` VALUES ('14', '导航添加视图,导航添加执行,导航列表展示,导航删除,导航修改视图,导航修改执行', '导航管理');
INSERT INTO `permission` VALUES ('15', '订单增加页面,订单增加执行,订单列表展示,订单删除,添加订单详情视图,添加订单详情执行,订单详情展示,订单详情修改页面,订单详情修改,订单详情中查看用户详情,订单详情中查看讲师详情,订单详情中查看课程详情,添加订单执行,订单选择支付类型', '订单管理');

-- ----------------------------
-- Table structure for profit_teacher
-- ----------------------------
DROP TABLE IF EXISTS `profit_teacher`;
CREATE TABLE `profit_teacher` (
  `pt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `lect_id` int(11) NOT NULL,
  `pt_time` int(11) NOT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profit_teacher
-- ----------------------------
INSERT INTO `profit_teacher` VALUES ('1', '2', '1', '1', '24', '1573816724');
INSERT INTO `profit_teacher` VALUES ('2', '3', '1', '2', '24', '1573816724');
INSERT INTO `profit_teacher` VALUES ('3', '4', '1', '3', '24', '1573816724');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `q_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `course_id` int(11) unsigned NOT NULL COMMENT '课程id',
  `q_title` varchar(50) NOT NULL COMMENT '问题标题',
  `q_content` varchar(255) NOT NULL,
  `q_browse` int(11) unsigned NOT NULL COMMENT '浏览量',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 未删除 2 已删除',
  `q_time` int(11) unsigned NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`q_id`),
  KEY `u_id` (`u_id`) USING BTREE,
  KEY `cou_id` (`course_id`) USING BTREE,
  KEY `q_time` (`q_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', '1', '2', 'php问题', '面向对象和抽象类？', '200', '1', '1573816724');

-- ----------------------------
-- Table structure for question_answer
-- ----------------------------
DROP TABLE IF EXISTS `question_answer`;
CREATE TABLE `question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `is_answer` varchar(255) DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_answer
-- ----------------------------
INSERT INTO `question_answer` VALUES ('65', '19', '1', '1', '1574324568');
INSERT INTO `question_answer` VALUES ('66', '19', '2', '1', '1574324568');
INSERT INTO `question_answer` VALUES ('67', '20', '1', '2', '1574324575');
INSERT INTO `question_answer` VALUES ('68', '20', '2', '2', '1574324575');
INSERT INTO `question_answer` VALUES ('69', '21', '2', '1|2|4', '1574324594');
INSERT INTO `question_answer` VALUES ('70', '21', '2', '1|2|4', '1574324594');
INSERT INTO `question_answer` VALUES ('71', '21', '3', '1|2|4', '1574324594');
INSERT INTO `question_answer` VALUES ('72', '21', '2', '1|2|4', '1574324594');

-- ----------------------------
-- Table structure for question_problem
-- ----------------------------
DROP TABLE IF EXISTS `question_problem`;
CREATE TABLE `question_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_problem
-- ----------------------------
INSERT INTO `question_problem` VALUES ('19', '3', '1+1=2', '1574324568');
INSERT INTO `question_problem` VALUES ('20', '3', '3+3=4', '1574324575');
INSERT INTO `question_problem` VALUES ('21', '2', '1+1=', '1574324594');

-- ----------------------------
-- Table structure for question_type
-- ----------------------------
DROP TABLE IF EXISTS `question_type`;
CREATE TABLE `question_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_type
-- ----------------------------
INSERT INTO `question_type` VALUES ('1', '单选');
INSERT INTO `question_type` VALUES ('2', '多选');
INSERT INTO `question_type` VALUES ('3', '判断');

-- ----------------------------
-- Table structure for response
-- ----------------------------
DROP TABLE IF EXISTS `response`;
CREATE TABLE `response` (
  `r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `course_id` int(11) unsigned NOT NULL COMMENT '课程id',
  `q_id` int(11) unsigned NOT NULL COMMENT '问题id',
  `r_content` text NOT NULL COMMENT '回答内容',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 未删除 2 已删除',
  `r_time` int(11) unsigned NOT NULL COMMENT '回答时间',
  PRIMARY KEY (`r_id`),
  KEY `u_id` (`u_id`) USING BTREE,
  KEY `cou_id` (`course_id`) USING BTREE,
  KEY `q_id` (`q_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of response
-- ----------------------------
INSERT INTO `response` VALUES ('1', '1', '2', '1', '问题答复测试1', '2', '1574220751');
INSERT INTO `response` VALUES ('2', '1', '2', '1', '嘻嘻嘻', '1', '1574314888');
INSERT INTO `response` VALUES ('3', '1', '2', '1', '哈哈哈哈', '2', '1574314815');
INSERT INTO `response` VALUES ('4', '1', '2', '1', '<p>sadasd</p>', '1', '1574394916');

-- ----------------------------
-- Table structure for right
-- ----------------------------
DROP TABLE IF EXISTS `right`;
CREATE TABLE `right` (
  `right_id` int(11) NOT NULL AUTO_INCREMENT,
  `right_name` varchar(60) NOT NULL COMMENT '权限名称',
  `right_desc` varchar(200) NOT NULL COMMENT '权限描述',
  `pid` int(11) NOT NULL COMMENT '当pid为0时，权限名称是模块名称，当pid不为0时,权限名称还是权限名称。',
  PRIMARY KEY (`right_id`),
  UNIQUE KEY `right_id` (`right_id`) USING BTREE,
  KEY `right_name` (`right_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of right
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '角色名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '角色描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`id`) USING BTREE,
  KEY `role_name` (`name`) USING BTREE,
  KEY `create_time` (`created_at`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超级管理员', '2019-11-18 11:37:39', '2019-11-18 11:37:39');
INSERT INTO `roles` VALUES ('2', '角色', '2019-11-18 11:46:54', '2019-11-18 11:46:54');
INSERT INTO `roles` VALUES ('3', '副管理员', '2019-11-22 09:00:36', '2019-11-22 01:00:36');

-- ----------------------------
-- Table structure for roles_permission
-- ----------------------------
DROP TABLE IF EXISTS `roles_permission`;
CREATE TABLE `roles_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles_permission
-- ----------------------------
INSERT INTO `roles_permission` VALUES ('1', '1', '2', '2019-11-18 11:37:39', '2019-11-18 11:37:39');
INSERT INTO `roles_permission` VALUES ('2', '1', '4', '2019-11-18 11:37:39', '2019-11-18 11:37:39');
INSERT INTO `roles_permission` VALUES ('3', '1', '5', '2019-11-18 11:37:39', '2019-11-18 11:37:39');
INSERT INTO `roles_permission` VALUES ('4', '1', '3', '2019-11-18 11:37:39', '2019-11-18 11:37:39');
INSERT INTO `roles_permission` VALUES ('5', '2', '3', '2019-11-18 11:46:54', '2019-11-18 11:46:54');
INSERT INTO `roles_permission` VALUES ('71', '3', '12', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('70', '3', '9', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('69', '3', '11', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('68', '3', '8', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('67', '3', '6', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('66', '3', '7', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('65', '3', '15', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('64', '3', '10', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('63', '3', '14', '2019-11-25 05:45:34', '2019-11-25 05:45:34');
INSERT INTO `roles_permission` VALUES ('62', '3', '13', '2019-11-25 05:45:34', '2019-11-25 05:45:34');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slide_url` varchar(50) NOT NULL,
  `slide_weight` int(11) unsigned NOT NULL,
  PRIMARY KEY (`slide_id`),
  UNIQUE KEY `slide_id` (`slide_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slide
-- ----------------------------

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `lect_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `lect_name` varchar(50) NOT NULL COMMENT '教师姓名',
  `lect_resume` varchar(100) NOT NULL COMMENT '教师个人简历',
  `lect_style` varchar(50) NOT NULL COMMENT '教师授课风格',
  `image` varchar(255) DEFAULT NULL,
  `is_del` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '1 未删除 2 已删除',
  `examine` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lect_id`),
  KEY `lect_name` (`lect_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('24', '1', '2', 'data大神', '这个人data用的特别好，堪称大神。', '闷骚', '/images/2019-11-21/73b4f57d308ba19aa6277cc121207c53.jpeg', '1', '0');
INSERT INTO `teacher` VALUES ('26', '1', '2', '赵世伟', '这个人很牛逼', '很闷骚', 'educationImages/MDnvvEHkwkba4qSFFESidJE8kDXFZKvhdDH9GrZb.jpeg', '1', '1');
INSERT INTO `teacher` VALUES ('27', '1', '2', '赵世伟', '这个人很牛逼', '很闷骚', 'educationImages/MDnvvEHkwkba4qSFFESidJE8kDXFZKvhdDH9GrZb.jpeg', '2', '1');
INSERT INTO `teacher` VALUES ('28', '8', '2', '荆宇航', '这个人很牛逼', '很闷骚', 'educationImages/pyegZZxDtozyCODXAcX6bp0a5Fc4tPBqUD9o4gBR.jpeg', '1', '1');

-- ----------------------------
-- Table structure for userdetail
-- ----------------------------
DROP TABLE IF EXISTS `userdetail`;
CREATE TABLE `userdetail` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(10) NOT NULL,
  `u_head` varchar(100) NOT NULL,
  `u_age` int(11) unsigned NOT NULL DEFAULT '0',
  `u_sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `u_time` int(11) unsigned NOT NULL,
  `ustatus` int(1) NOT NULL DEFAULT '2',
  `u_email` varchar(255) NOT NULL,
  `u_pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`),
  KEY `u_time` (`u_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userdetail
-- ----------------------------
INSERT INTO `userdetail` VALUES ('1', '赵世伟', 'educationImages/MDnvvEHkwkba4qSFFESidJE8kDXFZKvhdDH9GrZb.jpeg', '111', '1', '1574489874', '2', '111@qq.com', '202cb962ac59075b964b07152d234b70');
INSERT INTO `userdetail` VALUES ('8', '荆宇航', 'educationImages/pyegZZxDtozyCODXAcX6bp0a5Fc4tPBqUD9o4gBR.jpeg', '27', '1', '1574641222', '2', 'jyh102.mail@qq.com', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `password` varchar(188) NOT NULL COMMENT '密码',
  `administrator` tinyint(3) DEFAULT '2' COMMENT '是否超管，1是，2否',
  `status` tinyint(3) DEFAULT '1' COMMENT '状态，1启用，2禁用',
  `creator_id` int(11) DEFAULT NULL COMMENT '创建者id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '222@111.com', '荆宇航', '$2y$10$zDYRi/gfUZGMVhIKQXvW6OrdDgm3bzLrc5ifq4w7mxy49UxYWeRKu', '1', '1', '1', '2019-05-05 19:57:01', '2019-11-15 07:54:44');
INSERT INTO `users` VALUES ('8', '333@qq.com', '卢昂', '$2y$10$1zLX59CT2j9Mm8p1i7GOG.OTm7ZAyRaalE83rRRdDV1qy0yLKjx8S', '2', '1', '1', '2019-11-20 07:17:16', '2019-11-20 07:17:16');
INSERT INTO `users` VALUES ('10', '321@qq.com', '赵世伟', '$2y$10$q8j3Zdfo2z2djGmI4z04Cue2gZ8.Mbfw/0OnSu7avnhQJei9P0CuS', '2', '1', '1', '2019-11-24 09:59:00', '2019-11-24 09:59:00');

-- ----------------------------
-- Table structure for users_roles
-- ----------------------------
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `roles_id` int(10) unsigned NOT NULL COMMENT '角色id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='用户-角色关系表';

-- ----------------------------
-- Records of users_roles
-- ----------------------------
INSERT INTO `users_roles` VALUES ('2', '8', '3', '2019-11-20 07:17:16', '2019-11-20 07:17:16');
INSERT INTO `users_roles` VALUES ('3', '7', '2', '2019-11-21 06:40:21', '2019-11-21 06:40:21');
INSERT INTO `users_roles` VALUES ('4', '10', '3', '2019-11-24 09:59:00', '2019-11-24 09:59:00');

-- ----------------------------
-- Table structure for user_course
-- ----------------------------
DROP TABLE IF EXISTS `user_course`;
CREATE TABLE `user_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`) USING BTREE,
  KEY `course` (`course_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_course
-- ----------------------------
INSERT INTO `user_course` VALUES ('1', '1', '2');
