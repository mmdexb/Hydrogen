/*
 Navicat Premium Data Transfer

 Source Server         : chbsim
 Source Server Type    : MySQL
 Source Server Version : 50650
 Source Host           : 124.221.210.233:3306
 Source Schema         : fly

 Target Server Type    : MySQL
 Target Server Version : 50650
 File Encoding         : 65001

 Date: 02/08/2022 01:00:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `route` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `airport1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `airport2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_oneway` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `type` int(255) NOT NULL,
  PRIMARY KEY (`aid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (2, '平台首飞---ZGGG==&gt;ZSSS', '2022-08-03 19:30:00', '2022-08-03 23:59:00', 'YIN A461 MOLSO G586 WYN R473 NNX A599 ELNEX G204 MULOV V73 SUPAR', '', 'ZGGG', 'ZSSS', 0, 1, 0);

-- ----------------------------
-- Table structure for activities_bm
-- ----------------------------
DROP TABLE IF EXISTS `activities_bm`;
CREATE TABLE `activities_bm`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `aid` int(11) NULL DEFAULT NULL,
  `callsign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activities_bm
-- ----------------------------
INSERT INTO `activities_bm` VALUES (1, 'admin', 1, '6147', '1');
INSERT INTO `activities_bm` VALUES (2, 'admin', 2, '6147', '1');

-- ----------------------------
-- Table structure for atc
-- ----------------------------
DROP TABLE IF EXISTS `atc`;
CREATE TABLE `atc`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of atc
-- ----------------------------
INSERT INTO `atc` VALUES (13, '1731', 'Controller2', 1);
INSERT INTO `atc` VALUES (14, 'admin', 'Administrator', 1);
INSERT INTO `atc` VALUES (15, '3251', 'Administrator', 1);
INSERT INTO `atc` VALUES (16, '2921', 'Instructor3', 1);
INSERT INTO `atc` VALUES (17, '6147', 'Administrator', 1);
INSERT INTO `atc` VALUES (18, '6101', 'Instructor3', 1);

-- ----------------------------
-- Table structure for fsd_level
-- ----------------------------
DROP TABLE IF EXISTS `fsd_level`;
CREATE TABLE `fsd_level`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of fsd_level
-- ----------------------------
INSERT INTO `fsd_level` VALUES (1, '1', 'OBSPILOT');
INSERT INTO `fsd_level` VALUES (2, '2', 'Student1');
INSERT INTO `fsd_level` VALUES (3, '3', 'Student2');
INSERT INTO `fsd_level` VALUES (4, '4', 'Student3');
INSERT INTO `fsd_level` VALUES (5, '5', 'Controller1');
INSERT INTO `fsd_level` VALUES (6, '6', 'Controller2');
INSERT INTO `fsd_level` VALUES (7, '7', 'Controller3');
INSERT INTO `fsd_level` VALUES (8, '8', 'Instructor1');
INSERT INTO `fsd_level` VALUES (9, '9', 'Instructor2');
INSERT INTO `fsd_level` VALUES (10, '10', 'Instructor3');
INSERT INTO `fsd_level` VALUES (11, '11', 'Supervisor');
INSERT INTO `fsd_level` VALUES (12, '12', 'Administrator');
INSERT INTO `fsd_level` VALUES (13, '0', 'OBSPILOT');

-- ----------------------------
-- Table structure for mob
-- ----------------------------
DROP TABLE IF EXISTS `mob`;
CREATE TABLE `mob`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `flight_callsign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dep` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `arr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `datef` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `totime` time(5) NULL DEFAULT NULL,
  `fl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mob
-- ----------------------------
INSERT INTO `mob` VALUES (5, 'admin', 'CCA1312', 'ZBAA', 'ZGSZ', 'DCT', '删除', '2022-08-01', '23:00:00.00000', NULL);
INSERT INTO `mob` VALUES (6, 'admin', 'CHB6147', 'zbaa', 'zspd', 'DCT', '删除', '2022-08-01', '19:32:00.00000', NULL);
INSERT INTO `mob` VALUES (7, '6147', 'DKH6147', 'ZBAA', 'ZSPD', 'DCT', '删除', '2022-08-01', '22:45:00.00000', NULL);
INSERT INTO `mob` VALUES (8, '6147', 'DKH6147', 'ZBAA', 'ZSPD', 'DCT', '删除', '2022-08-01', '22:58:00.00000', 'FL311');
INSERT INTO `mob` VALUES (9, 'admin', 'CHB6147', 'zbaa', 'zspd', 'DCT', '删除', '2022-08-01', '23:00:00.00000', 'FL311');

-- ----------------------------
-- Table structure for pilot
-- ----------------------------
DROP TABLE IF EXISTS `pilot`;
CREATE TABLE `pilot`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pilot_level_id` int(11) NULL DEFAULT NULL,
  `pilot_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pilot
-- ----------------------------
INSERT INTO `pilot` VALUES (1, 'admin', 6, '五星教员');
INSERT INTO `pilot` VALUES (2, '1731', 1, '飞行学员');
INSERT INTO `pilot` VALUES (3, '1732', 1, '飞行学员');
INSERT INTO `pilot` VALUES (4, '1090', 1, '飞院学员');
INSERT INTO `pilot` VALUES (5, '3251', 1, '飞院学员');
INSERT INTO `pilot` VALUES (6, '6133', 1, '飞院学员');
INSERT INTO `pilot` VALUES (7, '2921', 1, '飞院学员');
INSERT INTO `pilot` VALUES (8, '6147', 6, '五星教员');
INSERT INTO `pilot` VALUES (9, '6101', 1, '飞院学员');
INSERT INTO `pilot` VALUES (10, '5505', 1, '飞院学员');
INSERT INTO `pilot` VALUES (11, '3517', 1, '飞院学员');
INSERT INTO `pilot` VALUES (12, '7520', 1, '飞院学员');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ud` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `context` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'gg', '<p>12312321312</p>');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NULL DEFAULT NULL,
  `status_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 1, '正常');
INSERT INTO `status` VALUES (2, 0, '不正常');

-- ----------------------------
-- Table structure for time
-- ----------------------------
DROP TABLE IF EXISTS `time`;
CREATE TABLE `time`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` float NULL DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of time
-- ----------------------------
INSERT INTO `time` VALUES (2, '1732', 6, '123', 'a');
INSERT INTO `time` VALUES (3, '1732', -4, '321', 'd');
INSERT INTO `time` VALUES (4, 'admin', 100, '', 'a');
INSERT INTO `time` VALUES (5, 'admin', 0, '', '');
INSERT INTO `time` VALUES (6, 'admin', 0, '', '');
INSERT INTO `time` VALUES (7, 'admin', 1.5, '123', 'a');
INSERT INTO `time` VALUES (8, 'admin', -1.5, '321', 'd');
INSERT INTO `time` VALUES (9, '6147', 0.4, '', 'a');
INSERT INTO `time` VALUES (10, 'admin', 0.4, '', 'a');
INSERT INTO `time` VALUES (11, '6101', 1, '', 'a');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qq` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` int(11) NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `is_atc` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'admin123456654321', 'admin@admin.cn', '10000', 1, 2, 12);
INSERT INTO `user` VALUES (2, '1731', 'Aa111111', 'congzheh@163.com', '1730583774', 1, 1, 6);
INSERT INTO `user` VALUES (3, '1732', 'Aa123456', '2177739866@qq.com', '2177739866', 1, 1, 0);
INSERT INTO `user` VALUES (4, '1090', 'Yu19781227', '42431251@qq.com', '42431251', 1, 1, 0);
INSERT INTO `user` VALUES (5, '3251', '98958889Cai', '3045106458@qq.com', '1411149939', 1, 1, 12);
INSERT INTO `user` VALUES (6, '6133', '6133', '1367072295@qq.com', '1367072295', 1, 1, 0);
INSERT INTO `user` VALUES (7, '2921', 'Zrzr110119', '3203296935@qq.com', '3203296935', 1, 1, 10);
INSERT INTO `user` VALUES (8, '6147', 'Yu20070512', '3218660753@qq.com', '3218660753', 1, 1, 12);
INSERT INTO `user` VALUES (9, '6101', 'Ldm20030815', '2540248119@qq.com', '2540248119', 1, 1, 10);
INSERT INTO `user` VALUES (10, '5505', '12345666Aa', 'abc@qq.com', '3045106458', 1, 1, 0);
INSERT INTO `user` VALUES (11, '3517', 'Zhj101010', '3097893696@163.com', '3097893696', 1, 1, 0);
INSERT INTO `user` VALUES (12, '7520', 'Ma18242351611', '1963702316@qq.com', '1963702316', 1, 1, 0);

-- ----------------------------
-- Table structure for yqm
-- ----------------------------
DROP TABLE IF EXISTS `yqm`;
CREATE TABLE `yqm`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yqm` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of yqm
-- ----------------------------
INSERT INTO `yqm` VALUES (8, 'sdfgfd', 0);
INSERT INTO `yqm` VALUES (9, 'pvb4esg98765', 1);
INSERT INTO `yqm` VALUES (10, '123456', 1);
INSERT INTO `yqm` VALUES (11, '123456', 1);
INSERT INTO `yqm` VALUES (12, '6147ass', 1);
INSERT INTO `yqm` VALUES (13, '2921ass', 0);
INSERT INTO `yqm` VALUES (14, '2921ass', 1);
INSERT INTO `yqm` VALUES (15, '61476147ass', 1);
INSERT INTO `yqm` VALUES (16, '6101ass', 1);
INSERT INTO `yqm` VALUES (17, '5505ass', 1);
INSERT INTO `yqm` VALUES (18, '3517ass', 1);
INSERT INTO `yqm` VALUES (19, '7520ass', 1);

-- ----------------------------
-- View structure for last_5_activities
-- ----------------------------
DROP VIEW IF EXISTS `last_5_activities`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `last_5_activities` AS select `activities`.`aid` AS `aid`,`activities`.`name` AS `name`,`activities`.`start_time` AS `start_time`,`activities`.`end_time` AS `end_time`,`activities`.`route` AS `route`,`activities`.`detail` AS `detail`,`activities`.`airport1` AS `airport1`,`activities`.`airport2` AS `airport2`,`activities`.`is_oneway` AS `is_oneway`,`activities`.`status` AS `status`,`activities`.`type` AS `type` from `activities` order by `activities`.`aid` desc limit 5;

-- ----------------------------
-- View structure for mob_view
-- ----------------------------
DROP VIEW IF EXISTS `mob_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `mob_view` AS select `mob`.`id` AS `id`,`mob`.`user` AS `user`,`mob`.`flight_callsign` AS `flight_callsign`,`mob`.`dep` AS `dep`,`mob`.`arr` AS `arr`,`mob`.`route` AS `route`,`mob`.`status` AS `status`,`mob`.`datef` AS `datef`,`mob`.`totime` AS `totime` from `mob` order by `mob`.`id` desc;

-- ----------------------------
-- View structure for user_activities
-- ----------------------------
DROP VIEW IF EXISTS `user_activities`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `user_activities` AS select `activities`.`name` AS `name`,`activities_bm`.`user` AS `user`,`activities_bm`.`aid` AS `aid`,`activities_bm`.`callsign` AS `callsign`,`activities_bm`.`status` AS `status`,`activities`.`route` AS `route`,`activities`.`airport1` AS `airport1`,`activities`.`airport2` AS `airport2`,`activities`.`start_time` AS `start_time`,`activities`.`end_time` AS `end_time`,`activities`.`detail` AS `detail`,`status`.`status_name` AS `status_name` from ((`activities` join `activities_bm` on((`activities`.`aid` = `activities_bm`.`aid`))) join `status` on((`activities_bm`.`status` = `status`.`status_id`)));

-- ----------------------------
-- View structure for user_time
-- ----------------------------
DROP VIEW IF EXISTS `user_time`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `user_time` AS select sum(`time`.`time`) AS `time_all`,`time`.`user` AS `user` from `time` group by `time`.`user` order by `time_all` desc;

-- ----------------------------
-- View structure for user_time_pm
-- ----------------------------
DROP VIEW IF EXISTS `user_time_pm`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `user_time_pm` AS select sum(`time`.`time`) AS `time_all`,`time`.`user` AS `user` from `time` group by `time`.`user` order by `time_all` desc limit 5;

-- ----------------------------
-- View structure for user_view
-- ----------------------------
DROP VIEW IF EXISTS `user_view`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `user_view` AS select `user`.`id` AS `id`,`user`.`user` AS `user`,`user`.`pwd` AS `pwd`,`user`.`email` AS `email`,`user`.`qq` AS `qq`,`user`.`active` AS `active`,`user`.`level` AS `level`,`user`.`is_atc` AS `is_atc`,`pilot`.`pilot_level_id` AS `pilot_level_id`,`pilot`.`pilot_level` AS `pilot_level`,`fsd_level`.`name` AS `atc_level_name`,`status`.`status_name` AS `status_name` from (((`user` join `pilot` on((`user`.`user` = `pilot`.`user`))) join `fsd_level` on((`user`.`is_atc` = `fsd_level`.`level`))) join `status` on((`user`.`active` = `status`.`status_id`))) order by `user`.`id`;

SET FOREIGN_KEY_CHECKS = 1;
