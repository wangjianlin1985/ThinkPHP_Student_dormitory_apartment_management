/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : sushe_db

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2019-09-17 19:46:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `username` varchar(20) NOT NULL default '',
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('a', 'a');

-- ----------------------------
-- Table structure for `t_classinfo`
-- ----------------------------
DROP TABLE IF EXISTS `t_classinfo`;
CREATE TABLE `t_classinfo` (
  `classNo` varchar(20) NOT NULL COMMENT 'classNo',
  `className` varchar(20) NOT NULL COMMENT '班级名称',
  `fudaoyuan` varchar(20) NOT NULL COMMENT '辅导员',
  `addTime` varchar(20) default NULL COMMENT '创建时间',
  PRIMARY KEY  (`classNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_classinfo
-- ----------------------------
INSERT INTO `t_classinfo` VALUES ('BJ001', '计算机1班', '王斌', '2019-09-17 19:32:28');
INSERT INTO `t_classinfo` VALUES ('BJ002', '计算机2班', '王小虎', '2019-09-17 19:40:25');

-- ----------------------------
-- Table structure for `t_fangke`
-- ----------------------------
DROP TABLE IF EXISTS `t_fangke`;
CREATE TABLE `t_fangke` (
  `fangkeId` int(11) NOT NULL auto_increment COMMENT '访客ID',
  `fangkeName` varchar(20) NOT NULL COMMENT '访客姓名',
  `studentObj` varchar(20) NOT NULL COMMENT '受访学生',
  `guanxi` varchar(20) NOT NULL COMMENT '关系',
  `inTime` varchar(20) default NULL COMMENT '进入时间',
  `leaveTime` varchar(20) default NULL COMMENT '离开时间',
  `addTime` varchar(20) default NULL COMMENT '创建时间',
  PRIMARY KEY  (`fangkeId`),
  KEY `studentObj` (`studentObj`),
  CONSTRAINT `t_fangke_ibfk_1` FOREIGN KEY (`studentObj`) REFERENCES `t_student` (`studentNo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_fangke
-- ----------------------------
INSERT INTO `t_fangke` VALUES ('1', '王大亮', 'STU001', '父子', '2019-09-17 15:35:03', '2019-09-17 16:35:14', '2019-09-17 15:35:19');
INSERT INTO `t_fangke` VALUES ('2', '李英', 'STU002', '母女', '2019-09-17 14:42:26', '2019-09-17 15:42:33', '2019-09-17 14:42:39');

-- ----------------------------
-- Table structure for `t_student`
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student` (
  `studentNo` varchar(20) NOT NULL COMMENT 'studentNo',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `sex` varchar(4) NOT NULL COMMENT '性别',
  `studentPhoto` varchar(60) NOT NULL COMMENT '学生照片',
  `birthday` varchar(20) default NULL COMMENT '生日',
  `qq` varchar(20) NOT NULL COMMENT '联系qq',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `classObj` varchar(20) NOT NULL COMMENT '所在班级',
  `susheObj` int(11) NOT NULL COMMENT '所在宿舍',
  `addTime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`studentNo`),
  KEY `classObj` (`classObj`),
  KEY `susheObj` (`susheObj`),
  CONSTRAINT `t_student_ibfk_2` FOREIGN KEY (`susheObj`) REFERENCES `t_sushe` (`susheId`),
  CONSTRAINT `t_student_ibfk_1` FOREIGN KEY (`classObj`) REFERENCES `t_classinfo` (`classNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES ('STU001', '王雄', '男', 'upload/393059e9b516e78e7466b334c802ced1.jpg', '2019-09-16', '51491483', '13598130824', 'BJ001', '1', '2019-09-17 19:34:42');
INSERT INTO `t_student` VALUES ('STU002', '张晓玲', '女', 'upload/4b2f58232acded1167a12e6fe1a04c42.jpg', '2019-09-10', '193803902', '13982901242', 'BJ001', '1', '2019-09-17 19:39:58');

-- ----------------------------
-- Table structure for `t_sushe`
-- ----------------------------
DROP TABLE IF EXISTS `t_sushe`;
CREATE TABLE `t_sushe` (
  `susheId` int(11) NOT NULL auto_increment COMMENT '宿舍ID',
  `susheName` varchar(20) NOT NULL COMMENT '宿舍名称',
  `totalBedNum` int(11) NOT NULL COMMENT '床位总数',
  `usedBedNum` int(11) NOT NULL COMMENT '已用床位',
  `guanliyuan` varchar(20) NOT NULL COMMENT '宿舍管理员',
  `beizhu` varchar(600) default NULL COMMENT '宿舍备注',
  `addTime` varchar(20) default NULL COMMENT '创建时间',
  PRIMARY KEY  (`susheId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sushe
-- ----------------------------
INSERT INTO `t_sushe` VALUES ('1', '芙蓉8斋-224', '8', '6', '李文丽', '现代化设施，一应具有', '2019-09-17 19:34:03');
INSERT INTO `t_sushe` VALUES ('2', '银杏7斋-201室', '8', '8', '张晓光', '男生宿舍', '2019-09-17 19:41:23');
