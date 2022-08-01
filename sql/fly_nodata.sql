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

 Date: 02/08/2022 01:53:31
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
