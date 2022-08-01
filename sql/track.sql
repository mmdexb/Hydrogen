/*
 Navicat Premium Data Transfer

 Source Server         : chbsim
 Source Server Type    : MySQL
 Source Server Version : 50650
 Source Host           : 124.221.210.233:3306
 Source Schema         : track

 Target Server Type    : MySQL
 Target Server Version : 50650
 File Encoding         : 65001

 Date: 02/08/2022 01:22:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for flight_route
-- ----------------------------
DROP TABLE IF EXISTS `flight_route`;
CREATE TABLE `flight_route`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `flight` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `flightid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lng` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dep` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `arr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `callsign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `speed` int(11) NULL DEFAULT NULL,
  `heading` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 104873 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
